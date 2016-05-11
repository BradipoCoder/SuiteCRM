<?php
$module_name = 'mkt_Worklogs';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'execution_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_EXECUTION_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'execution_date',
      ),
    ),
    'advanced_search' => 
    array (
      'current_user_only' => 
      array (
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'width' => '10%',
        'default' => true,
        'name' => 'current_user_only',
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'duration_hrs' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_DURATION_HRS',
        'width' => '10%',
        'name' => 'duration_hrs',
      ),
      'duration_min' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_DURATION_MIN',
        'width' => '10%',
        'name' => 'duration_min',
      ),
      'execution_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_EXECUTION_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'execution_date',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'studio' => 'visible',
        'label' => 'LBL_FLEX_RELATE',
        'link' => true,
        'sortable' => false,
        'ACLTag' => 'PARENT',
        'dynamic_module' => 'PARENT_TYPE',
        'id' => 'PARENT_ID',
        'related_fields' => 
        array (
          0 => 'parent_id',
          1 => 'parent_type',
        ),
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
      ),
      'completed' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_COMPLETED',
        'width' => '10%',
        'name' => 'completed',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
