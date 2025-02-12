<?php
session_start();
ob_start();

// Set default timezone
date_default_timezone_set("Asia/Ho_Chi_Minh");

// App path
$appPath = dirname(__FILE__);
define('APP_PATH', $appPath . DIRECTORY_SEPARATOR . 'src');

// Lib path
$libPath = 'lib';
define('LIB_PATH', APP_PATH . DIRECTORY_SEPARATOR . $libPath);

// Core path
$corePath = 'core';
define('CORE_PATH', APP_PATH . DIRECTORY_SEPARATOR . $corePath);

// Modules path
$modulesPath = 'modules';
define('MODULES_PATH', APP_PATH . DIRECTORY_SEPARATOR . $modulesPath);

// Helper path
$helperPath = 'helper';
define('HELPER_PATH', APP_PATH . DIRECTORY_SEPARATOR . $helperPath);

// Layout path
$layoutPath = 'layout';
define('LAYOUT_PATH', APP_PATH . DIRECTORY_SEPARATOR . $layoutPath);

// Components path
$componentsPath = 'components';
define('COMPONENTS_PATH', APP_PATH . DIRECTORY_SEPARATOR . $componentsPath);

// Assets path
$assetsPath = 'assets';
define('ASSETS_PATH', APP_PATH . DIRECTORY_SEPARATOR . $assetsPath);

// Config path
$configPath = 'config';
define('CONFIG_PATH', APP_PATH . DIRECTORY_SEPARATOR . $configPath);

require CORE_PATH . DIRECTORY_SEPARATOR . 'appload.php';
