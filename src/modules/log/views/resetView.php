<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/php/Project/DMT Shop/src/assets/images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="./src/assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="./src/assets/css/login.css">
    <link rel="stylesheet" href="./src/assets/css/form.css">
    <link rel="stylesheet" href="./src/assets/css/effect.css">
    <title>Reset Password</title>
</head>

<body>
    <form action="" method="post" id="reset" class="hidden-top">
        <h1>Forgot Password</h1>
        <p id="login_notify">Enter your email address</p>

        <fieldset>
            <legend>Email</legend>
            <input type="email" name="email" value="<?php echo setValue('email') ?>" autocomplete="off" spellcheck="false">
        </fieldset>
        <div class="error">
            <?php echo checkError('email') ?>
        </div>

        <p><a class="form" href="?mod=log&controller=login">Login</a> or <a class="form" href="?mod=log&controller=signup">Signup</a></p>

        <input type="hidden" id="hidden" name="redirect_to" value="?mod=log&controller=new_pass">
        <button type="submit" name="btn_reset" value="submit_reset">Send Email</button>
    </form>
</body>

</html>

<script src="./src/assets/js/login.js"></script>

<script>
    //! ========== Show Reset Password Alert ==========
    window.addEventListener('load', function() {
        let active = document.getElementById('verification');

        if (active) {
            document.querySelector('form#reset').style.display = `none`;
        } else {
            document.querySelector('form#reset').style.display = `flex`;
        }
    });

    //! ========== Show Form Scroll ==========
    let hiddenLeft = document.querySelectorAll('.hidden-left');
    let hiddenRight = document.querySelectorAll('.hidden-right');
    let hiddenBot = document.querySelectorAll('.hidden-bot');
    let hiddenTop = document.querySelectorAll('.hidden-top');
    let activeHeight = window.innerHeight / 5 * 4.9;

    window.addEventListener('load', () => {
        if (hiddenLeft) {
            hiddenLeft.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-left');
                }
            });
        }

        if (hiddenRight) {
            hiddenRight.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-right');
                }
            });
        }

        if (hiddenBot) {
            hiddenBot.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-bot');
                }
            });
        }

        if (hiddenTop) {
            hiddenTop.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-top');
                }
            });
        }
    });

    window.addEventListener('scroll', () => {
        if (hiddenLeft) {
            hiddenLeft.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-left');
                }
            });
        }

        if (hiddenRight) {
            hiddenRight.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-right');
                }
            });
        }

        if (hiddenBot) {
            hiddenBot.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-bot');
                }
            });
        }

        if (hiddenTop) {
            hiddenTop.forEach((value) => {
                if (value.getBoundingClientRect().top < activeHeight) {
                    value.classList.add('show-top');
                }
            });
        }
    });
</script>