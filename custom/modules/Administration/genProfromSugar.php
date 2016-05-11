<?php
/*********************************************************************************
 * This file is part of QuickCRM Mobile Full.
 * QuickCRM Mobile Full is a mobile client for SugarCRM
 * 
 * Author : NS-Team (http://www.ns-team.fr)
 * All rights (c) 2011-2016 by NS-Team
 *
 * This Version of the QuickCRM Mobile Full is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of NS-Team
 * 
 * You can contact NS-Team at NS-Team - 55 Chemin de Mervilla - 31320 Auzeville - France
 * or via email at infos@ns-team.fr
 * 
 ********************************************************************************/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $QuickCRM_modules,$QuickCRM_simple_modules,$QuickCRMDetailsFields,$QuickCRMTitleFields,$QuickCRMExtraFields,$QuickCRMAddressesFields,$QuickCRM_AddressDef,$QuickCRM_google_AddressDef;
require_once('custom/modules/Administration/quickcrm_std.php');
if (file_exists("custom/QuickCRM/QuickCRMDefaults.php")){
	include('custom/QuickCRM/QuickCRMDefaults.php');
}
require_once('modules/Administration/Administration.php');
require_once('include/utils.php');

function Q_new_bean($module_name){
	global $beanFiles, $beanList;
	global $sugar_config;
	if ($sugar_config['sugar_version']<'6.3'){
		require_once($beanFiles[$beanList[$module_name]]);
		return new $beanList[$module_name];
	}
	else {
		return BeanFactory::getBean($module_name);
	}
}

function suitecrmVersion(){
	global $sugar_config;
	if (isset($sugar_config['suitecrm_version']) ){
		return $sugar_config['suitecrm_version'];
	}
	else if (file_exists('suitecrm_version.php')){
		include('suitecrm_version.php');
		return $suitecrm_version;
	}
	return False;
	
}

class mobile_jsLanguage {
    
    /**
     * Creates javascript versions of language files
     */
    var $modfields;
	var $listOfLists;
	var $aos;

    function mobile_jsLanguage() {
		$this->modfields=array();
		$this->listOfLists=array();
    }
    
