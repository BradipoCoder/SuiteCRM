<?php
$viewdefs ['Cases'] = 
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CASE_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_case_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'case_number',
            'label' => 'LBL_CASE_NUMBER',
          ),
          1 => 'priority',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_SUBJECT',
          ),
          1 => 'type',
        ),
        2 => 
        array (
          0 => 'account_name',
          1 => 
          array (
            'name' => 'case_area_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_AREA',
          ),
        ),
        3 => 
        array (
          1 => 
          array (
            'name' => 'area_dinteresse_imp_c',
            'studio' => 'visible',
            'label' => 'LBL_AREA_DINTERESSE_IMP',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_close_prg_c',
            'label' => 'LBL_DATE_CLOSE_PRG',
          ),
          1 => 
          array (
            'name' => 'state',
            'comment' => 'The state of the case (i.e. open/closed)',
            'label' => 'LBL_STATE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 'status',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'descrizione_problematica_c',
            'studio' => 'visible',
            'label' => 'LBL_DESCRIZIONE_PROBLEMATICA',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'descrizione_aggiornamento_c',
            'studio' => 'visible',
            'label' => 'LBL_DESCRIZIONE_AGGIORNAMENTO',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 'resolution',
          1 => 
          array (
            'name' => 'origine_c',
            'studio' => 'visible',
            'label' => 'LBL_ORIGINE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_close_efct_c',
            'label' => 'LBL_DATE_CLOSE_EFCT',
          ),
          1 => 
          array (
            'name' => 'ref_worksheet_c',
            'label' => 'LBL_REF_WORKSHEET',
          ),
        ),
      ),
    ),
  ),
);
?>
