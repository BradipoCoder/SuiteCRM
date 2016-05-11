<?php
/*
All LBL_* are defined in: custom/modules/Meetings/language/it_IT.lang.php
*/

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


/*
$subpanel_layout = array(
	//Removed button because this layout def is a component of
	//the activities sub-panel.
	//'where' => "(calls.status=\'Planned\')",
	'where' => "(calls.status != 'Held' AND calls.status != 'Not Held')",


	'list_fields' => array(
		'object_image'=>array(
			'vname' => 'LBL_OBJECT_IMAGE',
			'widget_class' => 'SubPanelIcon',
 		 	'width' => '2%',
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
		'contact_name'=>array(
			 'widget_class' => 'SubPanelDetailViewLink',
			 'target_record_key' => 'contact_id',
			 'target_module' => 'Contacts',
			 'module' => 'Contacts',
			 'vname' => 'LBL_LIST_CONTACT',
			 'width' => '11%',
			 'sortable'=>false,
		),
			'contact_name_owner'=>array(
			'usage'=>'query_only',
			'force_exists'=>true
			),
			'contact_name_mod'=>array(
			'usage'=>'query_only',
			'force_exists'=>true
			),
		'contact_id'=>array(
			'usage'=>'query_only',

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
		'close_button'=>array(
			'widget_class' => 'SubPanelCloseButton',
			'vname' => 'LBL_LIST_CLOSE',
			'width' => '6%',
			'sortable'=>false,
		),
		'remove_button'=>array(
				'vname' => 'LBL_REMOVE',
			 'widget_class' => 'SubPanelRemoveButton',
			 'width' => '2%',
		),
		'time_start'=>array(
			'usage'=>'query_only',

		),
		'recurring_source'=>array(
			'usage'=>'query_only',
		),

	),
);
*/


$subpanel_layout = [
    'where' => "(calls.status != 'Held' AND calls.status != 'Not Held')",
    'fill_in_additional_fields'	=> false,
    'list_fields' => [
        'object_image'=>[
            'vname' => 'LBL_OBJECT_IMAGE',
            'widget_class' => 'SubPanelIcon',
            'width' => '2%',
        ],
        'name' => [
            'vname' => 'LBL_LIST_SUBJECT',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '58%',
        ],
        'status' => [
            'widget_class' => 'SubPanelActivitiesStatusField',
            'vname' => 'LBL_LIST_STATUS',
            'width' => '15%',
        ],
        'date_schedule_c'=> [
            'force_default' => '(SELECT date_schedule_c FROM calls_cstm WHERE calls_cstm.id_c = calls.id) AS',
            'force_exists' => true,
            'vname' => 'LBL_LIST_SCHEDULE_DATE',
            'width' => '10%',
            'alias' => 'date_start',
            'sort_by' => 'date_start',
        ],
        'assigned_user_name' => [
            'name' => 'assigned_user_name',
            'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'target_record_key' => 'assigned_user_id',
            'target_module' => 'Employees',
            'width' => '10%',
        ],
        'edit_button' => [
            'vname' => 'LBL_EDIT_BUTTON',
            'widget_class' => 'SubPanelEditButton',
            'width' => '5%',
        ],
    ]
];
