<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_worklogs_opportunities"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mkt_worklogs_opportunities' => 
    array (
      'lhs_module' => 'Opportunities',
      'lhs_table' => 'opportunities',
      'lhs_key' => 'id',
      'rhs_module' => 'mkt_Worklogs',
      'rhs_table' => 'mkt_worklogs',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mkt_worklogs_opportunities_c',
      'join_key_lhs' => 'mkt_worklogs_opportunitiesopportunities_ida',
      'join_key_rhs' => 'mkt_worklogs_opportunitiesmkt_worklogs_idb',
    ),
  ),
  'table' => 'mkt_worklogs_opportunities_c',
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
      'name' => 'mkt_worklogs_opportunitiesopportunities_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mkt_worklogs_opportunitiesmkt_worklogs_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mkt_worklogs_opportunitiesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mkt_worklogs_opportunities_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mkt_worklogs_opportunitiesopportunities_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mkt_worklogs_opportunities_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mkt_worklogs_opportunitiesmkt_worklogs_idb',
      ),
    ),
  ),
);