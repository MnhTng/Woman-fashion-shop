<?php
function construct()
{
    load_model('account');
}

function indexAction()
{
    load_view('account');
}

function avtAction()
{
    if (isset($_FILES['avt'])) {
        $dir = './src/assets/images/';
        $fileName = basename($_FILES['avt']['name']);
        $uploadFile = $dir . $fileName;

        if (file_exists($uploadFile)) 
            unlink($uploadFile);

        move_uploaded_file($_FILES['avt']['tmp_name'], $uploadFile);

        update_avt($uploadFile);

        $response = get_user();

        sleep(3);
        echo $response['avt'];
    }
}

function info_updateAction()
{
    load('lib', 'validation');

    if (isset($_POST)) {
        $alert = [];

        if (!empty($_POST['name']) && !nameRegex($_POST['name']))
            $alert['name'] = "Name must be letters and at least two characters long!";
        if (!empty($_POST['date']) && !dateRegex($_POST['date']))
            $alert['date'] = "Date must be less than current date!";
        if (!empty($_POST['email']) && !emailRegex($_POST['email']))
            $alert['email'] = "Email must be in the format: abc123@domain1.domain2!";
        if (!empty($_POST['phone']) && !phoneRegex($_POST['phone']))
            $alert['phone'] = "Phone number must start with 0 and have 10 to 12 digits!";

        if (empty($alert)) {
            $info = [];

            if (!empty($_POST['name']))
                $info['fullname'] = $_POST['name'];
            if (isset($_POST['gender']))
                $info['gender'] = $_POST['gender'];
            if (!empty($_POST['date']))
                $info['birthday'] = $_POST['date'];
            if (!empty($_POST['email']))
                $info['email'] = $_POST['email'];
            if (!empty($_POST['phone']))
                $info['tel'] = $_POST['phone'];

            if (!empty($info)) {
                update_info($info);

                $alert['success'] = "Update account successfully!";
                $alert['info'] = $info;

                echo json_encode($alert);
            } else {
                $alert['warning'] = "No changes made!";

                echo json_encode($alert);
            }
        } else
            echo json_encode($alert);
    }
}
