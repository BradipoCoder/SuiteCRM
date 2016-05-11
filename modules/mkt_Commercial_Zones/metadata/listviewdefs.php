<?php
$module_name = 'mkt_Commercial_Zones';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'ZIP_CODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ZIP_CODE',
    'width' => '10%',
    'default' => true,
  ),
  'PROVINCE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PROVINCE',
    'width' => '10%',
    'default' => true,
  ),
  'REGION' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_REGION',
    'width' => '10%',
    'default' => true,
  ),
  'COMMERCIAL_ZONE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_COMMERCIAL_ZONE',
    'width' => '10%',
    'default' => true,
  ),
  'IMP_AGENT' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_IMP_AGENT',
    'width' => '10%',
    'default' => true,
  ),
  'MEKIT_AGENT' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_AGENT',
    'width' => '10%',
    'default' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
);
?>
