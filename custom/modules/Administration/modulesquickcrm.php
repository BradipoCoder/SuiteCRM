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
global $app_list_strings;

global $sugar_config;
ini_set("display_errors", 0);
if ($sugar_config['quickcrm_trial'] == false) {

	require_once('modules/Administration/Administration.php');
	$administration = new Administration();
	$administration->retrieveSettings('QuickCRM');
	if (!isset($administration->settings['QuickCRM_keyverified']) || $administration->settings['QuickCRM_keyverified']==''){
		echo '<em><span style="color:red">'.$mod_strings['LBL_NOCODE'].'</span></em><br>';
	}


}

echo '<script>ajaxStatus.hideStatus();</script>';

require_once('custom/modules/Administration/QuickCRM_utils.php');
$qutils=new QUtils();
$qutils->LoadMobileConfig(true); 
$qutils->LoadServerConfig(true); // refresh first open only
/*
if (!isset($_REQUEST['conf_module'])) {
	$qutils->SaveServerConfig();
}
*/
$lst_enabled_modules = $qutils->mobile['modules'];
$lst_available_modules = $qutils->server_config['modules'];
$enabled_modules = array();
$available_modules = array();

foreach ($lst_enabled_modules as $module) {
		$enabled_modules[$module] = array(
			'id'=>$module,
			'full_name'=>$app_list_strings["moduleList"][$module],
		);
}
foreach ($lst_available_modules as $module) {
	if (!in_array($module,$lst_enabled_modules)){
		$available_modules[$module] = array(
			'id'=>$module,
			'full_name'=>$app_list_strings["moduleList"][$module],
		);
	}
}
$the_form = "";

if ($sugar_config['sugar_version']<'6.5'){
	$the_form .= <<<EOQ
	<script type="text/javascript" src="custom/QuickCRM/lib/js/jquery-1.7.2.min.js"></script>
EOQ;
}
if (!suitecrmVersion() || suitecrmVersion() < '7.2') {
	$the_form .= <<<EOQ
	<script type="text/javascript" src="custom/QuickCRM/lib/js/jquery-ui-1.8.21.custom.min.js"></script>
EOQ;
}

$the_form .= <<<EOQ
	<link rel="stylesheet" href="custom/QuickCRM/lib/css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css" media="all" />

	<style>
	#sortable1, #sortable2 { width:200px; border-color: black;border-style: solid; border-width:1px; text-align:center ;margin:10px; list-style-type: none; margin: 10px; padding: 0 0 2.5em; float: left; margin-right: 10px; }
	#sortable1 li, #sortable2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; text-align:left ;}
	</style>
	<script>
	$(function() {
		$( "#sortable1, #sortable2" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
		if ($('.sidebar').is(':visible'))
			$('#buttontoggle').click();
	});
	function beforeSave(button){
		button.form.enabled.value=$('#sortable1').sortable( 'toArray').toString();
		ajaxStatus.showStatus('{$mod_strings['LBL_CONFIG_SAVED']}');
		return true;
	}
	</script>
	
		<form name="modulesquickcrm2" method="POST" action="index.php">
			<input type="hidden" name="module" value="Administration">
			<input type="hidden" name="action" value="modulesquickcrm_save">
			<input type="hidden" name="return_module" value="Administration">
			<input type="hidden" name="return_action" value="modulesquickcrm">
			<input type="hidden" name="enabled" value="">
			
		<input title='{$app_strings['LBL_SAVE_BUTTON_TITLE']}' accessKey='M' class='button' onclick="return beforeSave(this);" name='button' type='submit' value='  {$app_strings['LBL_SAVE_BUTTON_TITLE']}  '>
		<input title='{$app_strings['LBL_CANCEL_BUTTON_TITLE']}' accessKey='X' class='button' onclick="location.href='index.php?module=Administration&action=index';" type='button' name='button' value='  {$app_strings['LBL_CANCEL_BUTTON_TITLE']}  '>
		<div class="demo">
			<br>
			<ul id="sortable1" class="connectedSortable">{$mod_strings['LBL_VISIBLE_TABS']}
EOQ;
foreach($enabled_modules as $module){
	$the_form .= "<li id= 'u_{$module['id']}' class='ui-state-default'>{$module['full_name']}</li>";
}
$the_form .= <<<EOQ
			</ul>

			<ul id="sortable2" class="connectedSortable">&nbsp;&nbsp;{$mod_strings['LBL_HIDDEN_TABS']}&nbsp;&nbsp;
EOQ;
foreach($available_modules as $module){
	$the_form .= "<li id= 'u_{$module['id']}' class='ui-state-default'>{$module['full_name']}</li>";
}
$the_form .= <<<EOQ
			</ul>

		</div>
EOQ;

$the_form .= <<<EOQ
		<br>
		</form>
EOQ;
echo $the_form;

?>
