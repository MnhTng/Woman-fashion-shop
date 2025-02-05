<?php
function update_checkout_all($status)
{
    $data = [
        'checkout' => $status
    ];
    $where = "id = {$_SESSION['user_id']}";
    db_update('cart', $data, $where);
}

function update_checkout_item($code, $size, $status)
{
    $data = ['checkout' => $status];
    $where = "id = {$_SESSION['user_id']} AND pcode = '{$code}' AND size = '{$size}'";
    db_update('cart', $data, $where);
}

function update_cart_quantity($quantity, $subTotal, $userID, $code, $size)
{
    $data = [
        'quantity' => $quantity,
        'subtotal' => $subTotal,
    ];
    $where = "id = {$userID} AND pcode = '{$code}' AND size = '{$size}'";

    db_update('cart', $data, $where);
}

function get_cart()
{
    $sql = "SELECT * FROM cart WHERE id = {$_SESSION['user_id']}";
    return db_fetch_array($sql);
}

function get_checkout_cart()
{
    $sql = "SELECT * FROM cart WHERE id = {$_SESSION['user_id']} AND checkout = 1";
    return db_fetch_array($sql);
}
