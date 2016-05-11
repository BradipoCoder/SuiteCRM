<?php
 // created: 2016-03-02 08:12:49
$layout_defs["Project"]["subpanel_setup"]['mkt_worklogs_project'] = array (
  'order' => 100,
  'module' => 'mkt_Worklogs',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'execution_date',
  'title_key' => 'LBL_MKT_WORKLOGS_PROJECT_FROM_MKT_WORKLOGS_TITLE',
  'get_subpanel_data' => 'mkt_worklogs_project',
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


// JACK TMP MOD
/*
$layout_defs["Project"]["subpanel_setup"]['mkt_worklogs_project'] = array (
    'order' => 100,
    'module' => 'mkt_Worklogs',
    'subpanel_name' => 'default',
    'sort_order' => 'desc',
    'sort_by' => 'date_entered',
    'title_key' => 'LBL_MKT_WORKLOGS_PROJECT_FROM_MKT_WORKLOGS_TITLE',
    //custom function to call
    'get_subpanel_data' => 'function:getCustomWorklogsListForSubpanels',
    'function_parameters' => array(
        // File where the above function is defined at
        'import_function_file' => 'custom/application/Ext/Utils/worklogs_utils.php',
        'parent_type' => $this->_focus->module_name,
        'parent_id' => $this->_focus->id,
        'return_as_array' => 'true'
    ),
    'generate_select' => true,
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
*/