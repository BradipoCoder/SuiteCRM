<?php
$listViewDefs ['Cases'] =
array (
    'CASE_NUMBER'              =>
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_NUMBER',
    'default' => true,
  ),
    'IMP_RAS_NUMBER_C'         =>
        array(
            'type'    => 'varchar',
            'default' => true,
            'label'   => 'LBL_IMP_RAS_NUMBER',
            'width'   => '10%',
        ),
    'NAME'                     =>
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
  ),
    'ACCOUNT_NAME'             =>
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
    'TYPE'                     =>
  array (
      'type'    => 'enum',
      'label'   => 'LBL_TYPE',
      'width'   => '10%',
      'default' => true,
  ),
    'STATE'                    =>
        array(
            'type'    => 'enum',
            'default' => true,
            'label'   => 'LBL_STATE',
            'width'   => '10%',
        ),
    'STATUS'                   =>
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
  ),
    'PRIORITY'                 =>
  array (
      'width'   => '10%',
      'label'   => 'LBL_LIST_PRIORITY',
      'default' => true,
  ),
    'DATE_ENTERED'             =>
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
    'IMP_DOC_PROGRESSIVO_C'    =>
  array (
      'type'    => 'int',
      'default' => false,
      'label'   => 'LBL_IMP_DOC_PROGRESSIVO',
      'width'   => '10%',
  ),
    'REF_PART_NUMBER_C'        =>
  array (
      'type'    => 'varchar',
      'default' => false,
      'label'   => 'LBL_REF_PART_NUMBER',
      'width'   => '10%',
  ),
    'REF_PART_DESCRIPTION_C'   =>
  array (
      'type'    => 'varchar',
      'default' => false,
      'label'   => 'LBL_REF_PART_DESCRIPTION',
      'width'   => '10%',
  ),
    'REF_PART_UNIQUE_NUMBER_C' =>
  array (
      'type'    => 'varchar',
      'default' => false,
      'label'   => 'LBL_REF_PART_UNIQUE_NUMBER',
      'width'   => '10%',
  ),
    'DATE_CLOSE_EFCT_C'        =>
  array (
      'type'    => 'date',
      'default' => false,
      'label'   => 'LBL_DATE_CLOSE_EFCT',
      'width'   => '10%',
  ),
    'AREA_DINTERESSE_IMP_C'    =>
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_AREA_DINTERESSE_IMP',
    'width' => '10%',
  ),
    'CASE_AREA_C'              =>
  array (
      'type'    => 'enum',
      'default' => false,
      'studio'  => 'visible',
      'label'   => 'LBL_CASE_AREA',
      'width'   => '10%',
  ),
    'DATE_CLOSE_PRG_C'         =>
  array (
      'type'    => 'date',
      'default' => false,
      'label'   => 'LBL_DATE_CLOSE_PRG',
      'width'   => '10%',
  ),
    'DATE_MODIFIED'            =>
  array (
      'type'    => 'datetime',
      'label'   => 'LBL_DATE_MODIFIED',
      'width'   => '10%',
      'default' => false,
  ),
    'CREATED_BY_NAME'          =>
  array (
      'type'    => 'relate',
      'link'    => true,
      'label'   => 'LBL_CREATED',
      'id'      => 'CREATED_BY',
      'width'   => '10%',
      'default' => false,
  ),
    'ASSIGNED_USER_NAME'       =>
  array (
      'width'   => '10%',
      'label'   => 'LBL_ASSIGNED_TO_NAME',
      'module'  => 'Employees',
      'id'      => 'ASSIGNED_USER_ID',
      'default' => false,
  ),
    'INTERNAL_TAG_NUMBER_C'    =>
  array (
      'type'    => 'enum',
      'default' => false,
      'studio'  => 'visible',
      'label'   => 'LBL_INTERNAL_TAG_NUMBER',
      'width'   => '10%',
  ),
    'RIF_COMMESSA_CODE_C'      =>
  array (
      'type'    => 'varchar',
      'default' => false,
      'label'   => 'LBL_RIF_COMMESSA_CODE',
      'width'   => '10%',
  ),
    'JJWG_MAPS_ADDRESS_C'      =>
  array (
      'type'    => 'varchar',
      'default' => false,
      'label'   => 'LBL_JJWG_MAPS_ADDRESS',
      'width'   => '10%',
  ),
);
?>
