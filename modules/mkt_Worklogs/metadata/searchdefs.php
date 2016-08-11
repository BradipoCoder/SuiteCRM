<?php
$module_name = 'mkt_Worklogs';
$searchdefs [$module_name] =
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
                        'operation_type'    =>
                            array(
                                'type'    => 'enum',
                                'default' => true,
                                'studio'  => 'visible',
                                'label'   => 'LBL_OPERATION_TYPE',
                                'width'   => '10%',
                                'name'    => 'operation_type',
                            ),
                        'parent_name'       =>
                            array(
                                'type'           => 'parent',
                                'studio'         => 'visible',
                                'label'          => 'LBL_FLEX_RELATE',
                                'link'           => true,
                                'sortable'       => false,
                                'ACLTag'         => 'PARENT',
                                'dynamic_module' => 'PARENT_TYPE',
                                'id'             => 'PARENT_ID',
                                'related_fields' =>
                                    array(
                                        0 => 'parent_id',
                                        1 => 'parent_type',
                                    ),
                                'width'          => '10%',
                                'default'        => true,
                                'name'           => 'parent_name',
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
                        'name'             =>
                            array(
                                'name'    => 'name',
                                'default' => true,
                                'width'   => '10%',
                            ),
                        'operation_type'   =>
                            array(
                                'type'    => 'enum',
                                'default' => true,
                                'studio'  => 'visible',
                                'label'   => 'LBL_OPERATION_TYPE',
                                'width'   => '10%',
                                'name'    => 'operation_type',
                            ),
                        'parent_name'      =>
                            array(
                                'type'           => 'parent',
                                'studio'         => 'visible',
                                'label'          => 'LBL_FLEX_RELATE',
                                'link'           => true,
                                'sortable'       => false,
                                'related_fields' =>
                                    array(
                                        0 => 'parent_id',
                                        1 => 'parent_type',
                                    ),
                                'width'          => '10%',
                                'default'        => true,
                                'ACLTag'         => 'PARENT',
                                'dynamic_module' => 'PARENT_TYPE',
                                'id'             => 'PARENT_ID',
                                'name'           => 'parent_name',
                            ),
                        'execution_date'   =>
                            array(
                                'type'    => 'date',
                                'label'   => 'LBL_EXECUTION_DATE',
                                'width'   => '10%',
                                'default' => true,
                                'name'    => 'execution_date',
                            ),
                        'assigned_user_id' =>
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
