<?php get_header(); ?>

<main>
    <div class="cart-container">
        <?php if (isset($_SESSION['is_login'], $_SESSION['cart']) && !empty($_SESSION['cartByID'])) { ?>
            <div class="cart-header hidden-top">
                <h1>Cart</h1>
            </div>

            <div class="cart-content hidden-left">
                <div class="select-all">
                    <div>
                        <input type="checkbox" id="select-all">
                        <label for="select-all">Select All</label>
                    </div>

                    <div class="remove-all">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="" width="2em" height="2em">
                                <path d="M566.6 54.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192-34.7-34.7c-4.2-4.2-10-6.6-16-6.6c-12.5 0-22.6 10.1-22.6 22.6l0 29.1L364.3 320l29.1 0c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16l-34.7-34.7 192-192zM341.1 353.4L222.6 234.9c-42.7-3.7-85.2 11.7-115.8 42.3l-8 8C76.5 307.5 64 337.7 64 369.2c0 6.8 7.1 11.2 13.2 8.2l51.1-25.5c5-2.5 9.5 4.1 5.4 7.9L7.3 473.4C2.7 477.6 0 483.6 0 489.9C0 502.1 9.9 512 22.1 512l173.3 0c38.8 0 75.9-15.4 103.4-42.8c30.6-30.6 45.9-73.1 42.3-115.8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="cart-list">
                    <?php
                    $freeShip = 0;
                    if ($_SESSION['quantityCheckout'] > 1)
                        $freeShip = 1;
                    $discount = 0;

                    $i = 1;
                    foreach ($_SESSION['cartByID'] as $item) {
                        $cat = array_search($item['productType'], explode(', ', $_SESSION['category'][$item['productID'] - 1]['type']));

                        echo "<div class='cart-item'>";
                        echo "<div class='select-item'>";
                        if ($item['checkout'] == 1)
                            echo "<input type='checkbox' id='select-item' data-code='{$item['pcode']}' data-size='{$item['size']}' checked>";
                        else
                            echo "<input type='checkbox' id='select-item' data-code='{$item['pcode']}' data-size='{$item['size']}'>";
                        echo "</div>";

                        echo "<div class='item-info'>";
                        echo "<a href='?mod=posts&controller=detail&id={$item['productID']}&cat={$cat}&code={$item['pcode']}' class='cart-item-img'>";
                        echo "<img src='{$item['image']}' alt=''>";
                        echo "</a>";

                        echo "<div class='cart-item-info'>";
                        echo "<div class='info'>";
                        echo "<a href='?mod=posts&controller=detail&id={$item['productID']}&cat={$cat}&code={$item['pcode']}'>" . mb_convert_case($item['name'], MB_CASE_TITLE) . "</a>";
                        echo "<span>Size: " . strtoupper($item['size']) . "</span>";
                        echo "</div>";

                        echo "<div class='item'>";
                        echo "<div class='price'>";
                        if ($item['sale']) {
                            echo "<span class='price-new'>" . currency_format($item['sale']) . "</span>";
                            echo "<span class='price-old'>" . currency_format($item['price']) . "</span>";

                            if ($item['checkout'])
                                $discount += ($item['price'] - $item['sale']) * $item['quantity'];
                        } else {
                            echo "<span class='price-new'>" . currency_format($item['price']) . "</span>";
                        }
                        echo "</div>";

                        $price = $item['sale'] ? $item['sale'] : $item['price'];
                        echo "<form class='quantity'>";
                        echo "<div class='dec'>";
                        echo "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='5' stroke='currentColor' class='size-6' width='1em' height='1em'>";
                        echo "<path stroke-linecap='round' stroke-linejoin='round' d='M15.75 19.5 8.25 12l7.5-7.5' />";
                        echo "</svg>";
                        echo "</div>";
                        echo "<input class='quantity' type='number' id='stt{$i}' data-id='{$i}' data-code='{$item['pcode']}' data-size='{$item['size']}' data-price='{$price}' min='1' value='{$item['quantity']}'>";
                        echo "<div class='inc'>";
                        echo "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='5' stroke='currentColor' class='size-6' width='1em' height='1em'>";
                        echo "<path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />";
                        echo "</svg>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='cart-item-action'>";
                        echo "<button class='btn-remove' data-code='{$item['pcode']}' data-size={$item['size']}>";
                        echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='size-6' width='1.5em' height='1.5em'>";
                        echo "<path fill-rule='evenodd' d='M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z' clip-rule='evenodd' />";
                        echo "</svg>";
                        echo "</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        $i++;
                    }
                    ?>
                </div>
            </div>

            <div class="cart-total hidden-right">
                <h2 class="header">Order Details</h2>

                <div class="detail">
                    <div>
                        <span>Total value of products</span>
                        <span>
                            <?php
                            echo currency_format($_SESSION['totalCheckout']);
                            ?>
                        </span>
                    </div>

                    <div>
                        <span>Shipping fee</span>
                        <span>
                            <?php
                            if (!empty($_SESSION['cartByCheckout']))
                                echo "20,000₫";
                            else
                                echo "0₫"
                            ?>
                        </span>
                    </div>

                    <div>
                        <?php
                        if ($_SESSION['totalCheckout'] && $freeShip) {
                            echo "<span>Shipping discount</span>";
                            echo "<span class='discount'>-20,000₫</span>";
                        }
                        ?>
                    </div>
                </div>

                <div class="total-price">
                    <span>Total payment</span>
                    <span>
                        <?php
                        if ($_SESSION['quantityCheckout'] && $freeShip)
                            echo currency_format($_SESSION['totalCheckout']);
                        else if ($_SESSION['quantityCheckout'])
                            echo currency_format($_SESSION['totalCheckout'] + 20000);
                        else
                            echo "0₫";
                        ?>
                    </span>
                </div>

                <div class="sale-notify">
                    <?php
                    if ($_SESSION['totalCheckout'] && $freeShip)
                        echo "<span>You have saved " . currency_format($discount + 20000) . "</span>";
                    else if ($_SESSION['totalCheckout'] && $discount)
                        echo "<span>You have saved " . currency_format($discount) . "</span>";
                    ?>
                </div>

                <a href="?mod=cart&controller=checkout" class="checkout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="2.5em" height="2.5em">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>

                    <p>Checkout</p>
                </a>
            </div>
        <?php } else { ?>
            <div class="cart-header-empty hidden-top">
                <h1>Your cart is empty</h1>
            </div>

            <div class="cart-content-empty hidden-bot">
                <div class="icon">
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/lwumwgrp.json" trigger="loop" state="morph-fill" colors="primary:#ffc738,secondary:#f24c00,tertiary:#d1e3fa" style="width:250px;height:250px">
                    </lord-icon>
                </div>

                <p>Looks like you haven't added any items to your cart yet.</p>
                <a href="?">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" width="2.5em" height="2.5em">
                        <path d="M547.6 103.8L490.3 13.1C485.2 5 476.1 0 466.4 0L109.6 0C99.9 0 90.8 5 85.7 13.1L28.3 103.8c-29.6 46.8-3.4 111.9 51.9 119.4c4 .5 8.1 .8 12.1 .8c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.2 0 49.3-11.4 65.2-29c16 17.6 39.1 29 65.2 29c4.1 0 8.1-.3 12.1-.8c55.5-7.4 81.8-72.5 52.1-119.4zM499.7 254.9c0 0 0 0-.1 0c-5.3 .7-10.7 1.1-16.2 1.1c-12.4 0-24.3-1.9-35.4-5.3L448 384l-320 0 0-133.4c-11.2 3.5-23.2 5.4-35.6 5.4c-5.5 0-11-.4-16.3-1.1l-.1 0c-4.1-.6-8.1-1.3-12-2.3L64 384l0 64c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-64 0-131.4c-4 1-8 1.8-12.3 2.3z" />
                    </svg>

                    <p>Continue shopping</p>
                </a>
            </div>
        <?php } ?>
    </div>
