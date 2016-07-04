<?php
if (!defined('sugarEntry') || !sugarEntry)
{
    die('Not A Valid Entry Point');
}

$searchdefs['ProspectLists'] = array(
    'templateMeta' => array(
        'maxColumns' => '3',
        'maxColumnsBasic' => '4',
        'widths' => array('label' => '10', 'field' => '30'),
    ),
    'layout' => array(
        'basic_search' => array(
            'name' => array('name' => 'name', 'label' => 'LBL_PROSPECT_LIST_NAME',),
            'list_type' => array('name' => 'list_type', 'label' => 'LBL_LIST_TYPE', 'type' => 'enum'),
            'current_user_only' => array(
                'name' => 'current_user_only',
                'label' => 'LBL_CURRENT_USER_FILTER',
                'type' => 'bool'
            ),

        ),
        'advanced_search' => array(
            'name' => array('name' => 'name', 'label' => 'LBL_PROSPECT_LIST_NAME',),
            'list_type' => array('name' => 'list_type', 'label' => 'LBL_LIST_TYPE', 'type' => 'enum'),
            'current_user_only' => array(
                'name' => 'current_user_only',
                'label' => 'LBL_CURRENT_USER_FILTER',
                'type' => 'bool'
            ),
        ),
    ),
);

