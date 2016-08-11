<?php
$module_name = 'mkt_Inspection_Washing';
$listViewDefs [$module_name] =
    array(
        'EXECUTION_DATE'                       =>
            array(
                'type'    => 'datetimecombo',
                'label'   => 'LBL_EXECUTION_DATE',
                'width'   => '10%',
                'default' => true,
            ),
        'NAME'                                 =>
            array(
                'width'   => '32%',
                'label'   => 'LBL_NAME',
                'default' => true,
                'link'    => true,
            ),
        'MACHINE_BRAND'                        =>
            array(
                'type'    => 'varchar',
                'label'   => 'LBL_MACHINE_BRAND',
                'width'   => '10%',
                'default' => true,
            ),
        'MACHINE_MODEL'                        =>
            array(
                'type'    => 'varchar',
                'label'   => 'LBL_MACHINE_MODEL',
                'width'   => '10%',
                'default' => true,
            ),
        'MKT_INSPECTION_WASHING_ACCOUNTS_NAME' =>
            array(
                'type'    => 'relate',
                'link'    => true,
                'label'   => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_ACCOUNTS_TITLE',
                'id'      => 'MKT_INSPECTION_WASHING_ACCOUNTSACCOUNTS_IDA',
                'width'   => '10%',
                'default' => true,
            ),
        'ASSIGNED_USER_NAME'                   =>
            array(
                'width'   => '9%',
                'label'   => 'LBL_ASSIGNED_TO_NAME',
                'module'  => 'Employees',
                'id'      => 'ASSIGNED_USER_ID',
                'default' => true,
            ),
        'DATE_ENTERED'                         =>
            array(
                'type'    => 'datetime',
                'label'   => 'LBL_DATE_ENTERED',
                'width'   => '10%',
                'default' => false,
            ),
        'DATE_MODIFIED'                        =>
            array(
                'type'    => 'datetime',
                'label'   => 'LBL_DATE_MODIFIED',
                'width'   => '10%',
                'default' => false,
            ),
        'TYPE'                                 =>
            array(
                'type'    => 'enum',
                'studio'  => 'visible',
                'label'   => 'LBL_TYPE',
                'width'   => '10%',
                'default' => false,
            ),
    );
?>
