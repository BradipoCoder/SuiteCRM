<?php
$dashletData['mkt_Inspection_WashingDashlet']['searchFields'] = array(
    'date_entered'     =>
        array(
            'default' => '',
        ),
    'date_modified'    =>
        array(
            'default' => '',
        ),
    'assigned_user_id' =>
        array(
            'type'    => 'assigned_user_name',
            'default' => 'Adam Jakab',
        ),
);
$dashletData['mkt_Inspection_WashingDashlet']['columns'] = array(
    'name'                                 =>
        array(
            'width'   => '40%',
            'label'   => 'LBL_LIST_NAME',
            'link'    => true,
            'default' => true,
            'name'    => 'name',
        ),
    'mkt_inspection_washing_accounts_name' =>
        array(
            'type'    => 'relate',
            'link'    => true,
            'label'   => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_ACCOUNTS_TITLE',
            'id'      => 'MKT_INSPECTION_WASHING_ACCOUNTSACCOUNTS_IDA',
            'width'   => '10%',
            'default' => true,
        ),
    'execution_date'                       =>
        array(
            'type'    => 'datetimecombo',
            'label'   => 'LBL_EXECUTION_DATE',
            'width'   => '10%',
            'default' => true,
        ),
    'date_entered'                         =>
        array(
            'width'   => '15%',
            'label'   => 'LBL_DATE_ENTERED',
            'default' => false,
            'name'    => 'date_entered',
        ),
    'date_modified'                        =>
        array(
            'width'   => '15%',
            'label'   => 'LBL_DATE_MODIFIED',
            'name'    => 'date_modified',
            'default' => false,
        ),
    'created_by'                           =>
        array(
            'width'   => '8%',
            'label'   => 'LBL_CREATED',
            'name'    => 'created_by',
            'default' => false,
        ),
    'assigned_user_name'                   =>
        array(
            'width'   => '8%',
            'label'   => 'LBL_LIST_ASSIGNED_USER',
            'name'    => 'assigned_user_name',
            'default' => false,
        ),
);
