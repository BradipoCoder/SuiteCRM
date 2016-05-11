<?php
$module_name = 'mkt_Worklogs';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'duration_hrs',
            'label' => 'LBL_DURATION_HRS',
          ),
          1 => 
          array (
            'name' => 'duration_min',
            'label' => 'LBL_DURATION_MIN',
          ),
        ),
        2 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'operation_type',
            'studio' => 'visible',
            'label' => 'LBL_OPERATION_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'execution_date',
            'label' => 'LBL_EXECUTION_DATE',
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
        ),
        4 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'completed',
            'label' => 'LBL_COMPLETED',
          ),
        ),
      ),
    ),
  ),
);
?>
