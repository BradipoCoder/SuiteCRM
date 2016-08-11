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
          'LBL_EDITVIEW_PANEL2'  =>
              array(
                  'newTab'       => true,
                  'panelDefault' => 'expanded',
              ),
          'LBL_EDITVIEW_PANEL1'  =>
        array (
            'newTab'       => true,
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
              'name'  => 'name',
              'label' => 'LBL_SUBJECT',
          ),
            1 => 'type',
        ),
          1 =>
        array (
            0 =>
          array (
              'name'    => 'state',
              'comment' => 'The state of the case (i.e. open/closed)',
              'label'   => 'LBL_STATE',
          ),
            1 => 'status',
        ),
          2 =>
        array (
            0 => 'priority',
        ),
          3 =>
              array(
          0 => 'account_name',
              ),
          4 =>
              array(
                  0 =>
          array (
              'name'  => 'jjwg_maps_address_c',
              'label' => 'LBL_JJWG_MAPS_ADDRESS',
          ),
        ),
          5 =>
        array (
            0 =>
          array (
            'name' => 'area_dinteresse_imp_c',
            'studio' => 'visible',
            'label' => 'LBL_AREA_DINTERESSE_IMP',
          ),
            1 =>
          array (
              'name'   => 'case_area_c',
              'studio' => 'visible',
              'label'  => 'LBL_CASE_AREA',
          ),
        ),
          6 =>
        array (
            0 =>
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
            1 =>
                array(
                    'name'  => 'date_close_prg_c',
                    'label' => 'LBL_DATE_CLOSE_PRG',
                ),
        ),
          7 =>
        array (
          0 =>
          array (
            'name' => 'descrizione_problematica_c',
            'studio' => 'visible',
            'label' => 'LBL_DESCRIZIONE_PROBLEMATICA',
          ),
        ),
          8 =>
        array (
          0 =>
          array (
            'name' => 'descrizione_aggiornamento_c',
            'studio' => 'visible',
            'label' => 'LBL_DESCRIZIONE_AGGIORNAMENTO',
          ),
        ),
          9 =>
              array(
                  0 =>
                      array(
                          'name'   => 'internal_tag_number_c',
                          'studio' => 'visible',
                          'label'  => 'LBL_INTERNAL_TAG_NUMBER',
                      ),
              ),
      ),
        'lbl_editview_panel2'  =>
            array(
                0 =>
                    array(
                        0 =>
                            array(
                                'name'  => 'imp_ras_number_c',
                                'label' => 'LBL_IMP_RAS_NUMBER',
                            ),
                        1 =>
                            array(
                                'name'  => 'rif_commessa_code_c',
                                'label' => 'LBL_RIF_COMMESSA_CODE',
                            ),
                    ),
                1 =>
                    array(
                        0 =>
                            array(
                                'name'  => 'ref_part_number_c',
                                'label' => 'LBL_REF_PART_NUMBER',
                            ),
                        1 =>
                            array(
                                'name'  => 'ref_part_description_c',
                                'label' => 'LBL_REF_PART_DESCRIPTION',
                            ),
                    ),
                2 =>
                    array(
                        0 =>
                            array(
                                'name'  => 'ref_part_unique_number_c',
                                'label' => 'LBL_REF_PART_UNIQUE_NUMBER',
                            ),
                    ),
                3 =>
                    array(
                        0 =>
                            array(
                                'name'  => 'imp_doc_progressivo_c',
                                'label' => 'LBL_IMP_DOC_PROGRESSIVO',
                            ),
                    ),
                4 =>
                    array(
                        0 =>
                            array(
                                'name'  => 'case_number',
                                'label' => 'LBL_CASE_NUMBER',
                            ),
                    ),
            ),
        'lbl_editview_panel1'  =>
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
        ),
      ),
    ),
  ),
);
?>
