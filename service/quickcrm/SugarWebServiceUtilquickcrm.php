<?php
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

require_once('service/v4_1/SugarWebServiceUtilv4_1.php');

function Qcmp_beans($a, $b)
{
    global $sugar_web_service_order_by;
    //If the order_by field is not valid, return 0;
    if (empty($sugar_web_service_order_by) || !isset($a->$sugar_web_service_order_by) || !isset($b->$sugar_web_service_order_by)){
        return 0;
    }
    if (is_object($a->$sugar_web_service_order_by) || is_object($b->$sugar_web_service_order_by)
        || is_array($a->$sugar_web_service_order_by) || is_array($b->$sugar_web_service_order_by))
    {
        return 0;
    }
	if (is_string($a->$sugar_web_service_order_by)){
		if (strtoupper($a->$sugar_web_service_order_by) == strtoupper($b->$sugar_web_service_order_by)){
			return 0;
		}
		if (strtoupper($a->$sugar_web_service_order_by) < strtoupper($b->$sugar_web_service_order_by))
		{
			return -1;
		} else {
			return 1;
		}
	}
	else {
		if ($a->$sugar_web_service_order_by == $b->$sugar_web_service_order_by) return 0;
		if ($a->$sugar_web_service_order_by < $b->$sugar_web_service_order_by)
		{
			return -1;
		} else {
			return 1;
		}
	}
}

function Qorder_beans($beans, $field_name)
{
    //Since php 5.2 doesn't include closures, we must use a global to pass the order field to cmp_beans.
    global $sugar_web_service_order_by;
    $sugar_web_service_order_by = $field_name;
    usort($beans, "Qcmp_beans");
    return $beans;
}


class SugarWebServiceUtilquickcrm extends SugarWebServiceUtilv4_1
{
    function filter_fields($value, $fields)
    {
        // fix bug with many2one relationship fields not returned
        $GLOBALS['log']->info('Begin: SoapHelperWebServices->filter_fields');
        global $invalid_contact_fields;
        $filterFields = array();
        foreach($fields as $field)
        {
            if (is_array($invalid_contact_fields))
            {
                if (in_array($field, $invalid_contact_fields))
                {
                    continue;
                }
            }
            if (isset($value->field_defs[$field]))
            {
                $var = $value->field_defs[$field];
                //if($var['type'] == 'link') continue;
                if($var['type'] == 'link' && (!isset($var['side']) || $var['side'] != 'right')) continue;
                if( isset($var['source'])
                    && ($var['source'] != 'db' && $var['source'] != 'custom_fields' && $var['source'] != 'non-db')
                    && $var['name'] != 'email1' && $var['name'] != 'email2'
                    && (!isset($var['type'])|| $var['type'] != 'relate')) {

                    if( $value->module_dir == 'Emails'
                        && (($var['name'] == 'description') || ($var['name'] == 'description_html') || ($var['name'] == 'from_addr_name')
                            || ($var['name'] == 'reply_to_addr') || ($var['name'] == 'to_addrs_names') || ($var['name'] == 'cc_addrs_names')
                            || ($var['name'] == 'bcc_addrs_names') || ($var['name'] == 'raw_source')))
                    {

                    }
                    else
                    {
                        continue;
                    }
                }
            }
            $filterFields[] = $field;
        }
        $GLOBALS['log']->info('End: SoapHelperWebServices->filter_fields');
        return $filterFields;
    }

	function Qget_name_value($field,$value){
		return $value;
	}
	
