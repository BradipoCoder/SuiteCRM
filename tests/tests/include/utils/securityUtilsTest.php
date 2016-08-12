<?php

require_once 'include/utils/security_utils.php';

/**
 * Class security_utilsTest
 */
class security_utilsTest extends PHPUnit_Framework_TestCase
{
    public function testquery_module_access_list()
    {
        $user = new User('1');
        
        require_once('modules/MySettings/TabController.php');
        $tabCtrl = new TabController();
        
        $display_tabs = $tabCtrl->get_user_tabs($user, 'display');
        $system_tabs = $tabCtrl->get_system_tabs();
        
        $actual = query_module_access_list($user);
        
        foreach($actual as $k => $v) {
            if(!in_array($k, [])) {
                $this->assertArrayHasKey($k, $display_tabs);
            }
            if(!in_array($k, [])) {
                $this->assertArrayHasKey($k, $system_tabs);
            }
        }
    }
    
    public function testquery_user_has_roles()
    {
        error_reporting(E_ERROR | E_PARSE);
        
        //execute the method and test it it returns expected contents
        
        $expected = '0';
        $actual = query_user_has_roles('1');
        $this->assertSame($expected, $actual);
    }
    
    public function testget_user_allowed_modules()
    {
        //execute the method and test it it returns expected contents
        
        $expected = array();
        $actual = get_user_allowed_modules('1');
        $this->assertSame($expected, $actual);
    }
    
    public function testget_user_disallowed_modules()
    {
        $expected = array(
            /*'Bugs' => 'Bugs',*/
            'ResourceCalendar' => 'ResourceCalendar',
            'AOBH_BusinessHours' => 'AOBH_BusinessHours',
            /*'AOR_Scheduled_Reports' => 'AOR_Scheduled_Reports',*/
            'SecurityGroups' => 'SecurityGroups',
        );
        
        $allowed = query_module_access_list(new User('1'));
        $actual = get_user_disallowed_modules('1', $allowed);
        
        print_r($actual);
        
        foreach ($expected as $k => $v) {
            $this->assertTrue(array_key_exists($k, $actual));
            $this->assertEquals($v, $actual[$k]);
        }
    }
    
    public function testquery_client_ip()
    {
        //test without setting any server parameters
        $this->assertSame(null, query_client_ip());
        
        //test with server params set
        $_SERVER['REMOTE_ADDR'] = '1.1.1.3';
        $this->assertSame('1.1.1.3', query_client_ip());
        
        $_SERVER['HTTP_FROM'] = '1.1.1.2';
        $this->assertSame('1.1.1.2', query_client_ip());
        
        $_SERVER['HTTP_CLIENT_IP'] = '1.1.1.1';
        $this->assertSame('1.1.1.1', query_client_ip());
    }
    
    public function testget_val_array()
    {
        //execute the method and test it it returns expected contents
        $tempArray = array('key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3');
        $expected = array('key1' => 'key1', 'key2' => 'key2', 'key3' => 'key3');
        $actual = get_val_array($tempArray);
        $this->assertSame($expected, $actual);
    }
}
