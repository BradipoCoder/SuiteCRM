<?php
$viewdefs ['Opportunities'] = 
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
          ),
          1 => 'name',
        ),
        1 => 
        array (
          0 => 'date_closed',
          1 => 'account_name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'amount',
            'label' => '{$MOD.LBL_AMOUNT} ({$CURRENCY})',
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
          0 => 
          array (
            'name' => 'description',
            'nl2br' => true,
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
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
