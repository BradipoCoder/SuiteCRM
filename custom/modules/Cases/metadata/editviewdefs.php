<?php
$viewdefs ['Cases'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
          'file' => 'include/javascript/bindWithDelay.js',
        ),
        1 => 
        array (
          'file' => 'modules/AOK_KnowledgeBase/AOK_KnowledgeBase_SuggestionBox.js',
        ),
        2 => 
        array (
          'file' => 'include/javascript/qtip/jquery.qtip.min.js',
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
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
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
            'type' => 'readonly',
          ),
          1 => 'priority',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
            ),
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
          0 => 'assigned_user_name',
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
          0 => 
          array (
            'name' => 'resolution',
            'nl2br' => true,
          ),
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
