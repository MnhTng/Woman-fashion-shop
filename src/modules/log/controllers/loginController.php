<?php
function construct()
{
    load_model('login');
}

function indexAction()
{
    load('components', 'mail');
    load('lib', 'validation');

    if (isset($_SESSION['is_login'])) {
        if (isset($_SESSION['is_login']))
            unset($_SESSION['is_login']);

        if (isset($_SESSION['user_id']))
            unset($_SESSION['user_id']);

        session_destroy();
    }

    if (isset($_POST['btn_login'])) {
        global $error, $username;
        $error = array();

        $username = $_POST["username"];
        $password = $_POST["password"];

        $userInfo = check_exist_user($username);

        // Chuan hoa username
        if (empty($username))
            $error['username'] = 'Không được để trống tên đăng nhập';
        else {
            if (!(strlen($username) >= 6 && strlen($username) <= 32))
                $error['username'] = 'Tên đăng nhập phải có độ dài từ 6 đến 32 ký tự';
            else {
                if (!usernameRegex($username))
                    $error['username'] = 'Tên đăng nhập phải chứa chữ cái, chữ số';
                else {
                    $user = check_exist_user($username);
                    if (!$user)
                        $error['username'] = 'Tên đăng nhập không tồn tại';
                }
            }
        }

        // Chuan hoa password
        if (empty($password))
            $error['password'] = 'Không được để trống mật khẩu';
        else {
            if (!(strlen($password) >= 6))
                $error['password'] = 'Mật khẩu phải có độ dài từ 6 ký tự trở lên';
            else {
                if (!passwordRegex($password))
                    $error['password'] = 'Mật khẩu phải chứa chữ cái, chữ số, gạch dưới hoặc ký tự đặc biệt';
                else {
                    $user = check_exist_user($username);
                    if (!$user)
                        $error['password'] = 'Mật khẩu không chính xác';
                    else if (!password_verify($password, $user['password']))
                        $error['password'] = 'Mật khẩu không chính xác';
                }
            }
        }

        if (empty($error)) {
            if (isset($_POST['remember_me']))
                setcookie('username', $username);

            $_SESSION['user_id'] = $userInfo['id'];
            $_SESSION['is_login'] = true;

            $redirect_to = $_POST['redirect_to'];
            redirect($redirect_to);
        }
    }

    load_view('login');
}
