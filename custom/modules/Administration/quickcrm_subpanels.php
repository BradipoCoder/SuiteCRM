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
$qutils->getSubPanelsLabels();

//$_REQUEST['conf_module']='Accounts';
$module = $_REQUEST['conf_module'];

$MBmod_strings=return_module_language($current_language, 'ModuleBuilder');
$ss = new Sugar_Smarty();
$ss->assign('module', $module);
$ss->assign('MOD', $mod_strings);
$ss->assign('APP_STRINGS', $app_strings);
$ss->assign('AVAILABLE', $MBmod_strings['LBL_AVAILABLE']);
$ss->assign('HIDDEN', $MBmod_strings['LBL_HIDDEN']);
$ss->assign('TITLE', $app_list_strings["moduleList"][$module] . ' - ' . $mod_strings['LBL_VISIBLE_PANELS']);


$displayed = $qutils->mobile['subpanels'][$module];
$available_fields=array();
foreach ($displayed as $field){
	$available_fields[]=array('field'=>$field,'label'=>$qutils->server_config['subpanels'][$module][$field]['tmplabel']);
}
$ss->assign('tabAvailable', $available_fields);

$hidden_fields=array();

foreach ($qutils->server_config['subpanels'][$module] as $field => $data ){
	if (!in_array($field,$displayed)){
		$hidden_fields[]=array('field'=>$field,'label'=>$data['tmplabel']);
	}
}
$ss->assign('tabHidden', $hidden_fields);

$ss->display('custom/modules/Administration/tpls/QCRMSubpanels.tpl');

?>