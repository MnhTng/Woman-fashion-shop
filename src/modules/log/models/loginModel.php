<?php
function check_exist_user($username)
{
    $sql = "SELECT * FROM user WHERE username = '{$username}'";
    return db_fetch_row($sql);
}
