<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_cases"] = array (
  'name' => 'mkt_worklogs_cases',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_MKT_WORKLOGS_CASES_FROM_CASES_TITLE',
  'id_name' => 'mkt_worklogs_casescases_ida',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_cases_name"] = array (
  'name' => 'mkt_worklogs_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_WORKLOGS_CASES_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'mkt_worklogs_casescases_ida',
  'link' => 'mkt_worklogs_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_casescases_ida"] = array (
  'name' => 'mkt_worklogs_casescases_ida',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_WORKLOGS_CASES_FROM_MKT_WORKLOGS_TITLE',
);
