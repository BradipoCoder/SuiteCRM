<?php
$module_name = 'mkt_Commercial_Zones';
$viewdefs [$module_name] = 
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
        'LBL_EDITVIEW_PANEL1' => 
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
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'zip_code',
            'label' => 'LBL_ZIP_CODE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'province',
            'label' => 'LBL_PROVINCE',
          ),
          1 => 
          array (
            'name' => 'region',
            'label' => 'LBL_REGION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'commercial_zone',
            'studio' => 'visible',
            'label' => 'LBL_COMMERCIAL_ZONE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'imp_agent',
            'studio' => 'visible',
            'label' => 'LBL_IMP_AGENT',
          ),
          1 => 
          array (
            'name' => 'mekit_agent',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_AGENT',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_modified',
            'comment' => 'Date record last modified',
            'label' => 'LBL_DATE_MODIFIED',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
        ),
        2 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
