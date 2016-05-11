<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_opportunities"] = array (
  'name' => 'mkt_worklogs_opportunities',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_opportunities',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_MKT_WORKLOGS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'mkt_worklogs_opportunitiesopportunities_ida',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_opportunities_name"] = array (
  'name' => 'mkt_worklogs_opportunities_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_WORKLOGS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'mkt_worklogs_opportunitiesopportunities_ida',
  'link' => 'mkt_worklogs_opportunities',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_opportunitiesopportunities_ida"] = array (
  'name' => 'mkt_worklogs_opportunitiesopportunities_ida',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_opportunities',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_WORKLOGS_OPPORTUNITIES_FROM_MKT_WORKLOGS_TITLE',
);
