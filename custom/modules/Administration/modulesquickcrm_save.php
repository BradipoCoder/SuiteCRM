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
if(!isset($_REQUEST['enabled']))
	sugar_die("No modules selected");

global $sugar_config;
global $mod_strings;

require_once('custom/modules/Administration/QuickCRM_utils.php');
$qutils=new QUtils();

$QuickCRM_enabled_modules= array();

$enabled=explode(",", $_REQUEST['enabled']);
foreach($enabled as $module){
	array_push($QuickCRM_enabled_modules,substr ($module ,2));
}
$qutils->LoadMobileConfig(false);
$qutils->mobile['modules']=$QuickCRM_enabled_modules;
$qutils->UpdateModules();
$qutils->SaveMobileConfig(true);
header("Location: index.php?module=Administration&action=modulesquickcrm");

?>
