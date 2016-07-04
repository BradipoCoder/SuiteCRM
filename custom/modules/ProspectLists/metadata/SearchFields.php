<?php
if (!defined('sugarEntry') || !sugarEntry)
{
    die('Not A Valid Entry Point');
}


$searchFields['ProspectLists'] = array(
    'name' => array('query_type' => 'default'),
    'list_type' => array('query_type' => 'default'),
    'current_user_only' => array(
        'query_type' => 'default',
        'db_field' => array('assigned_user_id'),
        'my_items' => TRUE,
        'vname' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool'
    ),
);

