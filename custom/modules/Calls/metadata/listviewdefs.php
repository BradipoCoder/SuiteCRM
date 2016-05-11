<?php
$listViewDefs ['Calls'] = 
array (
  'SET_COMPLETE' => 
  array (
    'width' => '1%',
    'label' => 'LBL_LIST_CLOSE',
    'link' => true,
    'sortable' => false,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'status',
    ),
  ),
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
  ),
  'LOCATION_ZONE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_LOCATION_ZONE',
    'width' => '10%',
  ),
  'INDUSTRY_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_INDUSTRY',
    'width' => '10%',
  ),
  'PARENT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_RELATED_TO',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'link' => true,
    'default' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
  ),
  'BILLING_ADDRESS_CITY_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_BILLING_ADDRESS_CITY',
    'width' => '10%',
  ),
  'OFFICE_PHONE_C' => 
  array (
    'type' => 'phone',
    'default' => true,
    'label' => 'LBL_OFFICE_PHONE',
    'width' => '10%',
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'RESULT_C' => 
  array (
    'type' => 'dynamicenum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RESULT',
    'width' => '10%',
  ),
  'DATE_SCHEDULE_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_DATE_SCHEDULE',
    'width' => '10%',
  ),
  'DATE_START' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_DATE',
    'link' => false,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'time_start',
    ),
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'TARGET_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_TARGET',
    'width' => '10%',
  ),
  'NEGATIVE_MOTIVATION_C' => 
  array (
    'type' => 'dynamicenum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_NEGATIVE_MOTIVATION',
    'width' => '10%',
  ),
  'NEGATIVE_REASON_C' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_NEGATIVE_REASON',
    'width' => '10%',
  ),
  'CAMPAGNA_TELEFONICA_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CAMPAGNA_TELEFONICA',
    'width' => '10%',
  ),
  'COMPANY_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_COMPANY_STATUS',
    'width' => '10%',
  ),
  'IMPORTANTE_C' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_IMPORTANTE',
    'width' => '10%',
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
  'CALL_PERIOD_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CALL_PERIOD',
    'width' => '10%',
  ),
  'RELATIVO_A_CAMPAGNA_C' => 
  array (
    'type' => 'relate',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_RELATIVO_A_CAMPAGNA',
    'id' => 'CAMPAIGN_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'PROFITABILITY_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_PROFITABILITY',
    'width' => '10%',
  ),
  'BILLING_ADDRESS_POSTALCODE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
    'width' => '10%',
  ),
  'ASSIGNED_CLIENT_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_ASSIGNED_CLIENT',
    'width' => '10%',
  ),
  'ATECO_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_ATECO',
    'width' => '10%',
  ),
  'RESCHEDULE_COUNT' => 
  array (
    'type' => 'varchar',
    'studio' => 'visible',
    'label' => 'LBL_RESCHEDULE_COUNT',
    'width' => '10%',
    'default' => false,
  ),
  'RESCHEDULE_HISTORY' => 
  array (
    'type' => 'varchar',
    'studio' => 'visible',
    'label' => 'LBL_RESCHEDULE_HISTORY',
    'width' => '10%',
    'default' => false,
  ),
  'SET_ACCEPT_LINKS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACCEPT_LINK',
    'width' => '10%',
    'default' => false,
  ),
  'ACCEPT_STATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACCEPT_STATUS',
    'width' => '10%',
    'default' => false,
  ),
  'OUTLOOK_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_OUTLOOK_ID',
    'width' => '10%',
    'default' => false,
  ),
  'REMINDERS' => 
  array (
    'type' => 'function',
    'label' => 'LBL_REMINDER',
    'width' => '10%',
    'default' => false,
  ),
  'PARENT_TYPE' => 
  array (
    'type' => 'parent_type',
    'label' => 'LBL_PARENT_TYPE',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_END' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_DATE_END',
    'width' => '10%',
    'default' => false,
  ),
  'DURATION_MINUTES' => 
  array (
    'type' => 'int',
    'label' => 'LBL_DURATION_MINUTES',
    'width' => '10%',
    'default' => false,
  ),
  'DURATION_HOURS' => 
  array (
    'type' => 'int',
    'label' => 'LBL_DURATION_HOURS',
    'width' => '10%',
    'default' => false,
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
  'DIRECTION' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_DIRECTION',
    'link' => false,
    'default' => false,
  ),
  'CONTACT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_CONTACT',
    'link' => true,
    'id' => 'CONTACT_ID',
    'module' => 'Contacts',
    'default' => false,
    'ACLTag' => 'CONTACT',
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
);
?>
