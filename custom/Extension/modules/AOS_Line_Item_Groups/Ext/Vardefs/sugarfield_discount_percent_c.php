<?php

/*
 *
 * based on: http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.5/Data_Framework/Vardefs/Examples/Manually_Creating_Custom_Fields/
 *
 * INSERT INTO fields_meta_data
 *  (id, name, vname, comments, custom_module, type, len, required, deleted, audited, massupdate, duplicate_merge, reportable, importable, ext1)
 * VALUES
 * ('AOS_Line_Item_Groupsdiscount_percent_c', 'discount_percent_c', 'LBL_DISCOUNT_PERCENT_C', '', 'AOS_Line_Item_Groups', 'decimal', 18, 0, 0, 0, 0, 0, 1, 'true', '1');
 */
//Discount Percent
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['name'] = 'discount_percent_c';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['id'] = 'discount_percent_c';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['vname'] = 'LBL_DISCOUNT_PERCENT';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['type'] = 'decimal';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['enforced'] = '';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['dependency'] = '';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['required'] = false;
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['massupdate'] = '0';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['default'] = '0';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['no_default'] = false;
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['comments'] = '';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['help'] = '';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['importable'] = 'true';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['duplicate_merge'] = 'disabled';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['duplicate_merge_dom_value'] = '0';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['audited'] = false;
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['reportable'] = true;
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['unified_search'] = false;
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['merge_filter'] = 'disabled';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['calculated'] = false;
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['len'] = '18';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['size'] = '20';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['custom_module'] = '';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['inline_edit']='';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['options']='numeric_range_search_dom';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['labelValue']='Sconto(%)';
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['enable_range_search']='1';
//required to create the field in the _cstm table
$dictionary['AOS_Line_Item_Groups']['fields']['discount_percent_c']['source'] = 'custom_fields';