    function createAppStringsCache($required_list,$lst_mod,$lang = 'en_us') {
		global $sugar_config, $mod_strings;
		
        $app_strings = return_application_language($lang);
        $all_app_list_strings = return_app_list_strings_language($lang);
		$app_list_strings= array();

		foreach($lst_mod as $key=>$lst){
			$app_list_strings["moduleList"][$lst]= $all_app_list_strings["moduleList"][$lst];
			$app_list_strings["moduleListSingular"][$lst]= isset($all_app_list_strings["moduleListSingular"][$lst])?$all_app_list_strings["moduleListSingular"][$lst]:$all_app_list_strings["moduleList"][$lst];
		}
		$app_list_strings["moduleList"]["SavedSearches"]= $all_app_list_strings["moduleList"]["SavedSearch"];
		if ($sugar_config['dbconfig']['db_type'] !='mssql'){
			$app_list_strings["moduleList"]['QCRM_SavedSearch']= $all_app_list_strings["moduleList"]['SavedSearch'];
			$app_list_strings["moduleListSingular"]['QCRM_SavedSearch']= $all_app_list_strings["moduleList"]['SavedSearch'];
		}

		$app_list_strings["parent_type_display"]=$all_app_list_strings["parent_type_display"];
		$app_list_strings["duration_intervals"]=$all_app_list_strings["duration_intervals"];
		$app_list_strings["duration_dom"]=$all_app_list_strings["duration_dom"];
		
		// date_range_search_dom in not defined until 6.2
		$app_list_strings["date_search"]= isset($all_app_list_strings["date_range_search_dom"])?$all_app_list_strings["date_range_search_dom"]:$all_app_list_strings["kbdocument_date_filter_options"];
		$app_list_strings["date_search"]['today']=$app_strings['LBL_TODAY'];
		$app_list_strings["date_search"]['yesterday']=$app_strings['LBL_YESTERDAY'];
		$app_list_strings["date_search"]['tomorrow']=$app_strings['LBL_TOMORROW'];
		
		if (isset($all_app_list_strings["numeric_range_search_dom"])) $app_list_strings["num_search"]= $all_app_list_strings["numeric_range_search_dom"];

		foreach($required_list as $lst){
			$app_list_strings[$lst]= $all_app_list_strings[$lst];
		}
		
		$json = getJSONobj();
        $app_list_strings_encoded = str_replace('\\\\',"\/",preg_replace("/'/","&#039;",$json->encode($app_list_strings)));
        
		$SS_mod_strings = return_module_language($lang, "SavedSearch");
		$MB_mod_strings = return_module_language($lang, "ModuleBuilder");
		
        $str = <<<EOQ
var RES_ASC='{$SS_mod_strings["LBL_ASCENDING"]}',RES_DESC='{$SS_mod_strings["LBL_DESCENDING"]}',RES_HOME_LABEL='{$all_app_list_strings["moduleList"]["Home"]}',RES_SYNC='{$all_app_list_strings["moduleList"]["Sync"]}',RES_SAVEDSEARCH='{$all_app_list_strings["moduleList"]["SavedSearch"]}',RES_SAVESEARCH='{$SS_mod_strings["LBL_SAVE_SEARCH_AS"]}',RES_MODULES='{$MB_mod_strings["LBL_MODULES"]}',RES_PUBLISH='{$MB_mod_strings["LBL_BTN_PUBLISH"]}',RES_PUBLISHED='{$MB_mod_strings["LBL_PUBLISHED"]}';
var sugar_app_list_strings = $app_list_strings_encoded;
EOQ;
		$SS_mod_strings = null;
		$MB_mod_strings = null;
		$all_app_list_strings = null;
		$app_array=array('LBL_CREATE_BUTTON_LABEL',
			'LBL_EDIT_BUTTON',
			'LBL_LIST',
			'LBL_SEARCH_BUTTON_LABEL',
			'LBL_CURRENT_USER_FILTER',// => 'My Items:',
			'LBL_BACK',
			'LBL_SAVE_BUTTON_LABEL',
			'LBL_CANCEL_BUTTON_LABEL',
			'LBL_MARK_AS_FAVORITES',
			'LBL_REMOVE_FROM_FAVORITES',
			'NTC_DELETE_CONFIRMATION',
			'NTC_REMOVE_CONFIRMATION',
			'LBL_DELETE_BUTTON_LABEL',
			'ERROR_NO_RECORD',
			'LBL_LAST_VIEWED',
			'LNK_LIST_NEXT',
			'LNK_LIST_PREVIOUS',
			'LBL_LINK_SELECT',
			'LBL_LIST_USER_NAME',
			'NTC_LOGIN_MESSAGE', //'Please enter your user name and password.'
//			'LBL_LOGOUT',
			'ERR_INVALID_EMAIL_ADDRESS',
			'LBL_ASSIGNED_TO',
			'LBL_CLEAR_BUTTON_LABEL',
			'LBL_DURATION_DAYS',
			'LBL_CLOSE_AND_CREATE_BUTTON_TITLE', // TO REMOVE WHEN APPS ARE UPDATED
			'LBL_CLOSE_AND_CREATE_BUTTON_LABEL',
			'LBL_CLOSE_BUTTON_TITLE', // TO REMOVE WHEN APPS ARE UPDATED
			'LBL_CLOSE_BUTTON_LABEL',
			'LBL_LISTVIEW_ALL',
			'LBL_LISTVIEW_NONE',
			'LBL_SAVED',
			'LBL_PRIMARY_ADDRESS',
			'LBL_BILLING_ADDRESS',
			'LBL_ALT_ADDRESS',
			'LBL_SHIPPING_ADDRESS',
			'LBL_DUPLICATE_BUTTON',
			'MSG_SHOW_DUPLICATES',
			'LBL_EMAIL_OPT_OUT',
			'MSG_LIST_VIEW_NO_RESULTS_BASIC',
			'LBL_CITY',
			'LBL_SHARE_PUBLIC',
			'LBL_SHARE_PRIVATE',
			'LNK_REMOVE',
			'NTC_OVERWRITE_ADDRESS_PHONE_CONFIRM',
			'LBL_FAVORITES',
			'LBL_VIEW_BUTTON_LABEL',
			'LBL_MODIFIED',
			'LBL_CREATED',
		);
		if (suitecrmVersion() && suitecrmVersion() >= '7.4') $app_array[] = 'LBL_FAVORITES_FILTER';
		
		if (file_exists('custom/include/generic/SugarWidgets/SugarWidgetFielddrawing.php')){
			$app_array=array_merge($app_array,array(
			'LBL_DRAWING_GENERAL',
			'LBL_DRAWING_CLEAR',
			'LBL_DRAWING_CLEAR_CONFIRM',
			'LBL_DRAWING_REINIT',
			'LBL_DRAWING_UNDO',

			'LBL_DRAWING_TOOLS',
			'LBL_DRAWING_ERASER',
			'LBL_DRAWING_HAND',
			'LBL_DRAWING_LINE',
			'LBL_DRAWING_RECT',
			'LBL_DRAWING_ELLIPSE',
			'LBL_DRAWING_TEXT',

			'LBL_DRAWING_TEXTINPUT',

			'LBL_DRAWING_FONTSIZE',
			'LBL_DRAWING_FONTSMALL',
			'LBL_DRAWING_FONTMEDIUM',
			'LBL_DRAWING_FONTLARGE',

			'LBL_DRAWING_STROKEWIDTH',
			'LBL_DRAWING_WIDTH1',
			'LBL_DRAWING_WIDTH3',
			'LBL_DRAWING_WIDTH5',
			'LBL_DRAWING_WIDTH10',

			'LBL_DRAWING_STROKECOLORS',
			'LBL_DRAWING_BLACK',
			'LBL_DRAWING_RED',
			'LBL_DRAWING_GREEN',
			'LBL_DRAWING_BLUE',

			'LBL_DRAWING_FILLCOLORS',
			'LBL_DRAWING_FILLNONE',
			'LBL_DRAWING_FILLBLACK',
			'LBL_DRAWING_FILLRED',
			'LBL_DRAWING_FILLGREEN',
			'LBL_DRAWING_FILLBLUE',
			));
		}
		$str_app_array=array();
		foreach($app_array as $key){
			$str_app_array[$key] = str_replace('"','\\"',isset($app_strings[$key])?$app_strings[$key]:$key);
		}
		$str_app_array['LBL_REPAIR_JS_FILES_PROCESSING']=$mod_strings['LBL_REPAIR_JS_FILES_PROCESSING'];

		$app_strings_encoded = $json->encode($str_app_array);
		$str .= "var sugar_app_strings = $app_strings_encoded;";
      
		$administration = new Administration();
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').$lang, base64_encode($str));
		$in_file=(strlen ($str) > 49000?'1':'0');
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').$lang.'f', $in_file);
// File will be used for sugarCRM < 6.3 or if string is too long for database.
		if ($in_file == '1' || $sugar_config['sugar_version']<'6.3'){
			$saveDir = realpath(dirname(__FILE__).'/../../../mobile'.($sugar_config['quickcrm_trial'] != false ?'_trial':'').'/fielddefs/');
			if($fh = @fopen($saveDir . '/' .$lang . '.js', "w")){
				fputs($fh, $str);
				fclose($fh);
			}
		}
    }
    
