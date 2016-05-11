<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_meetings"] = array (
  'name' => 'mkt_worklogs_meetings',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_meetings',
  'source' => 'non-db',
  'module' => 'Meetings',
  'bean_name' => 'Meeting',
  'vname' => 'LBL_MKT_WORKLOGS_MEETINGS_FROM_MEETINGS_TITLE',
  'id_name' => 'mkt_worklogs_meetingsmeetings_ida',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_meetings_name"] = array (
  'name' => 'mkt_worklogs_meetings_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_WORKLOGS_MEETINGS_FROM_MEETINGS_TITLE',
  'save' => true,
  'id_name' => 'mkt_worklogs_meetingsmeetings_ida',
  'link' => 'mkt_worklogs_meetings',
  'table' => 'meetings',
  'module' => 'Meetings',
  'rname' => 'name',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_meetingsmeetings_ida"] = array (
  'name' => 'mkt_worklogs_meetingsmeetings_ida',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_meetings',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_WORKLOGS_MEETINGS_FROM_MKT_WORKLOGS_TITLE',
);
