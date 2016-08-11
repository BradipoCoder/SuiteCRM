<?php
$module_name = 'mkt_Inspection_Washing';
$viewdefs [$module_name] =
    array(
        'EditView' =>
            array(
                'templateMeta' =>
                    array(
                        'maxColumns'          => '2',
                        'widths'              =>
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
                        'useTabs'             => false,
                        'tabDefs'             =>
                            array(
                                'DEFAULT'             =>
                                    array(
                                        'newTab'       => false,
                                        'panelDefault' => 'expanded',
                                    ),
                                'LBL_EDITVIEW_PANEL1' =>
                                    array(
                                        'newTab'       => false,
                                        'panelDefault' => 'expanded',
                                    ),
                                'LBL_EDITVIEW_PANEL2' =>
                                    array(
                                        'newTab'       => false,
                                        'panelDefault' => 'expanded',
                                    ),
                            ),
                        'syncDetailEditViews' => true,
                    ),
                'panels'       =>
                    array(
                        'default'             =>
                            array(
                                0 =>
                                    array(
                                        0 => 'name',
                                        1 => 'assigned_user_name',
                                    ),
                                1 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'  => 'execution_date',
                                                'label' => 'LBL_EXECUTION_DATE',
                                            ),
                                        1 =>
                                            array(
                                                'name'  => 'mkt_inspection_washing_accounts_name',
                                                'label' => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_ACCOUNTS_TITLE',
                                            ),
                                    ),
                                2 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'  => 'machine_brand',
                                                'label' => 'LBL_MACHINE_BRAND',
                                            ),
                                        1 =>
                                            array(
                                                'name'  => 'machine_model',
                                                'label' => 'LBL_MACHINE_MODEL',
                                            ),
                                    ),
                                3 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'type',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_TYPE',
                                            ),
                                        1 =>
                                            array(
                                                'name'  => 'competitor',
                                                'label' => 'LBL_COMPETITOR',
                                            ),
                                    ),
                                4 =>
                                    array(
                                        0 => 'description',
                                    ),
                            ),
                        'lbl_editview_panel1' =>
                            array(
                                0 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'water_hardness',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_WATER_HARDNESS',
                                            ),
                                    ),
                                1 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'ph_pool_tornasole',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_PH_POOL_TORNASOLE',
                                            ),
                                        1 =>
                                            array(
                                                'name'   => 'ph_pool_titolazione',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_PH_POOL_TITOLAZIONE',
                                            ),
                                    ),
                                2 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'pump_rev_detergent',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_PUMP_REV_DETERGENT',
                                            ),
                                        1 =>
                                            array(
                                                'name'   => 'pump_rev_brill',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_PUMP_REV_BRILL',
                                            ),
                                    ),
                                3 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'glass_dry_time',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_GLASS_DRY_TIME',
                                            ),
                                        1 =>
                                            array(
                                                'name'   => 'plate_dry_time',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_PLATE_DRY_TIME',
                                            ),
                                    ),
                                4 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'detergent_leftover',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_DETERGENT_LEFTOVER',
                                            ),
                                        1 =>
                                            array(
                                                'name'   => 'starch_presence',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_STARCH_PRESENCE',
                                            ),
                                    ),
                                5 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'limestone_presence',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_LIMESTONE_PRESENCE',
                                            ),
                                        1 =>
                                            array(
                                                'name'   => 'grease_presence',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_GREASE_PRESENCE',
                                            ),
                                    ),
                            ),
                        'lbl_editview_panel2' =>
                            array(
                                0 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'  => 'load_liters',
                                                'label' => 'LBL_LOAD_LITERS',
                                            ),
                                        1 =>
                                            array(
                                                'name'  => 'wash_cycle_liters',
                                                'label' => 'LBL_WASH_CYCLE_LITERS',
                                            ),
                                    ),
                                1 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'  => 'number_daily_wash_cycles',
                                                'label' => 'LBL_NUMBER_DAILY_WASH_CYCLES',
                                            ),
                                        1 =>
                                            array(
                                                'name'  => 'number_daily_covers',
                                                'label' => 'LBL_NUMBER_DAILY_COVERS',
                                            ),
                                    ),
                                2 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'  => 'detergent_used',
                                                'label' => 'LBL_DETERGENT_USED',
                                            ),
                                        1 =>
                                            array(
                                                'name'  => 'brill_used',
                                                'label' => 'LBL_BRILL_USED',
                                            ),
                                    ),
                                3 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'softener_presence',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_SOFTENER_PRESENCE',
                                            ),
                                    ),
                                4 =>
                                    array(
                                        0 =>
                                            array(
                                                'name'   => 'cover_composition',
                                                'studio' => 'visible',
                                                'label'  => 'LBL_COVER_COMPOSITION',
                                            ),
                                    ),
                            ),
                    ),
            ),
    );
?>
