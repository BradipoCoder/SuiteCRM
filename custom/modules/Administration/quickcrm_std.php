<?php
global $sugar_config,$moduleList;

$QuickCRM_modules= array('Accounts','Contacts','Opportunities','Leads','Calls','Meetings','Tasks','Cases','Project','ProjectTask','Notes','Documents');
$QuickCRM_simple_modules = array('Users');
$QuickCRM_AddressDef = array('street','city','state','postalcode','country');
$QuickCRM_google_AddressDef = array('street','city','state','postalcode','country');

$QuickCRMTitleFields = array(
	'Accounts' => array(
			'name',
		),
	'Contacts' => array(
			'first_name',
			'last_name',
		),
	'Leads' => array(
			'first_name',
			'last_name',
		),
	'Opportunities' => array(
			'name',
		),
	'Calls' => array(
			'name',
		),
	'Meetings' => array(
			'name',
		),
	'Tasks' => array(
			'name',
		),
	'Notes' => array(
			'name',
		),
	'Documents' => array(
			'document_name',
		),
	'Cases' => array(
			'name',
		),
	'Project' => array(
			'name',
		),
	'ProjectTask' => array(
			'name',
		),
	'Employees' => array(
			'first_name',
			'last_name',
		),
); 

$QuickCRMDetailsFields = array(
	'Accounts' => array(
			'phone_office',
			'phone_fax',
			'website',
			'email1',
			'description',
		),
	'Contacts' => array(
			'title',
			'account_name',
			'email1',
			'phone_work',
			'phone_mobile',
			'description',
		),
	'Leads' => array(
			'title',
			'account_name',
			'status',
			'email1',
			'phone_work',
			'phone_mobile',
			'description',
		),
	'Opportunities' => array(
			'amount','date_closed','sales_stage','account_name','description',
		),
	'Calls' => array(
			'direction','status','date_start','duration_hours','duration_minutes','description','parent_name',
		),
	'Meetings' => array(
			'status','date_start','duration_hours','duration_minutes','description','parent_name',
		),
	'Tasks' => array(
			'status','date_start','date_due','priority','description','contact_name','parent_name',
		),
	'Notes' => array(
			'description','filename'
		),
	'Documents' => array(
			'description','status_id','category_id',
		),
	'Cases' => array(
		'case_number','status','priority','description','account_name'
		),
	'Project' => array(
			'status','priority','description'
	),
	'ProjectTask' => array(
			'status','priority','project_name','description'
	),
	'Emails' => array(
			'description','description_html','type',
	),
	'Employees' => array(
			'address_city',
			'address_state',
			'email1',
			'phone_work',
			'phone_mobile',
		),
	'jjwg_Markers' => array(
			"city","description","marker_image","jjwg_maps_lat","jjwg_maps_lng"
		),
); 

$QuickCRMDefSearch = array(
	'Contacts' => array(
			'email1',
		),
	'Leads' => array(
			'status',
		),
	'Opportunities' => array(
			'date_closed','sales_stage',
		),
	'Calls' => array(
			'status','date_start',
		),
	'Meetings' => array(
			'status','date_start',
		),
	'Tasks' => array(
			'status','date_due','priority',
		),
	'Cases' => array(
		'status','priority',
		),
	'ProjectTask' => array(
			'status','priority',
	),
	'Documents' => array(
			'status_id','category_id',
		),
	'Emails' => array(
			'type',
	),
	'jjwg_Markers' => array(
			"city","marker_image"
		),

); 
if ($sugar_config['sugar_version'] >= '6.5'){
// removed (bug in SugarCRM REST API)
//		array_push($QuickCRMDefSearch['Contacts'],'account_name');
//		array_push($QuickCRMDefSearch['Opportunities'],'account_name');
}

$QuickCRMDefList = array(
	'Accounts' => array(
			"billing_address_city","billing_address_state"
		),
	'Contacts' => array(
			"account_name","title"
		),
	'Leads' => array(
			'status',"account_name","title"
		),
	'Opportunities' => array(
			"amount","account_name","sales_stage","date_closed"
		),
	'Calls' => array(
			'status','date_start',
		),
	'Meetings' => array(
			'status','date_start',
		),
	'Tasks' => array(
			'status','date_start','date_due','priority',
		),
	'Cases' => array(
		'status','priority',
		),
	'ProjectTask' => array(
			'status','priority',"assigned_user_name"
	),
	'Notes' => array(
			'filename'
	),
	'Employees' => array(
			"address_city","address_state"
		),
	'QCRM_SavedSearch' => array(
			"name","description","fields","shared"
		),
	'QCRM_Homepage' => array(
			"name","description","shared","dashlets","icons","hidden","creates"
		),
); 

