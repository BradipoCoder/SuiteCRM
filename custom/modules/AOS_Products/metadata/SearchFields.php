<?php
// created: 2016-03-04 08:36:10
$searchFields['AOS_Products'] = array (
  'name' => 
  array (
    'query_type' => 'default',
  ),
  'current_user_only' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'created_by',
    ),
    'my_items' => true,
    'vname' => 'LBL_CURRENT_USER_FILTER',
    'type' => 'bool',
  ),
  'range_price' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'start_range_price' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'end_range_price' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'range_cost' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'start_range_cost' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'end_range_cost' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'favorites_only' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT favorites.parent_id FROM favorites
			                    WHERE favorites.deleted = 0
			                        and favorites.parent_type = ""
			                        and favorites.assigned_user_id = "1eda4eda-43fb-df91-8975-56b1c1f35def") OR NOT ({0}',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'range_stock' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'start_range_stock' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'end_range_stock' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'range_sold_last_120_days' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'start_range_sold_last_120_days' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'end_range_sold_last_120_days' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'range_stock_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'start_range_stock_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'end_range_stock_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'range_sold_last_120_days_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'start_range_sold_last_120_days_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
  'end_range_sold_last_120_days_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
  ),
);