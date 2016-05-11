<?php
if (!defined('sugarEntry')) define('sugarEntry', true);
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/


/**
 * SugarWebServiceImplv4_1.php
 *
 * This class is an implementation class for all the web services.  Version 4_1 adds limit/off support to the
 * get_relationships function.  We also added the sync_get_modified_relationships function call from version
 * one to facilitate querying for related meetings/calls contacts/users records.
 *
 */
require_once('service/v4_1/SugarWebServiceImplv4_1.php');
require_once('service/quickcrm/SugarWebServiceUtilquickcrm.php');
if (file_exists('modules/KReports/Plugins/Presentation/standardview/standardviewinclude.php')){
	include('modules/KReports/Plugins/Presentation/standardview/standardviewinclude.php');}
if (file_exists('modules/AOR_Reports/aor_utils.php')){
	include('modules/AOR_Reports/aor_utils.php');}

class SugarWebServiceImplquickcrm extends SugarWebServiceImplv4_1
{

    /**
     * Class Constructor Object
     *
     */
    public function __construct()
    {
        self::$helperObject = new SugarWebServiceUtilquickcrm();
    }

    public function login($user_auth, $application, $name_value_list = array()){
		global $db,$sugar_config;
		$res=parent::login($user_auth, $application, $name_value_list);
		if ($res && isset($res['name_value_list']) && isset($_SESSION['user_id'])){
			$user_id= $_SESSION['user_id'];



			$qry="select id from qcrm_users where user_id = '$user_id'";
			$authorized = $db->getOne($qry);



			if ($authorized){
				$res['name_value_list']['fulluser'] = true;
				require_once("modules/ACLRoles/ACLRole.php");
				$acl_role_obj = new ACLRole();
				$res['name_value_list']['roles'] = $acl_role_obj->getUserRoles($user_id,True); // grab a list of the current user's roles
				if (file_exists('modules/SecurityGroups/SecurityGroup.php')){
					require_once('modules/SecurityGroups/SecurityGroup.php');
					$group= new SecurityGroup();
					$res['name_value_list']['teams'] = $group->getUserSecurityGroups($user_id);				
				}
				else {
					$res['name_value_list']['teams'] = false;								
				}
			}
			else {
				$res['name_value_list']['fulluser'] = false;				
				$res['name_value_list']['roles'] = false;
				$res['name_value_list']['teams'] = false;
			}
		}
		return $res;
	}
	
    function get_entry_list($session, $module_name, $query, $order_by,$offset, $select_fields, $link_name_to_fields_array, $max_results, $deleted, $favorites = false ){

        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_entry_list');
        global  $beanList, $beanFiles;
        $error = new SoapError();
        $using_cp = false;
        if($module_name == 'CampaignProspects'){
            $module_name = 'Prospects';
            $using_cp = true;
        }
        if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
            $GLOBALS['log']->error('End: SugarWebServiceImpl->get_entry_list - FAILED on checkSessionAndModuleAccess');
            return;
        } // if

        if (!self::$helperObject->checkQuery($error, $query, $order_by)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_entry_list');
        	return;
        } // if

        // If the maximum number of entries per page was specified, override the configuration value.
        if($max_results > 0){
            global $sugar_config;
            $sugar_config['list_max_entries_per_page'] = $max_results;
        } // if

        $class_name = $beanList[$module_name];
        require_once($beanFiles[$class_name]);
        $seed = new $class_name();

        if (!self::$helperObject->checkACLAccess($seed, 'list', $error, 'no_access')) {
            $GLOBALS['log']->error('End: SugarWebServiceImpl->get_entry_list - FAILED on checkACLAccess');
            return;
        } // if

        if($query == ''){
            $where = '';
        } // if
        if($offset == '' || $offset == -1){
            $offset = 0;
        } // if
        if($deleted){
            $deleted = -1;
        }
        if($using_cp){
            $response = $seed->retrieveTargetList($query, $select_fields, $offset,-1,-1,$deleted);
        }else
        {
            // tweak for low performance servers
			if (isset($sugar_config['quickcrm_norelatesearch']) && $sugar_config['quickcrm_norelatesearch']==true){
				$response = self::$helperObject->get_data_list($seed,$order_by, $query, $offset,-1,-1,$deleted,$favorites);
			}
			else {
				$response = self::$helperObject->get_data_list_with_relate($seed,$order_by, $query, $select_fields,$offset,-1,-1,$deleted,$favorites);
			}	
        } // else
        $list = $response['list'];

        $output_list = array();
        $linkoutput_list = array();

