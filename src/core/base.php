<?php
defined('APP_PATH') or exit('Do not have access to this section!');

//! Get Controller name
function get_controller()
{
    global $config;
    $controller = isset($_GET['controller']) ? $_GET['controller'] : $config['default_controller'];
    return $controller;
}

//! Get Module name
function get_module()
{
    global $config;
    $module = isset($_GET['mod']) ? $_GET['mod'] : $config['default_module'];
    return $module;
}

//! Get Action name
function get_action()
{
    global $config;
    $action = isset($_GET['act']) ? $_GET['act'] : $config['default_action'];
    return $action;
}

//! Load any file necessary from type folder you need
function load($type, $name)
{
    if ($type == 'lib')
        $path = LIB_PATH . DIRECTORY_SEPARATOR . "{$name}.php";
    if ($type == 'helper')
        $path = HELPER_PATH . DIRECTORY_SEPARATOR . "{$name}.php";
    if ($type == 'components') {
        if ($name == 'mail')
            $path = COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'mail' . DIRECTORY_SEPARATOR . 'sendMail.php';
    }

    if (file_exists($path))
        require $path;
    else
        require COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . '404.html';
}

//! Call function based on function name
function call_function($list_function = array())
{
    if (is_array($list_function)) {
        foreach ($list_function as $func) {
            if (function_exists($func()))
                $func();
        }
    }
}

function load_view($name, $data_send = array())
{
    global $data;
    $data = $data_send;
    $path = MODULES_PATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $name . 'View.php';

    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        require $path;
    } else
        require COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . '404.html';
}

function load_model($name)
{
    $path = MODULES_PATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . $name . 'Model.php';

    if (file_exists($path))
        require $path;
    else
        require COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . '404.html';
}

function get_header($name = '')
{
    global $data;
    if (empty($name))
        $name = 'header';
    else
        $name = "header-{$name}";

    $path = LAYOUT_PATH . DIRECTORY_SEPARATOR . $name . '.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        require $path;
    } else
        require COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . '404.html';
}

function get_footer($name = '')
{
    global $data;
    if (empty($name))
        $name = 'footer';
    else
        $name = "footer-{$name}";

    $path = LAYOUT_PATH . DIRECTORY_SEPARATOR . $name . '.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        require $path;
    } else
        require COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . '404.html';
}