	function Qget_return_value_for_link_fields($bean, $module, $link_name_to_value_fields_array) {
		$GLOBALS['log']->info('Begin: SoapHelperWebServices->get_return_value_for_link_fields');
		global $module_name, $current_user;
		$module_name = $module;
		if($module == 'Users' && $bean->id != $current_user->id){
			$bean->user_hash = '';
		}
		if(function_exists("clean_sensitive_data")) { // doesn't exist in older versions
			$bean = clean_sensitive_data($bean->field_defs, $bean);
		}

		if (empty($link_name_to_value_fields_array) || !is_array($link_name_to_value_fields_array)) {
			$GLOBALS['log']->debug('End: SoapHelperWebServices->get_return_value_for_link_fields - Invalid link information passed ');
			return array();
		}

		if ($this->isLogLevelDebug()) {
			$GLOBALS['log']->debug('SoapHelperWebServices->get_return_value_for_link_fields - link info = ' . var_export($link_name_to_value_fields_array, true));
		} // if
		$link_output = array();
		foreach($link_name_to_value_fields_array as $link_name_value_fields) {
			if (!is_array($link_name_value_fields) || !isset($link_name_value_fields['name']) || !isset($link_name_value_fields['value'])) {
				continue;
			}
			$link_field_name = $link_name_value_fields['name'];
			$link_module_fields = $link_name_value_fields['value'];
			if (is_array($link_module_fields) && !empty($link_module_fields)) {
				$result = $this->getRelationshipResults($bean, $link_field_name, $link_module_fields);
				if (!$result) {
					$link_output[] = array('name' => $link_field_name, 'records' => array());
					continue;
				}
				$list = $result['rows'];
				$filterFields = $result['fields_set_on_rows'];
				if ($list) {
					$rowArray = array();
					foreach($list as $row) {
						$nameValueArray = array();
						foreach ($filterFields as $field) {
							$nameValue = array();
							if (isset($row[$field])) {
								$nameValueArray[$field] = $this->Qget_name_value($field, $row[$field]);
							} // if
						} // foreach
						$rowArray[] = $nameValueArray;
					} // foreach
					$link_output[] = array('name' => $link_field_name, 'records' => $rowArray);
				} // if
			} // if
		} // foreach
		$GLOBALS['log']->debug('End: SoapHelperWebServices->get_return_value_for_link_fields');
		if ($this->isLogLevelDebug()) {
			$GLOBALS['log']->debug('SoapHelperWebServices->get_return_value_for_link_fields - output = ' . var_export($link_output, true));
		} // if
		return $link_output;
	} // fn
	
	function Qget_name_value_list_for_fields($value, $fields) {
		$GLOBALS['log']->info('Begin: SoapHelperWebServices->get_name_value_list_for_fields');
		global $app_list_strings;
		global $invalid_contact_fields;

		$list = array();
		if(!empty($value->field_defs)){
			if(empty($fields))$fields = array_keys($value->field_defs);
			if(isset($value->assigned_user_name) && in_array('assigned_user_name', $fields)) {
				$list['assigned_user_name'] = $this->Qget_name_value('assigned_user_name', $value->assigned_user_name);
			}
			if(isset($value->modified_by_name) && in_array('modified_by_name', $fields)) {
				$list['modified_by_name'] = $this->Qget_name_value('modified_by_name', $value->modified_by_name);
			}
			if(isset($value->created_by_name) && in_array('created_by_name', $fields)) {
				$list['created_by_name'] = $this->Qget_name_value('created_by_name', $value->created_by_name);
			}

			$filterFields = $this->filter_fields($value, $fields);


			foreach($filterFields as $field){
				$var = $value->field_defs[$field];
				if(isset($value->$var['name'])){
					$val = $value->$var['name'];
					$type = $var['type'];

					if(strcmp($type, 'date') == 0){
						$val = substr($val, 0, 10);
					}elseif(strcmp($type, 'enum') == 0 && !empty($var['options'])){
						//$val = $app_list_strings[$var['options']][$val];
					}

					$list[$var['name']] = $this->Qget_name_value($var['name'], $val);
				} // if
			} // foreach
		} // if
		$GLOBALS['log']->info('End: SoapHelperWebServices->get_name_value_list_for_fields');
		if ($this->isLogLevelDebug()) {
			$GLOBALS['log']->debug('SoapHelperWebServices->get_name_value_list_for_fields - return data = ' . var_export($list, true));
		} // if
		return $list;

	} // fn

