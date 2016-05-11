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
ini_set("display_errors", 0);

require_once('custom/modules/Administration/QuickCRM_utils.php');
$qutils=new QUtils();
// (re)build confif file
$qutils->LoadConfig();
$qutils->SaveConfig();

global $sugar_config;
global $mod_strings;

$webapp=$sugar_config['site_url'].'/mobile'.($sugar_config['quickcrm_trial'] != false?'_trial':'');
$nativeapp=$sugar_config['site_url'];
echo $mod_strings['LBL_UPDATE_MSG']." <strong><br>&nbsp;-&nbsp;Web app : $webapp<br>&nbsp;-&nbsp;QuickCRM for iOS : $nativeapp<br>&nbsp;-&nbsp;QuickCRM for Android : $nativeapp".'</strong>';

?>
