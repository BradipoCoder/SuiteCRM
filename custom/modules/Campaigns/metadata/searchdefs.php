<?php
$searchdefs ['Campaigns'] =
    array(
        'layout'       =>
            array(
                'basic_search'    =>
                    array(
                        'name'              =>
                            array(
                                'name'    => 'name',
                                'default' => true,
                                'width'   => '10%',
                            ),
                        'current_user_only' =>
                            array(
                                'name'    => 'current_user_only',
                                'label'   => 'LBL_CURRENT_USER_FILTER',
                                'type'    => 'bool',
                                'default' => true,
                                'width'   => '10%',
                            ),
                    ),
                'advanced_search' =>
                    array(
                        'name'              =>
                            array(
                                'name'    => 'name',
                                'default' => true,
                                'width'   => '10%',
                            ),
                        'current_user_only' =>
                            array(
                                'label'   => 'LBL_CURRENT_USER_FILTER',
                                'type'    => 'bool',
                                'width'   => '10%',
                                'default' => true,
                                'name'    => 'current_user_only',
                            ),
                        'status'            =>
                            array(
                                'name'    => 'status',
                                'default' => true,
                                'width'   => '10%',
                            ),
                        'campaign_type'     =>
                            array(
                                'name'    => 'campaign_type',
                                'default' => true,
                                'width'   => '10%',
                            ),
                        'assigned_user_id'  =>
                            array(
                                'name'     => 'assigned_user_id',
                                'label'    => 'LBL_ASSIGNED_TO',
                                'type'     => 'enum',
                                'function' =>
                                    array(
                                        'name'   => 'get_user_array',
                                        'params' =>
                                            array(
                                                0 => false,
                                            ),
                                    ),
                                'default'  => true,
                                'width'    => '10%',
                            ),
                        'start_date'        =>
                            array(
                                'name'          => 'start_date',
                                'type'          => 'date',
                                'displayParams' =>
                                    array(
                                        'showFormats' => true,
                                    ),
                                'default'       => true,
                                'width'         => '10%',
                            ),
                        'end_date'          =>
                            array(
                                'name'          => 'end_date',
                                'type'          => 'date',
                                'displayParams' =>
                                    array(
                                        'showFormats' => true,
                                    ),
                                'default'       => true,
                                'width'         => '10%',
                            ),
                    ),
            ),
        'templateMeta' =>
            array(
                'maxColumns'      => '3',
                'maxColumnsBasic' => '4',
                'widths'          =>
                    array(
                        'label' => '10',
                        'field' => '30',
                    ),
            ),
    );
?>
