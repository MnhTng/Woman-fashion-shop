<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/php/Project/DMT Shop/src/assets/images/logo.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playwrite+AR:wght@100..400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./src/assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="./src/assets/css/effect.css">
    <link rel="stylesheet" href="./src/assets/css/global.css">
    <link rel="stylesheet" href="./src/assets/css/style.css">

    <script src="./src/assets/js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./src/assets/js/jquery/jquery.ez-plus.js"></script>
    
    <title>DMT Shop</title>
</head>

<body>
    <div class="container">
        <header>
            <div id="hello-user" class="underline-top-bot"></div>
            <h1>Welcome to DMT Fashion Store</h1>
            <a href="?mod=log&controller=login" class="login-btn underline-top-bot" id="login-btn"></a>
        </header>

        <nav id="main-nav">
            <div class="brand">
                <a href="?">
                    <span class="brand-name">DMT</span>
                </a>
            </div>

            <ul>
                <li><a class="underline_center" href="?">Home</a></li>
                <li><a class="underline_center" href="?mod=posts">Products</a></li>
                <li><a class="underline_center" href="?mod=pages&controller=about">About Us</a></li>
                <li><a class="underline_center" href="?mod=pages&controller=contact">Contact</a></li>
            </ul>

            <div class="tools">
                <div class="search">
                    <div class="form">
                        <form class="search" action="" method="post" enctype="multipart/form-data">
                            <input type="text" id="search" placeholder="Search...">
                            <button type="submit" id="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6" width="2em" height="2em">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div id="search-icon">
                        <div class="line"></div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="2em" height="2em">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>

                <div class="cart">
                    <a class="number-item" href="?mod=cart">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="2em" height="2em">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>

                        <?php
                        if (isset($_SESSION['is_login'], $_SESSION['cart']) && !empty($_SESSION['cartByID']))
                            echo "<span class='number-product'>{$_SESSION['quantity']}</span>";
                        ?>
                    </a>
                </div>
            </div>
        </nav>