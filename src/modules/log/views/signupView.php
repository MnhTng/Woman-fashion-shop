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
    <title>Sign Up</title>
</head>

<body>
    <form action="" method="post" id="signup" class="hidden-right">
        <h1>Create Account</h1>

        <fieldset>
            <legend>Full name</legend>
            <input type="text" name="fullname" value="<?php echo setValue('fullname') ?>" autocomplete="off" spellcheck="false">
        </fieldset>
        <div class="error">
            <?php echo checkError('fullname') ?>
        </div>

        <fieldset>
            <legend>Username</legend>
            <input type="text" name="username" value="<?php echo setValue('username') ?>" autocomplete="off" spellcheck="false">
        </fieldset>
        <div class="error">
            <?php echo checkError('username') ?>
        </div>

        <fieldset>
            <legend>Email</legend>
            <input type="email" name="email" value="<?php echo setValue('email') ?>" autocomplete="off" spellcheck="false">
        </fieldset>
        <div class="error">
            <?php echo checkError('email') ?>
        </div>

        <fieldset>
            <legend>Phone number</legend>
            <input type="tel" name="tel" value="<?php echo setValue('tel') ?>" autocomplete="off" spellcheck="false">
        </fieldset>
        <div class="error">
            <?php echo checkError('tel') ?>
        </div>

        <fieldset class="pass">
            <legend>Password</legend>
            <input type="password" name="password" value="" autocomplete="off" spellcheck="false">

            <div class="eye">
                <svg class="close-pass" xmlns="http://www.w3.org/2000/svg" width="2.3em" height="2.5em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye-closed">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" />
                    <path d="M3 15l2.5 -3.8" />
                    <path d="M21 14.976l-2.492 -3.776" />
                    <path d="M9 17l.5 -4" />
                    <path d="M15 17l-.5 -4" />
                </svg>

                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon class="open-pass" src="https://cdn.lordicon.com/vfczflna.json" trigger="loop" delay="4000" stroke="bold" colors="primary:#fff,secondary:#f5f5f5" style="width:2.5em;height:2.5em"></lord-icon>
            </div>
        </fieldset>
        <div class="error">
            <?php echo checkError('password') ?>
        </div>

        <fieldset class="pass">
            <legend>Re-enter Password</legend>
            <input type="password" name="re_enter_password" value="" autocomplete="off" spellcheck="false">

            <div class="eye">
                <svg class="close-pass" xmlns="http://www.w3.org/2000/svg" width="2.3em" height="2.5em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye-closed">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" />
                    <path d="M3 15l2.5 -3.8" />
                    <path d="M21 14.976l-2.492 -3.776" />
                    <path d="M9 17l.5 -4" />
                    <path d="M15 17l-.5 -4" />
                </svg>

                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon class="open-pass" src="https://cdn.lordicon.com/vfczflna.json" trigger="loop" delay="4000" stroke="bold" colors="primary:#fff,secondary:#f5f5f5" style="width:2.5em;height:2.5em"></lord-icon>
            </div>
        </fieldset>
        <div class="error">
            <?php echo checkError('re_enter_password') ?>
        </div>

        <p id="exist_user">Existing user, sign in <a class="form" href="?mod=log&controller=login">Here</a></p>

        <input type="hidden" id="hidden" name="redirect_to" value="?mod=log&controller=login">
        <button type="submit" name="btn_signup" value="submit_signup">Sign Up</button>
    </form>
</body>

</html>

<script src="./src/assets/js/login.js"></script>

<script>
    //! ========== Show Activate Account Alert ==========
    window.addEventListener('load', function() {
        let active = document.getElementById('verification');

        if (active) {
            document.querySelector('form#signup').style.display = `none`;
        } else {
            document.querySelector('form#signup').style.display = `flex`;
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