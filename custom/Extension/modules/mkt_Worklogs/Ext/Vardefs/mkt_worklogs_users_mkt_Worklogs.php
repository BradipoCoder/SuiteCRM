<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_users"] = array (
  'name' => 'mkt_worklogs_users',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_users',
  'source' => 'non-db',
  'module' => 'Users',
  'bean_name' => 'User',
  'vname' => 'LBL_MKT_WORKLOGS_USERS_FROM_USERS_TITLE',
  'id_name' => 'mkt_worklogs_usersusers_ida',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_users_name"] = array (
  'name' => 'mkt_worklogs_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_WORKLOGS_USERS_FROM_USERS_TITLE',
  'save' => true,
  'id_name' => 'mkt_worklogs_usersusers_ida',
  'link' => 'mkt_worklogs_users',
  'table' => 'users',
  'module' => 'Users',
  'rname' => 'name',
);
$dictionary["mkt_Worklogs"]["fields"]["mkt_worklogs_usersusers_ida"] = array (
  'name' => 'mkt_worklogs_usersusers_ida',
  'type' => 'link',
  'relationship' => 'mkt_worklogs_users',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_WORKLOGS_USERS_FROM_MKT_WORKLOGS_TITLE',
);
