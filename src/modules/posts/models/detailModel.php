<?php
function get_product()
{
    $sql = "SELECT p.* FROM product AS p JOIN category AS c ON p.id = c.id";
    return db_fetch_array($sql);
}

function get_category()
{
    $sql = "SELECT * FROM category";
    return db_fetch_array($sql);
}

function get_cart()
{
    $sql = "SELECT * FROM cart";
    return db_fetch_array($sql);
}

function get_user()
{
    $sql = "SELECT * FROM cart WHERE id = {$_SESSION['user_id']}";
    return db_fetch_array($sql);
}