</main>

<?php get_footer(); ?>

<script>
    //! ========== Select - All Products In Cart ==========
    let selectAll = document.querySelector('input#select-all');
    let selectItem = document.querySelectorAll('input#select-item');
    let clear = document.querySelector('.remove-all>.icon>svg');
    let clearTitle = document.querySelector('.alert-remove>h2');
    let clearContent = document.querySelector('.alert-remove>p');

    window.addEventListener('load', function() {
        let checked = 0;
        let count = selectItem.length;

        selectItem.forEach((item) => {
            if (item.checked)
                checked++;
        });

        if (checked) {
            clear.style.transform = `translateX(0)`;
        } else {
            clear.style.transform = `translateX(3em)`;
        }

        if (checked == count) {
            selectAll.checked = true;

            let disableCheckout = document.querySelector('a.checkout');
            disableCheckout.style.pointerEvents = `auto`;
            disableCheckout.style.background = `#000`;
        } else {
            selectAll.checked = false;

            if (!checked) {
                let disableCheckout = document.querySelector('a.checkout');
                disableCheckout.style.pointerEvents = `none`;
                disableCheckout.style.background = `rgba(0, 0 ,0 , 0.5)`;
            }
        }
    });

    selectAll.addEventListener('change', () => {
        if (selectAll.checked) {
            clear.style.transform = `translateX(0)`;
            clearTitle.textContent = `Remove all products`;
            clearContent.textContent = `Are you sure you want to remove all items in your cart?`;
            let disableCheckout = document.querySelector('a.checkout');
            disableCheckout.style.pointerEvents = `auto`;
            disableCheckout.style.background = `#000`;

            selectItem.forEach((item) => {
                item.checked = true;
            });
        } else {
            clear.style.transform = `translateX(3em)`;
            let disableCheckout = document.querySelector('a.checkout');
            disableCheckout.style.pointerEvents = `none`;
            disableCheckout.style.background = `rgba(0, 0 ,0 , 0.5)`;

            selectItem.forEach((item) => {
                item.checked = false;
            });
        }
    });

    let check, count;
    selectItem.forEach((item) => {
        item.addEventListener('change', () => {
            check = 0;
            count = selectItem.length;

            selectItem.forEach((item) => {
                if (item.checked) {
                    check++;
                }
            });

            if (check) {
                clear.style.transform = `translateX(0)`;

                let disableCheckout = document.querySelector('a.checkout');
                disableCheckout.style.pointerEvents = `auto`;
                disableCheckout.style.background = `#000`;

                if (check == count) {
                    selectAll.checked = true;
                    clearTitle.textContent = `Remove all products`;
                    clearContent.textContent = `Are you sure you want to remove all items in your cart?`;
                } else {
                    selectAll.checked = false;
                    clearTitle.textContent = `Remove these products`;
                    clearContent.textContent = `Are you sure you want to remove these items in your cart?`;
                }
            } else {
                clear.style.transform = `translateX(3em)`;

                let disableCheckout = document.querySelector('a.checkout');
                disableCheckout.style.pointerEvents = `none`;
                disableCheckout.style.background = `rgba(0, 0 ,0 , 0.5)`;
            }
        });
    });

    //! ========== Remove Select - All Product ==========
    clear.addEventListener('click', () => {
        let deleteAlert = document.querySelector('.alert-container');

        deleteAlert.style.transform = `translate(-50%, -50%)`;

        let cancel = deleteAlert.querySelector('.btn-cancel');
        cancel.addEventListener('click', () => {
            deleteAlert.style.transform = `translate(100dvw, -50%)`;
        });
    });

    //! ========== Ajax Handle ==========
    $(document).ready(function() {
        //! ========== Select Products In Cart ==========
        $('input#select-item').each(function() {
            $(this).on('change', function() {
                let load;

                if (check == count) {
                    let data = {
                        all: true
                    };

                    $.ajax({
                        url: '?mod=cart&act=checkout',
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            load = setTimeout(function() {
                                $('.loading').css('display', 'flex');
                            }, 500);
                        },
                        success: function(response) {
                            $('.loading').css('display', 'none');
                            clearTimeout(load);

                            $('.detail>div:first>span:last').text(response.total);
                            $('.total-price span:last').text(response.finalTotal);
                            $('.detail>div:eq(1)>span:last').text('20,000₫');
                            $('.detail>div:last').html(response.freeShip);
                            $('.sale-notify').html(response.discount);
                            $('input#select-all').attr('checked', 'checked');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.status);
                            console.log(status);
                            console.log(error);
                        },
                    });
                } else {
                    let code = $(this).attr('data-code');
                    let size = $(this).attr('data-size');
                    let status = $(this).is(':checked') ? 1 : 0;
                    let data = {
                        code: code,
                        size: size,
                        status: status,
                    };

                    $.ajax({
                        url: '?mod=cart&act=checkout',
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            load = setTimeout(function() {
                                $('.loading').css('display', 'flex');
                            }, 500);
                        },
                        success: function(response) {
                            $('.loading').css('display', 'none');
                            clearTimeout(load);

                            if (response.empty) {
                                $('.detail>div:first>span:last').text('0₫');
                                $('.total-price span:last').text('0₫');
                                $('.detail>div:eq(1)>span:last').text('0₫');
                                $('.detail>div:last').html('');
                                $('.sale-notify').html('');
                            } else {
                                $('.detail>div:first>span:last').text(response.total);
                                $('.total-price span:last').text(response.finalTotal);
                                $('.detail>div:eq(1)>span:last').text('20,000₫');
                                $('.detail>div:last').html(response.freeShip);
                                $('.sale-notify').html(response.discount);
                            }

                            $('input#select-all').attr('checked', false);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.status);
                            console.log(status);
                            console.log(error);
                        },
                    });
                }
            });
        });

        //! ========== Select All In Cart ==========
        $('input#select-all').on('change', function() {
            let load;

            if ($(this).is(':checked')) {
                let data = {
                    all: true
                };

                $.ajax({
                    url: '?mod=cart&act=checkout',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        load = setTimeout(function() {
                            $('.loading').css('display', 'flex');
                        }, 500);
                    },
                    success: function(response) {
                        $('.loading').css('display', 'none');
                        clearTimeout(load);

                        $('.detail>div:first>span:last').text(response.total);
                        $('.total-price span:last').text(response.finalTotal);
                        $('.detail>div:eq(1)>span:last').text('20,000₫');
                        $('.detail>div:last').html(response.freeShip);
                        $('.sale-notify').html(response.discount);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.status);
                        console.log(status);
                        console.log(error);
                    },
                });
            } else {
                let data = {
                    all: false
                };

                $.ajax({
                    url: '?mod=cart&act=checkout',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        load = setTimeout(function() {
                            $('.loading').css('display', 'flex');
                        }, 500);
                    },
                    success: function(response) {
                        $('.loading').css('display', 'none');
                        clearTimeout(load);

                        $('.detail>div:first>span:last').text('0₫');
                        $('.total-price span:last').text('0₫');
                        $('.detail>div:eq(1)>span:last').text('0₫');
                        $('.detail>div:last').html('');
                        $('.sale-notify').html('');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.status);
                        console.log(status);
                        console.log(error);
                    },
                });
            }
        });

        //! ========== Remove Product ==========
        $('.btn-remove').each(function() {
            $(this).on('click', function() {
                let code = $(this).attr('data-code');
                let size = $(this).attr('data-size');

                $('.alert-container h2').text('Remove item');
                $('.alert-container p').text('Are you sure you want to remove this item in your cart?');
                $('.alert-container .btn-confirm a').attr('href', '?mod=cart&act=delete&code=' + code + '&size=' + size);
                $('.alert-container').css('transform', 'translate(-50%, -50%)');

                $('.alert-container .btn-cancel').on('click', function() {
                    $('.alert-container').css('transform', 'translate(100dvw, -50%)');
                });
            });
        });

        //! ========== Remove Select - All Product ==========
        $('.remove-all>.icon>svg').on('click', function() {
            if (check == count) {
                $('.alert-container .btn-confirm a').attr('href', '?mod=cart&act=delete&all=true');
            } else {
                let codeSelect = [];
                let sizeSelect = [];

                $('.cart-item .select-item input').each(function() {
                    if (this.checked) {
                        let code = $(this).attr('data-code');
                        let size = $(this).attr('data-size');

                        codeSelect = [...codeSelect, code];
                        sizeSelect = [...sizeSelect, size];
                    }
                });

                $('.alert-container .btn-confirm a').attr('href', '?mod=cart&act=delete&code=' + codeSelect + '&size=' + sizeSelect);
            }
        });

        //! ========== Change Quantity Product ==========
        $('.quantity>.dec').each(function() {
            $(this).on('click', function() {
                let load;

                let id = $(this).next().attr('data-id');
                let quantity = Math.max(parseInt($(this).next().val()) - 1, 1);
                let code = $(this).next().attr('data-code');
                let size = $(this).next().attr('data-size');
                let price = $(this).next().attr('data-price');
                let data = {
                    id: id,
                    quantity: quantity,
                    code: code,
                    size: size,
                    price: price
                };

                $.ajax({
                    url: '?mod=cart&act=update',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        load = setTimeout(function() {
                            $('.loading').css('display', 'flex');
                        }, 500);
                    },
                    success: function(response) {
                        $('.loading').css('display', 'none');
                        clearTimeout(load);

                        $("input#stt" + response.id).val(response.itemQuantity);
                        $('.detail>div:first>span:last').text(response.total);
                        $('.total-price span:last').text(response.finalTotal);
                        $('.detail>div:last').html(response.freeShip);
                        $('.sale-notify').html(response.discount);
                        $('span.number-product').text(response.quantity);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.status);
                        console.log(status);
                        console.error(error);
                    }
                });
            });
        });

        $('.quantity>.inc').each(function() {
            $(this).on('click', function() {
                let load;

                let id = $(this).prev().attr('data-id');
                let quantity = parseInt($(this).prev().val()) + 1;
                let code = $(this).prev().attr('data-code');
                let size = $(this).prev().attr('data-size');
                let price = $(this).prev().attr('data-price');
                let data = {
                    id: id,
                    quantity: quantity,
                    code: code,
                    size: size,
                    price: price
                };

                $.ajax({
                    url: '?mod=cart&act=update',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        load = setTimeout(function() {
                            $('.loading').css('display', 'flex');
                        }, 500);
                    },
                    success: function(response) {
                        $('.loading').css('display', 'none');
                        clearTimeout(load);

                        $("input#stt" + response.id).val(response.itemQuantity);
                        $('.detail>div:first>span:last').text(response.total);
                        $('.total-price span:last').text(response.finalTotal);
                        $('.detail>div:last').html(response.freeShip);
                        $('.sale-notify').html(response.discount);
                        $('span.number-product').text(response.quantity);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.status);
                        console.log(status);
                        console.error('Error: ', error);
                    }
                });
            });
        });

        $('input.quantity').on('change input', function() {
            let load;

            let id = $(this).attr('data-id');
            let quantity = parseInt($(this).val());
            let code = $(this).attr('data-code');
            let size = $(this).attr('data-size');
            let price = $(this).attr('data-price');
            let data = {
                id: id,
                quantity: quantity,
                code: code,
                size: size,
                price: price
            };

            $.ajax({
                url: '?mod=cart&act=update',
                method: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    load = setTimeout(function() {
                        $('.loading').css('display', 'flex');
                    }, 500);
                },
                success: function(response) {
                    $('.loading').css('display', 'none');
                    clearTimeout(load);

                    $("input#stt" + response.id).val(response.itemQuantity);
                    $('.detail>div:first>span:last').text(response.total);
                    $('.total-price span:last').text(response.finalTotal);
                    $('.detail>div:last').html(response.freeShip);
                    $('.sale-notify').html(response.discount);
                    $('span.number-product').text(response.quantity);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.status);
                    console.log(status);
                    console.error(error);
                }
            });
        });
    });
</script>