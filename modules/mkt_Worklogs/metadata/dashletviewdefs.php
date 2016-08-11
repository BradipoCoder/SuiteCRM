<?php
$dashletData['mkt_WorklogsDashlet']['searchFields'] = array(
    'name'             =>
        array(
            'default' => '',
        ),
    'execution_date'   =>
        array(
            'default' => '',
        ),
    'operation_type'   =>
        array(
            'default' => '',
        ),
    'assigned_user_id' =>
        array(
            'default' => '',
        ),
    'parent_name'      =>
        array(
            'default' => '',
        ),
);
$dashletData['mkt_WorklogsDashlet']['columns'] = array(
    'execution_date'     =>
        array(
            'type'    => 'date',
            'label'   => 'LBL_EXECUTION_DATE',
            'width'   => '10%',
            'default' => true,
            'name'    => 'execution_date',
        ),
    'name'               =>
        array(
            'width'   => '40%',
            'label'   => 'LBL_LIST_NAME',
            'link'    => true,
            'default' => true,
            'name'    => 'name',
        ),
    'assigned_user_name' =>
        array(
            'width'   => '8%',
            'label'   => 'LBL_LIST_ASSIGNED_USER',
            'name'    => 'assigned_user_name',
            'default' => true,
        ),
    'duration_hrs'       =>
        array(
            'type'    => 'int',
            'default' => false,
            'label'   => 'LBL_DURATION_HRS',
            'width'   => '10%',
        ),
    'duration_min'       =>
        array(
            'type'    => 'int',
            'default' => false,
            'label'   => 'LBL_DURATION_MIN',
            'width'   => '10%',
        ),
    'operation_type'     =>
        array(
            'type'    => 'enum',
            'default' => false,
            'studio'  => 'visible',
            'label'   => 'LBL_OPERATION_TYPE',
            'width'   => '10%',
        ),
    'description'        =>
        array(
            'type'     => 'text',
            'label'    => 'LBL_DESCRIPTION',
            'sortable' => false,
            'width'    => '10%',
            'default'  => false,
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
            'default'        => false,
        ),
    'completed'          =>
        array(
            'type'    => 'bool',
            'default' => false,
            'label'   => 'LBL_COMPLETED',
            'width'   => '10%',
        ),
);
