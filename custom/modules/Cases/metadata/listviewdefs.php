<?php
$listViewDefs ['Cases'] = 
array (
  'CASE_NUMBER' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_NUMBER',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'module' => 'Accounts',
    'id' => 'ACCOUNT_ID',
    'link' => true,
    'default' => true,
    'ACLTag' => 'ACCOUNT',
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
  ),
  'PRIORITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PRIORITY',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  'JJWG_MAPS_LNG_C' => 
  array (
    'type' => 'float',
    'default' => false,
    'label' => 'LBL_JJWG_MAPS_LNG',
    'width' => '10%',
  ),
  'SOLUZIONE_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SOLUZIONE',
    'sortable' => false,
    'width' => '10%',
  ),
  'DATE_CLOSE_EFCT_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_DATE_CLOSE_EFCT',
    'width' => '10%',
  ),
  'CASE_AREA_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CASE_AREA',
    'width' => '10%',
  ),
  'JJWG_MAPS_LAT_C' => 
  array (
    'type' => 'float',
    'default' => false,
    'label' => 'LBL_JJWG_MAPS_LAT',
    'width' => '10%',
  ),
  'DESCRIZIONE_PROBLEMATICA_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_DESCRIZIONE_PROBLEMATICA',
    'sortable' => false,
    'width' => '10%',
  ),
  'N_MATRICOLA_MACCHINARIO_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_N_MATRICOLA_MACCHINARIO',
    'width' => '10%',
  ),
  'REF_WORKSHEET_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_REF_WORKSHEET',
    'width' => '10%',
  ),
  'DESCRIZIONE_AGGIORNAMENTO_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_DESCRIZIONE_AGGIORNAMENTO',
    'sortable' => false,
    'width' => '10%',
  ),
  'JJWG_MAPS_GEOCODE_STATUS_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_JJWG_MAPS_GEOCODE_STATUS',
    'width' => '10%',
  ),
  'CONTROLLED_C' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_CONTROLLED',
    'width' => '10%',
  ),
  'DATE_CLOSE_PRG_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_DATE_CLOSE_PRG',
    'width' => '10%',
  ),
  'JJWG_MAPS_ADDRESS_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_JJWG_MAPS_ADDRESS',
    'width' => '10%',
  ),
  'AREA_DINTERESSE_IMP_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_AREA_DINTERESSE_IMP',
    'width' => '10%',
  ),
  'ORIGINE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_ORIGINE',
    'width' => '10%',
  ),
  'AOP_CASE_UPDATES_THREADED' => 
  array (
    'type' => 'function',
    'studio' => 'visible',
    'label' => 'LBL_AOP_CASE_UPDATES_THREADED',
    'width' => '10%',
    'default' => false,
  ),
  'INTERNAL' => 
  array (
    'type' => 'bool',
    'studio' => 'visible',
    'label' => 'LBL_INTERNAL',
    'width' => '10%',
    'default' => false,
  ),
  'UPDATE_TEXT' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_UPDATE_TEXT',
    'sortable' => false,
    'width' => '10%',
  ),
  'CONTACT_CREATED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACT_CREATED_BY_NAME',
    'id' => 'CONTACT_CREATED_BY_ID',
    'width' => '10%',
    'default' => false,
  ),
  'CASE_UPDATE_FORM' => 
  array (
    'type' => 'function',
    'studio' => 'visible',
    'label' => 'LBL_CASE_UPDATE_FORM',
    'width' => '10%',
    'default' => false,
  ),
  'CASE_ATTACHMENTS_DISPLAY' => 
  array (
    'type' => 'function',
    'studio' => 'visible',
    'label' => 'LBL_CASE_ATTACHMENTS_DISPLAY',
    'width' => '10%',
    'default' => false,
  ),
  'STATE' => 
  array (
    'type' => 'enum',
    'default' => false,
    'label' => 'LBL_STATE',
    'width' => '10%',
  ),
  'ACCOUNT_NAME1' => 
  array (
    'type' => 'text',
    'studio' => 
    array (
      'formula' => false,
    ),
    'label' => 'account_name1',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'SUGGESTION_BOX' => 
  array (
    'type' => 'readonly',
    'label' => 'LBL_SUGGESTION_BOX',
    'width' => '10%',
    'default' => false,
  ),
  'WORK_LOG' => 
  array (
    'type' => 'text',
    'label' => 'LBL_WORK_LOG',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'RESOLUTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_RESOLUTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_TYPE',
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
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
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
);
?>