$QuickCRMDefSubPanels = array(
	'Accounts' => array(
			'contacts',
			'opportunities',
			'calls',
			'meetings',
			'tasks',
			'leads',
			'notes'
		),
	'Contacts' => array(
			'calls',
			'meetings',
			'tasks',
			'opportunities',
			'notes'
		),
	'Leads' => array(
			'calls',
			'meetings',
			'tasks',
			'notes'
		),
	'Opportunities' => array(
			'contacts',
			'calls',
			'meetings',
			'tasks',
			'leads',
			'notes'
		),
	'Calls' => array(
			'contacts',
			'users',
			'leads',
			'notes'
		),
	'Meetings' => array(
			'contacts',
			'users',
			'leads',
			'notes'
		),
	'Tasks' => array(
			'notes'
		),
	'Notes' => array(
		),
	'Project' => array(
			'projecttask',
			'notes',
		),
	'ProjectTask' => array(
			'notes',
		),
	'Employees' => array(
		),
); 

$QuickCRMAddressesFields = array(
	'Accounts' => array(
			'billing',
			'shipping',
		),
	'Contacts' => array(
			'primary',
			'alt',
		),
	'Leads' => array(
			'primary',
			'alt',
		),
); 
$QuickCRMExtraFields = array(
	'Accounts' => array(
			"billing_address_street","billing_address_city","billing_address_state","billing_address_city","billing_address_postalcode",
			"shipping_address_street","shipping_address_city","shipping_address_state","shipping_address_city","shipping_address_postalcode",
		),
	'Opportunities' => array(
			'amount_usdollar',
		),
	'Notes' => array(
			'filename',
		),
	'Leads' => array(
			'converted',
		),
	'Documents' => array(
			'name','filename',
		),
	'jjwg_Maps' => array(
			'parent_name','parent_type','distance','module_type','unit_type',
		),
	'Calls' => array(
			'date_end','reminder_time',
		),
	'Meetings' => array(
			'date_end','reminder_time',
		),
	'Employees' => array(
		),
	'SugarFeed' => array(
			"created_by_name","related_module","related_id"
		),
	'jjwg_Markers' => array(
			"city","description","jjwg_maps_lat","jjwg_maps_lng","marker_image"
		),
); 

$QuickCRM_ExcludedModules= array('QCRM_Homepage','QCRM_SavedSearch','SecurityGroups','Users','AOS_Products_Quotes','AOS_PDF_Templates','jjwg_Address_Cache','jjwg_Areas');
if (!file_exists("custom/service/vAlineaSolReports/rest.php")) $QuickCRM_ExcludedModules[]= 'asol_Reports';
$QuickCRM_ExcludedFields= array (
	'Employees' => array (
		'user_name',
		'user_hash',
		'system_generated_password',
		'pwd_last_changed',
		'authenticate_id',
		'sugar_login',
		'is_admin',
		'external_auth_only',
		'receive_notifications',
		'portal_only',
		'show_on_employees',
		'is_group',
		'messenger_type',
		'email_link_type',
	),
);

// SugarCRM CE or SuiteCRM
$found_aos = (isset($sugar_config['aos']) || in_array ('AOS_Products_Quotes',$moduleList));

