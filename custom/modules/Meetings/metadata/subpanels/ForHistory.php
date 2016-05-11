<?php
/*
All LBL_* are defined in: custom/modules/Meetings/language/it_IT.lang.php
*/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*
$subpanel_layout = array(
    //Removed button because this layout def is a component of
    //the activities sub-panel.

    'where' => "(meetings.status='Held' OR meetings.status='Not Held')",

    'list_fields' => array(
        'object_image'=>array(
            'vname' => 'LBL_OBJECT_IMAGE',
            'widget_class' => 'SubPanelIcon',
            'width' => '2%',
            'image2'=>'attachment',
            'image2_url_field'=>'file_url'
        ),
        'name'=>array(
            'vname' => 'LBL_LIST_SUBJECT',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '30%',
        ),
        'status'=>array(
            'widget_class' => 'SubPanelActivitiesStatusField',
            'vname' => 'LBL_LIST_STATUS',
            'width' => '15%',
        ),
        'reply_to_status' => array(
            'usage'				=> 'query_only',
            'force_exists'			=> true,
            'force_default'		=> 0,
        ),
        'contact_name'=>array(
            'widget_class'			=> 'SubPanelDetailViewLink',
            'target_record_key'	=> 'contact_id',
            'target_module'		=> 'Contacts',
            'module'				=> 'Contacts',
            'vname'				=> 'LBL_LIST_CONTACT',
            'width'				=> '11%',
            'sortable'=>false,
        ),
        'contact_id'=>array(
            'usage'=>'query_only',

        ),
        'contact_name_owner'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
        'contact_name_mod'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
        'parent_id'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
        'parent_type'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
        'date_modified'=>array(
            'vname' => 'LBL_LIST_DATE_MODIFIED',
            'width' => '10%',
        ),
        'date_entered'=>array(
            'vname' => 'LBL_LIST_DATE_ENTERED',
            'width' => '10%',
        ),
        'date_start'=>array(
            'vname' => 'LBL_LIST_DUE_DATE',
            'width' => '10%',
        ),
        'assigned_user_name' => array (
            'name' => 'assigned_user_name',
            'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'target_record_key' => 'assigned_user_id',
            'target_module' => 'Employees',
            'width' => '10%',
        ),
        'edit_button'=>array(
            'vname' => 'LBL_EDIT_BUTTON',
            'widget_class' => 'SubPanelEditButton',
            'width' => '2%',
        ),
        'remove_button'=>array(
            'vname' => 'LBL_REMOVE',
            'widget_class' => 'SubPanelRemoveButton',
            'width' => '2%',
        ),
        'filename'=>array(
            'usage'=>'query_only',
            'force_exists'=>true
        ),
        'recurring_source'=>array(
            'usage'=>'query_only',
        ),
    ),
);
*/

$subpanel_layout = [
    'where' => "(meetings.status='Held' OR meetings.status='Not Held')",
    'fill_in_additional_fields'	=> false,
    'list_fields' => [
        'object_image' => [
            'vname' => 'LBL_OBJECT_IMAGE',
            'widget_class' => 'SubPanelIcon',
            'width' => '2%',
            'image2'=>'attachment',
            'image2_url_field'=>'file_url'
        ],
        'name' => [
            'vname' => 'LBL_LIST_SUBJECT',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '28%',
        ],
        'status' => [
            'widget_class' => 'SubPanelActivitiesStatusField',
            'vname' => 'LBL_LIST_STATUS',
            'width' => '15%',
            'force_exists' => true,
        ],
        'result_c' => [
            'force_blank' => true,
            'vname' => 'LBL_LIST_RESULT',
            'width' => '15%',
        ],
        'date_start' => [
            'vname' => 'LBL_LIST_START_DATE',
            'width' => '10%',
            'alias' => 'date_entered',
            'sort_by' => 'date_entered',
        ],
        'assigned_user_name' => [
            'name' => 'assigned_user_name',
            'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'target_record_key' => 'assigned_user_id',
            'target_module' => 'Employees',
            'width' => '10%',
        ],
    ]
];