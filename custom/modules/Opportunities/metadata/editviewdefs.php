<?php
$viewdefs ['Opportunities'] = 
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
      'javascript' => '{$PROBABILITY_SCRIPT}',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'identificativo_c',
            'label' => 'LBL_IDENTIFICATIVO',
            'displayParams' => 
            array (
              'readonly' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_closed',
          ),
          1 => 'account_name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'amount',
          ),
          1 => 
          array (
            'name' => 'statovendita_c',
            'studio' => 'visible',
            'label' => 'LBL_STATOVENDITA',
          ),
        ),
        3 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'fase_stato_vendita_c',
            'studio' => 'visible',
            'label' => 'LBL_FASE_STATO_VENDITA',
          ),
        ),
        4 => 
        array (
          0 => 'description',
        ),
        5 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'promemoria_ricontattare_il_c',
            'label' => 'LBL_PROMEMORIA_RICONTATTARE_IL',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 'next_step',
          1 => 
          array (
            'name' => 'descizione_esito_c',
            'label' => 'LBL_DESCIZIONE_ESITO',
          ),
        ),
      ),
    ),
  ),
);
?>
