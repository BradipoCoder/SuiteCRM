<?php
$popupMeta = array (
    'moduleMain' => 'Account',
    'varName' => 'ACCOUNT',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'accounts.name',
  'billing_address_city' => 'accounts.billing_address_city',
  'industry' => 'accounts.industry',
  'billing_address_state' => 'accounts.billing_address_state',
  'billing_address_country' => 'accounts.billing_address_country',
  'email' => 'accounts.email',
  'imp_origin_c' => 'accounts_cstm.imp_origin_c',
  'mekit_origin_c' => 'accounts_cstm.mekit_origin_c',
  'imp_agent_code_c' => 'accounts_cstm.imp_agent_code_c',
  'zone_c' => 'accounts_cstm.zone_c',
  'credit_risk_c' => 'accounts_cstm.credit_risk_c',
),
    'searchInputs' => array (
  0 => 'name',
  1 => 'billing_address_city',
  4 => 'industry',
  5 => 'billing_address_state',
  6 => 'billing_address_country',
  7 => 'email',
  9 => 'imp_origin_c',
  12 => 'mekit_origin_c',
  15 => 'imp_agent_code_c',
  16 => 'zone_c',
  17 => 'credit_risk_c',
),
    'create' => array (
  'formBase' => 'AccountFormBase.php',
  'formBaseClass' => 'AccountFormBase',
  'getFormBodyParams' => 
  array (
    0 => '',
    1 => '',
    2 => 'AccountSave',
  ),
  'createButton' => 'LNK_NEW_ACCOUNT',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'industry' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_INDUSTRY',
    'width' => '10%',
    'name' => 'industry',
  ),
  'imp_agent_code_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_IMP_AGENT_CODE',
    'width' => '10%',
    'name' => 'imp_agent_code_c',
  ),
  'zone_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_ZONE',
    'width' => '10%',
    'name' => 'zone_c',
  ),
  'billing_address_city' => 
  array (
    'name' => 'billing_address_city',
    'width' => '10%',
  ),
  'billing_address_state' => 
  array (
    'name' => 'billing_address_state',
    'width' => '10%',
  ),
  'billing_address_country' => 
  array (
    'name' => 'billing_address_country',
    'width' => '10%',
  ),
  'email' => 
  array (
    'name' => 'email',
    'width' => '10%',
  ),
  'imp_origin_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_IMP_ORIGIN',
    'width' => '10%',
    'name' => 'imp_origin_c',
  ),
  'credit_risk_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_CREDIT_RISK',
    'width' => '10%',
    'name' => 'credit_risk_c',
  ),
  'mekit_origin_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_ORIGIN',
    'width' => '10%',
    'name' => 'mekit_origin_c',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'BILLING_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_CITY',
    'default' => true,
    'name' => 'billing_address_city',
  ),
  'BILLING_ADDRESS_STATE' => 
  array (
    'width' => '7%',
    'label' => 'LBL_STATE',
    'default' => true,
    'name' => 'billing_address_state',
  ),
  'BILLING_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_COUNTRY',
    'default' => true,
    'name' => 'billing_address_country',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
),
);
