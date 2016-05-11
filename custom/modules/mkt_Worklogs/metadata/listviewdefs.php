<?php
$module_name = 'mkt_Worklogs';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'DURATION_HRS' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_DURATION_HRS',
    'width' => '10%',
  ),
  'DURATION_MIN' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_DURATION_MIN',
    'width' => '10%',
  ),
  'EXECUTION_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_EXECUTION_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'PARENT_NAME' => 
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
  ),
  'COMPLETED' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_COMPLETED',
    'width' => '10%',
  ),
);
?>
