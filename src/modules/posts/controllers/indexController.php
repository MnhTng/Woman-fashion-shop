<?php
function construct()
{
    load_model('index');
    load('helper', 'product');
}

function indexAction()
{
    load('helper', 'format');

    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $cat = isset($_GET['cat']) ? (int)$_GET['cat'] : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // ép kiểu int cho chuỗi không hợp lệ(bắt đầu không phải số) thì output = 0
    // id = 0 là trang chi tiết sản phẩm

    $data = [
        'id' => $id,
        'cat' => $cat,
        'page' => $page,
    ];

    load_view('index', $data);
}
