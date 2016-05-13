<?php


class ACLActionTest extends PHPUnit_Framework_TestCase
{
    public function testACLAction()
    {

        //execute the contructor and check for the Object type and type attribute
        $aclAction = new ACLAction();
        $this->assertInstanceOf('ACLAction', $aclAction);
        $this->assertInstanceOf('SugarBean', $aclAction);

        $this->assertAttributeEquals('ACLActions', 'module_dir', $aclAction);
        $this->assertAttributeEquals('ACLAction', 'object_name', $aclAction);
        $this->assertAttributeEquals('acl_actions', 'table_name', $aclAction);
        $this->assertAttributeEquals(TRUE, 'new_schema', $aclAction);
        $this->assertAttributeEquals(TRUE, 'disable_custom_fields', $aclAction);
    }

    public function testaddActions()
    {
        error_reporting(E_ERROR | E_PARSE);

        //take count of actions initially and then after method execution and test if action count increases
        $action_count = count(ACLAction::getDefaultActions());
        ACLAction::addActions('Test');
        $actual = ACLAction::getDefaultActions();
        $this->assertGreaterThan($action_count, count($actual));
    }

    public function testremoveActions()
    {

        //take count of actions initially and then after method execution and test if action count decreases
        $action_count = count(ACLAction::getDefaultActions());
        ACLAction::removeActions('Test');
        $actual = ACLAction::getDefaultActions();
        $this->assertLessThan($action_count, count($actual));
    }

    public function testAccessName()
    {
        $this->assertFalse(ACLAction::AccessName(''));

        $expected = translate("LBL_ACCESS_ALL", 'ACLActions');
        $this->assertEquals($expected, ACLAction::AccessName(90));
    }

    public function testgetDefaultActions()
    {
        $actual = ACLAction::getDefaultActions();
        $this->assertTrue(is_array($actual)); //verify that it returns an array
        foreach ($actual as $acl) {
            $this->assertInstanceOf('ACLAction', $acl);
        }
        $actual = ACLAction::getDefaultActions('module', 'list');
        $this->assertTrue(is_array($actual)); //verify that it returns an array
        foreach ($actual as $acl) {
            $this->assertInstanceOf('ACLAction', $acl);
            $this->assertEquals('list', $acl->name);
        }
    }

    public function testgetUserActions()
    {
        $result1 = ACLAction::getUserActions('1');
        $result2 = ACLAction::getUserActions('1', FALSE, 'Accounts');
        $result3 = ACLAction::getUserActions('1', FALSE, 'Accounts', 'list');

        //verify that all three results retunred are different
        $this->assertNotSame($result1, $result2);
        $this->assertNotSame($result1, $result3);
        $this->assertNotSame($result2, $result3);
    }

    public function testhasAccess()
    {
        $this->assertFalse(ACLAction::hasAccess()); //check with defaults
        $this->assertTrue(ACLAction::hasAccess(FALSE, FALSE, 90));  //access All with is owner false
        $this->assertTrue(ACLAction::hasAccess(TRUE, TRUE, 90)); //access All with is owner true
        $this->assertFalse(ACLAction::hasAccess(FALSE, FALSE, -98));// check access disabled
        $this->assertFalse(ACLAction::hasAccess(TRUE, TRUE, 89)); //check access enabled
        $this->assertTrue(ACLAction::hasAccess(TRUE, TRUE, 75)); //check owner access with is owner true
        $this->assertFalse(ACLAction::hasAccess(FALSE, TRUE, 75)); //check owner access with is owner false
    }

    public function testuserNeedsSecurityGroup()
    {
        $this->assertFalse(ACLAction::userNeedsSecurityGroup('1', '', ''));//test with empty module and action
        $this->assertFalse(
            ACLAction::userNeedsSecurityGroup('1', 'Accounts', 'list')
        ); //test with valid module and action
    }

    public function testuserHasAccess()
    {
        $this->assertFalse(ACLAction::userHasAccess('', '', '')); //test with empty module and action
        $this->assertTrue(
            ACLAction::userHasAccess('', 'Accounts', 'list')
        ); //test with e,pty user and valid module and action
        $this->assertTrue(ACLAction::userHasAccess('1', 'Accounts', 'list')); //test with valid User, module and action
        $this->assertTrue(
            ACLAction::userHasAccess('1', 'SecurityGroups', 'list')
        ); //test with valid User, module and action
        $this->assertTrue(ACLAction::userHasAccess('1', 'Users', 'list')); //test with valid User, module and action
    }

