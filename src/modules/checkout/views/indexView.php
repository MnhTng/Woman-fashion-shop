<?php get_header(); ?>

<main>
    <div id="checkout-page">
        <div class="checkout-header hidden-top">
            <h1>Checkout</h1>
        </div>

        <div class="checkout-detail hidden-right">
            <form action="" method="POST">
                <h2 class="title">Customer information</h2>

                <fieldset>
                    <legend>Full name</legend>
                    <input class="input" type="text" name="fullname"
                        value="<?php if (isset($_SESSION['account'])) echo $_SESSION['account']['fullname'] ?>"
                        autocomplete="off" spellcheck="false" required>
                </fieldset>

                <fieldset>
                    <legend>Email</legend>
                    <input class="input" type="email" name="email"
                        value="<?php if (isset($_SESSION['account'])) echo $_SESSION['account']['email'] ?>"
                        autocomplete="off" spellcheck="false" required>
                </fieldset>

                <fieldset>
                    <legend>Phone number</legend>
                    <input class="input" type="tel" name="tel"
                        value="<?php if (isset($_SESSION['account'])) echo $_SESSION['account']['tel'] ?>"
                        autocomplete="off" spellcheck="false" required>
                </fieldset>

                <fieldset>
                    <legend>Delivery address</legend>
                    <input class="input" type="text" name="addr" value="" autocomplete="off" spellcheck="false"
                        required>
                </fieldset>

                <fieldset>
                    <legend>Message</legend>
                    <textarea class="input" name="message"></textarea>
                </fieldset>

                <div class="payment-method">
                    <h2>Payment method</h2>

                    <div class="method">
                        <div>
                            <input type="radio" name="payment_method" id="cod" value="cod" required>
                            <label for="cod">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6" width="2em" height="2em">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                                COD
                            </label>
                            <div class="border"></div>
                        </div>

                        <div>
                            <input type="radio" name="payment_method" id="vnpay" value="vnpay" required>
                            <label for="vnpay">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6" width="2em" height="2em">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                                VnPay
                            </label>
                            <div class="border"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit_btn" name="checkout" value="submit_checkout">Checkout</button>
            </form>
        </div>

        <div class="checkout-info hidden-left">
            <h2 class="title">Product information</h2>

            <div class="cart-item">
                <div class="item-info">
                    <?php
                    if (isset($code)) {
                        $freeShip = 0;
                        if ($quantity > 1)
                            $freeShip = 1;
                        $discount = 0;
                        $total = 0;

                        foreach ($_SESSION['product'] as $item) {
                            if ($item['pcode'] == $code) {
                                echo "<div class='item'>";
                                echo "<img src='{$item['image']}' alt='product'>";
                                echo "<div class='info'>";
                                echo "<div class='name'>";
                                echo "<span>" . mb_convert_case($item['name'], MB_CASE_TITLE) . "</span>";
                                echo "<span>Size: " . strtoupper((string)$size) . "</span>";
                                echo "</div>";
                                echo "<div class='price'>";
                                echo "<div>";
                                if ($item['sale']) {
                                    echo "<span class='price-new'>" . currency_format($item['sale'])  . "</span>";
                                    echo "<span class='price-old'>" . currency_format($item['price']) . "</span>";

                                    $total = $item['sale'] * $quantity;
                                    $discount = ($item['price'] - $item['sale']) * $quantity;
                                } else {
                                    echo "<span class='price-new'>" . currency_format($item['price']) . "</span>";
                                    $total = $item['price'] * $quantity;
                                }
                                echo "</div>";
                                echo "<span>x{$quantity}</span>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";

                                break;
                            }
                        }
                    } else {
                        $freeShip = 0;
                        if ($_SESSION['quantityCheckout'] > 1)
                            $freeShip = 1;
                        $discount = 0;

                        foreach ($_SESSION['cartByCheckout'] as $item) {
                            echo "<div class='item'>";
                            echo "<img src='{$item['image']}' alt='product'>";
                            echo "<div class='info'>";
                            echo "<div class='name'>";
                            echo "<span>" . mb_convert_case($item['name'], MB_CASE_TITLE) . "</span>";
                            echo "<span>Size: " . strtoupper($item['size']) . "</span>";
                            echo "</div>";
                            echo "<div class='price'>";
                            echo "<div>";
                            if ($item['sale']) {
                                echo "<span class='price-new'>" . currency_format($item['sale'])  . "</span>";
                                echo "<span class='price-old'>" . currency_format($item['price']) . "</span>";

                                $discount += ($item['price'] - $item['sale']) * $item['quantity'];
                            } else
                                echo "<span class='price-new'>" . currency_format($item['price']) . "</span>";
                            echo "</div>";
                            echo "<span>x" . $item['quantity'] . "</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>

                <?php
                if (isset($code)) {
                    foreach ($_SESSION['product'] as $item) {
                        if ($item['pcode'] == $code) {
                ?>
                            <div class="cart-total">
                                <div class="detail">
                                    <div>
                                        <span>Total value of products</span>
                                        <span>
                                            <?php echo $item['sale'] ? currency_format($item['sale'])  : currency_format($item['price']); ?>
                                        </span>
                                    </div>

                                    <div>
                                        <span>Shipping fee</span>
                                        <span>20,000₫</span>
                                    </div>

                                    <div>
                                        <?php if ($freeShip) { ?>
                                            <span>Shipping discount</span>
                                            <span class='discount'>-20,000₫</span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="total-price">
                                    <span>Total payment</span>
                                    <span class="total" style="visibility: hidden;">
                                        <?php
                                        if ($freeShip)
                                            echo $total;
                                        else
                                            echo $total + 20000;
                                        ?>
                                    </span>
                                    <span>
                                        <?php
                                        if ($freeShip)
                                            echo currency_format($total);
                                        else
                                            echo currency_format($total + 20000);
                                        ?>
                                    </span>
                                </div>

                                <div class="sale-notify">
                                    <?php
                                    if ($freeShip)
                                        echo "<span>You have saved " . currency_format($discount + 20000) . "</span>";
                                    else if ($discount)
                                        echo "<span>You have saved " . currency_format($discount) . "</span>";
                                    ?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <div class="cart-total">
                        <div class="detail">
                            <div>
                                <span>Total value of products</span>
                                <span>
                                    <?php echo currency_format($_SESSION['totalCheckout']); ?>
                                </span>
                            </div>

                            <div>
                                <span>Shipping fee</span>
                                <span>20,000₫</span>
                            </div>

                            <div>
                                <?php if ($freeShip) { ?>
                                    <span>Shipping discount</span>
                                    <span class='discount'>-20,000₫</span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="total-price">
                            <span>Total payment</span>
                            <span class="total" style="visibility: hidden;">
                                <?php
                                if ($freeShip)
                                    echo $_SESSION['totalCheckout'];
                                else
                                    echo $_SESSION['totalCheckout'] + 20000;
                                ?>
                            </span>
                            <span>
                                <?php
                                if ($freeShip)
                                    echo currency_format($_SESSION['totalCheckout']);
                                else
                                    echo currency_format($_SESSION['totalCheckout'] + 20000);
                                ?>
                            </span>
                        </div>

                        <div class="sale-notify">
                            <?php
                            if ($freeShip)
                                echo "<span>You have saved " . currency_format($discount + 20000) . "</span>";
                            else if ($discount)
                                echo "<span>You have saved " . currency_format($discount) . "</span>";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</main>

<?php get_footer(); ?>

<script>
    //! ========== Interact with form ==========
    let input = document.querySelectorAll(".input");

    window.addEventListener("load", () => {
        input.forEach((value) => {
            if (value.value !== "") {
                value.parentElement.firstElementChild.classList.add("active");

                value.parentElement.firstElementChild.style.color = `rgb(255, 65, 31)`;
                value.parentElement.style.border = "2px solid rgba(255, 255, 255, 0.7)";
                value.parentElement.style.boxShadow = "0 0 10px 2px rgba(255, 255, 255, 0.7)";
            }

            value.addEventListener("focus", () => {
                value.parentElement.firstElementChild.classList.add("active");

                value.parentElement.firstElementChild.style.color = `rgb(255, 65, 31)`;
                value.parentElement.style.border = "2px solid rgba(255, 255, 255, 0.7)";
                value.parentElement.style.boxShadow = "0 0 10px 2px rgba(255, 255, 255, 0.7)";
            });

            value.addEventListener("blur", () => {
                if (value.value === "") {
                    value.parentElement.firstElementChild.classList.remove("active");

                    value.parentElement.firstElementChild.style.color = `#fff`;
                    value.parentElement.style.border = "2px solid transparent";
                    value.parentElement.style.boxShadow = "0 0 0 1px rgba(255, 255, 255, 0.7)";
                } else {
                    value.parentElement.firstElementChild.style.color = `rgb(255, 65, 31)`;
                    value.parentElement.style.border = "2px solid rgba(255, 255, 255, 0.7)";
                    value.parentElement.style.boxShadow = "0 0 10px 2px rgba(255, 255, 255, 0.7)";
                }
            });
        });
    });

    //! ========== Border Spin ==========
    let checked = document.querySelectorAll('.method input');

    checked.forEach((value, index) => {
        value.addEventListener('change', () => {
            checked.forEach((value) => {
                if (value.checked) {
                    let border = value.parentElement.lastElementChild;
                    let content = value.nextElementSibling;

                    content.style.color = `#66ccff`;
                    border.style.background =
                        `repeating-conic-gradient(from var(--angle), transparent 0deg 120deg, #fff 150deg 180deg, transparent 180deg 300deg, #fff 330deg 360deg)`;
                    border.style.animationName = `spin`;
                } else {
                    let border = value.parentElement.lastElementChild;
                    let content = value.nextElementSibling;

                    content.style.color = `#fff`;
                    border.style.background = `conic-gradient(from var(--angle), transparent)`;
                    border.style.animationName = `none`;
                }
            });
        });
    });

    //! ========== Sticky Product Info - Form ==========
    let checkoutInfo = document.querySelector('.checkout-info');
    let checkoutDetail = document.querySelector('.checkout-detail');

    if (checkoutDetail.offsetHeight > checkoutInfo.offsetHeight) {
        checkoutInfo.style.position = `sticky`;
        checkoutDetail.style.position = `static`;
    } else {
        checkoutDetail.style.position = `sticky`;
        checkoutInfo.style.position = `static`;
    }

    //! ========== Ajax Handle ==========
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            let load;

            let formData = $(this).serialize();
            formData += '&total=' + document.querySelector('.total-price .total').textContent;

            let code = "<?php
                        if (isset($code)) echo $code;
                        else echo 0;
                        ?>";
            let quantity = <?php
                            if (isset($quantity)) echo $quantity;
                            else echo 0;
                            ?>;
            let size = "<?php
                        if (isset($size)) echo $size;
                        else echo 0;
                        ?>";

            if (code !== "0")
                formData += "&code=" + code + "&quantity=" + quantity + "&size=" + size;

            $.ajax({
                url: '?mod=checkout&controller=order',
                method: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('.submit_btn').attr('disabled', 'disabled');
                    $('.submit_btn').html('Processing...');

                    load = setTimeout(function() {
                        $('.loading').css('display', 'flex');
                    }, 500);
                },
                success: function(response) {
                    $('.submit_btn').removeAttr('disabled');
                    $('.submit_btn').html('Checkout');

                    $('.loading').css('display', 'none');
                    clearTimeout(load);

                    if (response.payment_method === 'cod') {
                        let alert = 'Order successfully!';
                        window.location.href = '?mod=pages&controller=account&order=' + alert;
                    } else {
                        window.location.href =
                            '?mod=checkout&controller=order&act=vnpay&order=' + response
                            .order_code;
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.status);
                    console.log(status);
                    console.log(error);
                }
            });
        });
    });
</script>