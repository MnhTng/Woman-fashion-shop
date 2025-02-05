<?php
function add_cart($code, $sizeChose)
{
    foreach ($_SESSION['product'] as $item) {
        if ($item['pcode'] == $code) {
            $checkNewItem = 0;
            global $checkNewItem;

            if (!empty($_SESSION['cart'])) {
                $cartFilter = array_filter($_SESSION['cart'], function ($product) use ($code, $sizeChose) {
                    return $product['id'] == $_SESSION['user_id'] && $product['pcode'] == $code && $product['size'] == $sizeChose;
                });

                if (!empty($cartFilter)) {
                    foreach ($cartFilter as $product) {
                        $product['quantity'] += $_POST['quantity'];
                        $product['subtotal'] = $product['quantity'] * ($product['sale'] ? $product['sale'] : $product['price']);

                        $where = "id = {$_SESSION['user_id']} AND pcode = '{$code}' AND size = '{$sizeChose}'";
                        db_update('cart', $product, $where);
                    }
                } else
                    $checkNewItem = 1;
            } else
                $checkNewItem = 1;

            if ($checkNewItem) {
                $newItem = [
                    'id' => $_SESSION['user_id'],
                    'pcode' => $item['pcode'],
                    'productID' => $item['id'],
                    'productType' => $item['type'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'sale' => $item['sale'],
                    'size' => $sizeChose,
                    'image' => $item['image'],
                    'quantity' => $_POST['quantity'],
                    'subtotal' => $_POST['quantity'] * ($item['sale'] ? $item['sale'] : $item['price'])
                ];

                db_insert('cart', $newItem);
            }

            break;
        }
    }
}

function delete_item($code, $size, $quantity)
{
    for ($i = 0; $i < $quantity; $i++) {
        $where = "id = {$_SESSION['user_id']} AND pcode = '{$code[$i]}' AND size = '{$size[$i]}'";

        db_delete('cart', $where);
    }
}

function delete_cart()
{
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $where = "id = {$_SESSION['user_id']}";
        
        db_delete('cart', $where);
    }
}

function update_cart($quantity)
{
    $code = array_key_first($quantity);
    $size = array_key_first($quantity[$code]);

    if (!empty($_SESSION['cart'])) {
        $cartFilter = array_filter($_SESSION['cart'], function ($product) use ($code, $size) {
            return $product['id'] == $_SESSION['user_id'] && $product['pcode'] == $code && $product['size'] == $size;
        });

        if (!empty($cartFilter)) {
            foreach ($cartFilter as $product) {
                $product['quantity'] = $quantity[$code][$size];
                $product['subtotal'] = $quantity[$code][$size] * ($product['sale'] ? $product['sale'] : $product['price']);

                $where = "id = {$_SESSION['user_id']} AND pcode = '{$code}' AND size = '{$size}'";
                db_update('cart', $product, $where);
            }
        }
    }
}
