<?php
$module_name = 'mkt_Inspection_Washing';
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
                    'popup_module' => 'mkt_Inspection_Washing',
                ),
        ),
    'where'       => '',
    'list_fields' =>
        array(
            'name'               =>
                array(
                    'vname'        => 'LBL_NAME',
                    'widget_class' => 'SubPanelDetailViewLink',
                    'width'        => '45%',
                    'default'      => true,
                ),
            'execution_date'     =>
                array(
                    'type'    => 'datetimecombo',
                    'vname'   => 'LBL_EXECUTION_DATE',
                    'width'   => '10%',
                    'default' => true,
                ),
            'machine_brand'      =>
                array(
                    'type'    => 'varchar',
                    'vname'   => 'LBL_MACHINE_BRAND',
                    'width'   => '10%',
                    'default' => true,
                ),
            'machine_model'      =>
                array(
                    'type'    => 'varchar',
                    'vname'   => 'LBL_MACHINE_MODEL',
                    'width'   => '10%',
                    'default' => true,
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
            'edit_button'        =>
                array(
                    'vname'        => 'LBL_EDIT_BUTTON',
                    'widget_class' => 'SubPanelEditButton',
                    'module'       => 'mkt_Inspection_Washing',
                    'width'        => '4%',
                    'default'      => true,
                ),
            'remove_button'      =>
                array(
                    'vname'        => 'LBL_REMOVE',
                    'widget_class' => 'SubPanelRemoveButton',
                    'module'       => 'mkt_Inspection_Washing',
                    'width'        => '5%',
                    'default'      => true,
                ),
        ),
);