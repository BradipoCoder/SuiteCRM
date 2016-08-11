<?php
$module_name = 'mkt_Worklogs';
$listViewDefs [$module_name] =
    array(
        'EXECUTION_DATE'     =>
            array(
                'type'    => 'date',
                'label'   => 'LBL_EXECUTION_DATE',
                'width'   => '10%',
                'default' => true,
            ),
        'NAME'               =>
            array(
                'width'   => '32%',
                'label'   => 'LBL_NAME',
                'default' => true,
                'link'    => true,
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
        'DURATION_HRS'       =>
            array(
                'type'    => 'int',
                'default' => true,
                'label'   => 'LBL_DURATION_HRS',
                'width'   => '10%',
            ),
        'DURATION_MIN'       =>
            array(
                'type'    => 'int',
                'default' => true,
                'label'   => 'LBL_DURATION_MIN',
                'width'   => '10%',
            ),
        'ASSIGNED_USER_NAME' =>
            array(
                'width'   => '9%',
                'label'   => 'LBL_ASSIGNED_TO_NAME',
                'module'  => 'Employees',
                'id'      => 'ASSIGNED_USER_ID',
                'default' => true,
            ),
        'OPERATION_TYPE'     =>
            array(
                'type'    => 'enum',
                'studio'  => 'visible',
                'label'   => 'LBL_OPERATION_TYPE',
                'width'   => '10%',
                'default' => false,
            ),
        'DESCRIPTION'        =>
            array(
                'type'     => 'text',
                'label'    => 'LBL_DESCRIPTION',
                'sortable' => false,
                'width'    => '10%',
                'default'  => false,
            ),
        'COMPLETED'          =>
            array(
                'type'    => 'bool',
                'default' => false,
                'label'   => 'LBL_COMPLETED',
                'width'   => '10%',
            ),
        'DATE_ENTERED'       =>
            array(
                'type'    => 'datetime',
                'label'   => 'LBL_DATE_ENTERED',
                'width'   => '10%',
                'default' => false,
            ),
        'DATE_MODIFIED'      =>
            array(
                'type'    => 'datetime',
                'label'   => 'LBL_DATE_MODIFIED',
                'width'   => '10%',
                'default' => false,
            ),
);
?>
