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

$module = $_REQUEST['conf_module'];

$MBmod_strings=return_module_language($current_language, 'ModuleBuilder');
$ss = new Sugar_Smarty();
$ss->assign('module', $module);
$ss->assign('MOD', $mod_strings);
$ss->assign('APP_STRINGS', $app_strings);
$ss->assign('AVAILABLE', $MBmod_strings['LBL_AVAILABLE']);
$ss->assign('HIDDEN', $MBmod_strings['LBL_HIDDEN']);
$ss->assign('TITLE', $app_list_strings["moduleList"][$module] . ' - ' . $MBmod_strings['LBL_DETAILVIEW']);

if (!isset($qutils->mobile['detail']) ||!isset($qutils->mobile['detail'][$module]) || $qutils->mobile['detail'][$module] == False){
	$ss->assign('HIDEFIELDS', "style='display:none;'");
	$ss->assign('IS_SYNCED', $MBmod_strings['LBL_SYNC_TO_DETAILVIEW_NOTICE']);
}
else
	$displayed = $qutils->mobile['detail'][$module];

$available_fields=array();
foreach ($displayed as $field){
	$label = $qutils->getFieldLabel ($module,$field);
	$available_fields[]=array('field'=>$field,'label'=>$label);
}
$ss->assign('tabAvailable', $available_fields);

$hidden_fields=array();
$preset_fields = $qutils->QgetPresetModuleFields();
if (isset($preset_fields[$module])) $preset_fields = $preset_fields[$module];
else $preset_fields = array();

foreach ($qutils->server_config['fields'][$module] as $field => $data ){
	if (!in_array($field,$displayed) && !in_array($field,$preset_fields)){
		$hidden_fields[]=array('field'=>$field,'label'=>$data['label']);
	}
}
$ss->assign('tabHidden', $hidden_fields);

$ss->display('custom/modules/Administration/tpls/QCRMDetail.tpl');

?>