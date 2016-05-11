<?php
/*********************************************************************************
 * This file is part of QuickCRM Mobile Full.
 * QuickCRM Mobile Full is a mobile client for SugarCRM
 * 
 * Author : NS-Team (http://www.ns-team.fr)
 * All rights (c) 2013 by NS-Team
 *
 * This Version of the QuickCRM Mobile Full is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of NS-Team
 * 
 * You can contact NS-Team at NS-Team - 55 Chemin de Mervilla - 31320 Auzeville - France
 * or via email at infos@ns-team.fr
 * 
 ********************************************************************************/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
ini_set('max_execution_time', '500');

require_once('custom/modules/Administration/genProfromSugar.php');
require_once('modules/Administration/Administration.php');

class QUtils {

	var $QuickCRM_modules;
	var $QuickCRM_custom_modules;
	var $QuickCRM_simple_modules;
	var $QuickCRM_ExcludedModules;
	var $QuickCRM_ExcludedFields;
	var $QuickCRMTitleFields;
	var $QuickCRMDetailsFields;
	var $QuickCRMAddressesFields;
	var $QuickCRMExtraFields;
	var $QuickCRMDefSearch;
	var $QuickCRMDefList;
	var $QuickCRMDefSubPanels;
	var $ModuleDef;
	var $mobile; // mobile configuration
	var $server_config; // server configuration
	var $config; // server configuration
	
	function QUtils(){
		include('custom/modules/Administration/quickcrm_std.php');
		$this->QuickCRM_modules = $QuickCRM_modules;
		$this->QuickCRM_ExcludedModules = $QuickCRM_ExcludedModules;
		$this->QuickCRM_ExcludedFields = $QuickCRM_ExcludedFields;
		$this->QuickCRM_simple_modules = $QuickCRM_simple_modules;
		$this->QuickCRMTitleFields = $QuickCRMTitleFields; 
		$this->QuickCRMDetailsFields = $QuickCRMDetailsFields; 
		$this->QuickCRMAddressesFields = $QuickCRMAddressesFields;
		$this->QuickCRMExtraFields = $QuickCRMExtraFields;
		$this->QuickCRMDefSearch = $QuickCRMDefSearch;
		$this->QuickCRMDefList = $QuickCRMDefList;
		$this->QuickCRMDefSubPanels = $QuickCRMDefSubPanels;
		$this->QuickCRM_custom_modules = array();
		$this->server_config = array();
		$this->mobile = array();
	}
	
	function LoadCustomModules(){
		global $dictionary,$beanList,$beanFiles,$app_list_strings,$moduleList;

		$dmod=$this->QuickCRM_modules; // predefined module
		$smod=$this->QuickCRM_simple_modules;
		$allmodules = $moduleList;
		// in some configurations, Employees is not in $moduleList
		if (!in_array ('Employees',$allmodules)) array_push($allmodules,'Employees');
		if (!in_array ('SugarFeed',$allmodules)) array_push($allmodules,'SugarFeed');
		$res= array();
	
        foreach ($allmodules as $key => $e) {
			if (in_array ($e,$this->QuickCRM_ExcludedModules)) continue;
			if(isset($GLOBALS [ 'beanList' ][$e]) && file_exists($beanFiles[$beanList[$e]])) // installed modules must also exist in the beanList
			{
				$bean= ($e==='Cases'?'Case':$beanList[$e]);
				VardefManager::loadVardef($e, $bean);
				$dict=$dictionary;

				if (!in_array ($e,$dmod)&&!in_array ($e,$smod)) {
					array_push($res,$e);
					if (isset($dict[$bean]['templates']['person'])) {
						$this->QuickCRMAddressesFields[$e]= array('primary','alt');
					}
					elseif (isset($dict[$bean]['templates']['company']) || $e=='AOS_Quotes' || $e=='AOS_Invoices') {
						$this->QuickCRMAddressesFields[$e]= array('billing','shipping');
					}
				}
			}
		}
		$this->QuickCRM_custom_modules = $res;
		//return $res;
	}

	function BuildModDef(){
		global $dictionary,$beanList,$sugar_config;
		$smod=$this->QuickCRM_simple_modules;
		$res=array();
	
		foreach($this->mobile['modules'] as $e)
			{
				$bean= ($e==='Cases'?'Case':$beanList[$e]);
				VardefManager::loadVardef($e, $bean);
				$dict=$dictionary;
				if (!in_array ($e,$smod)) {
					$custom_icon=false;
					if ($sugar_config['sugar_version']<'6.1'){
						if (!file_exists("themes/default/images/icon_{$e}_32.gif")){
							if (file_exists("custom/themes/default/images/icon_{$e}_32.gif")){
								$custom_icon='custom';
							}
							else {
								$custom_icon='none';
							}
						}
						$filename='';
					}
					else {
						$filename = SugarThemeRegistry::current()->getImageURL("icon_{$e}_32.gif");
						if ($filename != false) {
							if (strpos ( $filename, "custom/themes" )!==FALSE ) $custom_icon='custom';
						}
					}
					$res[$e]= array(
						'type'=>(($e == 'Employees' || isset($dict[$bean]['templates']['person']))?'person':(isset($dict[$bean]['templates']['company'])?'company':(isset($dict[$bean]['templates']['file'])?'file':'basic'))),
						'table'=> $dict[$bean]['table'],
						'custom'=>$custom_icon, // kept for downward compatibility
						'icon'=> $filename == false ? '' : $filename,
					);
				}
			}
		return $res;
	}

