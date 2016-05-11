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
global $sugar_config;
global $db;

require_once('modules/Administration/Administration.php');
require_once('custom/modules/Administration/QuickCRM_utils.php');
$administration = new Administration();
$administration->retrieveSettings('QuickCRM',true);

echo '<script>ajaxStatus.hideStatus();</script>';
// find users list
$user= new User();
$user->retrieve('1');

// FIX FOR MS SQL
//$query = "SELECT id, CONCAT(IFNULL(first_name,''),' ',last_name) AS full_name FROM users WHERE status='Active' AND deleted=0";
$select_query = db_concat('users',array('first_name','last_name')) . " full_name ";
$query = "SELECT id, " . $select_query . " FROM users WHERE users.status='Active' AND users.deleted=0 AND (users.is_group IS NULL OR users.is_group =0)";

$users_list=$user->db->query($query);
$users_list_arr = array();
while (($row = $user->db->fetchByAssoc($users_list))!= null){$users_list_arr[] = $row;}
$json = getJSONobj();
$All_users_list=$json->encode($users_list_arr);

// find authorized users list
$auth_users_list_arr = array();
$usr = array(); // saved users
$stored_users=array();

$table_store = (($sugar_config['sugar_version']>='6.5') && isset($sugar_config['quickcrm_server_version']) && $sugar_config['quickcrm_server_version'] >= '4.5');
if ($table_store) {
	$query = "SELECT user_id FROM qcrm_users WHERE deleted=0";
	$users_list=$db->query($query);
	while (($row = $user->db->fetchByAssoc($users_list))!= null){$stored_users[] = $row['user_id'];}
}
else {
	if (isset($sugar_config['quickcrm_users']) && !empty($sugar_config['quickcrm_users']))
		$stored_users= explode(",", $sugar_config['quickcrm_users']);
}

foreach ($stored_users as $saved) {
        $name="";
        for ($i = 0; $i < sizeof($users_list_arr); $i++) {
            if ($users_list_arr[$i]['id']==$saved){
                $name=$users_list_arr[$i]['full_name'];
                unset($users_list_arr[$i]);
                $users_list_arr=array_values($users_list_arr);
                break;
            }
        }

        $auth_users_list_arr[] = array(
            'id'=> $saved,
            'full_name' => $name
        );
}

$check='';
$displayLimitDate='';
$checkKey=false;
if (isset($sugar_config['quickcrm_max']) && ($sugar_config['quickcrm_max']>0) ){
    $check .= <<<EOQ
	if (button.form.authorized.value=="") { alert ('{$mod_strings['LBL_NO_USER']}'); return false;}
	var nb=button.form.authorized.value.split(',').length;
	if (nb > {$sugar_config['quickcrm_max']}) { alert ('{$mod_strings['LBL_TOOMANYUSERS']}'); return false;}
EOQ;
}

