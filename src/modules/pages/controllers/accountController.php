<?php
function construct()
{
    load_model('account');
}

function indexAction()
{
    load('helper', 'format');

    if (isset($_GET['order'])) {
        $sql = "SELECT * FROM `order`";
        $_SESSION['order'] = db_fetch_array($sql);

        $sql = "SELECT * FROM `cancel_order`";
        $_SESSION['cancel_order'] = db_fetch_array($sql);
    }

    $order = isset($_GET['order']) ? $_GET['order'] : '';
    $cancel_order = isset($_GET['cancel_order']) ? $_GET['cancel_order'] : '';
    $order_fail = '';

    if (isset($_GET['vnp_ResponseCode'])) {
        $response = $_GET['vnp_ResponseCode'];
        $orderPaidByVnPay = explode(',', $_GET['vnpay_list_order']);
        $expectedStatus = '';

        if ($response == '00') {
            $expectedStatus = 'Paid';
        } else {
            $expectedStatus = 'Payment Failed';
            $order = "Payment failed!";
            $order_fail = "Payment failed!";
        }

        update_status_after_pay($orderPaidByVnPay, $expectedStatus);
    }

    $data = [
        'ordered' => $order,
        'canceled' => $cancel_order,
        'order_fail' => $order_fail,
    ];

    load_view('account', $data);
}

function avtAction()
{
    if (isset($_FILES['avt'])) {
        $dir = './src/assets/images/';
        $fileName = basename($_FILES['avt']['name']);
        $uploadFile = $dir . $fileName;

        if (file_exists($uploadFile))
            unlink($uploadFile);

        move_uploaded_file($_FILES['avt']['tmp_name'], $uploadFile);

        update_avt($uploadFile);

        $response = get_user();

        sleep(3);
        echo $response['avt'];
    }
}

function info_updateAction()
{
    load('lib', 'validation');

    if (isset($_POST)) {
        $alert = [];

        if (!empty($_POST['name']) && !nameRegex($_POST['name']))
            $alert['name'] = "Name must be letters and at least two characters long!";
        if (!empty($_POST['date']) && !dateRegex($_POST['date']))
            $alert['date'] = "Date must be less than current date!";
        if (!empty($_POST['email']) && !emailRegex($_POST['email']))
            $alert['email'] = "Email must be in the format: abc123@domain1.domain2!";
        if (!empty($_POST['phone']) && !phoneRegex($_POST['phone']))
            $alert['phone'] = "Phone number must start with 0 and have 10 to 12 digits!";

        if (empty($alert)) {
            $info = [];

            if (!empty($_POST['name']))
                $info['fullname'] = $_POST['name'];
            if (isset($_POST['gender']))
                $info['gender'] = $_POST['gender'];
            if (!empty($_POST['date']))
                $info['birthday'] = $_POST['date'];
            if (!empty($_POST['email']))
                $info['email'] = $_POST['email'];
            if (!empty($_POST['phone']))
                $info['tel'] = $_POST['phone'];

            if (!empty($info)) {
                update_info($info);

                $alert['success'] = "Update account successfully!";
                $alert['info'] = $info;

                echo json_encode($alert);
            } else {
                $alert['warning'] = "No changes made!";

                echo json_encode($alert);
            }
        } else
            echo json_encode($alert);
    }
}

function orderDetailAction()
{
    load('helper', 'format');

    if (isset($_POST['order_code'])) {
        $orderCode = $_POST['order_code'];

        $sql = "SELECT * FROM `order` WHERE user = {$_SESSION['user_id']} AND code = '{$orderCode}'";
        $order = db_fetch_row($sql);

        $sql = "SELECT * FROM `product` WHERE pcode = '$order[product]'";
        $product = db_fetch_row($sql);

        $response = [
            'order_code' => $orderCode,
            'order_date' => date_format(date_create($order['order_date']), 'd/m/Y H:i:s'),
            'order_payment' => $order['payment_method'],
            'order_status' => $order['status'],
            'order_total' => currency_format($order['total']),
            'addr' => $order['delivery_address'],
            'email' => $order['email'],
            'tel' => $order['tel'],
            'message' => $order['message'],
            'product_code' => $order['product'],
            'product_size' => mb_convert_case($order['size'], MB_CASE_UPPER),
            'product_quantity' => $order['quantity'],
            'product_name' => mb_convert_case($product['name'], MB_CASE_TITLE),
            'product_price_old' => currency_format($product['price']),
            'product_price_new' => currency_format($product['sale']),
            'order_img' => $product['image'],
        ];

        echo json_encode($response);
    }
}

function cancelOrderAction()
{
    if (isset($_POST['order_code'])) {
        show_array($_POST);
        $orderCode = $_POST['order_code'];

        cancel_order_status($orderCode);

        $data = [
            'user' => $_SESSION['user_id'],
            'order_code' => $orderCode,
            'reason' => $_POST['cancel_reason'],
            'date' => date('Y-m-d H:i:s'),
        ];
        db_insert('cancel_order', $data);

        $response = "Cancel order successfully!";

        redirect("?mod=pages&controller=account&cancel_order=" . $response);
    }
}