	function BuildModLinks(){
		$res=array('links' => array(), 'subpanels' => array());
		foreach($this->mobile['modules'] as $e)
			{
				$lnks=$this->QgetAvailableLinks($e);
				$res['links'][$e]=$lnks['links'];
				$res['subpanels'][$e]=$lnks['subpanels'];
			}
		return $res;
	}

	function getFieldLabel($module,$field){
		$label = $field;
		if ($this->server_config['fields'][$module][$field]){
			if ($this->server_config['fields'][$module][$field]['label']) $label= $this->server_config['fields'][$module][$field]['label'];
		}
		return $label;
	}
	
	function getSubPanelsLabels(){
		global $current_language,$app_strings,$app_list_strings;
		foreach($this->mobile['modules'] as $module)
			{
				$mod_strings=return_module_language($current_language, $module);
				if (isset($this->server_config['subpanels'][$module]))
				  foreach($this->server_config['subpanels'][$module] as $key=>$value)
					{	
						$lnk=$value['link'];
						$lnk_vname= $this->server_config['links'][$module][$lnk]['vname'];
						$lnk_target_module = $this->server_config['links'][$module][$lnk]['module'];
						if (isset($mod_strings[$lnk_vname])){
								$this->server_config['subpanels'][$module][$key]['tmplabel']=$mod_strings[$lnk_vname];
						}
						elseif (isset($app_strings[$lnk_vname])){
								$this->server_config['subpanels'][$module][$key]['tmplabel']=$app_strings[$lnk_vname];
						}
						else {
								$this->server_config['subpanels'][$module][$key]['tmplabel']=$app_list_strings["moduleList"][$lnk_target_module];
						}
					}
			}
	}

	function getAddressesLabels(){
		global $current_language,$app_strings,$app_list_strings;
		$this->server_config['addresses_label']=array();
		foreach($this->mobile['modules'] as $module)
			{
				if (isset($this->server_config['addresses'][$module])) {
					$labels=return_module_language($current_language, $module);
					$add_labels=array();
					foreach ($this->server_config['addresses'][$module] as $prefix){
						$add_labels[$prefix]=(isset($labels['LBL_'.strtoupper($prefix).'_ADDRESS'])?$labels['LBL_'.strtoupper($prefix).'_ADDRESS']:$prefix);
					}
					$this->server_config['addresses_label'][$module]=$add_labels;
				}
			}
	}


	function isLinkableModule($module){
		return in_array($module,$this->mobile['modules']) 
		|| in_array($module,$this->QuickCRM_simple_modules);
	}
	
	function QgetPresetModuleFields() {
		$mod_fields_arr = array();
		foreach ($this->mobile['modules'] as $module){
//			if (isset($this->QuickCRMDetailsFields[$module]))
//				$mod_fields_arr[$module]=array_merge($this->mobile['def_title_fields'][$module],$this->QuickCRMDetailsFields[$module]);
//			else
				$mod_fields_arr[$module]=$this->mobile['def_title_fields'][$module];
		}
		return $mod_fields_arr;
	}

	function QgetPresetSearch() {
		return $this->QuickCRMDefSearch;
	}
	
	function QgetPresetList() {
		return $this->QuickCRMDefList;
	}
	
	function QgetPresetSubpanels() {
		return $this->QuickCRMDefSubPanels;
	}
	
    function QgetAvailableLinks($moduleName) {
	// allowed display fields
		global $beanFiles, $beanList;
		
		$enabled_modules=array_merge($this->mobile['modules'],$this->QuickCRM_simple_modules);
		$excluded= array (
			'Contacts' => array (
						'tasks_parent',
						'accounts',
						'user_sync'
					),
			'Leads' => array (
						'reportees',
					),
			'Opportunities' => array (
						'accounts',
					),
			'Tasks' => array (
						'contact_parent',
					),
			'Employees' => array (
						'contacts_sync',
						'email_addresses',
						'email_addresses_primary',
						'eapm',
						'calls',
						'meetings',
						'emails_users',
						'oauth_tokens',
					),
		);
		
		// built list of links
		$links = array(); 
		$subpanels = array(); 
		if (file_exists($beanFiles[$beanList[$moduleName]])){
			$nodeModule = Q_new_bean($moduleName);
			$nodeModule->load_relationships();
			$linked_fields=$nodeModule->get_linked_fields();

			// list of target modules
			// if a module appears once, module name will be used, else link name will be
			$target_modules = array();
			foreach ($enabled_modules as $enabled) $target_modules[$enabled]=0;
			foreach($linked_fields as $linkedField => $linkedFieldData)
			{
				$rel_type=$nodeModule->$linkedField->_relationship->relationship_type;
				if ($rel_type=='') $rel_type=$linkedFieldData['type'];
				$lhs_module=$nodeModule->$linkedField->_relationship->lhs_module;
				$rhs_module=$nodeModule->$linkedField->_relationship->rhs_module;
				$target_module = $lhs_module==$moduleName ? $rhs_module : $lhs_module;
				if ($target_module=='' && isset($linkedFieldData['module'])) $target_module= $linkedFieldData['module'];
				if (isset($excluded[$moduleName]) && in_array($linkedField,$excluded[$moduleName])) {
					continue;
				}
				if (in_array($target_module,$enabled_modules) &&
					(
						$rel_type == 'many-to-many'
						||
						($rel_type == 'one-to-many' && 
							(
								(($lhs_module==$moduleName || strtoupper($rhs_module)!=strtoupper($moduleName))
								&& ($lhs_module!= $rhs_module || !isset($linkedFieldData['side']) || $linkedFieldData['side']!='right'))
							||
								($rhs_module==''&& $target_module!=''&& $target_module!=$moduleName)
								
							)
						)
					)
				){
					$target_modules[$target_module]++;
					$links[$linkedField] = array('module'=>$target_module,'vname'=>$linkedFieldData['vname'],'label'=>$linkedFieldData['vname']); 
					if (isset($linkedFieldData['id_name'])){
						$links[$linkedField]['id_name']=$linkedFieldData['id_name'];
					}
					$subpanels[$linkedField] = array('link'=>$linkedField,'tmplabel'=>'','customlabel'=>""); 
				}
			}
			// Rename links if necessary (use module name if only one link to that module)
			foreach ($enabled_modules as $enabled) {
				if ($target_modules[$enabled]==1){
					foreach ($links as $lnk=>$lnkvalues) {
						if ($lnkvalues['module']==$enabled 
							&& $lnkvalues['module']!=$moduleName // do not rename links to same module (members, direct reports, ...)
							// && // do not rename links made with Studio
							) {
							$links[$lnk]['label']= $lnkvalues['module'];
						}
					}
				}
			}
		}
		else {
			$GLOBALS['log']->fatal("[QuickCRM] Bean file not found for module $moduleName");
		}
		return array('links'=>$links,'subpanels'=>$subpanels);
	}
	
