<?php
$popupMeta = array(
    'moduleMain'   => 'mkt_Worklogs',
    'varName'      => 'mkt_Worklogs',
    'orderBy'      => 'mkt_worklogs.name',
    'whereClauses' => array(
        'name'               => 'mkt_worklogs.name',
        'execution_date'     => 'mkt_worklogs.execution_date',
        'operation_type'     => 'mkt_worklogs.operation_type',
        'parent_name'        => 'mkt_worklogs.parent_name',
        'assigned_user_name' => 'mkt_worklogs.assigned_user_name',
    ),
    'searchInputs' => array(
        1 => 'name',
        4 => 'execution_date',
        5 => 'operation_type',
        6 => 'parent_name',
        7 => 'assigned_user_name',
    ),
    'searchdefs'   => array(
        'name'               =>
            array(
                'type'  => 'name',
                'link'  => true,
                'label' => 'LBL_NAME',
                'width' => '10%',
                'name'  => 'name',
            ),
        'execution_date'     =>
            array(
                'type'  => 'date',
                'label' => 'LBL_EXECUTION_DATE',
                'width' => '10%',
                'name'  => 'execution_date',
            ),
        'operation_type'     =>
            array(
                'type'   => 'enum',
                'studio' => 'visible',
                'label'  => 'LBL_OPERATION_TYPE',
                'width'  => '10%',
                'name'   => 'operation_type',
            ),
        'assigned_user_name' =>
            array(
                'link'  => true,
                'type'  => 'relate',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'id'    => 'ASSIGNED_USER_ID',
                'width' => '10%',
                'name'  => 'assigned_user_name',
            ),
        'parent_name'        =>
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
                'name'           => 'parent_name',
            ),
    ),
    'listviewdefs' => array(
        'NAME'               =>
            array(
                'type'    => 'name',
                'link'    => true,
                'label'   => 'LBL_NAME',
                'width'   => '10%',
                'default' => true,
            ),
        'EXECUTION_DATE'     =>
            array(
                'type'    => 'date',
                'label'   => 'LBL_EXECUTION_DATE',
                'width'   => '10%',
                'default' => true,
            ),
        'OPERATION_TYPE'     =>
            array(
                'type'    => 'enum',
                'default' => true,
                'studio'  => 'visible',
                'label'   => 'LBL_OPERATION_TYPE',
                'width'   => '10%',
            ),
        'ASSIGNED_USER_NAME' =>
            array(
                'link'    => true,
                'type'    => 'relate',
                'label'   => 'LBL_ASSIGNED_TO_NAME',
                'id'      => 'ASSIGNED_USER_ID',
                'width'   => '10%',
                'default' => true,
            ),
        'PARENT_NAME'        =>
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
            ),
    ),
);
