<?php
function update_avt($uploadFile)
{
    $data = [
        'avt' => $uploadFile,
    ];
    $where = "id = {$_SESSION['user_id']}";

    db_update('user', $data, $where);
}

function update_info($info)
{
    $where = "id = {$_SESSION['user_id']}";
    db_update('user', $info, $where);
}

function get_user()
{
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
    return db_fetch_row($sql);
}

function cancel_order_status($orderCode)
{
    $data = [
        'status' => 'Cancelled',
    ];
    $where = "code = '{$orderCode}'";

    db_update('order', $data, $where);
}

function update_status_after_pay($orderPaidByVnPay, $expectedStatus)
{
    $sql = "SELECT * FROM `order` WHERE code IN ('" . implode("','", $orderPaidByVnPay) . "')";
    $orderPaid = db_fetch_array($sql);

    foreach ($orderPaid as $order) {
        $status = [
            'status' => $expectedStatus,
        ];
        $where = "code = '{$order['code']}'";
        db_update('order', $status, $where);
    }
}
