<?php
$viewdefs ['Accounts'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Accounts/Account.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'website',
          ),
          1 => 
          array (
            'name' => 'public_administration_c',
            'label' => 'LBL_PUBLIC_ADMINISTRATION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'email1',
          ),
          1 => 
          array (
            'name' => 'phone_office',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_postalcode',
            'comment' => 'The postal code used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'comment' => 'The street address used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'vat_number_c',
            'label' => 'LBL_VAT_NUMBER',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_city',
            'comment' => 'The city used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_CITY',
          ),
          1 => 
          array (
            'name' => 'codice_fiscale_c',
            'label' => 'LBL_CODICE_FISCALE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'account_type',
          ),
          1 => 
          array (
            'name' => 'imp_competitor_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_COMPETITOR',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'imp_interest_articles_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_INTEREST_ARTICLES',
          ),
          1 => 
          array (
            'name' => 'imp_origin_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_ORIGIN',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'employees',
            'comment' => 'Number of employees, varchar to accomodate for both number (100) or range (50-100)',
            'label' => 'LBL_EMPLOYEES',
          ),
          1 => 
          array (
            'name' => 'imp_client_yearly_revenue_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_CLIENT_YEARLY_REVENUE',
          ),
        ),
      ),
    ),
  ),
);
?>