    function createModuleStringsCache($lst_mod,$lang,$module_def,$mobile_config) {
		global $sugar_config;
        $json = getJSONobj();

		$str_to_add=array(
			"Accounts" => array (
							'LBL_BILLING_ADDRESS',
							'LBL_SHIPPING_ADDRESS',
						),
			"Contacts" => array (
							'LBL_PRIMARY_ADDRESS',
							'LBL_ALT_ADDRESS',
						),
			"Leads" => array (
							'LBL_PRIMARY_ADDRESS',
							'LBL_ALT_ADDRESS',
							'LBL_CONVERTLEAD',
							'LNK_SELECT_ACCOUNTS',
							'LNK_SELECT_CONTACTS',
							'LNK_NEW_ACCOUNT',
							'LNK_NEW_CONTACT',
						),
			"Meetings" => array (
							'LBL_REMINDER',
							'LBL_INVITEE',
							'LBL_STATUS',
						),
			"Calls" => array (
							'LBL_REMINDER',
							'LBL_INVITEE',
							'LNK_NEW_CALL',
						),
			"Tasks" => array (
							'LNK_NEW_TASK',
						),
			"Emails" => array (
							'LBL_BODY',
							'LBL_HTML_BODY',
						),
			"AOS_Quotes" => array (
							'LBL_ADD_PRODUCT_LINE',
							'LBL_ADD_SERVICE_LINE',
							'LBL_ADD_GROUP',
							'LBL_DELETE_GROUP',
							'LBL_GROUP_NAME',
							'LBL_GROUP_TOTAL',
							'LBL_PRODUCT_QUANITY',
							'LBL_PRODUCT_NAME',
							'LBL_PART_NUMBER' ,
							'LBL_PRODUCT_NOTE' ,
							'LBL_PRODUCT_DESCRIPTION',
							'LBL_LIST_PRICE',
							'LBL_DISCOUNT_AMT',
							'LBL_UNIT_PRICE',
							'LBL_VAT_AMT',
							'LBL_TOTAL_PRICE',
							'LBL_SERVICE_NAME' ,
							'LBL_SERVICE_LIST_PRICE',
							'LBL_SERVICE_PRICE' ,
							'LBL_SERVICE_DISCOUNT',
						),
			"AOS_Invoices" => array (
							'LBL_ADD_PRODUCT_LINE',
							'LBL_ADD_SERVICE_LINE',
							'LBL_ADD_GROUP',
							'LBL_DELETE_GROUP',
							'LBL_GROUP_NAME',
							'LBL_GROUP_TOTAL',
							'LBL_PRODUCT_QUANITY',
							'LBL_PRODUCT_NAME',
							'LBL_PART_NUMBER' ,
							'LBL_PRODUCT_NOTE' ,
							'LBL_PRODUCT_DESCRIPTION',
							'LBL_LIST_PRICE',
							'LBL_DISCOUNT_AMT',
							'LBL_UNIT_PRICE',
							'LBL_VAT_AMT',
							'LBL_TOTAL_PRICE',
							'LBL_SERVICE_NAME' ,
							'LBL_SERVICE_LIST_PRICE',
							'LBL_SERVICE_PRICE' ,
							'LBL_SERVICE_DISCOUNT',
						),
			"SugarFeed" => array (
							'CREATED_CONTACT',
							'CREATED_OPPORTUNITY',
							'CREATED_CASE',
							'CREATED_LEAD',
							'FOR',
							'CLOSED_CASE',
							'CONVERTED_LEAD',
							'WON_OPPORTUNITY',
							'WITH',
						),
			); 
		$str = <<<EOQ
var sugar_mod_strings={};
EOQ;
        $app_strings = return_application_language($lang);
		foreach($lst_mod as $key => $moduleName){
			$mod_fields = $this->modfields[$moduleName];
			$tmp_mod_strings = return_module_language($lang, $moduleName);
			$mod_strings=array();
			foreach($mod_fields as $field_name => $field_defs){
				if (isset($tmp_mod_strings[$field_defs['label']])) {
					$mod_strings[$field_defs['label']]=str_replace('\\',"/",str_replace('"',"",$tmp_mod_strings[$field_defs['label']]));
				}
				elseif (isset($app_strings[$field_defs['label']])) {
					$mod_strings[$field_defs['label']]=str_replace('\\',"/",str_replace('"',"",$app_strings[$field_defs['label']]));
				}
				else $mod_strings[$field_defs['label']]=$field_defs['label'];
			}
			if (isset($str_to_add[$moduleName])) {
				foreach($str_to_add[$moduleName] as $label){
					$mod_strings[$label]=str_replace('\\',"/",str_replace('"',"",$tmp_mod_strings[$label]));
				}
			}
			if (isset($mobile_config['links'][$moduleName])) {
				foreach ($mobile_config['subpanels'][$moduleName] as $lnk){
					$realname=$mobile_config['links'][$moduleName][$lnk]['vname'];
					// do not add this label if subpanel name is target module
					if ($realname != $mobile_config['links'][$moduleName][$lnk]['module']){
						if (isset($tmp_mod_strings[$realname])){
							$mod_strings[$realname]=$tmp_mod_strings[$realname];
						}
						elseif (isset($app_strings[$realname])){
							$mod_strings[$realname]=$app_strings[$realname];
						}
						else
							$mod_strings[$realname]=$realname;
					}
				}
			}
			$nodeModule = Q_new_bean($moduleName);
			$new_label='LNK_NEW_' . strtoupper($nodeModule->getObjectName());
			if (isset($tmp_mod_strings[$new_label]))
				$mod_strings['NEW']=$tmp_mod_strings[$new_label];
			else
				$mod_strings['NEW']='+';	
// 6.3+			$mod_strings['NEW']=$tmp_mod_strings['LNK_NEW_' . strtoupper(BeanFactory::getObjectName($moduleName))]
			$mod_strings_encoded =  preg_replace("/'/","&#039;",$json->encode($mod_strings));
			$str .= "sugar_mod_strings['$moduleName'] = $mod_strings_encoded;";
        }


		$administration = new Administration();
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'modules_'.$lang, base64_encode($str));

// KEEP IT for SugarCRM 6.1 and 6.2 support
		if ($sugar_config['sugar_version']<'6.3'){
			$saveDir = realpath(dirname(__FILE__).'/../../../mobile'.($sugar_config['quickcrm_trial'] != false ?'_trial':'').'/fielddefs/');
        
			if($fh = @fopen($saveDir .'/modules_'.$lang . '.js', "w")){
				fputs($fh, $str);
				fclose($fh);
			}
		}

	}

    function createModuleFieldsCache($lst_mod,$module_def) {
	
		global $sugar_config;
		global $QuickCRM_modules,$QuickCRM_simple_modules,$QuickCRMDetailsFields,$QuickCRMTitleFields,$QuickCRMAddressesFields;

		$administration = new Administration();
		$administration->retrieveSettings('QuickCRM');
		
        $json = getJSONobj();

		$str='';
		$str_def='';
		
// STORE FIELDS
		foreach($lst_mod as $key=>$moduleName)
		{
			$mod_strings=$this->modfields[$moduleName];
			$tmp_mod_strings=$mod_strings;
			foreach($tmp_mod_strings as $field_name => $field_defs){
				if (isset($field_defs['def'])){
					$def_val= $field_defs['def'];
					if (strpos ( $def_val , '&&' ) != FALSE || strpos ( $def_val , '@@' ) != FALSE){
						$str_def .= <<<EOQ
sugar_mod_fields['$moduleName']['$field_name'].def='$def_val'.replace(/&&/g,'"').replace(/@@/g,"'");
EOQ;
						unset($mod_strings[$field_name]['def']);
					}
				}
			}
			
			$mod_strings_encoded = $json->encode($mod_strings);
			$str .= "sugar_mod_fields['$moduleName'] = $mod_strings_encoded;";

			$str .=$str_def;
        }

// KEEP IT for SugarCRM 6.1 and 6.2 support
		$str23 = $str;
		
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'sugar_fields', base64_encode($str));
		$in_file=(strlen ($str) > 49000?'1':'0');
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'sugar_fields'.'f', $in_file);
// File will be used for sugarCRM < 6.3 or if string is too long for database.
		if ($in_file == '1' || $sugar_config['sugar_version']<'6.3'){
			$saveDir = realpath(dirname(__FILE__).'/../../../mobile'.($sugar_config['quickcrm_trial'] != false ?'_trial':'').'/fielddefs/');
			if($fh = @fopen($saveDir . '/' .'sugar_fields' . '.js', "w")){
				fputs($fh, $str);
				fclose($fh);
			}
		}
		
		$str='';
