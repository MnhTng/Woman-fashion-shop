<?php
function update_new_password($password)
{
    $data = [
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];
    $where = "email = '{$_SESSION['reset_email']}'";

    db_update('user', $data, $where);
}
