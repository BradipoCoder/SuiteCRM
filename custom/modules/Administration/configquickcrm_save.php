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

function SaveFields($module){

	global $qutils;
	// Save Additional fields
	$lstfields=$_REQUEST['sel_fields'];
	if ($lstfields!=''){
		$qutils->mobile['fields'][$module] = explode(",",$lstfields); 
	}
	else $qutils->mobile['fields'][$module]=array();

	if (!isset($qutils->mobile['detail'])) $qutils->mobile['detail'] = array();
	if ($_REQUEST['syncCheckbox'] =='1'){
		$qutils->mobile['detail'][$module] = False; 
	}
	elseif (!isset($qutils->mobile['detail'][$module]) || $qutils->mobile['detail'][$module] == False) {
		// changed from synced to unsynced and no fields selected. Copy detail fields
		$qutils->mobile['detail'][$module] = $qutils->mobile['fields'][$module];
	}
}

function SaveDetail($module){

	global $qutils;
	// Save detail view fields
	if (!isset($qutils->mobile['detail'])) $qutils->mobile['detail'] = array();
	$lstfields=$_REQUEST['sel_fields'];
	if ($lstfields!=''){
		$qutils->mobile['detail'][$module] = explode(",",$lstfields); 
	}
	else $qutils->mobile['detail'][$module]=array();

}

function SaveSearch($module){

	global $qutils;
	// Save Search fields
	$lstfields=$_REQUEST['sel_fields'];
	if ($lstfields!=''){
		$qutils->mobile['search'][$module] = explode(",",$lstfields); 
	}
	else $qutils->mobile['search'][$module]=array();
	
}

function SaveList($module){

	global $qutils;

	// Save List fields
	$lstfields=$_REQUEST['sel_fields'];
	if ($lstfields!=''){
		$qutils->mobile['list'][$module] = explode(",",$lstfields); 
	}
	else $qutils->mobile['list'][$module]=array();
	$qutils->mobile['marked'][$module]=$_REQUEST['colorfield'];
	
}

function SaveSubpanels($module){

	global $qutils;

	$lstfields=$_REQUEST['sel_fields'];
	if ($lstfields!=''){
		$qutils->mobile['subpanels'][$module] = explode(",",$lstfields); 
	}
	else $qutils->mobile['subpanels'][$module] = array();
}

function SaveGeneral(){
	global $qutils;
	// Save RowsPerPage
	$qutils->mobile['rowsperpage']=$_REQUEST['rowsperpage'];
	$qutils->mobile['groupusers']=(isset($_REQUEST[groupusers])&&$_REQUEST[groupusers]=='on');
	$qutils->mobile['users_dropdown']=(isset($_REQUEST[users_dropdown])&&$_REQUEST[users_dropdown]=='on');
	$qutils->mobile['native_cal']=(isset($_REQUEST[native_cal])&&$_REQUEST[native_cal]=='on');
	$qutils->mobile['force_lock']=(isset($_REQUEST[force_lock])&&$_REQUEST[force_lock]=='on');
	$qutils->mobile['documents_sync']=(isset($_REQUEST[documents_sync])&&$_REQUEST[documents_sync]=='on');
}

if ($_REQUEST['conf_module']!='general') {
	if ($_REQUEST['conf_type']=='fields') {
		SaveFields($_REQUEST['conf_module']);
	}
	if ($_REQUEST['conf_type']=='detail') {
		SaveDetail($_REQUEST['conf_module']);
	}
	elseif ($_REQUEST['conf_type']=='search') {
		SaveSearch($_REQUEST['conf_module']);
	}
	elseif ($_REQUEST['conf_type']=='list') {
		SaveList($_REQUEST['conf_module']);
	}
	elseif ($_REQUEST['conf_type']=='subpanels') {
		SaveSubpanels($_REQUEST['conf_module']);
	}
}
else 
	SaveGeneral();

$qutils->SaveMobileConfig(true);
