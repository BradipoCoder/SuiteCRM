<?php
$module_name = 'mkt_Worklogs';
$viewdefs [$module_name] =
    array(
        'QuickCreate' =>
  array (
      'templateMeta' =>
    array (
        'maxColumns' => '2',
        'widths'     =>
            array(
                0 =>
                    array(
                        'label' => '10',
                        'field' => '30',
                    ),
                1 =>
                    array(
                        'label' => '10',
                        'field' => '30',
                    ),
            ),
        'useTabs'    => false,
        'tabDefs'    =>
            array(
                'DEFAULT' =>
                    array(
                        'newTab'       => false,
                        'panelDefault' => 'expanded',
                    ),
            ),
    ),
      'panels'       =>
          array(
              'default' =>
                  array(
                      0 =>
                          array(
                              0 => 'name',
                          ),
                      1 =>
                          array(
                              0 =>
                                  array(
                                      'name'  => 'duration_hrs',
                                      'label' => 'LBL_DURATION_HRS',
                                  ),
                              1 =>
                                  array(
                                      'name'  => 'duration_min',
                                      'label' => 'LBL_DURATION_MIN',
                                  ),
                          ),
                      2 =>
                          array(
                              0 =>
                                  array(
                                      'name'  => 'execution_date',
                                      'label' => 'LBL_EXECUTION_DATE',
                                  ),
                              1 =>
                                  array(
                                      'name'   => 'operation_type',
                                      'studio' => 'visible',
                                      'label'  => 'LBL_OPERATION_TYPE',
                                  ),
                          ),
                      3 =>
                          array(
                              0 =>
                                  array(
                                      'name'    => 'description',
                                      'comment' => 'Full text of the note',
                                      'label'   => 'LBL_DESCRIPTION',
                                  ),
                          ),
                  ),
          ),
  ),
);
?>
