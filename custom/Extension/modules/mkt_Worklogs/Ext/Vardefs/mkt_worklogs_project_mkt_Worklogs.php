<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_project"] = array (
  'name' => 'mkt_worklogs_project',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_project',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_MKT_WORKLOGS_PROJECT_FROM_PROJECT_TITLE',
  'id_name' => 'mkt_worklogs_projectproject_ida',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_project_name"] = array (
  'name' => 'mkt_worklogs_project_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_WORKLOGS_PROJECT_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'mkt_worklogs_projectproject_ida',
  'link' => 'mkt_worklogs_project',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_projectproject_ida"] = array (
  'name' => 'mkt_worklogs_projectproject_ida',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_project',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_WORKLOGS_PROJECT_FROM_MKT_WORKLOGS_TITLE',
);
