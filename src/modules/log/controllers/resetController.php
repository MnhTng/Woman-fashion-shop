<?php
function construct()
{
    load_model('reset');
    load('lib', 'validation');
}

function indexAction()
{
    load('components', 'mail');

    if (isset($_POST['btn_reset'])) {
        global $error, $email;
        $error = array();

        $email = $_POST["email"];

        // Chuan hoa email
        if (empty($email))
            $error['email'] = 'Không được để trống email';
        else {
            if (!emailRegex($email))
                $error['email'] = 'Email phải có dạng mẫu: abc123@domain1.domain2';

            $checkEmail = check_exist_mail($email);
            if (empty($checkEmail['email']))
                $error['email'] = 'Email không tồn tại trên hệ thống';
        }

        if (empty($error)) {
            $result = get_user($email);
            $fullname = $result['fullname'];
            $username = $result['username'];

            $_SESSION['redirect'] = $_POST['redirect_to'];

            $_SESSION['reset_token'] = md5($email . time());
            $baseURL = base_url();
            $content = "
                <p style='color: #000;'>Hello <b>{$fullname}</b></p>
                <p style='color: #000;'>Click to below button to reset your account password</p>
                <button style='margin: 0 auto; padding: 10px 20px; border: none; border-radius: 10px; cursor: pointer; background: rgba(148, 170, 214, 0.7);'>
                    <a href='{$baseURL}?mod=log&controller=reset&act=reset&reset_token={$_SESSION['reset_token']}&email={$email}' style='color: #205AA7; text-decoration: none; font-size: 1.1em; font-weight: 500;'>Reset</a>
                </button>
                <p style='color: #000;'>If you do not reset your account password, please ignore this email</p>
                <p style='color: #000;'>Sincerely, DMT SHOP</p>
            ";

            echo "
            <div id='verification'>
                <h2>Verification</h2>
    
                <div class='center'>
                    <script src='https://cdn.lordicon.com/lordicon.js'></script>
                    <lord-icon
                        src='https://cdn.lordicon.com/rsbokaso.json'
                        trigger='loop'
                        colors='primary:#60ff11'
                        style='width:5em;height:5em'>
                    </lord-icon>
                </div>
    
                <p>Let access your email and accept message to reset account password</p>
            </div>
            ";

            sendMail($email, $username, "[DMT SHOP] KHÔI PHỤC MẬT KHẨU", $content);
        }
    }

    load_view('reset');
}

function resetAction()
{
    if (isset($_GET['reset_token'])) {
        $reset_token = $_GET['reset_token'];

        if ($reset_token == $_SESSION['reset_token']) {
            $_SESSION['reset_email'] = $_GET['email'];

            redirect($_SESSION['redirect']);
        }
    }
}
