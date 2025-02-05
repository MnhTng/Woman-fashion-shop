<?php
function nameRegex($name)
{
    $pattern = "/^([a-zA-ZáàảãạăắằẳẵặâấầẩẫậéèẻẽẹêềếểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưừứửữựýỳỷỹỵÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬÉÈẺẼẸÊỀẾỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỪỨỬỮỰÝỲỶỸỴđĐ][\s]*){2,32}$/";
    return preg_match_all($pattern, $name, $matches);
}

function dateRegex($date)
{
    $pattern = "/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/";
    $current = date("Y-m-d");

    return preg_match_all($pattern, $date, $matches) && $date < $current;
}

function usernameRegex($username)
{
    $pattern = "/^[A-Za-z0-9]{6,32}$/";
    return preg_match($pattern, $username, $matches);
}

function passwordRegex($password)
{
    $pattern = "/^([A-Za-z]{2,})([0-9]{1,})([_\.~!@#$%^&*-]*)$/";
    return preg_match($pattern, $password, $matches);
}

function emailRegex($email)
{
    $pattern = "/^([A-Za-z0-9_]{6,32})@gmail(.[A-Za-z]{2,12})+$/";
    return preg_match($pattern, $email, $matches);
}

function phoneRegex($phone)
{
    $pattern = "/^0[0-9]{9,11}$/";
    return preg_match($pattern, $phone, $matches);
}

function setValue($value)
{
    global $$value, $userInfo;
    if (isset($$value) && !empty($userInfo[$value]) && $$value == $userInfo[$value])
        return $$value;
    if (isset($$value) && $$value == htmlspecialchars($_POST[$value]))
        return $$value;
}

function checkError($value)
{
    global $error;
    if (isset($error[$value]))
        return "<p class='error'>{$error[$value]}</p>";
}
