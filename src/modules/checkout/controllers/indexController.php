<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    load('helper', 'format');

    $code = isset($_GET['code']) ? $_GET['code'] : null;
    $size = isset($_GET['size']) ? $_GET['size'] : null;
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : null;

    $data = [
        'code' => $code,
        'size' => $size,
        'quantity' => $quantity,
    ];

    load_view('index', $data);
}
