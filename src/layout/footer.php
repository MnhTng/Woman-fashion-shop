        <div class="alert-container">
            <div class="alert-remove">
                <h2>Remove all products</h2>
                <p>Are you sure you want to remove all items in your cart?</p>
                <div class="btn-group">
                    <div class="btn-cancel">
                        <span>Cancel</span>
                    </div>
                    <div class="btn-confirm">
                        <span>
                            <a href="?mod=cart&act=delete?all=true">Remove</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert-fixed"></div>

        <div class="loading">
            <div class="circle"></div>
            <div class="circle c2"></div>
            <div class="circle c3"></div>
            <div class="shadow"></div>
            <div class="shadow s2"></div>
            <div class="shadow s3"></div>
        </div>

        <button class="scroll-on-top">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>              
        </button>
        
        <footer>
            <p>&copy; 2024 Our Shop. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>

<script>
    //! ========== Update Product Quantity ==========
    let isLogin = <?php if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) echo 1;
                    else echo 0 ?>;
    let username = '<?php
                    if (isset($_SESSION['user_id'])) {
                        global $db;
                        db_connect($db);

                        $sql = "SELECT username FROM user WHERE id = {$_SESSION['user_id']}";
                        $result = db_fetch_row($sql);
                        if ($result)
                            echo $result['username'];

                        db_close();
                    } else echo '';
                    ?>';

    let productQuantity = document.querySelector('.number-product');
    let quantity = <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cartByID'])) echo $_SESSION['quantity'];
                    else echo 0 ?>;

    if (isLogin && quantity) {
        if (productQuantity)
            productQuantity.textContent = quantity;
        else {
            let cartNumber = document.createElement('span');
            cartNumber.classList.add('number-product');
            cartNumber.textContent = quantity;
            document.querySelector(".cart>a").appendChild(cartNumber);
        }
    }

    //! ========== Login Button ==========
    let loginButton = document.getElementById('login-btn');
    let helloUser = document.getElementById('hello-user');

    if (isLogin) {
        loginButton.textContent = 'Logout';
        helloUser.innerHTML = `
        <a href='?mod=pages&controller=account'>Hello <b><i>${username}</i></b></a>
        `;
    } else
        loginButton.textContent = 'Login';
</script>

<script src="./src/lib/alert.js"></script>
<script src='./src/assets/js/app.js'></script>
