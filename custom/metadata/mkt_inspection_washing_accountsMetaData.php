<?php
// created: 2016-08-10 13:43:23
$dictionary["mkt_inspection_washing_accounts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mkt_inspection_washing_accounts' => 
    array (
      'lhs_module' => 'Accounts',
      'lhs_table' => 'accounts',
      'lhs_key' => 'id',
      'rhs_module' => 'mkt_Inspection_Washing',
      'rhs_table' => 'mkt_inspection_washing',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mkt_inspection_washing_accounts_c',
      'join_key_lhs' => 'mkt_inspection_washing_accountsaccounts_ida',
      'join_key_rhs' => 'mkt_inspection_washing_accountsmkt_inspection_washing_idb',
    ),
  ),
  'table' => 'mkt_inspection_washing_accounts_c',
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
      'name' => 'mkt_inspection_washing_accountsaccounts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mkt_inspection_washing_accountsmkt_inspection_washing_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mkt_inspection_washing_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mkt_inspection_washing_accounts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mkt_inspection_washing_accountsaccounts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mkt_inspection_washing_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mkt_inspection_washing_accountsmkt_inspection_washing_idb',
      ),
    ),
  ),
);