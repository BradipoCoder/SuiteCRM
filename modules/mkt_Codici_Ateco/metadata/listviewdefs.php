<?php
$module_name = 'mkt_Codici_Ateco';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'SEZIONE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SEZIONE',
    'width' => '10%',
    'default' => true,
  ),
  'IMP_SECTOR' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'default' => true,
    'label' => 'LBL_IMP_SECTOR',
    'width' => '10%',
  ),
  'MEKIT_SECTOR' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'default' => true,
    'label' => 'LBL_MEKIT_SECTOR',
    'width' => '10%',
  ),
);
?>
