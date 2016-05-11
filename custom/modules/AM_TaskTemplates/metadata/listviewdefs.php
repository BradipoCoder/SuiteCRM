<?php
$module_name = 'AM_TaskTemplates';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'TASK_NUMBER' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TASK_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'DURATION' => 
  array (
    'type' => 'int',
    'label' => 'LBL_DURATION',
    'width' => '10%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'PRIORITY' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PRIORITY',
    'width' => '10%',
  ),
  'MILESTONE_FLAG' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_MILESTONE_FLAG',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'AM_TASKTEMPLATES_AM_PROJECTTEMPLATES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_AM_TASKTEMPLATES_AM_PROJECTTEMPLATES_FROM_AM_PROJECTTEMPLATES_TITLE',
    'id' => 'AM_TASKTEMPLATES_AM_PROJECTTEMPLATESAM_PROJECTTEMPLATES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'ORDER_NUMBER' => 
  array (
    'type' => 'int',
    'label' => 'LBL_ORDER_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'RELATIONSHIP_TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RELATIONSHIP_TYPE',
    'width' => '10%',
  ),
  'UTILIZATION' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_UTILIZATION',
    'width' => '10%',
  ),
  'ESTIMATED_EFFORT' => 
  array (
    'type' => 'int',
    'label' => 'LBL_ESTIMATED_EFFORT',
    'width' => '10%',
    'default' => false,
  ),
  'PREDECESSORS' => 
  array (
    'type' => 'int',
    'label' => 'LBL_PREDECESSORS',
    'width' => '10%',
    'default' => false,
  ),
  'PERCENT_COMPLETE' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_PERCENT_COMPLETE',
    'width' => '10%',
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => '10%',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
);
?>
