<?php
// created: 2016-03-02 08:12:19
$dictionary["Account"]["fields"]["mkt_commercial_zones_accounts"] = array (
  'name' => 'mkt_commercial_zones_accounts',
  'type' => 'link',
  'relationship' => 'mkt_commercial_zones_accounts',
  'source' => 'non-db',
  'module' => 'mkt_Commercial_Zones',
  'bean_name' => 'mkt_Commercial_Zones',
  'vname' => 'LBL_MKT_COMMERCIAL_ZONES_ACCOUNTS_FROM_MKT_COMMERCIAL_ZONES_TITLE',
  'id_name' => 'mkt_commercial_zones_accountsmkt_commercial_zones_ida',
);
$dictionary["Account"]["fields"]["mkt_commercial_zones_accounts_name"] = array (
  'name' => 'mkt_commercial_zones_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MKT_COMMERCIAL_ZONES_ACCOUNTS_FROM_MKT_COMMERCIAL_ZONES_TITLE',
  'save' => true,
  'id_name' => 'mkt_commercial_zones_accountsmkt_commercial_zones_ida',
  'link' => 'mkt_commercial_zones_accounts',
  'table' => 'mkt_commercial_zones',
  'module' => 'mkt_Commercial_Zones',
  'rname' => 'name',
);
$dictionary["Account"]["fields"]["mkt_commercial_zones_accountsmkt_commercial_zones_ida"] = array (
  'name' => 'mkt_commercial_zones_accountsmkt_commercial_zones_ida',
  'type' => 'link',
  'relationship' => 'mkt_commercial_zones_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MKT_COMMERCIAL_ZONES_ACCOUNTS_FROM_ACCOUNTS_TITLE',
);
