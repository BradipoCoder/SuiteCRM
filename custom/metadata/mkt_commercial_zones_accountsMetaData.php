<?php
// created: 2016-03-02 08:12:19
$dictionary["mkt_commercial_zones_accounts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mkt_commercial_zones_accounts' => 
    array (
      'lhs_module' => 'mkt_Commercial_Zones',
      'lhs_table' => 'mkt_commercial_zones',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mkt_commercial_zones_accounts_c',
      'join_key_lhs' => 'mkt_commercial_zones_accountsmkt_commercial_zones_ida',
      'join_key_rhs' => 'mkt_commercial_zones_accountsaccounts_idb',
    ),
  ),
  'table' => 'mkt_commercial_zones_accounts_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'mkt_commercial_zones_accountsmkt_commercial_zones_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mkt_commercial_zones_accountsaccounts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mkt_commercial_zones_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mkt_commercial_zones_accounts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mkt_commercial_zones_accountsmkt_commercial_zones_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mkt_commercial_zones_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mkt_commercial_zones_accountsaccounts_idb',
      ),
    ),
  ),
);