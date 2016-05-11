<?php
$module_name = 'mkt_Commercial_Zones';
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
      'imp_agent' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_IMP_AGENT',
        'width' => '10%',
        'default' => true,
        'name' => 'imp_agent',
      ),
      'mekit_agent' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'default' => true,
        'label' => 'LBL_MEKIT_AGENT',
        'width' => '10%',
        'name' => 'mekit_agent',
      ),
      'commercial_zone' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_COMMERCIAL_ZONE',
        'width' => '10%',
        'default' => true,
        'name' => 'commercial_zone',
      ),
      'zip_code' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_ZIP_CODE',
        'width' => '10%',
        'default' => true,
        'name' => 'zip_code',
      ),
      'province' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_PROVINCE',
        'width' => '10%',
        'default' => true,
        'name' => 'province',
      ),
      'region' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_REGION',
        'width' => '10%',
        'default' => true,
        'name' => 'region',
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
        'width' => '10%',
        'default' => true,
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
