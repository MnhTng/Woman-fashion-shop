<?php
defined('APP_PATH') or exit('Do not have access to this section!');

// Include database interactive function
require LIB_PATH . DIRECTORY_SEPARATOR . 'database.php';
require LIB_PATH . DIRECTORY_SEPARATOR . 'alert.php';

// Include core base function
require CORE_PATH . DIRECTORY_SEPARATOR . 'base.php';

// Include config file
require CONFIG_PATH . DIRECTORY_SEPARATOR . 'database.php';
require CONFIG_PATH . DIRECTORY_SEPARATOR . 'config.php';
require CONFIG_PATH . DIRECTORY_SEPARATOR . 'email.php';
require CONFIG_PATH . DIRECTORY_SEPARATOR . 'autoload.php';


if (is_array($autoload)) {
    foreach ($autoload as $type => $list_auto) {
        if (!empty($list_auto)) {
            foreach ($list_auto as $name)
                load($type, $name);
        }
    }
}


// Connect database and load data to session variable
db_connect($db);

$sql = "SELECT * FROM banner";
$_SESSION['banner'] = db_fetch_array($sql);

$sql = "SELECT p.* FROM product AS p JOIN category AS c ON p.id = c.id";
$_SESSION['product'] = db_fetch_array($sql);

$sql = "SELECT * FROM category";
$_SESSION['category'] = db_fetch_array($sql);

$sql = "SELECT * FROM cart";
$_SESSION['cart'] = db_fetch_array($sql);

if (isset($_SESSION['is_login']) && !empty($_SESSION['cart'])) {
    $_SESSION['cartByID'] = array_filter($_SESSION['cart'], function ($item) {
        return $item['id'] == $_SESSION['user_id'];
    });
    $_SESSION['quantity'] = array_sum(array_column($_SESSION['cartByID'], "quantity"));
    $_SESSION['total'] = array_sum(array_column($_SESSION['cartByID'], "subtotal"));

    $_SESSION['cartByCheckout'] = array_filter($_SESSION['cart'], function ($item) {
        return $item['id'] == $_SESSION['user_id'] && $item['checkout'] == 1;
    });
    $_SESSION['quantityCheckout'] = array_sum(array_column($_SESSION['cartByCheckout'], "quantity"));
    $_SESSION['totalCheckout'] = array_sum(array_column($_SESSION['cartByCheckout'], "subtotal"));
}

if (isset($_SESSION['user_id'])) {
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
    $_SESSION['account'] = db_fetch_row($sql);
}

require CORE_PATH . DIRECTORY_SEPARATOR . 'router.php';
