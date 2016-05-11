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
global $mod_strings;
global $app_strings;
global $app_list_strings;
global $current_language;
global $beanFiles, $beanList;
global $sugar_config;
ini_set("display_errors", 0);

require_once('custom/modules/Administration/QuickCRM_utils.php');
$qutils=new QUtils();
$qutils->LoadMobileConfig(true); // refresh first open only
$qutils->LoadServerConfig(true); // refresh first open only
$qutils->getAddressesLabels();

$module = $_REQUEST['conf_module'];

$MBmod_strings=return_module_language($current_language, 'ModuleBuilder');
$ss = new Sugar_Smarty();
$ss->assign('module', $module);
$ss->assign('MOD', $mod_strings);
$ss->assign('APP_STRINGS', $app_strings);
$ss->assign('AVAILABLE', $MBmod_strings['LBL_AVAILABLE']);
$ss->assign('HIDDEN', $MBmod_strings['LBL_HIDDEN']);
$ss->assign('TITLE', $app_list_strings["moduleList"][$module] . ' - ' . $MBmod_strings['LBL_LISTVIEW']);


$displayed = $qutils->mobile['list'][$module];
$available_fields=array();
foreach ($displayed as $field){
	$available_fields[]=array('field'=>$field,'label'=>$qutils->server_config['list'][$module][$field]['label']);
}
$ss->assign('tabAvailable', $available_fields);

$hidden_fields=array();
foreach ($qutils->server_config['list'][$module] as $field => $data ){
	if (!in_array($field,$displayed)){
		$hidden_fields[]=array('field'=>$field,'label'=>$data['label']);
	}
}
$ss->assign('tabHidden', $hidden_fields);

$colorfields = array();
$colorfields['none'] = $app_strings['LBL_NONE'];
$colorfields['assigned_user_id'] = $app_strings['LBL_LIST_ASSIGNED_USER'];
if (isset($qutils->server_config['marked'][$module])) {
	foreach ($qutils->server_config['marked'][$module] as $field => $data ){
		$colorfields[$field] = $data['label'];
	}
}

$ss->assign('color_value', $qutils->mobile['marked'][$module]);
$ss->assign('color_options', $colorfields);

$ss->display('custom/modules/Administration/tpls/QCRMList.tpl');

?>