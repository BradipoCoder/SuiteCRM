<?php
$listViewDefs ['Users'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'related_fields' => 
    array (
      0 => 'last_name',
      1 => 'first_name',
    ),
    'orderBy' => 'last_name',
    'default' => true,
  ),
  'USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_USER_NAME',
    'link' => true,
    'default' => true,
  ),
  'EMAIL1' => 
  array (
    'width' => '30%',
    'sortable' => false,
    'label' => 'LBL_LIST_EMAIL',
    'link' => true,
    'default' => true,
  ),
  'IMP_AGENT_CODE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_IMP_AGENT_CODE',
    'width' => '10%',
  ),
  'MEKIT_AGENT_CODE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_AGENT_CODE',
    'width' => '10%',
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'IS_ADMIN' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ADMIN',
    'link' => false,
    'default' => true,
  ),
  'IS_GROUP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_GROUP',
    'link' => true,
    'default' => false,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_PHONE',
    'link' => true,
    'default' => false,
  ),
  'DEPARTMENT' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DEPARTMENT',
    'link' => true,
    'default' => false,
  ),
  'TITLE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TITLE',
    'link' => true,
    'default' => false,
  ),
);
?>
