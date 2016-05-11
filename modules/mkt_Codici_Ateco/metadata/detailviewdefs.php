<?php
$module_name = 'mkt_Codici_Ateco';
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
