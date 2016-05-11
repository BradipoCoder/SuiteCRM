<?php
$listViewDefs ['Accounts'] = 
array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'link' => true,
    'default' => true,
  ),
  'INDUSTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_INDUSTRY',
    'default' => true,
  ),
  'BILLING_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_CITY',
    'default' => true,
  ),
  'PHONE_OFFICE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PHONE',
    'default' => true,
  ),
  'ZONE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ZONE',
    'width' => '10%',
  ),
  'EMAIL1' => 
  array (
    'width' => '20%',
    'label' => 'LBL_EMAIL_ADDRESS',
    'sortable' => false,
    'link' => true,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'default' => true,
  ),
  'IMP_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_IMP_STATUS',
    'width' => '10%',
  ),
  'IMP_STATUS_PHASE__C' => 
  array (
    'type' => 'dynamicenum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_IMP_STATUS_PHASE_',
    'width' => '10%',
  ),
  'TARGET_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TARGET',
    'width' => '10%',
  ),
  'MESIMOBILI12_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_MESIMOBILI12',
    'currency_format' => true,
    'width' => '10%',
  ),
  'CODICE_ATECO_OLD_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CODICE_ATECO_OLD',
    'width' => '10%',
  ),
  'DAGENAOGGI_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_DAGENAOGGI',
    'currency_format' => true,
    'width' => '10%',
  ),
  'IMP_METODO_CLIENT_CODE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_IMP_METODO_CLIENT_CODE',
    'width' => '10%',
  ),
  'IMP_METODO_INVOICE_CLIENT_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_IMP_METODO_INVOICE_CLIENT',
    'width' => '10%',
  ),
  'IMP_METODO_SUPPLIER_CODE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_IMP_METODO_SUPPLIER_CODE',
    'width' => '10%',
  ),
  'MEKIT_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_STATUS',
    'width' => '10%',
  ),
  'MEKIT_STATUS_PHASE_C' => 
  array (
    'type' => 'dynamicenum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_STATUS_PHASE',
    'width' => '10%',
  ),
  'GENERA_CHIAMATA_AUTO_C' => 
  array (
    'type' => 'radioenum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_GENERA_CHIAMATA_AUTO',
    'width' => '10%',
  ),
  'PHONE_FAX' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PHONE_FAX',
    'default' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'CREDIT_RISK_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CREDIT_RISK',
    'width' => '10%',
  ),
  'VAT_NUMBER_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_VAT_NUMBER',
    'width' => '10%',
  ),
  'EMPLOYEE_NUMBER_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_EMPLOYEE_NUMBER',
    'width' => '10%',
  ),
  'PUBLIC_ADMINISTRATION_C' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_PUBLIC_ADMINISTRATION',
    'width' => '10%',
  ),
  'MEKIT_CLIENT_YEARLY_REVENUE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_CLIENT_YEARLY_REVENUE',
    'width' => '10%',
  ),
  'GIORNI_DI_APERTURA_C' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_GIORNI_DI_APERTURA',
    'width' => '10%',
  ),
  'FASCIA_ORARIA_ACQUISTI_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_FASCIA_ORARIA_ACQUISTI',
    'width' => '10%',
  ),
  'FT_PERIODO_ATTUALE_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_FT_PERIODO_ATTUALE',
    'currency_format' => true,
    'width' => '10%',
  ),
  'FT_PERIODO_MOBILE_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_FT_PERIODO_MOBILE',
    'currency_format' => true,
    'width' => '10%',
  ),
  'FT_ANNO_MENO_UNO_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_FT_ANNO_MENO_UNO',
    'currency_format' => true,
    'width' => '10%',
  ),
  'IMP_ACCOUNT_START_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_IMP_ACCOUNT_START',
    'width' => '10%',
  ),
  'IMP_PROFITABILITY_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_IMP_PROFITABILITY',
    'width' => '10%',
  ),
  'IMP_ORIGIN_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_IMP_ORIGIN',
    'width' => '10%',
  ),
  'MEKIT_PROFITABILITY_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_PROFITABILITY',
    'width' => '10%',
  ),
  'IMP_AGENT_CODE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_IMP_AGENT_CODE',
    'width' => '10%',
  ),
  'MEKIT_AGENT_CODE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_AGENT_CODE',
    'width' => '10%',
  ),
  'BILLING_ADDRESS_STREET' => 
  array (
    'width' => '15%',
    'label' => 'LBL_BILLING_ADDRESS_STREET',
    'default' => false,
  ),
  'BILLING_ADDRESS_STATE' => 
  array (
    'width' => '7%',
    'label' => 'LBL_BILLING_ADDRESS_STATE',
    'default' => false,
  ),
  'BILLING_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
    'default' => false,
  ),
  'BILLING_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_STREET' => 
  array (
    'width' => '15%',
    'label' => 'LBL_SHIPPING_ADDRESS_STREET',
    'default' => false,
  ),
  'IMP_METODO_CODE_OLD_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_IMP_METODO_CODE_OLD',
    'width' => '10%',
  ),
  'SHIPPING_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SHIPPING_ADDRESS_CITY',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_STATE' => 
  array (
    'width' => '7%',
    'label' => 'LBL_SHIPPING_ADDRESS_STATE',
    'default' => false,
  ),
  'MEKIT_METODO_INVOICE_CLIENT_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_MEKIT_METODO_INVOICE_CLIENT',
    'width' => '10%',
  ),
  'SHIPPING_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SHIPPING_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SHIPPING_ADDRESS_COUNTRY',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '5%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
  'PHONE_ALTERNATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OTHER_PHONE',
    'default' => false,
  ),
  'WEBSITE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_WEBSITE',
    'default' => false,
  ),
  'OWNERSHIP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OWNERSHIP',
    'default' => false,
  ),
  'EMPLOYEES' => 
  array (
    'width' => '10%',
    'label' => 'LBL_EMPLOYEES',
    'default' => false,
  ),
  'TICKER_SYMBOL' => 
  array (
    'width' => '10%',
    'label' => 'LBL_TICKER_SYMBOL',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'width' => '5%',
    'label' => 'LBL_DATE_MODIFIED',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MODIFIED',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'MEKIT_ORIGIN_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEKIT_ORIGIN',
    'width' => '10%',
  ),
  'MEKIT_METODO_SUPPLIER_CODE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_MEKIT_METODO_SUPPLIER_CODE',
    'width' => '10%',
  ),
  'MEKIT_METODO_CLIENT_CODE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_MEKIT_METODO_CLIENT_CODE',
    'width' => '10%',
  ),
);
?>
