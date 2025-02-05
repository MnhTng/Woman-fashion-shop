<?php
function construct()
{
    load_model('detail');
    load('helper', 'product');
}

function indexAction()
{
    load('helper', 'format');

    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $cat = isset($_GET['cat']) ? (int)$_GET['cat'] : null;
    $code = $_GET['code'] ? $_GET['code'] : null;

    $data = [
        'id' => $id,
        'cat' => $cat,
        'code' => $code,
    ];

    load_view('detail', $data);
}

function add_buyAction()
{
    load('helper', 'cart');

    if (isset($_POST['action'])) {
        $alert = array();

        if (!isset($_SESSION['is_login'])) {
            $alert['login'] = 'Please login to use the features!';

            echo json_encode($alert);
        } else {
            if (isset($_POST['size'])) {
                $sizeChose = $_POST['size'];
            } else {
                $alert['size'] = 'Please choose product size you want!';
            }

            if ($_POST['quantity'] < 1) {
                $alert['quantity'] = 'Product quantity must be greater than 0!';
            }

            if (empty($alert)) {
                if ($_POST['action'] == "submit_add_product") {
                    $_SESSION['product'] = get_product();
                    $_SESSION['category'] = get_category();
                    $_SESSION['cart'] = get_cart();

                    $code = $_POST['code'];
                    add_cart($code, $sizeChose);

                    $result = get_user();
                    $_SESSION['quantity'] = array_sum(array_column($result, "quantity"));

                    $alert['success'] = 'Add success!';
                    $alert['number'] = $_SESSION['quantity'];

                    echo json_encode($alert);
                } else {
                    $alert = [
                        'buy' => true,
                        'quantity' => $_POST['quantity'],
                        'size' => $sizeChose,
                        'code' => $_POST['code'],
                    ];

                    echo json_encode($alert);
                }
            } else
                echo json_encode($alert);
        }
    }
}
