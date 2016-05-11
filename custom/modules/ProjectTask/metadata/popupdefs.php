<?php
$popupMeta = array (
    'moduleMain' => 'ProjectTask',
    'varName' => 'PROJECT_TASK',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'project_task.name',
  'current_user_only' => 'projecttask.current_user_only',
  'project_name' => 'projecttask.project_name',
  'assigned_user_id' => 'projecttask.assigned_user_id',
  'status' => 'projecttask.status',
  'milestone_flag' => 'projecttask.milestone_flag',
  'assigned_user_name' => 'projecttask.assigned_user_name',
),
    'searchInputs' => array (
  0 => 'name',
  1 => 'current_user_only',
  2 => 'project_name',
  3 => 'assigned_user_id',
  4 => 'status',
  5 => 'milestone_flag',
  6 => 'assigned_user_name',
),
    'searchdefs' => array (
  'current_user_only' => 
  array (
    'label' => 'LBL_CURRENT_USER_FILTER',
    'type' => 'bool',
    'width' => '10%',
    'name' => 'current_user_only',
  ),
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'project_name' => 
  array (
    'name' => 'project_name',
    'label' => 'LBL_PROJECT_NAME',
    'width' => '10%',
  ),
  'assigned_user_id' => 
  array (
    'name' => 'assigned_user_id',
    'type' => 'enum',
    'label' => 'LBL_ASSIGNED_TO',
    'function' => 
    array (
      'name' => 'get_user_array',
      'params' => 
      array (
        0 => false,
      ),
    ),
    'width' => '10%',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'name' => 'status',
  ),
  'milestone_flag' => 
  array (
    'type' => 'bool',
    'label' => 'LBL_MILESTONE_FLAG',
    'width' => '10%',
    'name' => 'milestone_flag',
  ),
  'assigned_user_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ASSIGNED_USER_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'name' => 'assigned_user_name',
  ),
),
    'listviewdefs' => array (
  'TASK_NUMBER' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TASK_NUMBER',
    'width' => '10%',
    'default' => true,
    'name' => 'task_number',
  ),
  'ORDER_NUMBER' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_ORDER_NUMBER',
    'width' => '10%',
    'name' => 'order_number',
  ),
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'sortable' => true,
    'name' => 'name',
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
    'name' => 'status',
  ),
  'PROJECT_NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_PROJECT_NAME',
    'id' => 'PROJECT_ID',
    'link' => true,
    'default' => true,
    'sortable' => true,
    'module' => 'Project',
    'ACLTag' => 'PROJECT',
    'related_fields' => 
    array (
      0 => 'project_id',
    ),
    'name' => 'project_name',
  ),
  'DATE_START' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_START',
    'default' => true,
    'sortable' => true,
    'name' => 'date_start',
  ),
  'DATE_FINISH' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_FINISH',
    'default' => true,
    'sortable' => true,
    'name' => 'date_finish',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
  'PRIORITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PRIORITY',
    'default' => true,
    'sortable' => true,
    'name' => 'priority',
  ),
  'PERCENT_COMPLETE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PERCENT_COMPLETE',
    'default' => true,
    'sortable' => true,
    'name' => 'percent_complete',
  ),
  'PREDECESSORS' => 
  array (
    'type' => 'text',
    'label' => 'LBL_PREDECESSORS',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
    'name' => 'predecessors',
  ),
  'MILESTONE_FLAG' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_MILESTONE_FLAG',
    'width' => '10%',
    'name' => 'milestone_flag',
  ),
),
);
