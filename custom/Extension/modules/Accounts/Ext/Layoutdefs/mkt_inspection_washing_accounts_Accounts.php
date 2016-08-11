<?php
// created: 2016-08-10 13:43:23
$layout_defs["Accounts"]["subpanel_setup"]['mkt_inspection_washing_accounts'] = array(
    'order'             => 100,
    'module'            => 'mkt_Inspection_Washing',
    'subpanel_name'     => 'default',
    'sort_order'        => 'asc',
    'sort_by'           => 'id',
    'title_key'         => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_MKT_INSPECTION_WASHING_TITLE',
    'get_subpanel_data' => 'mkt_inspection_washing_accounts',
    'top_buttons'       =>
        array(
            0 =>
                array(
                    'widget_class' => 'SubPanelTopButtonQuickCreate',
                ),
            1 =>
                array(
                    'widget_class' => 'SubPanelTopSelectButton',
                    'mode'         => 'MultiSelect',
                ),
        ),
);
