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

$admin_option_defs=array();


$admin_option_defs['Administration']['quickcrm_users']= array('Users','LBL_USERS_QUICKCRM_TITLE','LBL_USERS_QUICKCRM','./index.php?module=Administration&action=usersquickcrm');

$admin_option_defs['Administration']['quickcrm_settings']= array('Administration','LBL_SETTINGS_QUICKCRM_TITLE','LBL_SETTINGS_QUICKCRM','./index.php?module=Administration&action=settingsquickcrm');
$admin_option_defs['Administration']['quickcrm_modules']= array('Studio','LBL_MODULES_QUICKCRM_TITLE','LBL_MODULES_QUICKCRM','./index.php?module=Administration&action=modulesquickcrm');
$admin_option_defs['Administration']['quickcrm_config']= array('Studio','LBL_CONFIG_QUICKCRM_TITLE','LBL_CONFIG_QUICKCRM','./index.php?module=Administration&action=configquickcrm');
$admin_option_defs['Administration']['quickcrm_update']= array('Repair','LBL_UPDATE_QUICKCRM_TITLE','LBL_UPDATE_QUICKCRM','./index.php?module=Administration&action=updatequickcrmpro');
$admin_option_defs['Administration']['quickcrm_reset']= array('Repair','LBL_RESET_QUICKCRM_TITLE','LBL_RESET_QUICKCRM','./index.php?module=Administration&action=resetquickcrm');
$admin_option_defs['Administration']['quickcrm_doc']= array('help','LBL_DOC_QUICKCRM_TITLE','LBL_DOC_QUICKCRM','http://www.ns-team.fr/doc/mobile/latest/QuickCRM_Manual_english.htm');
$admin_option_defs['Administration']['quickcrm_devguide']= array('help','LBL_DEVGUIDE_QUICKCRM_TITLE','LBL_DEVGUIDE_QUICKCRM','http://www.ns-team.fr/doc/mobile/latest/QuickCRM_Developers_Guide.pdf');
$admin_group_header[]= array('LBL_QUICKCRM_PRO','',false,$admin_option_defs, '');


?>