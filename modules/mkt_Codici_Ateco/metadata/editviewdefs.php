<?php
$module_name = 'mkt_Codici_Ateco';
$viewdefs [$module_name] = 
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
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
          0 => 'name',
          1 => 
          array (
            'name' => 'sezione',
            'studio' => 'visible',
            'label' => 'LBL_SEZIONE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'imp_sector',
            'studio' => 'visible',
            'label' => 'LBL_IMP_SECTOR',
          ),
          1 => 
          array (
            'name' => 'mekit_sector',
            'studio' => 'visible',
            'label' => 'LBL_MEKIT_SECTOR',
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
