<?php
function update_avt($uploadFile)
{
    $data = [
        'avt' => $uploadFile,
    ];
    $where = "id = {$_SESSION['user_id']}";

    db_update('user', $data, $where);
}

function update_info($info)
{
    $where = "id = {$_SESSION['user_id']}";
    db_update('user', $info, $where);
}

function get_user()
{
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
    return db_fetch_row($sql);
}