	function Qget_return_value_for_fields($value, $module, $fields) {
		$GLOBALS['log']->info('Begin: SoapHelperWebServices->get_return_value_for_fields');
		global $module_name, $current_user;
		$module_name = $module;
		if($module == 'Users' && $value->id != $current_user->id){
			$value->user_hash = '';
		}
		if(function_exists("clean_sensitive_data")) { // doesn't exist in older versions
			$value = clean_sensitive_data($value->field_defs, $value);
		}
		$GLOBALS['log']->info('End: SoapHelperWebServices->get_return_value_for_fields');
		return Array('id'=>$value->id,
					'module_name'=> $module,
					'name_value_list'=>$this->Qget_name_value_list_for_fields($value, $fields)
					);
	}


    /**
     * Equivalent of get_list function within SugarBean but allows the possibility to pass in an indicator
     * if the list should filter for favorites.  Should eventually update the SugarBean function as well.
     *
	 * NS-TEAM : - fix bug with order by 
     */
    function get_data_list($seed, $order_by = "", $where = "", $row_offset = 0, $limit=-1, $max=-1, $show_deleted = 0, $favorites = false)
	{
		global $sugar_version;
		$GLOBALS['log']->debug("get_list:  order_by = '$order_by' and where = '$where' and limit = '$limit'");
		if(isset($_SESSION['show_deleted']))
		{
			$show_deleted = 1;
		}
		// Fix bug with sort order in get_entry_list
		if ($sugar_version < '6.5.15') {
			$order_by=$seed->process_order_by($order_by, null);
		}

		$params = array();
		if(!empty($favorites)) {
		  $params['favorites'] = true;
		}

		$query = $seed->create_new_list_query($order_by, $where,array(),$params, $show_deleted);
		return $seed->process_list_query($query, $row_offset, $limit, $max, $where);
	}
	
    function get_data_list_with_relate($seed, $order_by = "", $where = "", $select_fields, $row_offset = 0, $limit=-1, $max=-1, $show_deleted = 0, $favorites = false)
	{
		global $sugar_version;
		$GLOBALS['log']->debug("get_list:  order_by = '$order_by' and where = '$where' and limit = '$limit'");
		if(isset($_SESSION['show_deleted']))
		{
			$show_deleted = 1;
		}
		// Fix bug with sort order in get_entry_list
		if ($sugar_version < '6.5.15') {
			$order_by=$seed->process_order_by($order_by, null);
		}
			   
		$filter=array();
		foreach ($select_fields as $key=>$value_array) {
			$filter[$value_array]=true;
		}
		
		$params = array('distinct'=>true);
		if(!empty($favorites)) {
		  $params['favorites'] = true;
		}
		
		if ($seed->module_name == 'Users' || $seed->module_name == 'Employees') $query = $seed->create_new_list_query($order_by, $where,array(),$params, $show_deleted);
		else $query = $seed->create_new_list_query($order_by, $where,$filter,$params, $show_deleted, '', false, null, true);
		if ($seed->module_name == 'Meetings') // Allow searching participants
			$query = str_replace ('FROM meetings','FROM meetings LEFT JOIN  meetings_users m_u on  m_u.meeting_id = meetings.id',$query);
		
		return $seed->process_list_query($query, $row_offset, $limit, $max, $where);
	}