/*
		foreach($QuickCRMTitleFields as $moduleName=>$contents)
		{
			if ($moduleName == 'Documents' || in_array($moduleName,$QuickCRM_simple_modules)) continue;

			$str_fields="Beans['$moduleName'].TitleFields=['" . implode("','",$QuickCRMTitleFields[$moduleName]) . "'];";
			$str .= $str_fields;
						
        }
*/
// fix bug in app 3.4.4 and earlier
//		$str .= "Beans['Leads'].TitleFields=['first_name','last_name'];";
		
		// STORE MODULE TYPE (Person/Basic) AND TABLE
		$str .= "var sugar_mod=". $json->encode($module_def) . ";";
		
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'fields_std', base64_encode($str));
		
// KEEP IT for SugarCRM 6.1 and 6.2 support
		if ($sugar_config['sugar_version']<'6.3'){
			$saveDir = realpath(dirname(__FILE__).'/../../../mobile'.($sugar_config['quickcrm_trial'] != false ?'_trial':'').'/fielddefs/');
			if($fh = @fopen($saveDir . '/fields_std.js', "w")){
				fputs($fh, $str23 . $str);
				fclose($fh);
			}
		}

    }

    function createSugarConfig($aos) {
		global $sugar_config,$moduleList;
		global $QuickCRM_modules,$QuickCRMDetailsFields,$QuickCRMTitleFields,$QuickCRMAddressesFields,$mod_fields_additional_arr;

		$administration = new Administration();
		$administration->retrieveSettings('',true);
		
        $json = getJSONobj();

		$str = "var mobile_edition = 'Pro',QServer='4.6.3', Q_API='3.1', module_access={}, sugar_mod_fields={},";
        $str .= " RES_OLD_VERSION = 'Please update your app to latest version on App Store or Google Play',"; // STRING MISSING IN VERSIONS 4.0.0 and lower
        $str .= ' sugar_version = "'.$sugar_config['sugar_version'].'",';
        $str .= ' sugar_name = "'.$administration->settings['system_name'].'",';
        $str .= ' default_language = "'.$sugar_config['default_language'].'",';
		$lst_lang=get_languages();
        $str .= ' sugar_languages = '.$json->encode($lst_lang).',';
        $str .= ' default_currency_name = "'.$sugar_config['default_currency_name'].'",';
        $str .= ' default_currency_symbol = "'.$sugar_config['default_currency_symbol'].'",';
        $str .= ' default_date_format = "'.$sugar_config['default_date_format'].'",';
        $str .= ' db_type = "'.$sugar_config['dbconfig']['db_type'].'",';
		
		if (in_array ('jjwg_Maps',$moduleList)){
			$str .= ' jjwg_installed = true,';
			if (isset($administration->settings['jjwg_map_default_unit_type'])){
				$jjwg_def_unit=$administration->settings['jjwg_map_default_unit_type'];
			}
			else {
				$jjwg_def_unit='miles';
			}
			$str .= 'jjwg_def_unit="'.$jjwg_def_unit.'",';
			if (isset($administration->settings['jjwg_valid_geocode_modules'])){
				$jjwg_modules=$administration->settings['jjwg_valid_geocode_modules'];
			}
			else {
				$jjwg_modules='';
			}
			$str .= 'jjwg_modules="'.$jjwg_modules.'",';
			if (isset($administration->settings['map_default_center_latitude'])){
				$jjwg_c_lat=$administration->settings['map_default_center_latitude'];
				$jjwg_c_lng=$administration->settings['map_default_center_longitude'];
			}
			else {
				$jjwg_c_lat=39.5;
				$jjwg_c_lng=-99.5;
			}
			$str .= 'jjwg_c_lat='.$jjwg_c_lat.',' . 'jjwg_c_lng='.$jjwg_c_lng.',';
		}
		else {
			$str .= ' jjwg_installed = false,jjwg_def_unit="",jjwg_modules="",';
		}
		if (isset($sugar_config['aos'])) {
			$str .= ' aos_installed = "' . $sugar_config['aos']['version'] . '",';
			$str .= ' aos_params = '.$json->encode($sugar_config['aos']) . ',';
		}
		elseif ($aos) {
			$str .= ' aos_installed = "5.1",';
			$str .= ' aos_params = false,';
		}
		else {
			$str .= ' aos_installed = false,';
		}
		$str .= ' suitecrm = "' . suitecrmVersion() . '",';

		$str .= ' securitysuite = '.(in_array ('SecurityGroups',$moduleList)?'true':'false').',';
        $str .= ' offline_max_days = 7;';
		if ($sugar_config['quickcrm_trial'] != false) {
			$str .= 'var trial_code = "'.$sugar_config['quickcrm_trialcode'].'",';
			$str .= 'trial = "'.$sugar_config['quickcrm_trial'].'";';
		}
        else {
			$str .= 'var trial = false,';
			if (isset($administration->settings['QuickCRM_InDt'])) {
				$InDt=$administration->settings['QuickCRM_InDt'];
			}
			else {
				$InDt=date("Y-m-d");
				$administration->saveSetting('QuickCRM', 'InDt', $InDt);
			}
			$str .= 'QInDt = "'.$InDt.'",';
			$key="";


			if (isset($administration->settings['QuickCRM_key'])){

				$key=$administration->settings['QuickCRM_key'];

			}

			$str .= 'QProKey = "'.$key.'";';
		}

        $str .= 'var quickcrm_upd_time = "'.time().'";';


        $str .= 'QCRM.sugaroutfitters=false;';
		$usersTable = 'false';
		if (($sugar_config['sugar_version']>='6.5') && isset($sugar_config['quickcrm_server_version']) && $sugar_config['quickcrm_server_version'] >= '4.5')
			$usersTable = 'true';
        $str .= "QCRM.usersTable= $usersTable ;";

// FIND PLUGINS		
		$js_plugin="var js_plugins=[";
		$html_plugin="var html_plugins=[";
		try {
			$plugin_files = array();
			$handler = opendir(realpath(dirname(__FILE__).'/../../QuickCRM/plugins/'));
			$js_first=true;
			$html_first=true;
			if ($handler){
				while ($file = readdir($handler)) {
					if ($file !='.' && $file !='..' && $file !='.htaccess' && $file !='index.html') {
						if (substr($file,-3)=='.js'){
							if ($js_first){
								$js_first=false;
							}
							else{
								$js_plugin.= ",";
							}
							$js_plugin.= "'$file'";
						}
						elseif (substr($file,-4)=='.htm' || substr($file,-5)=='.html'){
							if ($html_first){
								$html_first=false;
							}
							else{
								$html_plugin.= ",";
							}
							$html_plugin.= "'$file'";
						}
					}
				}
				closedir($handler);
			}
		}
		catch (Exception $e) {
		}
		
		$js_plugin.="];";
		$html_plugin.="];";
        $str .= $js_plugin . $html_plugin;
		
		$str .= "var CustomHTML=".(file_exists("custom/QuickCRM/home.html")?"true":"false").",";
		$str .= " CustomJS=".(file_exists("custom/QuickCRM/custom.js")?"true":"false").";";
		$str .= " QCRM.CustomCSS=".(file_exists("custom/QuickCRM/custom.css")?"true":"false").";";
		
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'sugar_config', base64_encode($str));
		
