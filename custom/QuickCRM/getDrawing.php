<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

if(empty($_REQUEST['drawing']) || !isset($_SESSION['authenticated_user_id'])) {
	die("Not a Valid Entry Point");
} else {
    @ini_set('zlib.output_compression','Off');//bug 27089, if use gzip here, the Content-Length in header may be incorrect.
    // cn: bug 8753: current_user's preferred export charset not being honored
    $GLOBALS['current_user']->retrieve($_SESSION['authenticated_user_id']);
    $GLOBALS['current_language'] = $_SESSION['authenticated_user_language'];
    $app_strings = return_application_language($GLOBALS['current_language']);
    $mod_strings = return_module_language($GLOBALS['current_language'], 'ACL');

	$local_location =  "upload://{$_REQUEST['drawing']}";

	if(!file_exists( $local_location ) || strpos($local_location, "..")) {
		$local_location = "themes/default/images/_blank.png";
	}

	$name = isset($_REQUEST['tempName'])?$_REQUEST['tempName']:'';
	if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']))
	{
		$name = urlencode($name);
		$name = str_replace("+", "_", $name);
	}

	header("Pragma: public");
	header("Cache-Control: no-cache, post-check=0, pre-check=0");
	$mime = getimagesize($local_location);
	
	if(!empty($mime)) {
		header("Content-Type: {$mime['mime']}");
	} else {
		header("Content-Type: image/png");
	}

	// disable content type sniffing in MSIE
	header("X-Content-Type-Options: nosniff");
	header("Content-Length: " . filesize($local_location));
	header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
	@set_time_limit(0);

	@ob_end_clean();
	ob_start();
	readfile($local_location);
	@ob_flush();

}
?>