    function QgetMarkableFields($moduleName,$labels) {
	// allowed colored or marked fields
		global $beanFiles, $beanList;
		global $app_strings;
		$list = array();
		$possible= array('bool','boolean','enum','radioenum','dynamicenum');
		if (file_exists($beanFiles[$beanList[$moduleName]])) {
			$nodeModule = Q_new_bean($moduleName);
			foreach($nodeModule->field_name_map as $field_name => $field_defs)
			{
				if (isset($this->QuickCRM_ExcludedFields[$moduleName])){
					if (in_array($field_defs['name'],$this->QuickCRM_ExcludedFields[$moduleName])) continue;
				}
				$source=(isset($field_defs['source'])?$field_defs['source']:"");
				if(in_array($field_defs['type'], $possible) && ($source != 'non-db') && ($field_name != 'deleted'))
				{
					$list[$field_defs['name']] = array(
									'type' => $field_defs['type'],
									'label' => preg_replace("/'/","&#039;",isset($labels[$field_defs['vname']])?$labels[$field_defs['vname']]:(isset($app_strings[$field_defs['vname']])?$app_strings[$field_defs['vname']]:$field_defs['vname'])),
							);
				}
			}
		}
		return $list;
	}
	
    function QgetFields($moduleName,$labels,$excluded_types) {
	// allowed display fields
		global $beanFiles, $beanList;
		global $app_strings;
		global $current_language;
		$list = array();
		$excluded_names = array('id','assigned_user_id','assigned_user_name','deleted','name','first_name','last_name');
		if (file_exists($beanFiles[$beanList[$moduleName]])) {
			$nodeModule = Q_new_bean($moduleName);
			foreach($nodeModule->field_name_map as $field_name => $field_defs)
			{
				if (in_array($field_defs['name'],$excluded_names)) continue;
				if (isset($this->QuickCRM_ExcludedFields[$moduleName])){
					if (in_array($field_defs['name'],$this->QuickCRM_ExcludedFields[$moduleName])) continue;
				}
				$source=(isset($field_defs['source'])?$field_defs['source']:"");
				$mod=(isset($field_defs['module'])?$field_defs['module']:"");
				$dbType=(isset($field_defs['dbType'])?$field_defs['dbType']:"");
				if((!in_array($field_defs['type'],$excluded_types)
					&& ($source != 'non-db'
					// PRO ONLY
						|| ($source == 'non-db'
							&& ($field_defs['type'] == 'html' || $field_defs['type'] == 'Drawing' || $field_defs['type'] == 'phone' || $field_defs['name'] == 'description' || $field_defs['name'] == 'description_html'))
						)
					)
					||
					($field_defs['name'] == 'email1')
					||
					(($field_defs['type'] == 'parent') && isset($field_defs['parent_type']) && isset($field_defs['options']))
					||
					($field_defs['type'] == 'relate' && $this->isLinkableModule($mod) && (!isset($field_defs['link']) || !isset($field_defs['link_type'])) && $dbType != 'id')
					)
				{
					$list[$field_defs['name']] = array(
									'type' => $field_defs['type'],
									'label' => preg_replace("/'/","&#039;",isset($labels[$field_defs['vname']])?$labels[$field_defs['vname']]:(isset($app_strings[$field_defs['vname']])?$app_strings[$field_defs['vname']]:$field_defs['vname'])),
							);
				}
			}
			$list['assigned_user_name'] = array(
				'type' => 'relate',
				'label' => isset($labels['LBL_ASSIGNED_TO_NAME'])?$labels['LBL_ASSIGNED_TO_NAME']:$app_strings['LBL_ASSIGNED_TO_NAME'],
			);
			if ($moduleName=='Emails'){
				$list['description_html']['label'] = $labels['LBL_HTML_BODY'];
			}
		}
		return $list;
	}
	
    function QgetDisplayFields($moduleName,$labels) {
		global $app_strings, $QuickCRM_AddressDef,$QuickCRM_google_AddressDef;
		$list=$this->QgetFields($moduleName,$labels,array('link','id','function','parent_type','assigned_user_name'));
		if (isset($this->server_config['addresses'][$moduleName])){
			foreach($this->server_config['addresses'][$moduleName] as $prefix){
				
				foreach ($QuickCRM_AddressDef as $suffix) {
					//unset ($list[$prefix.'_address_'.$suffix]);
				}
				$list['$ADD'.$prefix] = array(
									'type' => 'Address',
									'label' => (isset($labels['LBL_'.strtoupper($prefix).'_ADDRESS'])?$labels['LBL_'.strtoupper($prefix).'_ADDRESS']:$prefix) . '(' . $app_strings['LBL_LINK_ALL'] .')',
					);
			}
		}
		return $list;
	}
	
