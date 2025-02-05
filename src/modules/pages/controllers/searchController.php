<?php
function construct()
{
    load_model('search');
    load('helper', 'product');
}

function indexAction()
{
    load('helper', 'format');

    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $data = [
        'search' => $search,
        'page' => $page,
    ];

    load_view('search', $data);
}

function searchAction()
{
    if (isset($_POST['result'])) {
        $search = $_POST['result'];

        echo $search;
    }
}
