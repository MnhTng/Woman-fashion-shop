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
    <title>New Password</title>
</head>

<body>
    <form action="" method="post" id="new" class="hidden-bot">
        <h1>New Password</h1>
        <p id="login_notify">Create a new password</p>

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

        <button type="submit" name="btn_change" value="submit_change">Change</button>
    </form>
</body>

</html>

<script src="./src/assets/js/login.js"></script>

<script>
    //! ========== Show New Password Alert ==========
    window.addEventListener('load', function() {
        let active = document.getElementById('verification');

        if (active) {
            document.querySelector('form#new').style.display = `none`;
        } else {
            document.querySelector('form#new').style.display = `flex`;
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