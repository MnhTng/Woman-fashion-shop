<?php
// Gọi đến file xử lý thông qua request
$request_path = MODULES_PATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller() . 'Controller.php';

if (file_exists($request_path))
    require $request_path;
else
    require COMPONENTS_PATH . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR . '404.html';

$action_name = get_action() . 'Action';
call_function(array('construct', $action_name));
