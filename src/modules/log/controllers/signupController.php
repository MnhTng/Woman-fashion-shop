<?php
function construct()
{
    load_model('signup');
    load('lib', 'validation');
}

function indexAction()
{
    load('components', 'mail');

    if (isset($_POST['btn_signup'])) {
        global $error, $fullname, $username, $email, $tel;
        $error = array();

        $fullname = htmlspecialchars($_POST["fullname"]);
        $username = $_POST["username"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $password = $_POST["password"];
        $re_enter_password = $_POST["re_enter_password"];


        // Chuan hoa fullname
        if (empty($fullname))
            $error['fullname'] = 'Không được để trống họ tên';

        // Chuan hoa username
        if (empty($username))
            $error['username'] = 'Không được để trống tên đăng nhập';
        else {
            if (!(strlen($username) >= 6 && strlen($username) <= 32))
                $error['username'] = 'Tên đăng nhập phải có độ dài từ 6 đến 32 ký tự';
            else {
                if (!usernameRegex($username))
                    $error['username'] = 'Tên đăng nhập phải chứa chữ cái, chữ số';

                $checkUsername = check_exist_user($username);
                if (!empty($checkUsername['username']))
                    $error['username'] = 'Tên đăng nhập đã tồn tại';
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
            }
        }

        // Chuan hoa email
        if (empty($email))
            $error['email'] = 'Không được để trống email';
        else {
            if (!emailRegex($email))
                $error['email'] = 'Email phải có dạng mẫu: abc123@domain1.domain2';

            $checkEmail = check_exist_mail($email);
            if (!empty($checkEmail['email']))
                $error['email'] = 'Email đã tồn tại';
        }

        // Chuan hoa tel
        if (empty($tel))
            $error['tel'] = 'Không được để trống số điện thoại';
        else {
            if (!phoneRegex($tel))
                $error['tel'] = 'Số điện thoại phải bắt đầu từ số 0 và có 10 đến 12 chữ số';
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
            $_SESSION['register'] = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'fullname' => $fullname,
                'gender' => '',
                'birthday' => '',
                'email' => $email,
                'tel' => $tel,
            ];
            $_SESSION['redirect'] = $_POST['redirect_to'];

            $_SESSION['active_token'] = md5($username . time());
            $baseURL = base_url();
            $content = "
                <p style='color: #000;'>Hello <b>{$fullname}</b></p>
                <p style='color: #000;'>Click to below button to activate your account</p>
                <button style='margin: 0 auto; padding: 10px 20px; border: none; border-radius: 10px; cursor: pointer; background: rgba(148, 170, 214, 0.7);'>
                    <a href='{$baseURL}?mod=log&controller=signup&act=activate&active_token={$_SESSION['active_token']}' style='color: #205AA7; text-decoration: none; font-size: 1.1em;'>Activate</a>
                </button>
                <p style='color: #000;'>If you are not a registered user, please ignore this email</p>
                <p style='color: #000;'>Sincerely, DMT SHOP</p>
            ";

            echo "
            <div id='verification'>
                <h2>Verification</h2>
    
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='#60ff11' class='size-6' width='5em' height='5em'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3' />
                </svg>
    
                <div class='center'>
                    <script src='https://cdn.lordicon.com/lordicon.js'></script>
                    <lord-icon
                        src='https://cdn.lordicon.com/xtnsvhie.json'
                        trigger='loop'
                        delay='500'
                        colors='primary:#60ff11'
                        style='width:5em;height:5em'>
                    </lord-icon>
                </div>
    
                <p>Let access your register email and accept message to active account</p>
            </div>
            ";

            sendMail($email, $username, "[DMT SHOP] KÍCH HOẠT TÀI KHOẢN", $content);
        }
    }

    load_view('signup');
}

function activateAction()
{
    if (isset($_GET['active_token'])) {
        $active_token = $_GET['active_token'];

        if ($active_token == $_SESSION['active_token']) {
            activate_account();

            redirect($_SESSION['redirect']);
        }
    }
}
