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

include('custom/modules/Administration/QuickCRM_utils.php');
global $qutils;
$qutils=new QUtils();
$qutils->LoadMobileConfig();

function SaveGeneral(){
	global $qutils, $sugar_config;
	$qutils->mobile['rowsperpage']=$_REQUEST['rowsperpage'];
	$qutils->mobile['groupusers']=(isset($_REQUEST['groupusers'])&&$_REQUEST['groupusers']=='on');
	$qutils->mobile['users_dropdown']=(isset($_REQUEST['users_dropdown'])&&$_REQUEST['users_dropdown']=='on');
	$qutils->mobile['native_cal']=(isset($_REQUEST['native_cal'])&&$_REQUEST['native_cal']=='on');
	$qutils->mobile['force_lock']=(isset($_REQUEST['force_lock'])&&$_REQUEST['force_lock']=='on');
	$qutils->mobile['documents_sync']=(isset($_REQUEST['documents_sync'])&&$_REQUEST['documents_sync']=='on');
	if (isset($sugar_config['suitecrm_version'])){
		$qutils->mobile['productimage']=(isset($_REQUEST['productimage'])&&$_REQUEST['productimage']=='on');
	}
}

SaveGeneral();

$qutils->SaveMobileConfig(true);
header ("Location: index.php?module=Administration&action=index");