    function QgetListFields($moduleName,$labels) {
		$list=$this->QgetFields($moduleName,$labels,array('link','id','function','iframe','parent_type','assigned_user_name','Drawing'));
		return $list;
	}
	
    function QgetSearchFields($moduleName,$labels) {
	// allowed search fields
		global $beanFiles, $beanList, $app_strings, $sugar_config;
		
		$list = array();
		$excluded_types = array('link','id','function','file','iframe','relate','parent_type','assigned_user_name');
		$allow_nondb_relate = (!isset($sugar_config['quickcrm_norelatesearch']) || $sugar_config['quickcrm_norelatesearch']==false); 
		$excluded_names = array('id','assigned_user_id','assigned_user_name','deleted','name','first_name','last_name');
		if (file_exists($beanFiles[$beanList[$moduleName]])){
			$nodeModule = Q_new_bean($moduleName);
			$map=$nodeModule->field_name_map;
			foreach($nodeModule->field_name_map as $field_name => $field_defs)
			{
				if (in_array($field_defs['name'],$excluded_names)) continue;
				if (isset($this->QuickCRM_ExcludedFields[$moduleName])){
					if (in_array($field_defs['name'],$this->QuickCRM_ExcludedFields[$moduleName])) continue;
				}
				$source=(isset($field_defs['source'])?$field_defs['source']:"");
				$mod=(isset($field_defs['module'])?$field_defs['module']:"");
				if ($field_defs['type'] == 'relate' && $source=='non-db'){
					if (isset($field_defs['id_name'])){
						if (!isset($map[$field_defs['id_name']]['source']) || $map[$field_defs['id_name']]['source'] != 'non-db'){
							$source='';
						}
					}
				}
				if((!in_array($field_defs['type'],$excluded_types)
					&& ($source != 'non-db'
						|| ($field_defs['type'] == 'html')
						)
					)
				|| 
					($field_defs['type'] == 'relate' && ($allow_nondb_relate || $source != 'non-db') && (!isset($field_defs['dbType']) || $field_defs['dbType'] !='id') && $this->isLinkableModule($mod))
				||
					(($field_defs['type'] == 'parent') && isset($field_defs['parent_type']) && isset($field_defs['options']))
				||
					($field_defs['name'] == 'email1')
				)
					
				{
					$list[$field_defs['name']] = array(
									'type' => $field_defs['type'],
									'label' => preg_replace("/'/","&#039;",isset($labels[$field_defs['vname']])?$labels[$field_defs['vname']]:(isset($app_strings[$field_defs['vname']])?$app_strings[$field_defs['vname']]:$field_defs['vname'])),
							);
				}
			}
			$list['assigned_user_name'] = array(
					'type' => 'relate',
					'label' => isset($labels['LBL_ASSIGNED_TO_NAME'])?$labels['LBL_ASSIGNED_TO_NAME']:$app_strings['LBL_ASSIGNED_TO_NAME'],
				);
		}
		return $list;
	}

	function UpdateModules(){
		global $beanFiles, $beanList,$sugar_config;
		// remove suppressed modules from module list
		$newmodule_list=array();
		foreach ($this->mobile['modules'] as $module){
			if (file_exists($beanFiles[$beanList[$module]])){
				array_push($newmodule_list,$module);
			}
		}
		$this->mobile['modules']=$newmodule_list;
		
		$this->mobile['mod_def']= $this->BuildModDef();
		$res=$this->BuildModLinks();
		$this->mobile['links']=$res['links'];
		if (!isset($this->mobile['list'])){
			$this->mobile['list']=array();
		}
		if (!isset($this->mobile['users_dropdown'])){ // add to config defined in earlier versions
			$this->mobile['users_dropdown']=(($sugar_config['quickcrm_max']!=0) && ($sugar_config['quickcrm_max']<70));
		}
		if (!isset($this->mobile['share_search'])){ // add to config defined in earlier versions
			$this->mobile['share_search']='All';
		}

		if (!isset($this->mobile['groupmode'])){ // add to config defined in earlier versions
			$this->mobile['groupmode']=in_array ('SecurityGroups',$moduleList)?'SecurityGroups':'ACLRoles';
		}
		if (!isset($this->mobile['groupviews'])){
			$this->mobile['groupviews']=array();
		}

		if (!isset($this->mobile['native_cal'])){ // add to config defined in earlier versions
			$this->mobile['native_cal']=true;
		}

		if (!isset($this->mobile['force_lock'])){ // add to config defined in earlier versions
			$this->mobile['force_lock']=false;
		}

		if (!isset($this->mobile['documents_sync'])){ // add to config defined in earlier versions
			$this->mobile['documents_sync']=true;
		}
		
		$this->mobile['def_title_fields']=array();
		$this->mobile['def_details_fields']=array();
		if (!isset($this->mobile['marked'])) $this->mobile['marked']=array();
		foreach ($this->mobile['modules'] as $module){
			// remove from modules subpanels unavailable subpanels and add default fields for new modules
			if (isset($this->QuickCRMTitleFields[$module])) $this->mobile['def_title_fields'][$module] = $this->QuickCRMTitleFields[$module];
			if (isset($this->QuickCRMDetailsFields[$module])) $this->mobile['def_details_fields'][$module] = $this->QuickCRMDetailsFields[$module];
			if (!isset($this->mobile['fields'][$module])){
				if (isset($this->QuickCRMDetailsFields[$module])){
					$this->mobile['fields'][$module] = $this->QuickCRMDetailsFields[$module];
				}
				else $this->mobile['fields'][$module]=array();
			}
			if (!isset($this->mobile['list'][$module])){
				if (isset($this->QuickCRMDefList[$module])){
					$this->mobile['list'][$module] = $this->QuickCRMDefList[$module];
				}
				else $this->mobile['list'][$module]=array();
			}
			$subpanels=array();
			if (isset($this->mobile['subpanels'][$module]))
			  foreach ($this->mobile['subpanels'][$module] as $subpanel){
				if (isset($res['links'][$module][$subpanel])) {
					$subpanels[]=$subpanel;
				}
			}
			$this->mobile['subpanels'][$module]=$subpanels; // TODO CHECK ???
			
			if (!isset($this->mobile['def_title_fields'][$module])){
				if ($this->mobile['mod_def'][$module]['type']=='person') {
					$this->mobile['def_title_fields'][$module]= array('first_name','last_name');
				}
				elseif ($this->mobile['mod_def'][$module]['type']=='file') {
					$this->mobile['def_title_fields'][$module]= array('document_name');
				}
				else {
					$this->mobile['def_title_fields'][$module]= array('name');
				}
			}
		}
	}

