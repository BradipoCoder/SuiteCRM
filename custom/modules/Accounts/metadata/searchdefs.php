<?php
$searchdefs ['Accounts'] = 
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
      'favorites_only' => 
      array (
        'name' => 'favorites_only',
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'industry' => 
      array (
        'name' => 'industry',
        'default' => true,
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
      'current_user_only' => 
      array (
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
        'name' => 'current_user_only',
      ),
      'favorites_only' => 
      array (
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
        'name' => 'favorites_only',
      ),
      'email' => 
      array (
        'name' => 'email',
        'label' => 'LBL_ANY_EMAIL',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'industry' => 
      array (
        'name' => 'industry',
        'default' => true,
        'width' => '10%',
      ),
      'employee_number_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_EMPLOYEE_NUMBER',
        'width' => '10%',
        'name' => 'employee_number_c',
      ),
      'zone_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ZONE',
        'width' => '10%',
        'name' => 'zone_c',
      ),
      'imp_cliente_fatturazione_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_IMP_CLIENTE_FATTURAZIONE',
        'width' => '10%',
        'name' => 'imp_cliente_fatturazione_c',
      ),
      'codiceatecorelate_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CODICEATECORELATE',
        'id' => 'MKT_CODICI_ATECO_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'codiceatecorelate_c',
      ),
      'public_administration_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_PUBLIC_ADMINISTRATION',
        'width' => '10%',
        'name' => 'public_administration_c',
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
      'campaign_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CAMPAIGN',
        'id' => 'CAMPAIGN_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'campaign_name',
      ),
      'billing_address_postalcode' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
        'width' => '10%',
        'default' => true,
        'name' => 'billing_address_postalcode',
      ),
      'billing_address_city' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_BILLING_ADDRESS_CITY',
        'width' => '10%',
        'default' => true,
        'name' => 'billing_address_city',
      ),
      'billing_address_state' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_BILLING_ADDRESS_STATE',
        'width' => '10%',
        'default' => true,
        'name' => 'billing_address_state',
      ),
      'phone_office' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_PHONE_OFFICE',
        'width' => '10%',
        'default' => true,
        'name' => 'phone_office',
      ),
      'vat_number_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_VAT_NUMBER',
        'width' => '10%',
        'name' => 'vat_number_c',
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
      'codice_fiscale_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CODICE_FISCALE',
        'width' => '10%',
        'name' => 'codice_fiscale_c',
      ),
      'imp_agent_code_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_AGENT_CODE',
        'width' => '10%',
        'name' => 'imp_agent_code_c',
      ),
      'imp_status_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_STATUS',
        'width' => '10%',
        'name' => 'imp_status_c',
      ),
      'imp_status_phase__c' => 
      array (
        'type' => 'dynamicenum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_STATUS_PHASE_',
        'width' => '10%',
        'name' => 'imp_status_phase__c',
      ),
      'mekit_agent_code_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MEKIT_AGENT_CODE',
        'width' => '10%',
        'name' => 'mekit_agent_code_c',
      ),
      'mekit_industry_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MEKIT_INDUSTRY',
        'width' => '10%',
        'name' => 'mekit_industry_c',
      ),
      'mekit_status_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MEKIT_STATUS',
        'width' => '10%',
        'name' => 'mekit_status_c',
      ),
      'mekit_status_phase_c' => 
      array (
        'type' => 'dynamicenum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MEKIT_STATUS_PHASE',
        'width' => '10%',
        'name' => 'mekit_status_phase_c',
      ),
      'mekit_origin_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MEKIT_ORIGIN',
        'width' => '10%',
        'name' => 'mekit_origin_c',
      ),
      'mekit_related_campaign_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MEKIT_RELATED_CAMPAIGN',
        'id' => 'CAMPAIGN_ID1_C',
        'link' => true,
        'width' => '10%',
        'name' => 'mekit_related_campaign_c',
      ),
      'imp_profitability_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_PROFITABILITY',
        'width' => '10%',
        'name' => 'imp_profitability_c',
      ),
      'imp_origin_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_ORIGIN',
        'width' => '10%',
        'name' => 'imp_origin_c',
      ),
      'imp_account_start_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_ACCOUNT_START',
        'width' => '10%',
        'name' => 'imp_account_start_c',
      ),
      'imp_metodo_client_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_IMP_METODO_CLIENT_CODE',
        'width' => '10%',
        'name' => 'imp_metodo_client_code_c',
      ),
      'imp_metodo_invoice_client_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_IMP_METODO_INVOICE_CLIENT',
        'width' => '10%',
        'name' => 'imp_metodo_invoice_client_c',
      ),
      'imp_metodo_supplier_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_IMP_METODO_SUPPLIER_CODE',
        'width' => '10%',
        'name' => 'imp_metodo_supplier_code_c',
      ),
      'mekit_metodo_client_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_MEKIT_METODO_CLIENT_CODE',
        'width' => '10%',
        'name' => 'mekit_metodo_client_code_c',
      ),
      'mekit_metodo_supplier_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_MEKIT_METODO_SUPPLIER_CODE',
        'width' => '10%',
        'name' => 'mekit_metodo_supplier_code_c',
      ),
      'mekit_metodo_invoice_client_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_MEKIT_METODO_INVOICE_CLIENT',
        'width' => '10%',
        'name' => 'mekit_metodo_invoice_client_c',
      ),
      'active_inactive_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ACTIVE_INACTIVE',
        'width' => '10%',
        'name' => 'active_inactive_c',
      ),
      'credit_risk_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CREDIT_RISK',
        'width' => '10%',
        'name' => 'credit_risk_c',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'telerratoinesistente_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TELERRATOINESISTENTE',
        'width' => '10%',
        'name' => 'telerratoinesistente_c',
      ),
      'imp_cleaning_c' => 
      array (
        'type' => 'radioenum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IMP_CLEANING',
        'width' => '10%',
        'name' => 'imp_cleaning_c',
      ),
      'giorni_di_apertura_c' => 
      array (
        'type' => 'multienum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_GIORNI_DI_APERTURA',
        'width' => '10%',
        'name' => 'giorni_di_apertura_c',
      ),
      'fascia_oraria_acquisti_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_FASCIA_ORARIA_ACQUISTI',
        'width' => '10%',
        'name' => 'fascia_oraria_acquisti_c',
      ),
      'price_listing_c' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_PRICE_LISTING',
        'width' => '10%',
        'name' => 'price_listing_c',
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