    function getEmailRelationshipResults($init_array,$bean, $link_field_name, $link_module_fields, $optional_where = '', $order_by = '', $offset = 0, $limit = '') {
        $GLOBALS['log']->info('Begin: SoapHelperWebServices->getEmailRelationshipResults');
		require_once('include/TimeDate.php');
		global $beanList, $beanFiles, $current_user;
		global $disable_date_format, $timedate;
		
		$bean->load_relationship($link_field_name);

		$p = array('link'=>'contacts');
		$GLOBALS['app']->controller->bean = $bean;
		$qry_params = $bean->get_unlinked_email_query(array('return_as_array'=>true), $bean);

		$emails_query = $qry_params['select'] . ' ' . $qry_params['from']. ' ' . $qry_params['join']. ' ' . $qry_params['where'];
		if ($order_by != '') $emails_query .= 'ORDER BY emails.' . $order_by;
		$linked_emails = $GLOBALS['db']->query($emails_query);

		$related_beans= array();
			while($val = $GLOBALS['db']->fetchByAssoc($linked_emails,false))
				{
					$email= new Email();
					$related_beans[$val['id']] = $email->retrieve($val['id']);
				}		


			//First get all the related beans
            $params = array();
            $params['offset'] = $offset;
            $params['limit'] = $limit;

            if (!empty($optional_where))
            {
                $params['where'] = $optional_where;
            }

            //Create a list of field/value rows based on $link_module_fields
			$list = $init_array['rows'];
            $filterFields = $init_array['fields_set_on_rows'];
            if (!empty($order_by) && !empty($related_beans))
            {
                $related_beans = Qorder_beans($related_beans, $order_by);
            }
            foreach($related_beans as $id => $bean)
            {
                if (empty($filterFields) && !empty($link_module_fields))
                {
                    $filterFields = $this->filter_fields($bean, $link_module_fields);
                }
                $row = array();
                foreach ($filterFields as $field) {
                    if (isset($bean->$field))
                    {
                        if (isset($bean->field_defs[$field]['type']) && $bean->field_defs[$field]['type'] == 'date') {
                            $row[$field] = $timedate->to_display_date_time($bean->$field);
                        } else {
                            $row[$field] = $bean->$field;
                        }
                    }
                    else
                    {
                        $row[$field] = "";
                    }
                }
                //Users can't see other user's hashes
                if(is_a($bean, 'User') && $current_user->id != $bean->id && isset($row['user_hash'])) {
                    $row['user_hash'] = "";
                }
				if(function_exists("clean_sensitive_data")) { // doesn't exist in older versions
					$row = clean_sensitive_data($bean->field_defs, $row);
				}
                $list[] = $row;
            }
            $GLOBALS['log']->info('End: SoapHelperWebServices->getEmailRelationshipResults');
            return array('rows' => $list, 'fields_set_on_rows' => $filterFields);

	} // fn
	
    function getAccountsEmailRelationshipResults($bean, $link_field_name, $link_module_fields, $optional_where = '', $order_by = '', $offset = 0, $limit = '') {
        $GLOBALS['log']->info('Begin: SoapHelperWebServices->getAccountsEmailRelationshipResults');
		require_once('include/TimeDate.php');
		global $beanList, $beanFiles, $current_user;
		global $disable_date_format, $timedate;
		
		$bean->load_relationship($link_field_name);

		$p = array('link'=>'contacts');
		$GLOBALS['app']->controller->bean = $bean;
		$qry_params = get_emails_by_assign_or_link($p);

		$emails_query = $qry_params['select'] . ' ' . $qry_params['from']. ' ' . $qry_params['join']. ' ' . $qry_params['where'];
		if ($order_by != '') $emails_query .= 'ORDER BY emails.' . $order_by;
		$linked_emails = $GLOBALS['db']->query($emails_query);

		$related_beans= array();
			while($val = $GLOBALS['db']->fetchByAssoc($linked_emails,false))
				{
					$email= new Email();
					$related_beans[$val['id']] = $email->retrieve($val['id']);
				}		

			//First get all the related beans
            $params = array();
            $params['offset'] = $offset;
            $params['limit'] = $limit;

            if (!empty($optional_where))
            {
                $params['where'] = $optional_where;
            }

            //Create a list of field/value rows based on $link_module_fields
			$list = array();
            $filterFields = array();
            if (!empty($order_by) && !empty($related_beans))
            {
                //$related_beans = Qorder_beans($related_beans, $order_by);
            }
            foreach($related_beans as $id => $bean)
            {
                if (empty($filterFields) && !empty($link_module_fields))
                {
                    $filterFields = $this->filter_fields($bean, $link_module_fields);
                }
                $row = array();
                foreach ($filterFields as $field) {
                    if (isset($bean->$field))
                    {
                        if (isset($bean->field_defs[$field]['type']) && $bean->field_defs[$field]['type'] == 'date') {
                            $row[$field] = $timedate->to_display_date_time($bean->$field);
                        } else {
                            $row[$field] = $bean->$field;
                        }
                    }
                    else
                    {
                        $row[$field] = "";
                    }
                }
                //Users can't see other user's hashes
                if(is_a($bean, 'User') && $current_user->id != $bean->id && isset($row['user_hash'])) {
                    $row['user_hash'] = "";
                }
				if(function_exists("clean_sensitive_data")) { // doesn't exist in older versions
					$row = clean_sensitive_data($bean->field_defs, $row);
				}
                $list[] = $row;
            }
            $GLOBALS['log']->info('End: SoapHelperWebServices->getAccountsEmailRelationshipResults');
            return array('total_count'=> count($related_beans),'rows' => $list, 'fields_set_on_rows' => $filterFields);

	} // fn
	
