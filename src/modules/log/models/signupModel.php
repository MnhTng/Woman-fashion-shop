<?php
function check_exist_user($username)
{
    $sql = "SELECT username FROM user WHERE username = '{$username}'";
    return db_fetch_row($sql);
}

function check_exist_mail($email)
{
    $sql = "SELECT email FROM user WHERE email = '{$email}'";
    return db_fetch_row($sql);
}

function activate_account()
{
    db_insert('user', $_SESSION['register']);
}