// KEEP IT for SugarCRM 6.1 and 6.2 support
		if ($sugar_config['sugar_version']<'6.3'){
			$saveDir = realpath(dirname(__FILE__).'/../../../mobile'.($sugar_config['quickcrm_trial'] != false ?'_trial':'').'/');
        
			if($fh = @fopen($saveDir . '/config.js', "w")){
				fputs($fh, $str);
				fclose($fh);
			}
		}
    }

	function buildFieldArray($module,$module_def,$mobile_config){
		global $QuickCRM_modules,$QuickCRMDetailsFields,$QuickCRMTitleFields,$QuickCRMAddressesFields,$QuickCRMExtraFields,$QuickCRM_AddressDef;
		global $beanFiles, $beanList;
		$modfields=array();
		
		if (!file_exists($beanFiles[$beanList[$module]])){
			$GLOBALS['log']->fatal("[QuickCRM] Bean file not found for module $module");
			$this->modfields[$module]=$modfields;
			return;
		}
		
		$nodeModule = Q_new_bean($module);
		$excluded=array("id","created_by", "modified_user_id", "assigned_user_id","deleted");
		$users_include=array("user_name","first_name", "last_name", "department", "phone_mobile","email1");
		
		if (!isset($QuickCRMDetailsFields[$module])) {$Details=array();} else {$Details=$QuickCRMDetailsFields[$module];}
		if (!isset($QuickCRMTitleFields[$module])) {$Title=array();} else {$Title=$QuickCRMTitleFields[$module];}
		if (!isset($QuickCRMExtraFields[$module])) {$Extra=array();} else {$Extra=$QuickCRMExtraFields[$module];}
		$allfields=array_merge($Details,$Title); // ALL THESE DEFAULT FIELDS MUST BE LOADED. THEY MIGHT BE USED BY TEMPLATES.

		if (!isset($mobile_config['fields'][$module])) {$Add=array();} else {$Add=$mobile_config['fields'][$module];}
		if (!isset($mobile_config['search'][$module])) {$Search=array();} else {$Search=$mobile_config['search'][$module];}
		if (!isset($mobile_config['list'][$module])) {$List=array();} else {$List=$mobile_config['list'][$module];}
		if (!isset($mobile_config['addresses'][$module])) {$Addr=array();} else {$Addr=$mobile_config['addresses'][$module];}

		foreach ($Add as $A=>$val){

			if (substr($val,0,4)=='$ADD'){
				$prefix=substr($val,4,strlen($val)-4);
				foreach ($QuickCRM_AddressDef as $suffix) {
					$allfields[]=$prefix."_address_".$suffix;
				}
				// Add the virtual address fielddef
				$modfields[$val] = array(
									'type' => 'none',
									'req' => false,
									'label' => '',
									'source' => "non-db",
							);
			}
			else
				if (!in_array($val,$allfields)) $allfields[]=$val;
		}
		foreach ($Search as $S=>$val){
			if (!in_array($val,$allfields)) $allfields[]=$val;
		}
		
		foreach ($List as $S=>$val){
			if (!in_array($val,$allfields)) $allfields[]=$val;
		}
		
		foreach ($Extra as $S=>$val){
			if (!in_array($val,$allfields)) $allfields[]=$val;
		}
		
		// These fields are used internally. Add them if not already selected in customizations
		if (!in_array('date_entered',$allfields)) $allfields[]='date_entered';
		if (!in_array('date_modified',$allfields)) $allfields[]='date_modified';
		if (!in_array('assigned_user_name',$allfields)) $allfields[]='assigned_user_name';
		
		// Add name or firstname/lastname for custom modules.
		if (isset($module_def[$module]) && $module_def[$module]['type']=='person') {
			if (!in_array('first_name',$allfields)) $allfields[]='first_name';
			if (!in_array('last_name',$allfields)) $allfields[]='last_name';
		}
		elseif (isset($module_def[$module]) && $module_def[$module]['type']=='file') {
			if (!in_array('document_name',$allfields)) $allfields[]='document_name';
		}
		else {
			if (!in_array('name',$allfields)) $allfields[]='name';
		}

		// Add colorfield if it exists
		if (isset($mobile_config['marked'][$module]) && ($mobile_config['marked'][$module] !='') && ($mobile_config['marked'][$module] !='none') && ($mobile_config['marked'][$module] !='assigned_user_id')){
			if (!in_array($mobile_config['marked'][$module],$allfields)) $allfields[]=$mobile_config['marked'][$module];
		}
		
		foreach($nodeModule->field_name_map as $field_name => $field_defs)
		{	$source=(isset($field_defs['source'])?$field_defs['source']:"");

			if (in_array($field_defs['name'],$excluded)
				|| ($module=='Users' && !in_array($field_defs['name'],$users_include))
				|| ($module!='Users' && !in_array($field_defs['name'],$allfields))
// CE VERSION					||($field_defs['source']=='custom_fields')
				){
				continue;
			}
			if ($field_defs['type'] == 'datetimecombo') { $field_defs['type'] = 'datetime'; }
			if (($field_defs['type'] == 'relate')&&(isset($field_defs['module']))){
				$modfields[$field_defs['name']] = array(
									'type' => $field_defs['type'],
									'module' => $field_defs['module'],
									'req' => (isset($field_defs['required']) && ($field_defs['required']==True||$field_defs['required']=='1')),
									'id_name' => $field_defs['id_name'],
									'label' => $field_defs['vname'],
							);
				$id_fielddef=$nodeModule->field_name_map[$field_defs['id_name']];
				if (isset($id_fielddef['source']) && $id_fielddef['source'] == 'non-db') {
					$modfields[$field_defs['name']]['search']='non-db';
				}
				elseif (isset($id_fielddef['source']) && $id_fielddef['source'] == 'custom_fields') {
					$modfields[$field_defs['name']]['source']= '_cstm';
				}
			}
			elseif (($field_defs['type'] == 'parent')&& isset($field_defs['parent_type']) && isset($field_defs['options'])){
				$modfields[$field_defs['name']] = array(
									'type' => $field_defs['type'],
									'id_type' => $field_defs['type_name'],
									'id_name' => $field_defs['id_name'],
									'label' => $field_defs['vname'],
									'options' => $field_defs['options'],
							);
				if (!in_array ( $field_defs['options'] , $this->listOfLists )) $this->listOfLists[]= $field_defs['options'];
			}
			elseif ($field_defs['name']=='email1'){
				$modfields[$field_defs['name']] = array(
									'type' => 'email',
									'req' => (isset($field_defs['required']) && ($field_defs['required']==True||$field_defs['required']=='1')),
//									'source' => "",
									'label' => $field_defs['vname'],
							);
			}
			elseif($field_defs['type'] != 'link'
				&& $field_defs['type'] != 'relate'
				&& ($source != 'non-db'
					|| ($source == 'non-db'
						&& ($field_defs['type'] == 'Drawing'  || $field_defs['type'] == 'html'  || $field_defs['type'] == 'phone' || $field_defs['name'] == 'description' || $field_defs['name'] == 'description_html' || $field_defs['name'] == 'filename')
						)
					)
				)
			{
				$modfields[$field_defs['name']] = array(
									'type' => $field_defs['type'],
									'req' => (isset($field_defs['required']) && ($field_defs['required']==True||$field_defs['required']=='1')),
//									'source' => ($field_defs['source'] == 'custom_fields') ? '_cstm' : ($field_defs['source'] == 'non-db' ? 'non-db' :""),
									'label' => $field_defs['vname'],
							);
				if ($source == 'custom_fields') {
					$modfields[$field_defs['name']]['source']= '_cstm';
				}
				else {
					$modfields[$field_defs['name']]['source']= $source;
				}
				if (strpos($field_defs['type'],'enum') !== false) {
					$modfields[$field_defs['name']]['options']= $field_defs['options'];
					if (!in_array ( $field_defs['options'] , $this->listOfLists )) $this->listOfLists[]= $field_defs['options'];
					if ($field_defs['type'] == 'radioenum' ||($field_defs['type'] == 'dynamicenum')) {
						$modfields[$field_defs['name']]['type']= 'enum';
						if ($field_defs['type'] == 'dynamicenum') $modfields[$field_defs['name']]['parentenum']= $field_defs['parentenum'];
					}
				}
				if (isset($field_defs['readonly']) && ($field_defs['readonly']==True||$field_defs['readonly']=='1')){
					$modfields[$field_defs['name']]['readonly']= true;
				}
				$def='';
				if (isset($field_defs['default_value'])&&($field_defs['default_value']!=null)) {
					$def=$field_defs['default_value'];
				}
				if (isset($field_defs['default'])&&($field_defs['default']!=null)) {
					$def=$field_defs['default'];
				}
				if ($def!='') {
					$def=preg_replace("/'/","&#039;",$def);
					$def=preg_replace("/\"/","&&",$def);
					$def=preg_replace("/\\n/","<br>",$def);
					$modfields[$field_defs['name']]['def']=$def;
				}
				if ($field_defs['type'] == 'url' || $field_defs['type'] == 'iframe') {
					if (isset($field_defs['gen'])&&($field_defs['gen']==1)){
						$modfields[$field_defs['name']]['gen'] =1;
						$modfields[$field_defs['name']]['source'] ='non-db'; // non editable field
					}
					else {
						$modfields[$field_defs['name']]['gen'] =0;
					}
					if ($field_defs['type'] == 'iframe') {
						$modfields[$field_defs['name']]['height'] =$field_defs['height'];
					}
				}
				else if ($field_defs['type'] == 'Drawing' || $field_defs['type'] == 'image') {
					if (isset($field_defs['width'])&&($field_defs['width']!='')){
						$modfields[$field_defs['name']]['width'] =$field_defs['width'];
					}
					else {
						$modfields[$field_defs['name']]['width'] ='300px';
					}
					if (isset($field_defs['height'])&&($field_defs['height']!='')){
						$modfields[$field_defs['name']]['height'] =$field_defs['height'];
					}
					else {
						$modfields[$field_defs['name']]['height'] ='250px';
					}
				}
				else if ($field_defs['type'] == 'photo') {
					if ($field_defs['ext2']==1){
						$modfields[$field_defs['name']]['width'] =$field_defs['ext3'];
						$modfields[$field_defs['name']]['height'] =$field_defs['ext4'];
					}
				}
			}
		}
		if ($module=='Emails' && isset($modfields['description_html'])){
				$modfields['description_html']['label'] = 'LBL_HTML_BODY';
		}
		$this->modfields[$module]=$modfields;
		return;

	}

	function BuildModuleDef($mobile_config){
		$module_def=$mobile_config['mod_def'];
		foreach ($mobile_config['modules'] as $module){
			$module_def[$module]['links']=array();
			foreach ($mobile_config['links'][$module] as $lnk=>$values){
				$module_def[$module]['links'][$lnk]=$values['module'];
/* TODO FOR 3.0 once native apps have been updated

				if (isset($values['id_name'])){
					$module_def[$module]['links'][$lnk]= array (
						'module' => $values['module'],
						'id_name' => $values['id_name'],
					);
				}
				else {
					$module_def[$module]['links'][$lnk]=$values['module'];
				}
*/
			}
		}
		return $module_def;
	}
	
	function createFiles($lst_mod,$mobile_config){
		global $sugar_config;
		$module_def=$this->BuildModuleDef($mobile_config);
		$lst2=$lst_mod;
		$aos = (in_array('AOS_Quotes',$lst_mod) || in_array('AOS_Invoices',$lst_mod));
		
		if ( $aos && !in_array('AOS_Products_Quotes',$lst_mod)) {
			array_push($lst2,'AOS_Products_Quotes');
		}
		if ($sugar_config['dbconfig']['db_type'] !='mssql'){
			array_push($lst2,'QCRM_SavedSearch');
			array_push($lst2,'QCRM_Homepage');
		}

		foreach($lst2 as $key=>$moduleName)
		{
			$this->buildFieldArray($moduleName,$module_def,$mobile_config);
		}
		$this->createSugarConfig($aos);
		$this->createModuleFieldsCache($lst2,$module_def);
		$lst_lang=get_languages();
		$required_list = $this->listOfLists; // List of application list strings used in the application (enums)
		foreach($lst_lang as $language => $language_name){
			$this->createAppStringsCache($required_list,$lst_mod,$language);
			$this->createModuleStringsCache($lst2,$language,$module_def,$mobile_config);
		}
	}
}

?>