    function getRelationshipResults($bean, $link_field_name, $link_module_fields, $optional_where = '', $order_by = '', $offset = 0, $limit = '') {
		// fix bug with sort order and offset
        $GLOBALS['log']->info('Begin: SoapHelperWebServices->getRelationshipResults');
		require_once('include/TimeDate.php');
		global $beanList, $beanFiles, $current_user;
		global $disable_date_format, $timedate;

		$bean->load_relationship($link_field_name);

		if (isset($bean->$link_field_name)) {
			//First get all the related beans
            $params = array();
            //$params['offset'] = $offset;
            //$params['limit'] = $limit;

            if (!empty($optional_where))
            {
                $params['where'] = $optional_where;
            }

            $related_beans = $bean->$link_field_name->getBeans($params);
            //Create a list of field/value rows based on $link_module_fields
			$list = array();
            $filterFields = array();
            if (!empty($order_by) && !empty($related_beans))
            {
                $order_by_elts = explode(' ', $order_by);
				$related_beans = Qorder_beans($related_beans, $order_by_elts[0]);
				if (isset($order_by_elts[1]) && $order_by_elts[1] =='desc')
					$related_beans = array_reverse($related_beans);
            }
			//$nb=0;
			//$added=0;
            foreach($related_beans as $id => $bean)
            {
                /*
                $nb++;
				if ($link_field_name != 'emails'){ // for emails, offset and limit are managed in the app
					if ($nb < $offset+1) continue;
					if ($limit && $added == $limit) break;
				}
				$added++;
				*/
				if (empty($filterFields) && !empty($link_module_fields))
                {
                    $filterFields = $this->filter_fields($bean, $link_module_fields);
                }
                $row = array();
                foreach ($filterFields as $field) {
                    if (isset($bean->$field))
                    {
                        if (isset($bean->field_defs[$field]['type']) && $bean->field_defs[$field]['type'] == 'date') {
                            $row[$field] = $timedate->to_display_date_time($bean->$field);
                        } else {
                            $row[$field] = $bean->$field;
                        }
                    }
                    else
                    {
                        $row[$field] = "";
                    }
                }
                //Users can't see other user's hashes
                if(is_a($bean, 'User') && $current_user->id != $bean->id && isset($row['user_hash'])) {
                    $row['user_hash'] = "";
                }
				if(function_exists("clean_sensitive_data")) { // doesn't exist in older versions
					$row = clean_sensitive_data($bean->field_defs, $row);
				}
                $list[] = $row;
            }
            $GLOBALS['log']->info('End: SoapHelperWebServices->getRelationshipResults');
            return array('total_count'=> count($related_beans), 'rows' => $list, 'fields_set_on_rows' => $filterFields);
		} else {
			$GLOBALS['log']->info('End: SoapHelperWebServices->getRelationshipResults - ' . $link_field_name . ' relationship does not exists');
			return false;
		} // else

	} // fn
	
