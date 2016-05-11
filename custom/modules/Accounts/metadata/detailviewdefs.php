<?php
$viewdefs ['Accounts'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
          'AOS_GENLET' => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_GENERATE_LETTER}">',
          ),
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_ACCOUNT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL14' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL7' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL8' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL10' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL9' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL11' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL12' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL13' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_account_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'comment' => 'Name of the Company',
            'label' => 'LBL_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_office',
            'comment' => 'The office phone number',
            'label' => 'LBL_PHONE_OFFICE',
          ),
          1 => 
          array (
            'name' => 'telerratoinesistente_c',
            'studio' => 'visible',
            'label' => 'LBL_TELERRATOINESISTENTE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'phone_alternate',
            'comment' => 'An alternate phone number',
            'label' => 'LBL_PHONE_ALT',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
            'comment' => 'The fax phone number of this company',
            'label' => 'LBL_FAX',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'label' => 'LBL_BILLING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'billing',
            ),
          ),
          1 => 
          array (
            'name' => 'shipping_address_street',
            'label' => 'LBL_SHIPPING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'shipping',
            ),
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'zone_c',
            'studio' => 'visible',
            'label' => 'LBL_ZONE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'vat_number_c',
            'label' => 'LBL_VAT_NUMBER',
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
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL',
          ),
          1 => 
          array (
            'name' => 'website',
            'type' => 'link',
            'label' => 'LBL_WEBSITE',
            'displayParams' => 
            array (
              'link_target' => '_blank',
            ),
          ),
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'public_administration_c',
            'label' => 'LBL_PUBLIC_ADMINISTRATION',
          ),
          1 => 
          array (
            'name' => 'codice_ateco_old_c',
            'label' => 'LBL_CODICE_ATECO_OLD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'business_purpose_c',
            'label' => 'LBL_BUSINESS_PURPOSE',
          ),
          1 => 
          array (
            'name' => 'target_c',
            'studio' => 'visible',
            'label' => 'LBL_TARGET',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'employee_number_c',
            'studio' => 'visible',
            'label' => 'LBL_EMPLOYEE_NUMBER',
          ),
          1 => 
          array (
            'name' => 'volume_affari_c',
            'studio' => 'visible',
            'label' => 'LBL_VOLUME_AFFARI',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'cciaa_rea_c',
            'label' => 'LBL_CCIAA_REA',
          ),
          1 => 
          array (
            'name' => 'active_inactive_c',
            'studio' => 'visible',
            'label' => 'LBL_ACTIVE_INACTIVE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'credit_risk_c',
            'studio' => 'visible',
            'label' => 'LBL_CREDIT_RISK',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'imp_agent_code_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_AGENT_CODE',
          ),
          1 => 
          array (
            'name' => 'imp_origin_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_ORIGIN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'imp_related_campaign_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_RELATED_CAMPAIGN',
          ),
          1 => 
          array (
            'name' => 'imp_related_account_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_RELATED_ACCOUNT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'imp_profitability_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_PROFITABILITY',
          ),
          1 => 
          array (
            'name' => 'imp_client_yearly_revenue_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_CLIENT_YEARLY_REVENUE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'imp_competitor_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_COMPETITOR',
          ),
          1 => 
          array (
            'name' => 'imp_interest_articles_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_INTEREST_ARTICLES',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'imp_other_competitor_c',
            'label' => 'LBL_IMP_OTHER_COMPETITOR',
          ),
          1 => 
          array (
            'name' => 'imp_served_by_c',
            'label' => 'LBL_IMP_SERVED_BY',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'imp_cleaning_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_CLEANING',
          ),
          1 => 
          array (
            'name' => 'dacheclienteimpeservito_c',
            'studio' => 'visible',
            'label' => 'LBL_DACHECLIENTEIMPESERVITO',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'imp_status_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_STATUS',
          ),
          1 => 
          array (
            'name' => 'imp_status_phase__c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_STATUS_PHASE_',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'industry',
            'comment' => 'The company belongs in this industry',
            'label' => 'LBL_INDUSTRY',
          ),
          1 => 
          array (
            'name' => 'imp_account_start_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_ACCOUNT_START',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'imp_commercial_notes_c',
            'label' => 'LBL_IMP_COMMERCIAL_NOTES',
          ),
          1 => 
          array (
            'name' => 'fascia_oraria_acquisti_c',
            'studio' => 'visible',
            'label' => 'LBL_FASCIA_ORARIA_ACQUISTI',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'giorni_di_apertura_c',
            'studio' => 'visible',
            'label' => 'LBL_GIORNI_DI_APERTURA',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel14' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'imp_macchine_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_MACCHINE',
          ),
          1 => 
          array (
            'name' => 'imp_macchine_note_c',
            'label' => 'LBL_IMP_MACCHINE_NOTE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'imp_macchine_proprieta_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_MACCHINE_PROPRIETA',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'imp_prev_di_fatt_100_c',
            'label' => 'LBL_IMP_PREV_DI_FATT_100',
          ),
          1 => 
          array (
            'name' => 'imp_prev_di_fatt_50_c',
            'label' => 'LBL_IMP_PREV_DI_FATT_50',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'imp_prev_di_fatt_10_c',
            'label' => 'LBL_IMP_PREV_DI_FATT_10',
          ),
          1 => 
          array (
            'name' => 'imp_totale_prev_fatt_c',
            'label' => 'LBL_IMP_TOTALE_PREV_FATT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'imp_sconto_medio_c',
            'label' => 'LBL_IMP_SCONTO_MEDIO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'price_listing_c',
            'label' => 'LBL_PRICE_LISTING',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_1_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_1',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_1_c',
            'label' => 'LBL_FATTURATO_THISYEAR_1',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_2_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_2',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_2_c',
            'label' => 'LBL_FATTURATO_THISYEAR_2',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_3_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_3',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_3_c',
            'label' => 'LBL_FATTURATO_THISYEAR_3',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_4_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_4',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_4_c',
            'label' => 'LBL_FATTURATO_THISYEAR_4',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_5_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_5',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_5_c',
            'label' => 'LBL_FATTURATO_THISYEAR_5',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_6_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_6',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_6_c',
            'label' => 'LBL_FATTURATO_THISYEAR_6',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_7_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_7',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_7_c',
            'label' => 'LBL_FATTURATO_THISYEAR_7',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_8_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_8',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_8_c',
            'label' => 'LBL_FATTURATO_THISYEAR_8',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_9_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_9',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_9_c',
            'label' => 'LBL_FATTURATO_THISYEAR_9',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_10_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_10',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_10_c',
            'label' => 'LBL_FATTURATO_THISYEAR_10',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_11_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_11',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_11_c',
            'label' => 'LBL_FATTURATO_THISYEAR_11',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'fatturato_lastyear_12_c',
            'label' => 'LBL_FATTURATO_LASTYEAR_12',
          ),
          1 => 
          array (
            'name' => 'fatturato_thisyear_12_c',
            'label' => 'LBL_FATTURATO_THISYEAR_12',
          ),
        ),
      ),
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'ft_periodo_attuale_c',
            'label' => 'LBL_FT_PERIODO_ATTUALE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ft_periodo_mobile_c',
            'label' => 'LBL_FT_PERIODO_MOBILE',
          ),
          1 => 
          array (
            'name' => 'ft_perc_att_mob_c',
            'label' => 'LBL_FT_PERC_ATT_MOB',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'ft_anno_meno_uno_c',
            'label' => 'LBL_FT_ANNO_MENO_UNO',
          ),
          1 => 
          array (
            'name' => 'ft_perc_att_amu_c',
            'label' => 'LBL_FT_PERC_ATT_AMU',
          ),
        ),
      ),
      'lbl_editview_panel10' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mesimobili12_c',
            'label' => 'LBL_MESIMOBILI12',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ft_anno_meno_uno_completo_c',
            'label' => 'LBL_FT_ANNO_MENO_UNO_COMPLETO',
          ),
          1 => 
          array (
            'name' => 'mesi12mobiliannom1_c',
            'label' => 'LBL_MESI12MOBILIANNOM1',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'dagenaoggi_c',
            'label' => 'LBL_DAGENAOGGI',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'stessoanno1_c',
            'label' => 'LBL_STESSOANNO1',
          ),
          1 => 
          array (
            'name' => 'inizioannostesso1_c',
            'label' => 'LBL_INIZIOANNOSTESSO1',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mekit_agent_code_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_AGENT_CODE',
          ),
          1 => 
          array (
            'name' => 'mekit_origin_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_ORIGIN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mekit_related_campaign_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_RELATED_CAMPAIGN',
          ),
          1 => 
          array (
            'name' => 'mekit_related_account_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_RELATED_ACCOUNT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'mekit_profitability_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_PROFITABILITY',
          ),
          1 => 
          array (
            'name' => 'mekit_client_yearly_revenue_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_CLIENT_YEARLY_REVENUE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'mekit_competitor_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_COMPETITOR',
          ),
          1 => 
          array (
            'name' => 'mekit_interest_articles_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_INTEREST_ARTICLES',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'mekit_other_competitor_c',
            'label' => 'LBL_MEKIT_OTHER_COMPETITOR',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'mekit_industry_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_INDUSTRY',
          ),
          1 => 
          array (
            'name' => 'mekit_account_start_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_ACCOUNT_START',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'mekit_status_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_STATUS',
          ),
          1 => 
          array (
            'name' => 'mekit_status_phase_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_STATUS_PHASE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'mekit_commercial_notes_c',
            'label' => 'LBL_MEKIT_COMMERCIAL_NOTES',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mkt_prev_di_fatt_100_c',
            'label' => 'LBL_MKT_PREV_DI_FATT_100',
          ),
          1 => 
          array (
            'name' => 'mkt_prev_di_fatt_50_c',
            'label' => 'LBL_MKT_PREV_DI_FATT_50',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mkt_prev_di_fatt_10_c',
            'label' => 'LBL_MKT_PREV_DI_FATT_10',
          ),
          1 => 
          array (
            'name' => 'mkt_totale_prev_fatt_c',
            'label' => 'LBL_MKT_TOTALE_PREV_FATT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'mkt_sconto_medio_c',
            'label' => 'LBL_MKT_SCONTO_MEDIO',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_1_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_1',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_1_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_1',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_2_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_2',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_2_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_2',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_3_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_3',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_3_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_3',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_4_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_4',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_4_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_4',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_5_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_5',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_5_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_5',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_6_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_6',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_6_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_6',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_7_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_7',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_7_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_7',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_8_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_8',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_8_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_8',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_9_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_9',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_9_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_9',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_10_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_10',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_10_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_10',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_11_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_11',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_11_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_11',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'mkt_fatturato_lastyear_12_c',
            'label' => 'LBL_MKT_FATTURATO_LASTYEAR_12',
          ),
          1 => 
          array (
            'name' => 'mkt_fatturato_thisyear_12_c',
            'label' => 'LBL_MKT_FATTURATO_THISYEAR_12',
          ),
        ),
      ),
      'lbl_editview_panel11' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mkt_ft_periodo_attuale_c',
            'label' => 'LBL_MKT_FT_PERIODO_ATTUALE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mkt_ft_periodo_mobile_c',
            'label' => 'LBL_MKT_FT_PERIODO_MOBILE',
          ),
          1 => 
          array (
            'name' => 'mkt_ft_perc_att_mob_c',
            'label' => 'LBL_MKT_FT_PERC_ATT_MOB',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'mkt_ft_anno_meno_uno_c',
            'label' => 'LBL_MKT_FT_ANNO_MENO_UNO',
          ),
          1 => 
          array (
            'name' => 'mkt_ft_perc_att_amu_c',
            'label' => 'LBL_MKT_FT_PERC_ATT_AMU',
          ),
        ),
      ),
      'lbl_editview_panel12' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mkt_mesimobili12_c',
            'label' => 'LBL_MKT_MESIMOBILI12',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mkt_ft_anno_meno_uno_complet_c',
            'label' => 'LBL_MKT_FT_ANNO_MENO_UNO_COMPLET',
          ),
          1 => 
          array (
            'name' => 'mkt_mesi12mobiliannom1_c',
            'label' => 'LBL_MKT_MESI12MOBILIANNOM1',
          ),
        ),
      ),
      'lbl_editview_panel13' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mkt_dagenaoggi_c',
            'label' => 'LBL_MKT_DAGENAOGGI',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mkt_stessoanno1_c',
            'label' => 'LBL_MKT_STESSOANNO1',
          ),
          1 => 
          array (
            'name' => 'mkt_inizioannostesso1_c',
            'label' => 'LBL_MKT_INIZIOANNOSTESSO1',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'imp_metodo_code_old_c',
            'label' => 'LBL_IMP_METODO_CODE_OLD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'imp_metodo_client_code_c',
            'label' => 'LBL_IMP_METODO_CLIENT_CODE',
          ),
          1 => 
          array (
            'name' => 'mekit_metodo_client_code_c',
            'label' => 'LBL_MEKIT_METODO_CLIENT_CODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'imp_metodo_supplier_code_c',
            'label' => 'LBL_IMP_METODO_SUPPLIER_CODE',
          ),
          1 => 
          array (
            'name' => 'mekit_metodo_supplier_code_c',
            'label' => 'LBL_MEKIT_METODO_SUPPLIER_CODE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'imp_metodo_invoice_client_c',
            'label' => 'LBL_IMP_METODO_INVOICE_CLIENT',
          ),
          1 => 
          array (
            'name' => 'mekit_metodo_invoice_client_c',
            'label' => 'LBL_MEKIT_METODO_INVOICE_CLIENT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'imp_metodo_invoice_supplier_c',
            'label' => 'LBL_IMP_METODO_INVOICE_SUPPLIER',
          ),
          1 => 
          array (
            'name' => 'mekit_metodo_invoice_supplie_c',
            'label' => 'LBL_MEKIT_METODO_INVOICE_SUPPLIE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'imp_metodo_notes_c',
            'label' => 'LBL_IMP_METODO_NOTES',
          ),
          1 => 
          array (
            'name' => 'mekit_metodo_notes_c',
            'label' => 'LBL_MEKIT_METODO_NOTES',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'metodo_last_update_time_c',
            'label' => 'LBL_METODO_LAST_UPDATE_TIME',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'imp_sync_as_client_c',
            'studio' => 'visible',
            'label' => 'LBL_IMP_SYNC_AS_CLIENT',
          ),
          1 => 
          array (
            'name' => 'mekit_sync_as_client_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_SYNC_AS_CLIENT',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'imp_sync_as_supplier_c',
            'studio' => 'visible',
            'label' => 'LBL_	IMP_SYNC_AS_SUPPLIER',
          ),
          1 => 
          array (
            'name' => 'mekit_sync_as_supplier_c',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_SYNC_AS_SUPPLIER',
          ),
        ),
      ),
    ),
  ),
);
?>
