<?php
 // created: 2016-03-02 08:12:49
$layout_defs["Cases"]["subpanel_setup"]['mkt_worklogs_cases'] = array (
  'order' => 100,
  'module' => 'mkt_Worklogs',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MKT_WORKLOGS_CASES_FROM_MKT_WORKLOGS_TITLE',
  'get_subpanel_data' => 'mkt_worklogs_cases',
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