if ($found_aos && !file_exists("custom/QuickCRM/plugins/quickcrm_AOS.php")){
	if (isset($sugar_config['aos'])) {
		$aos_version = $sugar_config['aos']['version'];
	}
	else {
		$aos_version = '5.1';
	}
	
	// Begin AOS Support
	$QuickCRMTitleFields['AOS_Quotes'] = array(
			'name',
		);
		
	$QuickCRMDetailsFields['AOS_Quotes'] = array(
			'number','billing_account','stage',"expiration",'total_amount'
		);
		
	$QuickCRMDefList['AOS_Quotes'] = array(
			'number','billing_account','total_amount','stage'
		);

	$QuickCRMDefSearch['AOS_Quotes'] = array(
			'number',
			'stage',
		);
		
	$QuickCRMExtraFields['AOS_Quotes'] = array(
			"total_amt","discount_amount","subtotal_amount","subtotal_tax_amount","tax_amount","tax_amount","total_amount"
		);
		
	$QuickCRMAddressesFields['AOS_Quotes'] = array(
			'billing',
			'shipping',
		);

	$QuickCRMDefSubPanels['AOS_Quotes'] = array(
		);

	$QuickCRMTitleFields['AOS_Invoices'] = array(
			'name',
		);
		
	$QuickCRMDetailsFields['AOS_Invoices'] = array(
			'number','billing_account',"due_date",'total_amount',
		);
		
	$QuickCRMDefList['AOS_Invoices'] = array(
			'number','billing_account','total_amount'
		);
		
	$QuickCRMDefSearch['AOS_Invoices'] = array(
			'number',
			'status',
		);
		
	$QuickCRMExtraFields['AOS_Invoices'] = array(
			"total_amt","discount_amount","subtotal_amount","subtotal_tax_amount","tax_amount","tax_amount","total_amount"
		);
		
	$QuickCRMAddressesFields['AOS_Invoices'] = array(
			'billing',
			'shipping',
		);

	$QuickCRMDefSubPanels['AOS_Invoices'] = array(
		);
/*
	$QuickCRMTitleFields['AOS_Products_Quotes'] = array(
			'name',
		);
*/		
	$QuickCRMDetailsFields['AOS_Products_Quotes'] = array(
			'product_qty','product_list_price','discount','product_discount','product_discount_amount','product_unit_price','vat','vat_amt','product_total_price'
		);
		
	$QuickCRMExtraFields['AOS_Products_Quotes'] = array( // hidden or required fields
		'name','product_id','parent_name','number','product_qty','product_list_price','discount','product_discount','product_discount_amount','product_unit_price','vat','vat_amt','product_total_price',
		); 

	$QuickCRMTitleFields['AOS_Products'] = array(
			'name',
		);
		
	$QuickCRMDetailsFields['AOS_Products'] = array(
			'price'
		);
		
	$QuickCRMDefSearch['AOS_Products'] = array(
		);
		
	$QuickCRMDefList['AOS_Products'] = array(
			'price'
		);

	if ($aos_version > '5.2') {
		array_push($QuickCRMExtraFields['AOS_Products_Quotes'],'group_name','group_id');
	}
	if ($aos_version > '5.3') {
		array_push($QuickCRMExtraFields['AOS_Quotes'],"shipping_amount","shipping_tax_amt","shipping_tax");
		array_push($QuickCRMExtraFields['AOS_Invoices'],"shipping_amount","shipping_tax_amt","shipping_tax");
		array_push($QuickCRMDetailsFields['AOS_Products'],'aos_product_category_name');
		array_push($QuickCRMDefList['AOS_Products'],'aos_product_category_name');
		$QuickCRMTitleFields['AOS_Product_Categories'] = array(
			'name',
		);
		array_unshift($QuickCRMDetailsFields['AOS_Products'],'part_number');
		array_unshift($QuickCRMDefSearch['AOS_Products'],'part_number');
		array_unshift($QuickCRMDefList['AOS_Products'],'part_number');
		
		array_unshift($QuickCRMDetailsFields['AOS_Products_Quotes'],'part_number');
	}
	//if (!in_array ('AOS_Products_Quotes',$moduleList)) array_push($moduleList,'AOS_Products_Quotes');
}
// END AOS SUPPORT

try {
	$handler = opendir(realpath(dirname(__FILE__).'/../../QuickCRM/plugins/'));
	while ($file = readdir($handler)) {
		if (substr($file,-4)=='.php'){
			include('custom/QuickCRM/plugins/'.$file);
		}
	}
	closedir($handler);
}
catch (Exception $e) {
}

foreach ($QuickCRMTitleFields as $module=>$contents){
	if (!in_array($module,$QuickCRM_modules)){
		array_push($QuickCRM_modules,$module); // add custom modules
	}
}

?>