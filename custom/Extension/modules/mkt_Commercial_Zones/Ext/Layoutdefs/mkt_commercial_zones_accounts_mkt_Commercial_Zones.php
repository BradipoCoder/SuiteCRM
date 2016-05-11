<?php
 // created: 2016-03-02 08:12:19
$layout_defs["mkt_Commercial_Zones"]["subpanel_setup"]['mkt_commercial_zones_accounts'] = array (
  'order' => 100,
  'module' => 'Accounts',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MKT_COMMERCIAL_ZONES_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'get_subpanel_data' => 'mkt_commercial_zones_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
