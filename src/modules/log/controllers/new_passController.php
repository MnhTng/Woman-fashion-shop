<?php
function construct()
{
    load_model('new_pass');
    load('lib', 'validation');
}

function indexAction()
{
    if (isset($_POST['btn_change'])) {
        global $error;
        $error = array();

        $password = $_POST["password"];
        $re_enter_password = $_POST["re_enter_password"];

        // Chuan hoa password
        if (empty($password))
            $error['password'] = 'Không được để trống mật khẩu';
        else {
            if (!(strlen($password) >= 6))
                $error['password'] = 'Mật khẩu phải có độ dài từ 6 ký tự trở lên';
            else {
                if (!passwordRegex($password))
                    $error['password'] = 'Mật khẩu phải chứa chữ cái, chữ số, gạch dưới hoặc ký tự đặc biệt';
            }
        }

        // Chuan hoa re-enter password
        if (empty($password))
            $error['re_enter_password'] = 'Vui lòng nhập mật khẩu trước';
        else {
            if (empty($re_enter_password))
                $error['re_enter_password'] = 'Vui lòng xác nhận lại mật khẩu';
            else if ($re_enter_password != $password)
                $error['re_enter_password'] = 'Mật khẩu không khớp';
        }

        if (empty($error)) {
            echo "
            <form id='verification' style='padding-bottom: 0;'>
                <h2>Change Password Success</h2>
    
                <div>
                    <script src='https://cdn.lordicon.com/lordicon.js'></script>
                    <lord-icon
                        src='https://cdn.lordicon.com/ktsahwvc.json'
                        trigger='loop'
                        colors='primary:#60ff11'
                        style='width:5em;height:5em'>
                    </lord-icon>
                </div>
    
                <p>Your password have changed. Now you can login with your new password</p>
    
                <button type='button' style='position: relative'>
                    <a href='?mod=log&controller=login' style='display: block; width: 100%; height: 100%; position: absolute; top: 0; left: 0;'></a>
                    Login now
                </button>
            </form>
            ";

            update_new_password($password);
        }
    }

    load_view('new_pass');
}