	function ConvertConfig(){
		global $sugar_config;
		$proKey='QuickCRM_mobileconfig';
		$trialKey='QuickCRM_trialmobileconfig';

		$administration = new Administration();
		$administration->retrieveSettings('QuickCRM',true);
			
			if (!isset($administration->settings[$proKey]) || $administration->settings[$proKey]=='') {
				if (isset($administration->settings[$trialKey]) && $administration->settings[$trialKey]!='') {
					$administration->saveSetting('QuickCRM', 'mobileconfig', $administration->settings[$trialKey]);
					$administration->saveSetting('QuickCRM', 'trialmobileconfig', '');
				}
			}	
	}
	
	function LoadMobileConfig($refresh=false){
		global $sugar_config, $moduleList;
		
		if (isset($this->mobile['modules'])){ // Already loaded
			return;
		}
		
		$json = getJSONobj();
		
		$administration = new Administration();
		$administration->retrieveSettings('QuickCRM',true);

		$confKey='QuickCRM_'.($sugar_config['quickcrm_trial'] != false?'trial':'').'mobileconfig';
		if (isset($administration->settings[$confKey]) && $administration->settings[$confKey]!='') {
			$this->mobile = $json->decode(base64_decode($administration->settings[$confKey]));
			if ($refresh){
				$this->UpdateModules();
			}
			
			return;
		}	

		$this->mobile = array(
			'def_title_fields' => $this->QuickCRMTitleFields, // predefined title fields
			'def_details_fields' => $this->QuickCRMDetailsFields, // predefined detail fields
			// customizations
			'modules' => $this->QuickCRM_modules, // selected
			'fields' => array(), // additional fields for display
			'addresses' => $this->QuickCRMAddressesFields, // displayed address fields
			'search' => array(), // search fields
			'list' => array(), // list fields
			'marked' => array(), // list fields
			'subpanels' => array(), // subpanels (ordered)
			'rowsperpage' => '20',
			'groupusers' => false,
			'groupmode' => in_array ('SecurityGroups',$moduleList)?'SecurityGroups':'ACLRoles',
			'groupviews' => array(), // specific views per group
			'share_search' => 'All',
			'native_cal' => true,
			'force_lock' => false,
			'documents_sync' => true,
			'users_dropdown' => (($sugar_config['quickcrm_max']!=0) && ($sugar_config['quickcrm_max']<70)),
			
			'mod_def' => array(), // Properties of selected modules
			'links' => array(), // available links for selected modules
		);
		if (file_exists('custom/QuickCRM/views.php')){
			include ('custom/QuickCRM/views.php');
		}
		$oldconfKey='QuickCRM_'.($sugar_config['quickcrm_trial'] != false?'trial':'').'mobile_config';
		$conf_file='custom/QuickCRM/mobile.config.js';
		$lines=array();
		if (!isset($administration->settings[$oldconfKey]) || $administration->settings[$oldconfKey]=='') {
			if (!file_exists($conf_file)) {
//				return;
			}
			else {
				$lines = file($conf_file); 
			}
		}
		else {
			$lines = explode("\n", base64_decode($administration->settings[$oldconfKey]));
		}
		$addfields=array();
		$updateFromOldConfig=true;
		if (isset($lines[0]) && substr($lines[0], 0, 4)!='//V3'){
			$rows_pattern ='/^RowsPerPage=(.+);$/';
			$updateFromOldConfig= (substr($lines[0], 0, 4)=='//V1' || substr($lines[0], 0, 4)=='//V2');
				$additional_pattern ='/^Beans\[\'(.+)\'\]\.AdditionalFields.+\[(.+)\].+$/';
				$search_pattern ='/^Beans\[\'(.+)\'\]\.SearchFields.+\[(.+)\].+$/';
				$list_pattern ='/^Beans\[\'(.+)\'\]\.CustomListFields.+\[(.+)\].+$/';
				$addresses_pattern ='/^Beans\[\'(.+)\'\]\.Addresses.+\[(.+)\].+$/';
				$no_access_pattern = "/^Beans\[\'(.+)\'\]\.access.+=.+\'none\';$/";
				$enabled_pattern ='/^QCRM.enableBeans\(\[(.+)\]\);$/';
		}
		else {
			$lines=array(); // do not read config file saved with V3.0
		}
		foreach ($lines AS $line) {
			if (preg_match($rows_pattern,$line)>0){
				$this->mobile['rowsperpage']=trim(preg_replace($rows_pattern,'$1',$line));
			}
			elseif (preg_match($enabled_pattern,$line)>0){
				$module = trim(preg_replace($enabled_pattern,'$1',$line));
				$module_arr=explode(",", $module);
				$enabled_modules = array();
				foreach($module_arr as $module){
					$module=substr($module, 1, -1);
					array_push($enabled_modules,$module);
				}
				$this->mobile['modules'] = $enabled_modules;
			}
			elseif (preg_match($additional_pattern,$line)>0){
				$module = trim(preg_replace($additional_pattern,'$1',$line));
				$fields = trim(preg_replace($additional_pattern,'$2',$line));
				$fields_arr=explode(",", $fields);
				if (!isset($addfields[$module])) $addfields[$module]=array();
				foreach($fields_arr as $field){
					$fld=substr($field, 1, -1);
					$addfields[$module][]=$fld;
				}
			}
			elseif (preg_match($search_pattern,$line)>0){
				$module = trim(preg_replace($search_pattern,'$1',$line));
				$fields = trim(preg_replace($search_pattern,'$2',$line));
				$fields_arr=explode(",", $fields);
				foreach($fields_arr as $field){
					$fld=substr($field, 1, -1);
					$this->mobile['search'][$module][]=$fld;
				}
			}
			elseif (preg_match($list_pattern,$line)>0){
				$module = trim(preg_replace($list_pattern,'$1',$line));
				$fields = trim(preg_replace($list_pattern,'$2',$line));
				$fields_arr=explode(",", $fields);
				foreach($fields_arr as $field){
					$fld=substr($field, 1, -1);
					$this->mobile['list'][$module][]=$fld;
				}
			}
			elseif (preg_match($addresses_pattern,$line)>0){
				$module = trim(preg_replace($addresses_pattern,'$1',$line));
				$addresses = trim(preg_replace($addresses_pattern,'$2',$line));
				$fields_arr=explode(",", $addresses);
				// reset addresses 
				$this->mobile['addresses'][$module]=array();
				foreach($fields_arr as $field){
					$fld=substr($field, 1, -1);
					$this->mobile['addresses'][$module][]=$fld;
				}
			}
		}
		$this->mobile['mod_def']= $this->BuildModDef();
		$res=$this->BuildModLinks();
		$this->mobile['links']=$res['links'];
		$ModuleDef=$this->mobile['mod_def'];
		foreach($this->mobile['modules'] as $module)
			{

				if (!isset($this->mobile['def_title_fields'][$module])){
					if ($ModuleDef[$module]['type']=='person') {
						$this->mobile['def_title_fields'][$module]= array('first_name','last_name');
					}
					else {
						$this->mobile['def_title_fields'][$module]= array('name');
					}
				}
				
				$subpanels=array();
				if (isset($this->QuickCRMDefSubPanels[$module])){
					foreach ($this->QuickCRMDefSubPanels[$module] as $lnk){
						$subpanels[]=$lnk;
					}				
				}
				else {
					foreach ($res['subpanels'][$module] as $lnk){
						$subpanels[]=$lnk['link'];
					}				
				}
				$this->mobile['subpanels'][$module]=$subpanels;

				$searchfields=array();
				if (isset($this->QuickCRMDefSearch[$module]) && !isset($this->mobile['search'][$module])){
					foreach ($this->QuickCRMDefSearch[$module] as $fld){
						$searchfields[]=$fld;
					}				
				}
				$this->mobile['search'][$module]=$searchfields;

				$listfields=array();
				if (isset($this->QuickCRMDefList[$module]) && !isset($this->mobile['list'][$module])){
					foreach ($this->QuickCRMDefList[$module] as $fld){
						$listfields[]=$fld;
					}				
				}
				$this->mobile['list'][$module]=$list;

				if (isset($this->QuickCRMDetailsFields[$module])) {
					if ($updateFromOldConfig && isset($addfields[$module])){
						$this->mobile['fields'][$module]=array();
						// for upward compatibility when new default fields have been defined
						// add only default fields that have not been defined by user
						foreach ($this->QuickCRMDetailsFields[$module] as $fld){
							if (!in_array($fld,$addfields[$module])){
								array_push($this->mobile['fields'][$module],$fld);
							}
						}				
					}
					else {
						$this->mobile['fields'][$module]=$this->QuickCRMDetailsFields[$module];
					}
				}
				else
					$this->mobile['fields'][$module]=array();
					
				if (isset($this->mobile['addresses'][$module])) {
					foreach($this->mobile['addresses'][$module] as $key=>$fld){
						array_push($this->mobile['fields'][$module],'$ADD'.$fld);
					}
				}
			
				if (isset($addfields[$module])) {
					$this->mobile['fields'][$module]=array_merge($this->mobile['fields'][$module],$addfields[$module]);
				}
				
			}
	}

