<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_tasks"] = array (
  'name' => 'mkt_worklogs_tasks',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_tasks',
  'source' => 'non-db',
  'module' => 'Tasks',
  'bean_name' => 'Task',
  'vname' => 'LBL_MKT_WORKLOGS_TASKS_FROM_TASKS_TITLE',
  'id_name' => 'mkt_worklogs_taskstasks_ida',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_tasks_name"] = array (
  'name' => 'mkt_worklogs_tasks_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_WORKLOGS_TASKS_FROM_TASKS_TITLE',
  'save' => true,
  'id_name' => 'mkt_worklogs_taskstasks_ida',
  'link' => 'mkt_worklogs_tasks',
  'table' => 'tasks',
  'module' => 'Tasks',
  'rname' => 'name',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_taskstasks_ida"] = array (
  'name' => 'mkt_worklogs_taskstasks_ida',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_tasks',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_WORKLOGS_TASKS_FROM_MKT_WORKLOGS_TITLE',
);
