<?php
$module_name='mkt_Worklogs';
$subpanel_layout = array(
    'top_buttons' =>
        array(
            0 =>
                array(
                    'widget_class' => 'SubPanelTopCreateButton',
                ),
            1 =>
                array(
                    'widget_class' => 'SubPanelTopSelectButton',
                    'popup_module' => 'mkt_Worklogs',
                ),
        ),
    'where'       => '',
    'list_fields' =>
        array(
            'execution_date'     =>
                array(
                    'type'    => 'date',
                    'vname'   => 'LBL_EXECUTION_DATE',
                    'width'   => '10%',
                    'default' => true,
                ),
            'name'               =>
                array(
                    'vname'        => 'LBL_NAME',
                    'widget_class' => 'SubPanelDetailViewLink',
                    'width'        => '45%',
                    'default'      => true,
                ),
            'operation_type'     =>
                array(
                    'type'    => 'enum',
                    'default' => true,
                    'studio'  => 'visible',
                    'vname'   => 'LBL_OPERATION_TYPE',
                    'width'   => '10%',
                ),
            'assigned_user_name' =>
                array(
                    'link'              => true,
                    'type'              => 'relate',
                    'vname'             => 'LBL_ASSIGNED_TO_NAME',
                    'id'                => 'ASSIGNED_USER_ID',
                    'width'             => '10%',
                    'default'           => true,
                    'widget_class'      => 'SubPanelDetailViewLink',
                    'target_module'     => 'Users',
                    'target_record_key' => 'assigned_user_id',
                ),
            'duration_hrs'       =>
                array(
                    'type'    => 'int',
                    'default' => true,
                    'vname'   => 'LBL_DURATION_HRS',
                    'width'   => '10%',
                ),
            'duration_min'       =>
                array(
                    'type'    => 'int',
                    'default' => true,
                    'vname'   => 'LBL_DURATION_MIN',
                    'width'   => '10%',
                ),
            'edit_button'        =>
                array(
                    'vname'        => 'LBL_EDIT_BUTTON',
                    'widget_class' => 'SubPanelEditButton',
                    'module'       => 'mkt_Worklogs',
                    'width'        => '4%',
                    'default'      => true,
                ),
            'remove_button'      =>
                array(
                    'vname'        => 'LBL_REMOVE',
                    'widget_class' => 'SubPanelRemoveButton',
                    'module'       => 'mkt_Worklogs',
                    'width'        => '5%',
                    'default'      => true,
                ),
        ),
);