	function LoadServerConfig($refresh=false){
		global $current_language, $sugar_config;
		
		$json = getJSONobj();
		if (!$refresh){
			$administration = new Administration();
			$administration->retrieveSettings('QuickCRM');

			$confKey='QuickCRM_'.($sugar_config['quickcrm_trial'] != false?'trial':'').'serverconfig';
			if (isset($administration->settings[$confKey])) {
				$this->server_config=$json->decode(base64_decode($administration->settings[$confKey]));
				$Sflds=array();
				$Dflds=array();
				$Lflds=array();
				$current_Sversion=false;
				$current_Dversion=false;
				$current_Lversion=false;
				foreach($this->server_config['modules'] as $module){
					if (isset($administration->settings['QuickCRM_'.'S'.$module])){
						$current_Sversion=true;
						$Sflds[$module]=$json->decode(base64_decode($administration->settings['QuickCRM_'.'S'.$module]));
					}
					if (isset($administration->settings['QuickCRM_'.'D'.$module])){
						$current_Dversion=true;
						$Dflds[$module]=$json->decode(base64_decode($administration->settings['QuickCRM_'.'D'.$module]));
					}
					if (isset($administration->settings['QuickCRM_'.'L'.$module])){
						$current_Lversion=true;
						$Lflds[$module]=$json->decode(base64_decode($administration->settings['QuickCRM_'.'L'.$module]));
					}
				}
				// In previous version, all search fields were already stored in the same settings
				if ($current_Sversion) $this->server_config['search']=$Sflds;
				if ($current_Dversion) $this->server_config['fields']=$Dflds;
				if ($current_Lversion) $this->server_config['list']=$Lflds;
				return;
			}
		}
		$this->server_config = array(
			'modules' => array(), // Available modules
			'fields' => array(), // Available fields for display
			'search' => array(), // Available fields for search
			'list' => array(), // Available fields for list
			'marked' => array(), // Available fields for marked fields (colors)
			'addresses' => array(), // Available fields for addresses
			'links' => array(), // Available fields for links for selected modules
			'subpanels' => array(), // Available fields for addresses
		);
		
		$this->LoadCustomModules();
		$this->server_config['modules'] = array_merge($this->QuickCRM_modules,$this->QuickCRM_custom_modules);

		// if mobile config not yet loaded, do it now
		if (!isset($this->mobile['modules'])){
			$this->LoadMobileConfig($refresh);
		}

		$lst_mod=$this->mobile['modules'];
		$ModuleDef=$this->mobile['mod_def'];		

		foreach($lst_mod as $module){
			$labels=return_module_language($current_language, $module);
			if ($ModuleDef[$module]['type']=='person' && $module != 'Employees') {
				$this->server_config['addresses'][$module]= array('primary','alt');
			}
			elseif ($ModuleDef[$module]['type']=='company'  || $module=='AOS_Quotes' || $module=='AOS_Invoices') {
				$this->server_config['addresses'][$module]= array('billing','shipping');
			}
			$this->server_config['fields'][$module] = $this->QgetDisplayFields($module,$labels);
			$this->server_config['search'][$module] = $this->QgetSearchFields($module,$labels);
			$this->server_config['list'][$module] = $this->QgetListFields($module,$labels);
			$this->server_config['marked'][$module] = $this->QgetMarkableFields($module,$labels);
/*
			if (isset($this->server_config['addresses'][$module])){
				foreach($this->server_config['addresses'][$module] as $prefix){
					unset ($this->server_config['fields'][$module][$prefix.'_address_street']);
					unset ($this->server_config['fields'][$module][$prefix.'_address_city']);
					unset ($this->server_config['fields'][$module][$prefix.'_address_state']);
					unset ($this->server_config['fields'][$module][$prefix.'_address_postalcode']);
					unset ($this->server_config['fields'][$module][$prefix.'_address_country']);
					$this->server_config['fields'][$module]['$ADD'.$prefix] = array(
									'type' => 'Address',
									'label' => $prefix,
							);
				}
			}
*/
			$lnks=$this->QgetAvailableLinks($module);
			$this->server_config['links'][$module]=$lnks['links'];
			$this->server_config['subpanels'][$module]=$lnks['subpanels'];
		}
	}

