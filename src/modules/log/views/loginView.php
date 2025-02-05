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
    <title>Login</title>
</head>

<body>
    <form action="" method="post" class="hidden-left">
        <h1>Login</h1>
        <p id="login_notify">Enter your account</p>

        <fieldset class="user">
            <legend>Username</legend>
            <input type="text" name="username" value="<?php echo setValue('username'); ?>" autocomplete="off" spellcheck="false">
            <div class="suggest user-child">
                <ul>
                </ul>
            </div>
        </fieldset>
        <div class="error">
            <?php echo checkError('username') ?>
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

        <div class="remember_me">
            <input type="checkbox" id="remember_me" name="remember_me">
            <label for="remember_me">Remember me</label>
        </div>

        <a class="form" href="?mod=log&controller=reset">Forgot your password?</a>
        <a class="form" href="?mod=log&controller=signup">Don't you have an account?</a>

        <input type="hidden" id="hidden" name="redirect_to" value="?">
        <button type="submit" name="btn_login" value="submit_login">Login</button>
    </form>
</body>

</html>

<script src="./src/assets/js/login.js"></script>

<script>
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

    //! ========== Show Suggest ==========
    // Config
    let UserSuggest = "UserSuggest";

    const saveSuggest = (data) => {
        localStorage.setItem(UserSuggest, JSON.stringify(data));
    };

    const loadSuggest = () => {
        return JSON.parse(localStorage.getItem(UserSuggest)) || [];
    };

    const addSuggest = (data) => {
        let info = loadSuggest();
        info = [...info, data];
        saveSuggest(info);
    };

    // Exec
    // UserSuggest
    let username = '<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username'];
                    else echo ''; ?>';

    let sug = loadSuggest();
    let foundSuggest = sug.find(user => user.username === username);
    if (!foundSuggest && username !== '') {
        let data = {
            username: username
        };

        addSuggest(data);
    }

    function getUsername(index) {
        let inputSuggest = document.querySelector('.user>input');
        let ul = document.querySelector('.suggest>ul');

        inputSuggest.value = ul.children[index].textContent;
    }

    const userSuggest = loadSuggest();

    if (userSuggest.length) {
        let suggest = document.querySelector('.suggest');
        let ul = document.querySelector('.suggest>ul');
        let inputSuggest = document.querySelector('.user>input');

        inputSuggest.addEventListener('focus', () => {
            suggest.style.display = 'block';

            let value = inputSuggest.value;
            let i = 0,
                count = -1;
            let check = 0;
            let listSuggest = userSuggest.map((user, index) => {
                if (i < 5 && user.username.toLowerCase().includes(value.toLowerCase())) {
                    i++;
                    count++;

                    return `
                    <li index=${count} onmousedown="getUsername(${count})">${user.username}</li>
                    `;
                } else
                    check++;
            });

            if (check == userSuggest.length)
                suggest.style.display = "none";
            else {
                suggest.style.display = "block";
                ul.innerHTML = listSuggest.join('');
            }
        });

        inputSuggest.addEventListener('input', () => {
            suggest.style.display = 'block';

            let value = inputSuggest.value;
            let i = 0,
                count = -1;
            let check = 0;
            let listSuggest = userSuggest.map((user, index) => {
                if (i < 5 && user.username.toLowerCase().includes(value.toLowerCase())) {
                    i++;
                    count++;

                    return `
                    <li index=${count} onmousedown="getUsername(${count})">${user.username}</li>
                    `;
                } else
                    check++;
            });

            if (check == userSuggest.length)
                suggest.style.display = "none";
            else {
                suggest.style.display = "block";
                ul.innerHTML = listSuggest.join('');
            }
        });

        inputSuggest.addEventListener('blur', () => {
            suggest.style.display = 'none';
        });
    }
</script>