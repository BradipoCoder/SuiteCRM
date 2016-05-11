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

$MBmod_strings=return_module_language($current_language, 'ModuleBuilder');

global $sugar_config;
ini_set("display_errors", 0);
if ($sugar_config['quickcrm_trial'] == false) {

	require_once('modules/Administration/Administration.php');
	$administration = new Administration();
	$administration->retrieveSettings('QuickCRM',true);
	if (!isset($administration->settings['QuickCRM_keyverified']) || $administration->settings['QuickCRM_keyverified']==''){
		echo '<em><span style="color:red">'.$mod_strings['LBL_NOCODE'].'</span></em><br>';
	}


}

$titles=array(	'fields'=>$MBmod_strings['LBL_EDITVIEW'],
				'detail'=>$MBmod_strings['LBL_DETAILVIEW'],
				'search'=>$mod_strings['LBL_SEARCH_FIELDS_TITLE'],
				'list'=>$MBmod_strings['LBL_LISTVIEW'],
				'subpanels'=> $mod_strings['LBL_VISIBLE_PANELS']
	);
	
require_once('custom/modules/Administration/QuickCRM_utils.php');
require_once('include/ytree/Tree.php');
require_once('include/ytree/Node.php');
$qutils=new QUtils();
$qutils->LoadMobileConfig(true); 

$QuickCRM_modules= $qutils->mobile['modules'];

$conftree=new Tree('conftree');
$conftree->set_param('module','Administration');
foreach($QuickCRM_modules as $module){
	$node=new Node($module, isset($app_list_strings["moduleList"][$module])?$app_list_strings["moduleList"][$module]:$module);
	
	$nodeDisp =new Node($module."Display", $titles['detail']);
	$nodeDisp->set_property("href", "javascript: conf_detail('$module')");

	$nodeEdit =new Node($module."Fields", $titles['fields']);
	$nodeEdit->set_property("href", "javascript: conf_fields('$module')");

	$nodeSearch =new Node($module."Search", $titles['search']);
	$nodeSearch->set_property("href", "javascript: conf_search('$module')");
	
	$nodeList =new Node($module."List", $titles['list']);
	$nodeList->set_property("href", "javascript: conf_list('$module')");

	$nodeSubpanels =new Node($module."Subpanel", $titles['subpanels']);
	$nodeSubpanels->set_property("href", "javascript: conf_subpanels('$module')");

    $node->add_node($nodeEdit);       
    $node->add_node($nodeDisp);       
    $node->add_node($nodeSearch);       
    $node->add_node($nodeList);       
    $node->add_node($nodeSubpanels);       
	
    $conftree->add_node($node);       
}

echo $conftree->generate_header();

if ($sugar_config['sugar_version']<'6.5'){
	echo <<<EOQ
	<script type="text/javascript" src="custom/QuickCRM/lib/js/jquery-1.7.2.min.js"></script>
EOQ;
}
if (!suitecrmVersion() || suitecrmVersion() < '7.2') {
	echo <<<EOQ
	<script type="text/javascript" src="custom/QuickCRM/lib/js/jquery-ui-1.8.21.custom.min.js"></script>
EOQ;
}

echo <<<EOQ
<link rel="stylesheet" href="custom/QuickCRM/lib/css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css" media="all" />
<script type="text/javascript" src="custom/modules/Administration/conf_quickcrm.js?v=4.6.3"></script>
<style>
	#conf_sortableD1, #conf_sortableD2 { border-color: black;border-style: solid; border-width:1px; text-align:center ;margin:10px; width: 180px;list-style-type: none; margin: 10px; padding: 0 0 2.5em; float: left; margin-right: 10px; }
	#conf_sortableD1 li, #conf_sortableD2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 160px; text-align:left ;}
</style>
<div id="StatusDiv" style="height:20px;text-align:center;"></div>
<table cellpadding="0" cellspacing="0" style="border-left:1px solid; border-right:1px solid; border-bottom:1px solid" width="100%" class="edit view">
<tr>
	<td width="20%" valign="top" style="border-right: 1px solid">
		<div id="conftree">
			{$conftree->generate_nodes_array()}
		</div>
	</td>
	<td width="80%" valign="top" style="border-right: 1px">
		<form name="configquickcrm" method="POST" action="index.php">
			<div id="confpage" style="padding-left: 15px">
			</div>
		</form>
	</td>
</tr>
</table>
EOQ;
?>