        foreach($list as $value) {
            if(isset($value->emailAddress)){
                $value->emailAddress->handleLegacyRetrieve($value);
            } // if
            $value->fill_in_additional_detail_fields();

            $output_list[] = self::$helperObject->get_return_value_for_fields($value, $module_name, $select_fields);
            if(!empty($link_name_to_fields_array)){
                $linkoutput_list[] = self::$helperObject->get_return_value_for_link_fields($value, $module_name, $link_name_to_fields_array);
            }
        } // foreach

        // Calculate the offset for the start of the next page
        $next_offset = $offset + sizeof($output_list);

		$returnRelationshipList = array();
		foreach($linkoutput_list as $rel){
			$link_output = array();
			foreach($rel as $row){
				$rowArray = array();
				foreach($row['records'] as $record){
					$rowArray[]['link_value'] = $record;
				}
				$link_output[] = array('name' => $row['name'], 'records' => $rowArray);
			}
			$returnRelationshipList[]['link_list'] = $link_output;
		}

		$totalRecordCount = $response['row_count'];
        if( !empty($sugar_config['disable_count_query']) )
            $totalRecordCount = -1;

        $GLOBALS['log']->info('End: SugarWebServiceImpl->get_entry_list - SUCCESS');
        return array('result_count'=>sizeof($output_list), 'total_count' => $totalRecordCount, 'next_offset'=>$next_offset, 'entry_list'=>$output_list, 'relationship_list' => $returnRelationshipList);
    } // fn
	
    function Qget_entry_list($session, $module_name, $query, $order_by,$offset, $select_fields, $link_name_to_fields_array, $max_results, $deleted, $favorites = false ){
		// does not return name_value_list but just values

        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_entry_list');
        global  $beanList, $beanFiles;
        $error = new SoapError();
        $using_cp = false;
        if($module_name == 'CampaignProspects'){
            $module_name = 'Prospects';
            $using_cp = true;
        }
        if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
            $GLOBALS['log']->error('End: SugarWebServiceImpl->get_entry_list - FAILED on checkSessionAndModuleAccess');
            return;
        } // if

        if (!self::$helperObject->checkQuery($error, $query, $order_by)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_entry_list');
        	return;
        } // if

        // If the maximum number of entries per page was specified, override the configuration value.
        if($max_results > 0){
            global $sugar_config;
            $sugar_config['list_max_entries_per_page'] = $max_results;
        } // if

        $class_name = $beanList[$module_name];
        require_once($beanFiles[$class_name]);
        $seed = new $class_name();

        if (!self::$helperObject->checkACLAccess($seed, 'list', $error, 'no_access')) {
            $GLOBALS['log']->error('End: SugarWebServiceImpl->get_entry_list - FAILED on checkACLAccess');
            return;
        } // if

        if($query == ''){
            $where = '';
        } // if
        if($offset == '' || $offset == -1){
            $offset = 0;
        } // if
        if($deleted){
            $deleted = -1;
        }
        if($using_cp){
            $response = $seed->retrieveTargetList($query, $select_fields, $offset,-1,-1,$deleted);
        }else
        {
            // tweak for low performance servers
			if (isset($sugar_config['quickcrm_norelatesearch']) && $sugar_config['quickcrm_norelatesearch']==true){
				$response = self::$helperObject->get_data_list($seed,$order_by, $query, $offset,-1,-1,$deleted,$favorites);
			}
			else {
				$response = self::$helperObject->get_data_list_with_relate($seed,$order_by, $query, $select_fields,$offset,-1,-1,$deleted,$favorites);
			}	
        } // else
        $list = $response['list'];

        $output_list = array();
        $linkoutput_list = array();

		//$list_ids = array();
        foreach($list as $value) {
        	// manage duplicate ids
        	//if (in_array($value->id,$list_ids)) continue;
        	//$list_ids[] = $value->id;

            if(isset($value->emailAddress)){
                $value->emailAddress->handleLegacyRetrieve($value);
            } // if
            //$value->fill_in_additional_detail_fields();

            $values = self::$helperObject->Qget_return_value_for_fields($value, $module_name, $select_fields);
			if($module_name == 'AOS_Quotes' || $module_name == 'AOS_Invoices' || $module_name == 'AOS_Contracts'){
				$focus = BeanFactory::getBean($module_name, $value->id);
				$details = self::$helperObject->AOSgetLineItems($focus,false);
				$values['name_value_list']['lineitems']=json_encode($details['lineitems']);
				$values['name_value_list']['groups']=json_encode($details['groups']);
			}
            $output_list[] = $values;
			
            if(!empty($link_name_to_fields_array)){
                $linkoutput_list[] = self::$helperObject->Qget_return_value_for_link_fields($value, $module_name, $link_name_to_fields_array);
            }
        } // foreach

        // Calculate the offset for the start of the next page
        $next_offset = $offset + sizeof($output_list);

		$returnRelationshipList = array();
		foreach($linkoutput_list as $rel){
			$link_output = array();
			foreach($rel as $row){
				$rowArray = array();
				foreach($row['records'] as $record){
					$rowArray[]['link_value'] = $record;
				}
				$link_output[] = array('name' => $row['name'], 'records' => $rowArray);
			}
			$returnRelationshipList[]['link_list'] = $link_output;
		}

		$totalRecordCount = $response['row_count'];
        if( !empty($sugar_config['disable_count_query']) )
            $totalRecordCount = -1;

        $GLOBALS['log']->info('End: SugarWebServiceImpl->get_entry_list - SUCCESS');
        return array('result_count'=>sizeof($output_list), 'total_count' => $totalRecordCount, 'next_offset'=>$next_offset, 'entry_list'=>$output_list, 'relationship_list' => $returnRelationshipList);
    } // fn

    function AOSget_entry($session, $module_name, $id,$select_fields, $link_name_to_fields_array,$track_view = FALSE)
    {
        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->AOSget_entry');
        $res = self::get_entries($session, $module_name, array($id), $select_fields, $link_name_to_fields_array, $track_view);
		if ($id != '' && $res && isset($res['entry_list'])){
			$focus = BeanFactory::getBean($module_name, $id);
			$details = self::$helperObject->AOSgetLineItems($focus,true);
			if($focus->id != '') {
				$res['entry_list'][0]['name_value_list']['lineitems']=$details['lineitems'];
				$res['entry_list'][0]['name_value_list']['groups']=$details['groups'];
			}
		}
		
        $GLOBALS['log']->info('end: SugarWebServiceImpl->AOSget_entry');
		return $res;
	}

    function set_entry($session,$module_name, $name_value_list, $track_view = FALSE){
		// FIX ISSUE WITH NOTIFICATIONS AND DATE/TIME
		// FIX ISSUE WITH SECURITY SUITE INHERIT
        global  $beanList, $beanFiles, $current_user, $sugar_config;
        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->set_entry');
        if (self::$helperObject->isLogLevelDebug()) {
            $GLOBALS['log']->debug('SoapHelperWebServices->set_entry - input data is ' . var_export($name_value_list, true));
        } // if
        $error = new SoapError();
        if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'write', 'no_access', $error)) {
            $GLOBALS['log']->info('End: SugarWebServiceImpl->set_entry');
            return;
        } // if
		
		// fix bug with logic hooks manipulating date/time
		
		$_SESSION[$current_user->user_name.'_PREFERENCES']['global']['datef'] = 'Y-m-d';		
		$_SESSION[$current_user->user_name.'_PREFERENCES']['global']['timef'] = 'H:i';		
		
        $class_name = $beanList[$module_name];
        require_once($beanFiles[$class_name]);
        $seed = new $class_name();
        foreach($name_value_list as $name=>$value){
            if(is_array($value) &&  $value['name'] == 'id'){
				if (isset($value['name'])){
					$seed->retrieve($value['value']);
					break;
				}
            }else if($name === 'id' ){
                $seed->retrieve($value);
            }
        }

        $return_fields = array();
		$parent_type='';
		$parent_id='';
        foreach($name_value_list as $name=>$value){
            if($module_name == 'Users' && !empty($seed->id) && ($seed->id != $current_user->id) && $name == 'user_hash'){
                continue;
            }
            if(!empty($seed->field_name_map[$name]['sensitive'])) {
                    continue;
            }

            if(!is_array($value)){
                $seed->$name = $value;
                $return_fields[] = $name;
            }else{
				if (isset($value['name'])){
					$seed->$value['name'] = $value['value'];
					$return_fields[] = $value['name'];
					// manage security suite Inherit parent
					if ($value['name'] =='parent_type') {
						$parent_type = $value['value'];
					}
					elseif ($value['name'] =='parent_id') {
						$parent_id = $value['value'];
					}
				}
            }
        }
		global $sugar_config;
		if (empty($seed->id) && isset($sugar_config['securitysuite_inherit_parent']) && $sugar_config['securitysuite_inherit_parent'] == true && $parent_id != '' && $parent_type != ''){
			$_REQUEST['relate_to']=$parent_type;
			$_REQUEST['relate_id']=$parent_id;
		}
        if (!self::$helperObject->checkACLAccess($seed, 'Save', $error, 'no_access') || ($seed->deleted == 1  && !self::$helperObject->checkACLAccess($seed, 'Delete', $error, 'no_access'))) {
            $GLOBALS['log']->info('End: SugarWebServiceImpl->set_entry');
            return;
        } // if
