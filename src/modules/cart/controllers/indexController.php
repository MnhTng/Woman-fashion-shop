<?php
function construct()
{
    load_model('index');
    load('helper', 'cart');
}

function indexAction()
{
    load('helper', 'format');
    load_view('index');
}

function deleteAction()
{
    if (isset($_GET['all']))
        delete_cart();
    else {
        $code = explode(',', $_GET['code']);
        $size = explode(',', $_GET['size']);

        delete_item($code, $size, count($code));
    }

    redirect('?mod=cart');
}

function updateAction()
{
    load('helper', 'format');

    if (isset($_POST['quantity'])) {
        $userID = $_SESSION['user_id'];
        $id = $_POST['id'];
        $code = $_POST['code'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        $subTotal = $quantity * $_POST['price'];
        $freeShip = '';
        $discount = 0;

        update_cart_quantity($quantity, $subTotal, $userID, $code, $size);

        $cart = get_cart();
        $checkout = get_checkout_cart();

        $_SESSION['quantity'] = array_sum(array_column($cart, "quantity"));
        $_SESSION['quantityCheckout'] = array_sum(array_column($checkout, "quantity"));
        $_SESSION['totalCheckout'] = array_sum(array_column($checkout, "subtotal"));

        foreach ($checkout as $item) {
            if ($item['sale'])
                $discount += ($item['price'] - $item['sale']) * $item['quantity'];
        }

        if ($_SESSION['quantityCheckout'] > 1) {
            $freeShip = "<span>Shipping discount</span><span class='discount'>-20,000₫</span>";
            $finalTotal = $_SESSION['totalCheckout'];
            $discount += 20000;
        } else if ($_SESSION['quantityCheckout'])
            $finalTotal = $_SESSION['totalCheckout'] + 20000;
        else
            $finalTotal = 0;

        if ($discount)
            $discount = "<span>You have saved " . currency_format($discount) . "</span>";
        else
            $discount = '';

        $response = [
            'id' => $id,
            'itemQuantity' => $quantity,
            'quantity' => $_SESSION['quantity'],
            'total' => currency_format($_SESSION['totalCheckout']),
            'finalTotal' => currency_format($finalTotal),
            'freeShip' => $freeShip,
            'discount' => $discount,
        ];

        echo json_encode($response);
    }
}

function checkoutAction()
{
    load('helper', 'format');

    if (isset($_POST['all'])) {
        $checkAll = $_POST['all'];

        if ($checkAll == 'true') {
            $freeShip = '';
            $discount = 0;

            update_checkout_all(1);

            $result = get_cart();

            $quantity = array_sum(array_column($result, 'quantity'));
            $total = array_sum(array_column($result, 'subtotal'));

            foreach ($result as $item) {
                if ($item['sale'])
                    $discount += ($item['price'] - $item['sale']) * $item['quantity'];
            }

            if ($quantity > 1) {
                $freeShip = "<span>Shipping discount</span><span class='discount'>-20,000₫</span>";
                $finalTotal = $total;
                $discount += 20000;
            } else
                $finalTotal = $total + 20000;

            if ($discount)
                $discount = "<span>You have saved " . currency_format($discount) . "</span>";
            else
                $discount = '';

            $response = [
                'total' => currency_format($total),
                'finalTotal' => currency_format($finalTotal),
                'freeShip' => $freeShip,
                'discount' => $discount,
            ];

            echo json_encode($response);
        } else {
            update_checkout_all(0);

            echo json_encode($_POST);
        }
    } else {
        $code = $_POST['code'];
        $size = $_POST['size'];
        $status = $_POST['status'];

        update_checkout_item($code, $size, $status);

        $result = get_checkout_cart();

        $quantity = array_sum(array_column($result, 'quantity'));
        $total = array_sum(array_column($result, 'subtotal'));

        $freeShip = '';
        $discount = 0;

        foreach ($result as $item) {
            if ($item['sale'] > 0)
                $discount += ($item['price'] - $item['sale']) * $item['quantity'];
        }

        if ($quantity > 1) {
            $freeShip = "<span>Shipping discount</span><span class='discount'>-20,000₫</span>";
            $finalTotal = $total;
            $discount += 20000;
        } else
            $finalTotal = $total + 20000;

        if ($discount)
            $discount = "<span>You have saved " . currency_format($discount) . "</span>";
        else
            $discount = '';

        if ($quantity)
            $emptySelect = 0;
        else
            $emptySelect = 1;

        $response = [
            'empty' => $emptySelect,
            'status' => $status,
            'total' => currency_format($total),
            'finalTotal' => currency_format($finalTotal),
            'freeShip' => $freeShip,
            'discount' => $discount,
        ];

        echo json_encode($response);
    }
}