	function getJSConfig(){
		global $sugar_config,$QuickCRM_AddressDef,$QuickCRM_google_AddressDef;
	
		$str="//V3.0\n";
		$enabled= $this->mobile['modules'];

		$str.= "QCRM.users_dropdown=" . ((isset ($this->mobile['users_dropdown']) && !$this->mobile['users_dropdown']) ?"false":"true"). ";\n";
		$str.= "QCRM.share_search=" . ((isset ($this->mobile['share_search'])  && $this->mobile['share_search'] != 'All') ? $this->mobile['share_search']:"'All'"). ";\n";
		$str.= "QCRM.native_cal=" . ((isset ($this->mobile['native_cal'])  && !$this->mobile['native_cal']) ? "false":"true"). ";\n";
		if (isset($sugar_config['suitecrm_version'])){
			$str.= "QCRM.AOS_show_image=" . ((!isset ($this->mobile['productimage'])  || $this->mobile['productimage']) ? "true":"false"). ";\n";
		}
		$str.= "QCRM.forceLock=" . ((!isset ($this->mobile['force_lock'])  || !$this->mobile['force_lock']) ? "false":"true"). ";\n";
		if (in_array ('Documents',$enabled) && isset($this->mobile['documents_sync']) && !$this->mobile['documents_sync']){
			$str.= "Beans.Documents.SyncOptions={sync:'None',max:true};\n";
		}
			
		
		$str.="QCRM.enableBeans(['" . implode("','",$enabled) . "']);\n";
		if (!isset($this->mobile['detail'])) $this->mobile['detail'] = array();
		$preset_fields = $this->QgetPresetModuleFields();
		foreach($enabled as $module){
			if (count($this->mobile['fields'][$module]) >0){
				$str.="Beans['$module'].AdditionalFields = ['" . implode("','",$this->mobile['fields'][$module]) . "'];\n";
			}
			if (isset($this->mobile['detail'][$module]) && $this->mobile['detail'][$module] != False && (count($this->mobile['detail'][$module]) >0)){
				if (isset($preset_fields[$module])) $def_fields = $preset_fields[$module];
				else $def_fields = array();
				$str.="Beans['$module'].DetailFields = ['" . implode("','",array_merge ($def_fields,$this->mobile['detail'][$module])) . "'];\n";
			}
			
			if (isset($this->mobile['search'][$module]) && (count($this->mobile['search'][$module]) >0)){
				$str.="Beans['$module'].SearchFields = ['" . implode("','",$this->mobile['search'][$module]) . "'];\n";
			}
			
			if (isset($this->mobile['list'][$module]) && (count($this->mobile['list'][$module]) >0)){
				$str.="Beans['$module'].CustomListFields = ['" . implode("','",$this->mobile['list'][$module]) . "'];\n";
			}

			if (isset($this->mobile['def_title_fields'][$module])){ // TO REMOVE WHEN APP HAS BEEN UPDATED
				$titlefield = implode("','",$this->mobile['def_title_fields'][$module]);
				if ($titlefield != 'name') {
					$str.="Beans['$module'].TitleFields = ['" . $titlefield . "'];\n";
				}
			}
			
			if (isset($this->mobile['subpanels'][$module]) && count($this->mobile['subpanels'][$module])>0){
				$str.="Beans['$module'].CustomLinks = {";
				$str_subp="";
				foreach($this->mobile['subpanels'][$module] as $key=>$fld){
					$str_subp .= ($str_subp==''?"":",") ."'".$fld."':{title:'".$this->mobile['links'][$module][$fld]['label']."'}";
				}
				$str.= $str_subp . "};\n";
			}
			else $str.="Beans['$module'].CustomLinks = [];\n";
			
			if (isset($this->mobile['marked'][$module]) && ($this->mobile['marked'][$module] !=='') && ($this->mobile['marked'][$module] !=='none')){
				$str.="Beans['$module'].ColoredField = '" . $this->mobile['marked'][$module] . "';\n";
			}

		}
		
		if (isset($this->mobile['groupviews'])){
			$str.="QCRM.Profiles={};";
			foreach ($this->mobile['groupviews'] as $group => $settings){
				$str.="QCRM.Profiles['$group']={};";
				foreach ($settings as $module => $module_settings){
					$str.="QCRM.Profiles['$group']['$module']={fields:['" . implode("','",$module_settings['fields']) . "']};\n";
				}
			}
		}
			
		// Save group mode (roles or security group)
		$str.="QCRM.ProfileMode='". $this->mobile['groupmode'] . "';\n";
		// Save RowsPerPage & groupusers
		$str.='RowsPerPage='. $this->mobile['rowsperpage'] . ";\n";
		if (!isset ($this->mobile['groupusers']) || !$this->mobile['groupusers']){
			$str.= "SimpleBeans['Users'].query += 'AND (users.is_group=0 OR users.is_group IS NULL)';\n";
		}
		$str.="QCRM.addressFields=['" . implode("','",$QuickCRM_AddressDef) . "'];\n";
		$str.="QCRM.google_addressFields=['" . implode("','",$QuickCRM_google_AddressDef) . "'];\n";

		return $str;
	}

