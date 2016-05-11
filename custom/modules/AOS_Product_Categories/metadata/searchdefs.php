<?php
$module_name = 'AOS_Product_Categories';
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
      'metodo_category_code_c' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_METODO_CATEGORY_CODE',
        'width' => '10%',
        'name' => 'metodo_category_code_c',
      ),
      'is_parent' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_IS_PARENT',
        'width' => '10%',
        'name' => 'is_parent',
      ),
    ),
    'advanced_search' => 
    array (
      0 => 'name',
      1 => 
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
