<?php
function add_order($order)
{
    db_insert('order', $order);
}

function delete_item_paid($item)
{
    $where = "id = {$_SESSION['user_id']} AND pcode = '{$item}' AND checkout = 1";
    db_delete('cart', $where);
}