	function SaveMobileConfig($saveLanguages){
		global $sugar_config;
		$json = getJSONobj();
	
		$str= $this->getJSConfig();

		$administration = new Administration();
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'mobile_config', base64_encode($str));
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'mobileconfig', base64_encode($json->encode($this->mobile)));
		
// KEEP IT UNTIL upwards compatibility with Android App		
		$saveDir = realpath(dirname(__FILE__).'/../../QuickCRM/');
		if($fh = @fopen($saveDir .'/' .  'mobile.config.js', "w")){
			fputs($fh, $str);
			fclose($fh);
		}
		if ($saveLanguages){
			$mobile = new mobile_jsLanguage();
			$mobile->createFiles(array_merge($this->mobile['modules'],$this->QuickCRM_simple_modules),$this->mobile);
		}
	}

	function SaveServerConfig(){
		global $sugar_config;
		$json = getJSONobj();
		$administration = new Administration();
		foreach($this->server_config['modules'] as $module){
			if (isset($this->server_config['search'][$module]))
				$administration->saveSetting('QuickCRM', 'S'.$module, base64_encode($json->encode($this->server_config['search'][$module])));
			if (isset($this->server_config['fields'][$module]))
				$administration->saveSetting('QuickCRM', 'D'.$module, base64_encode($json->encode($this->server_config['fields'][$module])));
			if (isset($this->server_config['list'][$module]))
				$administration->saveSetting('QuickCRM', 'L'.$module, base64_encode($json->encode($this->server_config['list'][$module])));
		}
		$save_Sflds=$this->server_config['search'];
		$save_Dflds=$this->server_config['fields'];
		$save_Lflds=$this->server_config['list'];
		$this->server_config['search']="";
		$this->server_config['fields']="";
		$this->server_config['list']="";
		$administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'serverconfig', base64_encode($json->encode($this->server_config)));
		$this->server_config['search']=$save_Sflds;
		$this->server_config['fields']=$save_Dflds;
		$this->server_config['list']=$save_Lflds;
	}

	function LoadConfig($refresh=true){
		$this->LoadMobileConfig($refresh);
		$this->LoadServerConfig($refresh);
		
	}

	function SaveConfig(){
	
		function CheckAccess(){
			global $sugar_config;

			if (is_windows() || !function_exists("curl_init")){
				return true;
			}
			else {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $sugar_config['site_url']."/custom/QuickCRM/rest.php");
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_NOBODY, true); 
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
				$res=curl_exec($ch);
				$err=curl_errno($ch);
				if (!$err) {
					$info = curl_getinfo($ch);
					$info = $info['http_code'];
					$err=($info=='403' || $info=='500');
				}

				curl_close($ch); 
				return (!$err);
			}
		}
		
		$this->SaveServerConfig();
		$this->SaveMobileConfig(true);
		return (CheckAccess());
	}

}
