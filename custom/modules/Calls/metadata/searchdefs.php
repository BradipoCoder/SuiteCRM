<?php
$searchdefs ['Calls'] = 
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
      'favorites_only' => 
      array (
        'name' => 'favorites_only',
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
      ),
      0 => 
      array (
        'name' => 'open_only',
        'label' => 'LBL_OPEN_ITEMS',
        'type' => 'bool',
        'default' => false,
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
      'parent_name' => 
      array (
        'type' => 'parent',
        'label' => 'LBL_LIST_RELATED_TO',
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'direction' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_DIRECTION',
        'width' => '10%',
        'default' => true,
        'name' => 'direction',
      ),
      'status' => 
      array (
        'name' => 'status',
        'default' => true,
        'width' => '10%',
      ),
      'result_c' => 
      array (
        'type' => 'dynamicenum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_RESULT',
        'width' => '10%',
        'name' => 'result_c',
      ),
      'campagna_telefonica_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CAMPAGNA_TELEFONICA',
        'width' => '10%',
        'name' => 'campagna_telefonica_c',
      ),
      'relativo_a_campagna_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_RELATIVO_A_CAMPAGNA',
        'id' => 'CAMPAIGN_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'relativo_a_campagna_c',
      ),
      'location_zone_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_LOCATION_ZONE',
        'width' => '10%',
        'name' => 'location_zone_c',
      ),
      'company_status_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_COMPANY_STATUS',
        'width' => '10%',
        'name' => 'company_status_c',
      ),
      'industry_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_INDUSTRY',
        'width' => '10%',
        'name' => 'industry_c',
      ),
      'target_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TARGET',
        'width' => '10%',
        'name' => 'target_c',
      ),
      'billing_address_city_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_BILLING_ADDRESS_CITY',
        'width' => '10%',
        'name' => 'billing_address_city_c',
      ),
      'call_period_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CALL_PERIOD',
        'width' => '10%',
        'name' => 'call_period_c',
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
        'default' => true,
        'width' => '10%',
      ),
      'date_schedule_c' => 
      array (
        'type' => 'datetimecombo',
        'default' => true,
        'label' => 'LBL_DATE_SCHEDULE',
        'width' => '10%',
        'name' => 'date_schedule_c',
      ),
      'date_start' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'date_start',
      ),
      'date_end' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE_END',
        'width' => '10%',
        'default' => true,
        'name' => 'date_end',
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
