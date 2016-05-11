<?php
$module_name = 'AOS_Products';
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
      'part_number' => 
      array (
        'name' => 'part_number',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'part_number' => 
      array (
        'name' => 'part_number',
        'default' => true,
        'width' => '10%',
      ),
      'cost' => 
      array (
        'name' => 'cost',
        'default' => true,
        'width' => '10%',
      ),
      'price' => 
      array (
        'name' => 'price',
        'default' => true,
        'width' => '10%',
      ),
      'created_by' => 
      array (
        'name' => 'created_by',
        'label' => 'LBL_CREATED',
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
      'aos_product_category_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_AOS_PRODUCT_CATEGORYS_NAME',
        'id' => 'AOS_PRODUCT_CATEGORY_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'aos_product_category_name',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
