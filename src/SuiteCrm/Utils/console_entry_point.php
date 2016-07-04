<?php
/**
 * Common entry point setup to include in console commands
 *
 * usage:
 * paste the below code in your command body:
 *

require_once PROJECT_ROOT . '/src/SuiteCrm/Utils/console_entry_point.php';
/** @var array $sugar_config *\/
/** @var  \User $current_user */
/** @var string $current_language */
/** @var \DBManager $db */
/** @var array $beanList */
/** @var array $beanFiles */
/** @var array $app_list_strings */
/** @var array $app_strings */
/** @var \Localization $locale */

 /** ;) *\/
 *
 */

if(php_sapi_name() != 'cli') {
    die("Only cli usage is allowed!");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('sugarEntry', TRUE);

/** @var array $sugar_config */
global $sugar_config;

/** @var  \User $current_user */
global $current_user;

/** @var string $current_language */
global $current_language;

/** @var \DBManager $db */
global $db;

/** @var array $beanList */
global $beanList;

/** @var array $beanFiles */
global $beanFiles;

/** @var array $app_list_strings */
global $app_list_strings;

/** @var array $app_strings */
global $app_strings;

/** \Localization $locale */
global $locale;

require PROJECT_ROOT . '/config.php';
require_once PROJECT_ROOT . '/include/entryPoint.php';
require_once(PROJECT_ROOT . '/include/Localization/Localization.php');

/* Substituting Sugar's logger */
if(isset($this->loggerManager)) {
    $GLOBALS['log'] = $this->loggerManager;
}

$locale = new \Localization();

if (!isset($current_language) || empty($current_language))
{
    $current_language = $sugar_config['default_language'];
}

$app_list_strings = return_app_list_strings_language($current_language);
$app_strings = return_application_language($current_language);

$current_user = new \User();
$current_user->getSystemUser();

$db = \DBManagerFactory::getInstance();