<?php
 if(!defined('sugarEntry'))define('sugarEntry', true);


/**
 * This is a rest entry point for rest version Sugar 6.5 +
 */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Allow-Credentials: true");
chdir('../..');

    require_once('custom/service/vAlineaSolReports/SugarWebServiceImplvAlineaSolReports.php');
    $webservice_path = 'service/core/SugarRestService.php';
    $webservice_class = 'SugarRestService';
    $webservice_impl_class = 'SugarWebServiceImplvAlineaSolReports';
    $registry_path = 'custom/service/vAlineaSolReports/registry.php';
    $registry_class = 'registry_vAlineaSolReports';
    $location = 'custom/service/vAlineaSolReports/rest.php';
    require_once('service/core/webservice.php');
