<?php
// created: 2016-03-02 08:12:49
$dictionary["mkt_worklogs_meetings"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mkt_worklogs_meetings' => 
    array (
      'lhs_module' => 'Meetings',
      'lhs_table' => 'meetings',
      'lhs_key' => 'id',
      'rhs_module' => 'mkt_Worklogs',
      'rhs_table' => 'mkt_worklogs',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mkt_worklogs_meetings_c',
      'join_key_lhs' => 'mkt_worklogs_meetingsmeetings_ida',
      'join_key_rhs' => 'mkt_worklogs_meetingsmkt_worklogs_idb',
    ),
  ),
  'table' => 'mkt_worklogs_meetings_c',
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
      'name' => 'mkt_worklogs_meetingsmeetings_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mkt_worklogs_meetingsmkt_worklogs_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mkt_worklogs_meetingsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mkt_worklogs_meetings_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mkt_worklogs_meetingsmeetings_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mkt_worklogs_meetings_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mkt_worklogs_meetingsmkt_worklogs_idb',
      ),
    ),
  ),
);