    function QgetRelationshipResults($bean, $link_field_name, $link_module_fields, $optional_where = '', $order_by = '', $offset = 0, $limit = '') {
		// fix bug with sort order and offset
        $GLOBALS['log']->info('Begin: SoapHelperWebServices->getRelationshipResults');
		require_once('include/TimeDate.php');
		global $beanList, $beanFiles, $current_user;
		global $disable_date_format, $timedate;

		$bean->load_relationship($link_field_name);

		if (isset($bean->$link_field_name)) {
			//First get all the related beans
            $params = array();
            // offset and limits are not used so that sort order can be applied to the full list
            //$params['offset'] = $offset;
            //$params['limit'] = $limit;

            if (!empty($optional_where))
            {
                $params['where'] = $optional_where;
            }

            $related_beans = $bean->$link_field_name->getBeans($params);
            //Create a list of field/value rows based on $link_module_fields
			$list = array();
            $filterFields = array();
            if (!empty($order_by) && !empty($related_beans))
            {
                $count_order = explode(' ', $order_by);
				$order_field = $count_order[0];
				$related_beans = Qorder_beans($related_beans, $order_field);
				if (count($count_order) == 2 && ( strtoupper($count_order[1]) == 'DESC')){
					$related_beans = array_reverse($related_beans);
				}
            }
            foreach($related_beans as $id => $bean)
            {
				if (empty($filterFields) && !empty($link_module_fields))
                {
                    $filterFields = $this->filter_fields($bean, $link_module_fields);
                }
                $row = array();
                foreach ($filterFields as $field) {
                    if (isset($bean->$field))
                    {
                        if (isset($bean->field_defs[$field]['type']) && $bean->field_defs[$field]['type'] == 'date') {
                            $row[$field] = $timedate->to_display_date_time($bean->$field);
                        } else {
                            $row[$field] = $bean->$field;
                        }
                    }
                    else
                    {
                        $row[$field] = "";
                    }
                }
                //Users can't see other user's hashes
                if(is_a($bean, 'User') && $current_user->id != $bean->id && isset($row['user_hash'])) {
                    $row['user_hash'] = "";
                }
				if(function_exists("clean_sensitive_data")) { // doesn't exist in older versions
					$row = clean_sensitive_data($bean->field_defs, $row);
				}
                $list[] = $row;
            }
            $GLOBALS['log']->info('End: SoapHelperWebServices->getRelationshipResults');
            return array('total_count'=> count($related_beans),'rows' => $list, 'fields_set_on_rows' => $filterFields);
		} else {
			$GLOBALS['log']->info('End: SoapHelperWebServices->getRelationshipResults - ' . $link_field_name . ' relationship does not exists');
			return false;
		} // else

	} // fn
	
    function buildChartHTMLPChart($chart,array $reportData, array $fields,$index = 0){
        $imgUri = $chart->buildChartImage($reportData,$fields,true,$index);
        $img = "<img id='{$chart->id}_img' src='{$imgUri}'>";
        return $img;
    }

    function AOSgetLineItems($focus,$return_as_nvl){
			if($focus->id != '') {
				require_once('modules/AOS_Products_Quotes/AOS_Products_Quotes.php');
				require_once('modules/AOS_Line_Item_Groups/AOS_Line_Item_Groups.php');

				$sql = "SELECT pg.id, pg.group_id FROM aos_products_quotes pg LEFT JOIN aos_line_item_groups lig ON pg.group_id = lig.id WHERE pg.parent_type = '" . $focus->object_name . "' AND pg.parent_id = '" . $focus->id . "' AND pg.deleted = 0 ORDER BY lig.number ASC, pg.number ASC";

				$result = $focus->db->query($sql);
				$line_items=array();
				$groups=array();
				$stored_groups=array();
				while ($row = $focus->db->fetchByAssoc($result)) {
					$line_item = new AOS_Products_Quotes();
					$line_item->retrieve($row['id']);
					$line_item = $return_as_nvl ? self::get_name_value_list_for_fields($line_item, "") : self::Qget_name_value_list_for_fields($line_item, "");

					$group_item = 'null';
					if ($row['group_id'] != null) {
						$group_item = new AOS_Line_Item_Groups();
						$group_item->retrieve($row['group_id']);
						$group_item = $return_as_nvl ? self::get_name_value_list_for_fields($group_item, "") : self::Qget_name_value_list_for_fields($group_item, "");
						if (!in_array($row['group_id'],$stored_groups)){
							$groups[] = $group_item;
							$stored_groups[]=$row['group_id'];
						}
					}
					$line_items[]=$line_item;

				}
				return array('lineitems' =>$line_items,'groups'=>$groups);
			}
			else return array('lineitems' => array() ,'groups'=>array());
	}
}