if ($sugar_config['quickcrm_trial'] == false) {
    if (!isset($administration->settings['QuickCRM_keyverified']) || $administration->settings['QuickCRM_keyverified']==''){
        $checkKey=true;
        if (isset($administration->settings['QuickCRM_InDt'])) {
            $InDt=$administration->settings['QuickCRM_InDt'];
            $MaxDt=date('Y-m-d', strtotime("-7 days"));
            if ($MaxDt < $InDt) {
                $checkKey=false;
                $displayLimitDate=date('Y-m-d',strtotime($InDt." +7 days"));
            }
        }
    }
    if ($checkKey) {
        $check .= <<<EOQ
		if (button.form.trial_code.value=="") { alert ('{$mod_strings['LBL_NOCODE']}'); return false;}
EOQ;
    }
}
if(!function_exists("curl_init")) {
    echo "<span style='color:red'>ERROR: curl PHP extension must be enabled prior to QuickCRM settings</span><br><br>";
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
	var allUsers=$All_users_list;
	$(function() {
		$( "#sortable1, #sortable2" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
		if ($('.sidebar').is(':visible'))
			$('#buttontoggle').click();
	});
	function AddAllUsers(elt){
		$("#sortable1 li").remove();
		$("#sortable2 li").remove();
		for (var e in allUsers){
			elt.append($("<li id= 'u_"+allUsers[e].id+"' class='ui-state-highlight'>"+allUsers[e].full_name+"</li>"));
		}
	}
	function deselectAll(){
		AddAllUsers($("#sortable1"));
	}
	function selectAll(){
		AddAllUsers($("#sortable2"));
	}
	function beforeSave(button){
		button.form.authorized.value=$('#sortable2').sortable( 'toArray').toString();
		$check;
		ajaxStatus.showStatus('{$mod_strings['LBL_CONFIG_SAVED']}');
		return true;
	}
	</script>
	
		<form name="usersquickcrm2" method="POST" action="index.php">
			<input type="hidden" name="module" value="Administration">
			<input type="hidden" name="action" value="usersquickcrm_save">
			<input type="hidden" name="authorized" value="">
			
		<input title='{$app_strings['LBL_SAVE_BUTTON_TITLE']}' accessKey='M' class='button' onclick="return beforeSave(this);" type='submit' name='button' value='  {$app_strings['LBL_SAVE_BUTTON_TITLE']}  '>
		<input title='{$app_strings['LBL_CANCEL_BUTTON_TITLE']}' accessKey='X' class='button' onclick="location.href='index.php?module=Administration&action=index';" type='button' name='button' value='  {$app_strings['LBL_CANCEL_BUTTON_TITLE']}  '>
EOQ;

$current_code='';
$dt='';
$keyverified=false;
if ($sugar_config['quickcrm_trial'] != false) {
    if (isset($sugar_config['quickcrm_trialcode'])){
        $current_code=$sugar_config['quickcrm_trialcode'];
    }
}
else {
    if (isset($administration->settings['QuickCRM_key'])){
        $current_code=$administration->settings['QuickCRM_key'];
    }
    if (isset($administration->settings['QuickCRM_keyverified'])){
        $dt=$administration->settings['QuickCRM_keyverified'];
        if ($dt!=='') $keyverified=true;
    }
}

if ($keyverified){
    $the_form .= <<<EOQ
		<br><br>{$mod_strings['LBL_TRIAL_CODE']}&nbsp;&nbsp;$current_code &nbsp;&nbsp;<input title='{$app_strings['LBL_CLEAR_BUTTON_TITLE']}' accessKey='C' class='button' onclick="location.href='index.php?module=Administration&action=quickcrm_reset_license';" type='button' name='button' value='  {$app_strings['LBL_CLEAR_BUTTON_TITLE']}  '>
EOQ;
}
else {
    $the_form .= <<<EOQ
		<br><br>{$mod_strings['LBL_TRIAL_CODE']}&nbsp;&nbsp;<input title='{$mod_strings['LBL_TRIAL_CODE']}' type="text" id='trial_code' name='trial_code' value='$current_code'>
EOQ;
    if($current_code!='' && isset($_REQUEST['keyok']) && $_REQUEST['keyok']=='0'){
        $the_form .= "&nbsp;&nbsp;<span style='color:red'>Invalid key</span>";
    }
    if ($displayLimitDate!='') {
        $the_form .= "<br><span style='color:red'>".str_replace ('@',$displayLimitDate,$mod_strings['LBL_CODE_LIMIT'].'</span>');
    }
}

$the_form .= <<<EOQ
		<div class="demo">
			<br>{$mod_strings['LBL_USERSLISTHELP']}<br>
			<input title='{$app_strings['LBL_LISTVIEW_OPTION_ENTIRE']}' accessKey='A' class='button' onclick="selectAll();" type='button' name='sel_all' value='  {$app_strings['LBL_LISTVIEW_OPTION_ENTIRE']}  '>
			<input title='{$app_strings['LBL_LISTVIEW_NONE']}' accessKey='N' class='button' onclick="deselectAll();" type='button' name='desel_all' value='  {$app_strings['LBL_LISTVIEW_NONE']}  '>
			<br>
			<br>
			<input type="text" id="search_user_sortable1" name="search" placeholder="{$app_strings['LBL_SEARCH']}" style="margin-left:10px;width:190px">
			<input type="text" id="search_user_sortable2" name="search" placeholder="{$app_strings['LBL_SEARCH']}" style="margin-left:15px;width:190px">
						<br>
			<ul id="sortable1" class="connectedSortable">{$mod_strings['LBL_USERSLIST']}
EOQ;
foreach($users_list_arr as $usr){
    $the_form .= "<li id= 'u_{$usr['id']}' class='ui-state-default'>{$usr['full_name']}</li>";
}
$the_form .= <<<EOQ
			</ul>
			<ul id="sortable2" class="connectedSortable">&nbsp;&nbsp;{$mod_strings['LBL_SELECTEDUSERS']}&nbsp;&nbsp;
EOQ;
foreach($auth_users_list_arr as $usr){
    $the_form .= "<li id= 'u_{$usr['id']}' class='ui-state-highlight'>{$usr['full_name']}</li>";
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
<script>
    $('#search_user_sortable1').on('keyup', function(){
        var str = $(this).val();
        var tt= $('#sortable1 li');
        $(tt).each(function(indx, element){
            var start_str = $(element).text().toLowerCase();

            if(start_str.indexOf(str.toLowerCase())!==-1){
                $(element).show();
            }
            else {
                $(element).hide();
            }
        })
    });
    $('#search_user_sortable2').on('keyup', function(){
        var str = $(this).val();
        var tt= $('#sortable2 li');
        $(tt).each(function(indx, element){
            var start_str = $(element).text().toLowerCase();

            if(start_str.indexOf(str.toLowerCase())!==-1){
                $(element).show();
            }
            else {
                $(element).hide();
            }
        })
    });
</script>