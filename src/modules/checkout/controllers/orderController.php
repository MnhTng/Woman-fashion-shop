<?php
function construct()
{
    load_model('order');
}

function indexAction()
{
    // TẮT HIỂN THỊ LỖI TRÊN MÀN HÌNH (tránh HTML trong response)
    ini_set('display_errors', 0);
    ini_set('log_errors', 1); // Ghi log vào file
    header('Content-Type: application/json'); // QUAN TRỌNG

    if (isset($_POST['fullname'])) {
        $data = array();
        $response = array();

        if (isset($_POST['code'])) {
            $orderCode = substr(hash('sha512', $_POST['code'] . time()), 0, 10);
            $orderCode = mb_convert_case($orderCode, MB_CASE_UPPER);

            $data = [
                'code' => $orderCode,
                'product' => $_POST['code'],
                'size' => $_POST['size'],
                'quantity' => $_POST['quantity'],
                'total' => $_POST['total'],
                'user' => $_SESSION['user_id'],
                'order_date' => date('Y-m-d H:i:s'),
                'payment_method' => $_POST['payment_method'],
                'status' => $_POST['payment_method'] == 'cod' ? 'Pending' : 'Awaiting Payment',
                'delivery_address' => $_POST['addr'],
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
                'message' => $_POST['message'],
            ];

            add_order($data);

            $response = [
                'buy_direct' => true,
                'payment_method' => $_POST['payment_method'],
                'order_code' => $orderCode,
            ];

            echo json_encode($response);
        } else {
            $orderList = "";

            foreach ($_SESSION['cartByCheckout'] as $value) {
                $orderCode = substr(hash('sha512', $value['pcode'] . time()), 0, 10);
                $orderCode = mb_convert_case($orderCode, MB_CASE_UPPER);

                $data = [
                    'code' => $orderCode,
                    'product' => $value['pcode'],
                    'size' => $value['size'],
                    'quantity' => $value['quantity'],
                    'total' => $value['subtotal'],
                    'user' => $_SESSION['user_id'],
                    'order_date' => date('Y-m-d H:i:s'),
                    'payment_method' => $_POST['payment_method'],
                    'status' => $_POST['payment_method'] == 'cod' ? 'Pending' : 'Awaiting Payment',
                    'delivery_address' => $_POST['addr'],
                    'email' => $_POST['email'],
                    'tel' => $_POST['tel'],
                    'message' => $_POST['message'],
                ];

                add_order($data);
                delete_item_paid($value['pcode']);

                $orderList .= $orderCode . ",";
            }

            $sql = "SELECT * FROM cart";
            $_SESSION['cart'] = db_fetch_array($sql);

            $_SESSION['cartByID'] = array_filter($_SESSION['cart'], function ($item) {
                return $item['id'] == $_SESSION['user_id'];
            });
            $_SESSION['quantity'] = array_sum(array_column($_SESSION['cartByID'], "quantity"));
            $_SESSION['total'] = array_sum(array_column($_SESSION['cartByID'], "subtotal"));

            $_SESSION['cartByCheckout'] = array();
            $_SESSION['quantityCheckout'] = 0;
            $_SESSION['totalCheckout'] = 0;

            $response = [
                'order_in_cart' => true,
                'payment_method' => $_POST['payment_method'],
                'order_code' => $orderList,
            ];

            echo json_encode($response);
        }
    }

    exit();
}

function vnpayAction()
{
    global $config;

    $orderList = explode(",", $_GET['order']);

    $order = array_filter($_SESSION['order'], function ($item) use ($orderList) {
        return in_array($item['code'], $orderList);
    });

    $total = array_sum(array_column($order, "total"));

    $vnpaySuccessAlert = "Your payment process has been successfully completed";

    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = $config['base_url'] . "?mod=pages&controller=account&order=" . $vnpaySuccessAlert . "&vnpay_list_order=" . $_GET['order'];
    $vnp_TmnCode = "JV66XP4S"; //Mã website tại VNPAY 
    $vnp_HashSecret = "ERDGLO9IIMJB4B7CFWBHMII4RKA6A22L"; //Chuỗi bí mật

    $vnp_TxnRef = time() . ""; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán hóa đơn mua hàng"; //Nội dung thanh toán
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $total * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    // Expired payment process
    $startTime = date("YmdHis");
    $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $expire,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    header('Location: ' . $vnp_Url);
    die();
}

function vnpayIPN()
{
    // 
}