    public function testgetUserAccessLevel()
    {

        //tes for accoounts module with two different actions
        $this->assertEquals(90, ACLAction::getUserAccessLevel('1', 'Accounts', 'list'));
        $this->assertEquals(89, ACLAction::getUserAccessLevel('1', 'Accounts', 'access'));

        //tes for users module with two different actions
        $this->assertEquals(90, ACLAction::getUserAccessLevel('1', 'Users', 'list'));
        $this->assertEquals(89, ACLAction::getUserAccessLevel('1', 'Users', 'access'));
    }

    public function testuserNeedsOwnership()
    {

        //test with invalid values
        $this->assertFalse(ACLAction::userNeedsOwnership('', '', ''));

        //test with valid values for different module and action combination
        $this->assertFalse(ACLAction::userNeedsOwnership('1', 'Accounts', 'list'));
        $this->assertFalse(ACLAction::userNeedsOwnership('1', 'Accounts', 'delete'));
        $this->assertFalse(ACLAction::userNeedsOwnership('1', 'Users', 'delete'));
        $this->assertFalse(ACLAction::userNeedsOwnership('1', 'Users', 'list'));
    }

    public function testsetupCategoriesMatrix()
    {

        //preset required data
        $categories = array();
        $categories['Accounts']['module']['list'][] = 'list';
        $categories['Accounts']['module']['edit'][] = 'edit';


        $names_expected = array(
            'list' => translate("LBL_ACTION_LIST", 'ACLActions'),
            'edit' => translate("LBL_ACTION_EDIT", 'ACLActions')
        );

        $names_expected = array(
            'list' => translate("LBL_ACTION_LIST", 'ACLActions'),
            'edit' => translate("LBL_ACTION_EDIT", 'ACLActions')
        );

        $categories_expected = array(
            'Accounts' => array(
                'module' => array(
                    'list' => array(
                        'list',
                        'accessColor' => FALSE,
                        'accessName' => FALSE,
                        'accessLabel' => FALSE,
                        'accessOptions' => array(
                            90 => translate("LBL_ACCESS_ALL", 'ACLActions'),
                            80 => translate("LBL_ACCESS_GROUP", 'ACLActions'),
                            75 => translate("LBL_ACCESS_OWNER", 'ACLActions'),
                            0 => translate("LBL_ACCESS_DEFAULT", 'ACLActions'),
                            -99 => translate("LBL_ACCESS_NONE", 'ACLActions')
                        )
                    ),
                    'edit' => array(
                        'edit',
                        'accessColor' => FALSE,
                        'accessName' => FALSE,
                        'accessLabel' => FALSE,
                        'accessOptions' => array(
                            90 => translate("LBL_ACCESS_ALL", 'ACLActions'),
                            80 => translate("LBL_ACCESS_GROUP", 'ACLActions'),
                            75 => translate("LBL_ACCESS_OWNER", 'ACLActions'),
                            0 => translate("LBL_ACCESS_DEFAULT", 'ACLActions'),
                            -99 => translate("LBL_ACCESS_NONE", 'ACLActions')
                        )
                    ),
                ),
            ),
        );

        //execute the method and verify that it retunrs expected results
        $result = ACLAction::setupCategoriesMatrix($categories);
        $this->assertSame($names_expected, $result);
        $this->assertSame($categories, $categories_expected);
    }

    public function testtoArray()
    {
        $aclAction = new ACLAction();

        //wihout any fields set
        $expected = array('id' => NULL, 'aclaccess' => NULL);
        $actual = $aclAction->toArray();
        $this->assertSame($expected, $actual);

        //with fileds pre populated
        $aclAction->populateFromRow(array('id' => '1234', 'aclaccess' => '9999'));
        $expected = array('id' => '1234', 'aclaccess' => '9999');
        $actual = $aclAction->toArray();
        $this->assertSame($expected, $actual);
    }

    public function testfromArray()
    {
        $aclAction = new ACLAction();
        $arr = array('id' => '1234', 'name' => 'test');

        //execute the method and verify that it retunrs expected results
        $aclAction->fromArray($arr);
        $this->assertSame($aclAction->id, '1234');
        $this->assertSame($aclAction->name, 'test');
    }

    public function testclearSessionCache()
    {
        $aclAction = new ACLAction();

        //execute the method and verify that it unsets the session cache
        $aclAction->clearSessionCache();
        $this->assertFalse(isset($_SESSION['ACL']));
    }
}
