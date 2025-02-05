<?php
function check_exist_mail($email)
{
    $sql = "SELECT email FROM user WHERE email = '{$email}'";
    return db_fetch_row($sql);
}

function get_user($email)
{
    $sql = "SELECT * FROM user WHERE email = '{$email}'";
    return db_fetch_row($sql);
}