// FIX NS-TEAM
// ADD NOTIFICATION SUPPORT
		if (substr($module_name,0,4) != 'QCRM_') 
			$seed->notify_inworkflow = true;
// END FIX NS-TEAM
        $seed->save(self::$helperObject->checkSaveOnNotify());

        $return_entry_list = self::$helperObject->get_name_value_list_for_fields($seed, $return_fields );

        if($seed->deleted == 1){
            $seed->mark_deleted($seed->id);
        }

        if($track_view){
            self::$helperObject->trackView($seed, 'editview');
        }

        $GLOBALS['log']->info('End: SugarWebServiceImpl->set_entry');
        return array('id'=>$seed->id, 'entry_list' => $return_entry_list);
    } // fn

	
    function AOSset_entry($session,$module_name, $name_value_list, $track_view = FALSE){
		// Line items are retrieved from post data
        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->set_entry');
		
        foreach($name_value_list as $name=>$value){
            if(!is_array($value)){
            }else{
				if (isset($value['name']) && $value['name']=='lineitems'){
					$lineitems=$value['value'];
					foreach($lineitems as $f=>$val){
						$_POST[$f]=$val;
					}
				}
            }
        }
		
        $GLOBALS['log']->info('End: SugarWebServiceImpl->AOSset_entry');
        return self::set_entry($session,$module_name, $name_value_list, $track_view = FALSE);
    } // fn

    function AOSOLset_entry($session,$module_name, $name_value_list, $track_view = FALSE){
		// Line items are retrieved from post data
        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->set_entry');
		
		$group_ids=array();
		$item_ids=array();
		$lineitems=array();
		$groups=array();
		$alllines=array();
		$current_id="";
        foreach($name_value_list as $name=>$value){
            if(!is_array($value)){
            }else{
				if (isset($value['name']) && $value['name']=='lineitems'){
					$lineitems=$value['value'];
				}
				else if (isset($value['name']) && $value['name']=='groups'){
					$groups=$value['value'];
				}
				else if (isset($value['name']) && $value['name']=='id'){
					$current_id=$value['value'];
				}
            }
        }
		foreach ($groups as $idx => $group){
			if (isset($group['deleted']) && $group['deleted']=="1") continue;
			$group_ids[]= $group['id'];
			if (isset($group['new_with_id']) && $group['new_with_id']=="1"){
				$newgroup = new AOS_Line_Item_Groups();
				$newgroup->id=$group['id'];
				$newgroup->new_with_id =true;
				$newgroup->save(false);
			}
			foreach ($group as $field => $val){
				if ($field == 'new_with_id') continue;
				$key='group_'.$field;
				if (!isset($alllines[$key])) $alllines[$key]=array();
				$alllines[$key][]=$val;
			}
		}
		foreach ($lineitems as $idx => $item){
			if (isset($item['deleted']) && $item['deleted']=="1") continue;
			$item_ids[]= $item['id'];
			if (isset($item['new_with_id']) && $item['new_with_id']=="1"){
				$newitem = new AOS_Products_Quotes();
				$newitem->id=$item['id'];
				$newitem->new_with_id =true;
				$newitem->save(false);
			}
			foreach ($item as $field => $val){
				if ($field == 'new_with_id') continue;
				$key = ($item['product_id']=='0'?'service_':'product_').$field;			
				if (!isset($alllines[$key]))$alllines[$key]=array();
				$alllines[$key][]=$val;
			}
		}
		
		// delete old groups and items
		$focus = new AOS_Line_Item_Groups();
        $sql = "SELECT lig.id FROM aos_line_item_groups lig WHERE lig.parent_type = '".$module_name."' AND lig.parent_id = '".$current_id."' AND lig.deleted = 0";
        $result = $focus->db->query($sql);
        while ($row = $focus->db->fetchByAssoc($result)) {
            $grp_id=$row['id'];
			if (!in_array($grp_id,$group_ids)){
				$focus->mark_deleted($grp_id);
			}
		}
		$focus = new AOS_Products_Quotes();
        $sql = "SELECT lig.id FROM aos_products_quotes lig WHERE lig.parent_type = '".$module_name."' AND lig.parent_id = '".$current_id."' AND lig.deleted = 0";
        $result = $focus->db->query($sql);
        while ($row = $focus->db->fetchByAssoc($result)) {
            $grp_id=$row['id'];
			if (!in_array($grp_id,$item_ids)){
				$focus->mark_deleted($grp_id);
			}
		}
		
		// set post data for module save
		foreach ($alllines as $key => $val){
			$_POST[$key]=$val;
		}
		
        $GLOBALS['log']->info('End: SugarWebServiceImpl->AOSset_entry');
        return self::set_entry($session,$module_name, $name_value_list, $track_view = FALSE);
    } // fn
	
    function get_relationships($session, $module_name, $module_id, $link_field_name, $related_module_query, $related_fields, $related_module_link_name_to_fields_array, $deleted, $order_by = '', $offset = 0, $limit = false)
    {
        // FIXES ISSUES WITH EMAILS AND SORT ORDER
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_relationships '.$link_field_name);
        //self::$helperObject = new SugarWebServiceUtilv4_1();
        global  $beanList, $beanFiles, $sugar_config, $current_user;
    	$error = new SoapError();

    	if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
    		return;
    	} // if

    	$mod = BeanFactory::getBean($module_name, $module_id);

        if (!self::$helperObject->checkQuery($error, $related_module_query, $order_by)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
        	return;
        } // if

        if (!self::$helperObject->checkACLAccess($mod, 'DetailView', $error, 'no_access')) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
        	return;
        } // if

        $output_list = array();
    	$linkoutput_list = array();
		
		if ($module_name=='Accounts' && $link_field_name == 'emails'){
			$result = self::$helperObject->getAccountsEmailRelationshipResults($mod, $link_field_name, $related_fields, $related_module_query, $order_by, $offset, $limit);
		}
		else {
			// get all the related modules data.
			$result = self::$helperObject->getRelationshipResults($mod, $link_field_name, $related_fields, $related_module_query, $order_by, $offset, $limit);

		if (method_exists($mod,'get_unlinked_email_query') && $link_field_name == 'emails'){
				// append unlinked mails
				$result = self::$helperObject->getEmailRelationshipResults($result,$mod, $link_field_name, $related_fields, $related_module_query, $order_by, $offset, $limit);
			}
		}
        if (self::$helperObject->isLogLevelDebug()) {
    		$GLOBALS['log']->debug('SoapHelperWebServices->get_relationships - return data for getRelationshipResults is ' . var_export($result, true));
        } // if
    	$total_count = 0;
		$added=0;
    	if ($result) {

    		$list = $result['rows'];
    		$filterFields = $result['fields_set_on_rows'];
			$check_group = false; 
			
			if (sizeof($list) > 0) {
    			$submodulename = $mod->$link_field_name->getRelatedModuleName();
                $submoduletemp = BeanFactory::getBean($submodulename);
				
				if (isset($sugar_config['securitysuite_version'])){
					// getBean doesn't manage Security Groups. We need to filter results
					if(ACLController::requireSecurityGroup($submodulename, 'view')){
						$check_group = true;
						$allowed = array();

						// rebuild list so that security group is taken into account
						$list_ids = array();
						foreach($list as $row) {
							$list_ids[] = $row['id'];
						}	
						$query =  $submoduletemp->table_name . ".id IN ('" .implode("','",$list_ids). "')";
						$response = self::$helperObject->get_data_list($submoduletemp,"", $query, 0,-1,-1,$deleted,false);
						if ($response && isset($response['list'])){
							foreach($response['list'] as $value) {
								$allowed[] = $value->id;
							} 
						}
					}	
				}
			
    			foreach($list as $row) {
					if ($check_group && !in_array($row['id'],$allowed)) continue;
                	$total_count++;
					if ($link_field_name != 'emails'){ // for emails, offset and limit are managed in the app
						if ($total_count < $offset+1) continue;
						if ($limit && $added == $limit) break;
					}
					$added++;
					
   					$submoduleobject = @clone($submoduletemp);
    				// set all the database data to this object
    				foreach ($filterFields as $field) {
    					$submoduleobject->$field = $row[$field];
    				} // foreach
    				if (isset($row['id'])) {
    					$submoduleobject->id = $row['id'];
    				}
    				$output_list[] = self::$helperObject->get_return_value_for_fields($submoduleobject, $submodulename, $filterFields);
    				if (!empty($related_module_link_name_to_fields_array)) {
    					$linkoutput_list[] = self::$helperObject->get_return_value_for_link_fields($submoduleobject, $submodulename, $related_module_link_name_to_fields_array);
    				} // if

    			} // foreach
    		}

    	} // if

    	$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
    	return array('entry_list'=>$output_list, 'relationship_list' => $linkoutput_list,'total_count'=> $total_count);
    }
	
    function Qget_relationships($session, $module_name, $module_id, $link_field_name, $related_module_query, $related_fields, $related_module_link_name_to_fields_array, $deleted, $order_by = '', $offset = 0, $limit = false)
    {
        // FIXES ISSUES WITH EMAILS AND SORT ORDER
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_relationships '.$link_field_name);
        //self::$helperObject = new SugarWebServiceUtilv4_1();
        global  $beanList, $beanFiles;
    	$error = new SoapError();

    	if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
    		return;
    	} // if

    	$mod = BeanFactory::getBean($module_name, $module_id);

        if (!self::$helperObject->checkQuery($error, $related_module_query, $order_by)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
        	return;
        } // if

        if (!self::$helperObject->checkACLAccess($mod, 'DetailView', $error, 'no_access')) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
        	return;
        } // if

        $output_list = array();
    	$linkoutput_list = array();
		
		if ($module_name=='Accounts' && $link_field_name == 'emails'){
			$result = self::$helperObject->getAccountsEmailRelationshipResults($mod, $link_field_name, $related_fields, $related_module_query, $order_by, $offset, $limit);
		}
		else {
			// get all the related modules data.
			$result = self::$helperObject->QgetRelationshipResults($mod, $link_field_name, $related_fields, $related_module_query, $order_by, $offset, $limit);

		if (method_exists($mod,'get_unlinked_email_query') && $link_field_name == 'emails'){
				// append unlinked mails
				$result = self::$helperObject->getEmailRelationshipResults($result,$mod, $link_field_name, $related_fields, $related_module_query, $order_by, $offset, $limit);
			}
		}
        if (self::$helperObject->isLogLevelDebug()) {
    		$GLOBALS['log']->debug('SoapHelperWebServices->get_relationships - return data for getRelationshipResults is ' . var_export($result, true));
        } // if
    	if ($result) {

    		$list = $result['rows'];
    		$filterFields = $result['fields_set_on_rows'];

    		if (sizeof($list) > 0) {
    			// get the related module name and instantiate a bean for that
    			$submodulename = $mod->$link_field_name->getRelatedModuleName();
                $submoduletemp = BeanFactory::getBean($submodulename);

    			foreach($list as $row) {
    				$submoduleobject = @clone($submoduletemp);
    				// set all the database data to this object
    				foreach ($filterFields as $field) {
    					$submoduleobject->$field = $row[$field];
    				} // foreach
    				if (isset($row['id'])) {
    					$submoduleobject->id = $row['id'];
    				}
    				$output_list[] = self::$helperObject->get_return_value_for_fields($submoduleobject, $submodulename, $filterFields);
    				if (!empty($related_module_link_name_to_fields_array)) {
    					$linkoutput_list[] = self::$helperObject->get_return_value_for_link_fields($submoduleobject, $submodulename, $related_module_link_name_to_fields_array);
    				} // if

    			} // foreach
    		}

    	} // if

    	$GLOBALS['log']->info('End: SugarWebServiceImpl->get_relationships');
    	return array('entry_list'=>$output_list, 'relationship_list' => $linkoutput_list);
    }
	
    function get_chart($session, $id, $chart_id=False, $width=False, $height=False,$language="")
    {
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_chart');
		global $current_language,$app_list_strings;
		if ($language=="") $language=$current_language;
		else $current_language=$language;
		$app_list_strings = return_app_list_strings_language($language); // required for AOR. They are not initializez with web services.
		
		$report=BeanFactory::getBean('AOR_Reports',$id);
        if ($report->retrieve($id) == null){
			return;
		}

        $result = $report->db->query($report->build_report_query());
        $data = array();
        while($row = $report->db->fetchByAssoc($result, false))
        {
            $data[] = $row;
        }
        $fields = $report->getReportFields();
		
		$x = 0;
		$charts = array();
        foreach($report->get_linked_beans('aor_charts','AOR_Charts') as $chart){
			if (!$chart_id || !$chart_id == '' || $chart_id == $chart->id){
				$charts[] = array('id' => $chart->id,'chart'=> self::$helperObject->buildChartHTMLPChart($chart,$data,$fields,$x));
				$x++;
			}
        }

		return array('entry_list'=>array('charts' => $charts,'count' => $x), 'relationship_list' => array());
        $GLOBALS['log']->info('end: SugarWebServiceImpl->get_chart');
    }

    function get_report($session, $id, $offset, $max_results,$language="")
    {
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_report');
		global $current_language,$app_list_strings,$beanList;
		if ($language=="") $language=$current_language;
		else $current_language=$language;
		$app_list_strings = return_app_list_strings_language($language); // required for AOR. They are not initializez with web services.

		$report=BeanFactory::getBean('AOR_Reports',$id);
        if ($report->retrieve($id) == null){
			return;
		}
		
        $max_rows = $max_results;
		$links = false;
		$group_value = '';
        $total_rows = 0;

        $report_sql = $report->build_report_query($group_value);
        $count_sql = explode('ORDER BY', $report_sql);
        $count_query = 'SELECT count(*) c FROM ('.$count_sql[0].') as n';

        // We have a count query.  Run it and get the results.
        $result = $report->db->query($count_query);
        $assoc = $report->db->fetchByAssoc($result);
        if(!empty($assoc['c']))
        {
            $total_rows = $assoc['c'];
        }
		
		$header=array();
		$values=array();
        if($offset >= 0){
            $start = 0;
            $end = 0;
            $previous_offset = 0;
            $next_offset = 0;
            $last_offset = 0;

            if($total_rows > 0){
                $start = $offset +1;
                $end = (($offset + $max_rows) < $total_rows) ? $offset + $max_rows : $total_rows;
                $previous_offset = ($offset - $max_rows) < 0 ? 0 : $offset - $max_rows;
                $next_offset = $offset + $max_rows;
                $last_offset = $max_rows * floor($total_rows / $max_rows);
            }

        } else{
        }

        $sql = "SELECT id FROM aor_fields WHERE aor_report_id = '".$report->id."' AND deleted = 0 ORDER BY field_order ASC";
        $result = $report->db->query($sql);

        $fields = array();
        $i = 0;
        while ($row = $report->db->fetchByAssoc($result)) {
            $field = new AOR_Field();
            $field->retrieve($row['id']);

            $path = unserialize(base64_decode($field->module_path));

            $field_bean = new $beanList[$report->report_module]();

            $field_module = $report->report_module;
            $field_alias = $field_bean->table_name;
            if($path[0] != $report->report_module){
                foreach($path as $rel){
                    if(empty($rel)){
                        continue;
                    }
                    $field_module = getRelatedModule($field_module,$rel);
                    $field_alias = $field_alias . ':'.$rel;
                }
            }
            $label = str_replace(' ','_',$field->label).$i;
            $fields[$label]['field'] = $field->field;
            $fields[$label]['label'] = $field->label;
            $fields[$label]['display'] = $field->display && !$field->group_display;
            $fields[$label]['function'] = $field->field_function;
            $fields[$label]['module'] = $field_module;
            $fields[$label]['alias'] = $field_alias;
            $fields[$label]['link'] = $field->link;
            $fields[$label]['total'] = $field->total;


            if($fields[$label]['display']){
				$header[]=$field->label;
            }
            ++$i;
        }

        if($offset >= 0){
            $result = $report->db->limitQuery($report_sql, $offset, $max_rows);
        } else {
            $result = $report->db->query($report_sql);
        }

        $totals = array();
        while ($row = $report->db->fetchByAssoc($result)) {
			$table_row=array();
            foreach($fields as $name => $att){
                if($att['display']){
                    if($att['link'] && $links){
                        // $html .= "<a href='index.php?module=".$att['module']."&action=DetailView&record=".$row[$att['alias'].'_id']."'>";
                    }

                    $currency_id = isset($row[$att['alias'].'_currency_id']) ? $row[$att['alias'].'_currency_id'] : '';

                    switch ($att['function']){
                        case 'COUNT':
                        //case 'SUM':
							$table_row[]=$row[$name];
                            break;
                        default:
							//$table_row[]=$row[$name];
                            $table_row[]= getModuleField($att['module'], $att['field'], $att['field'], 'DetailView',$row[$name],'',$currency_id);
                            break;
                    }
                    if($att['total']){
                        $totals[$name][] = $row[$name];
                    }
                    //if($att['link'] && $links) $html .= "</a>";
                }
            }
			$values[]=$table_row;
        }
        // $html .= $report->getTotalHtml($fields,$totals);
			
		return array('entry_list'=>array('name'=> $report->name,'previous_offset' => $previous_offset,'next_offset' => $next_offset,'last_offset' => $last_offset,'values' => $values,'header' => $header,'count' => $total_rows), 'relationship_list' => array());
        $GLOBALS['log']->info('end: SugarWebServiceImpl->get_report');
    }

    function get_Kreport($session, $id, $offset=0, $max_results=0,$language="")
    {
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_Kreport');
		global $db,$current_language,$app_list_strings,$beanList;
		if ($language=="") $language=$current_language;
		else $current_language=$language;
		$app_list_strings = return_app_list_strings_language($language); 

		$report=BeanFactory::getBean('KReports',$id);
        if ($report->retrieve($id) == null){
			return;
		}
		$reportView=new kreportpresentationstandard();
		$columns = $reportView->buildColumnArray($report);
		$reportParams = array('noFormat' => true, 'start' => $offset, 'limit' => $max_results);
		
      $totalArray = array();
      $totalArray['records'] = $report->getSelectionResults($reportParams, '0', false);

      // rework ... load from kQuery fieldArray
      $fieldArr = array();

      //2012-12-01 added link array to add to metadata for buiilding links in the frontend
      $linkArray = $report->buildLinkArray($report->kQueryArray->queryArray['root']['kQuery']->fieldArray);

      foreach ($report->kQueryArray->queryArray['root']['kQuery']->fieldArray as $fieldid => $fieldname) {
         $thisFieldArray = array('name' => $fieldname);
         if (isset($linkArray[$fieldid]))
            $thisFieldArray['linkInfo'] = json_encode($linkArray[$fieldid]);
         $fieldArr[] = $thisFieldArray;
      }

      $totalArray['metaData'] = array(
          'totalProperty' => 'count',
          'root' => 'records',
          'fields' => $fieldArr
      );
      // send the total along
      if ($report->kQueryArray->summarySelectString != '') {
         $totalArray['recordtotal'] = $db->fetchByAssoc($db->query($report->kQueryArray->summarySelectString));
         $report->processFormulas($totalArray['recordtotal']);
      }

      // do a count 
      $totalArray['count'] = $report->getSelectionResults(array('start' => $offset, 'limit' => max_results), '0', true);

	return array('entry_list'=>array('name'=> $report->name,'values' => $totalArray,'header' => $columns), 'relationship_list' => array());

    }

	function set_image_file($session,$module_name,$id,$field,$drawing,$deleted,$filename) {
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->set_drawing');
		global $sugar_config;
		$error = new SoapError();
		if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'write', 'no_access', $error)) {
			$GLOBALS['log']->info('End: SugarWebServiceImpl->set_drawing');
			return;
		} // if

		if ($deleted == 0) {			
			//Need to remove the stuff at the beginning of the string
			$drawing = substr($drawing, strpos($drawing, ",")+1);
			$drawing = base64_decode($drawing);
			$imgRes = imagecreatefromstring($drawing);

			if ($imgRes === false || imagepng($imgRes, $filename) !== true)
				$filename = '';
		}
		else {
			if (file_exists($filename)) {
				unlink($filename);
			}
		}
		$GLOBALS['log']->info('End: SugarWebServiceImpl->set_drawing');
		return array('id'=>$id, 'entry_list' => array('filename'=>$filename));
	} // fn

	function set_drawing($session,$module_name,$id,$field,$drawing,$deleted=0) {
		global $sugar_config;		
		return self::set_image_file($session,$module_name,$id,$field,$drawing,$deleted,$sugar_config['upload_dir'].$id.'_'.$field.'.png');
	} // fn

	function set_image($session,$module_name,$id,$field,$drawing,$deleted=0,$name="") {
		global $sugar_config;		
		return self::set_image_file($session,$module_name,$id,$field,$drawing,$deleted,$sugar_config['upload_dir'].$id.'_'.$field);
	} // fn

	function set_photo($session,$module_name,$id,$field,$drawing,$deleted=0,$name="") {
		global $sugar_config;		
		return self::set_image_file($session,$module_name,$id,$field,$drawing,$deleted,$sugar_config['cache_dir'].'images/'.$id.'_'.$name);
	} // fn

	function get_image_file($session,$module_name,$id,$field,$filename) {
		$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_image_file');
		$error = new SoapError();
		if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
			$GLOBALS['log']->error('End: SugarWebServiceImpl->get_image_file - FAILED on checkACLAccess');
			return;
		} // if
	
		$local_location =  $filename;
		$hasDrawing=true;

		if(!file_exists( $local_location )) {
			$local_location = "themes/default/images/_blank.png";
			$hasDrawing=false;
		}
		$res= base64_encode(file_get_contents($local_location,true));

		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_image_file');
		return array('entry_list'=>array('hasDrawing'=> $hasDrawing,'contents' => $res));

	}

	function get_drawing($session,$module_name,$id,$field) {
		return self::get_image_file($session,$module_name,$id,$field,"upload://{$id}_{$field}.png");
	} // fn
	function get_image($session,$module_name,$id,$field,$name="") {
		return self::get_image_file($session,$module_name,$id,$field,"upload://{$id}_{$field}");
	} // fn
	function get_photo($session,$module_name,$id,$field,$name="") {
		global $sugar_config;		
		return self::get_image_file($session,$module_name,$id,$field,$sugar_config['cache_dir'].'images/'.$id.'_'.$name);
	} // fn

}