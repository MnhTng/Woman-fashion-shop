<?php get_header(); ?>

<main>
    <div class="breadcrumb hidden-left">
        <?php show_breadcrumb($id, $cat, $code); ?>
    </div>

    <div class="product-detail">
        <div class='dialog'>
            <img class="size-guild" src='./src/assets/images/sizeTable.png' alt=''>

            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1'
                stroke='currentColor' class='size-6'>
                <path stroke-linecap='round' stroke-linejoin='round'
                    d='m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
            </svg>
        </div>

        <?php
        $i = 0;
        foreach ($_SESSION['product'] as $item) {
            if ($item['pcode'] == $code) {
                // Image
                echo "<div class='product-image hidden-bot'>";
                echo "<div class='slider'>";
                $thumbs = explode(', ', $item['thumb']);
                $numberThumb = count($thumbs);
                for ($i = 0; $i < 5; $i++) {
                    foreach ($thumbs as $thumb)
                        echo "<img src='{$thumb}' alt=''>";
                }
                echo "</div>";

                echo "<div class='main'>";
                echo "<img id='zoom_{$i}' src='{$item['image']}' data-zoom-image='{$item['image']}' alt=''>";
                echo "</div>";
                echo "</div>";

                // Product Info
                echo "<div class='product-info hidden-right'>";
                echo "<h3>" . mb_convert_case($item['name'], MB_CASE_UPPER) . "</h3>";
                echo "<span class='brand'>Brand: MnhTng</span>";

                echo "<div class='price'>";
                if (($item['sale'])) {
                    echo "<span class='price'>" . number_format($item['sale'], 0, '', ',') . "₫</span>";
                    echo "<span class='sales'>" . number_format($item['price'], 0, '', ',') . "₫</span>";
                } else {
                    echo "<span class='price'>" . number_format($item['price'], 0, '', ',') . "₫</span>";
                }
                echo "</div>";

                echo "<form class='cart' enctype='multipart/form-data'>";
                echo "<div class='size-table'>";
                echo "<span>Size</span>";
                echo "<div class='table'>";
                $sizes = explode(", ", $item['size']);
                $sizeBoard = ['s', 'm', 'l', 'xl', '2xl', '3xl'];
                foreach ($sizeBoard as $size) {
                    if (array_search($size, $sizes) !== false) {
                        echo "<div class='size'>";
                        echo "<input id='{$size}' type='radio' name='size' value='{$size}' ";
                        if (isset($sizeChose) && $sizeChose == $size)
                            echo "checked = 'checked'";
                        echo ">";
                        echo "<label for='{$size}'>" . strtoupper($size) . "</label>";
                        echo "</div>";
                    } else {
                        echo "<div class='size'>";
                        echo "<input id='{$size}' type='radio' name='size' value='' disabled>";
                        echo "<label class='empty' for='{$size}'>" . strtoupper($size) . "</label>";
                        echo "</div>";
                    }
                }
                echo "</div>";
                echo "<span class='guild'>Guild for size chosen</span>";
                echo "</div>";

                echo "<div class='color'>";
                echo "<p>Color</p>";
                echo "<div class='color-board'>";
                $colors = explode(", ", $item['color']);
                foreach ($colors as $color)
                    echo "<div style='background-color: {$color}'></div>";
                echo "</div>";
                echo "</div>";

                echo "<div class='amount'>";
                echo "<p>Amount</p>";
                echo "<div class='quantity'>";
                echo "<button type='button' class='dec'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='5' stroke='currentColor' class='size-6' width='1em' height='1em'>";
                echo "<path stroke-linecap='round' stroke-linejoin='round' d='M15.75 19.5 8.25 12l7.5-7.5' />";
                echo "</svg>";
                echo "</button>";
                echo "<input class='quantity' type='number' name='quantity' value='1'>";
                echo "<button type='button' class='inc'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='5' stroke='currentColor' class='size-6' width='1em' height='1em'>";
                echo "<path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />";
                echo "</svg>";
                echo "</button>";
                echo "</div>";
                echo "</div>";

                echo "<div class='product-act'>";
                echo "<button type='submit' name='add_btn' value='submit_add_product' data-code='{$item['pcode']}' class='add'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='2em' height='2em'>";
                echo "<path stroke-linecap='round' stroke-linejoin='round' d='M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z' />";
                echo "</svg>";
                echo "<p>Add to cart</p>";
                echo "</button>";
                echo "<button type='submit' name='buy_btn' value='submit_buy_product' data-code='{$item['pcode']}' class='buy'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='2em' height='2em'>";
                echo "<path stroke-linecap='round' stroke-linejoin='round' d='M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z' />";
                echo "</svg>";
                echo "<p>Buy now</p>";
                echo "</button>";
                echo "</div>";
                echo "</form>";

                echo "<div class='des'>";
                echo $item['des'];
                echo "</div>";
                echo "</div>";

                break;
            }
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>

<script>
    //! ========== Show Dialog ==========
    let guild = document.querySelector('.guild');
    let dialog = document.querySelector('.dialog');
    let exit = dialog.querySelector('svg');

    guild.addEventListener('click', () => {
        dialog.style.width = "100%";
        dialog.style.height = "100%";
        dialog.style.opacity = "1";
        exit.style.display = "block";
    });

    exit.addEventListener('click', () => {
        dialog.style.width = "0";
        dialog.style.height = "0";
        dialog.style.opacity = "0";
        exit.style.display = "none";
    });

    //! ========== Select Number Product ==========
    let number = document.querySelector('input.quantity');
    let minus = document.querySelector('.dec');
    let plus = document.querySelector('.inc');

    minus.addEventListener('click', () => {
        if (number.value > 1)
            number.value--;
    });

    plus.addEventListener('click', () => {
        number.value++;
    });

    //! ========== Set Animation Thumb Slider ==========
    let slider = document.querySelector('.slider');
    let numberThumb = <?php echo $numberThumb; ?>

    // Lấy tham chiếu đến sheet
    const stylesheet = document.styleSheets[4];

    // Tìm keyframes rule có tên "slider"
    let keyframesRule = null;
    for (let i = 0; i < stylesheet.cssRules.length; i++) {
        const rule = stylesheet.cssRules[i];
        if (rule.type === CSSRule.KEYFRAMES_RULE && rule.name === 'slider') {
            keyframesRule = rule;
            break;
        }
    }

    if (keyframesRule) {
        slider.style.animation = `slider ${numberThumb * 5}s linear infinite forwards`;

        // Sửa đổi keyframes
        window.addEventListener('load', () => {
            let image = document.querySelector('.slider>img');
            let imageHeight = image.offsetHeight;

            const keyframeRuleEnd = keyframesRule.findRule('100%');
            keyframeRuleEnd.style.transform =
                `translateY(calc((${numberThumb} * -${imageHeight}px) - (${numberThumb - 1} * 5px + 4px)))`;
        });

        window.addEventListener('resize', () => {
            let image = document.querySelector('.slider>img');
            let imageHeight = image.offsetHeight;

            const keyframeRuleEnd = keyframesRule.findRule('100%');
            keyframeRuleEnd.style.transform =
                `translateY(calc((${numberThumb} * -${imageHeight}px) - (${numberThumb - 1} * 5px + 4px)))`;
        });
    }

    //! ========== Pause Animation Thumb Slider ==========
    slider.addEventListener('mouseenter', () => {
        slider.style.animationPlayState = 'paused';
    });

    slider.addEventListener('mouseleave', () => {
        slider.style.animationPlayState = 'running';
    });

    //! ========== Ajax Handle ==========
    $(document).ready(function() {
        //! ========== Add Cart ==========
        $('button[name=add_btn]').on('click', function() {
            $('form.cart .product-act button').removeClass('click');

            $(this).addClass('click');
        });
        $('button[name=buy_btn]').on('click', function() {
            $('form.cart .product-act button').removeClass('click');

            $(this).addClass('click');
        });

        $('form.cart').on('submit', function(e) {
            e.preventDefault();
            let load;

            let formData = $(this).serialize();
            let action = $('button.click').val();
            let code = $('button.click').attr('data-code');
            formData += "&action=" + action + "&code=" + code;

            $.ajax({
                url: '?mod=posts&controller=detail&act=add_buy',
                type: 'POST',
                dataType: 'json',
                data: formData,
                beforeSend: function() {
                    load = setTimeout(function() {
                        $('.loading').css('display', 'flex');
                    }, 500);
                },
                success: function(response) {
                    $('.loading').css('display', 'none');
                    clearTimeout(load);

                    if (response.login) {
                        $('.alert-fixed').append(warning_alert_jq(response.login));

                        close_alert_jq();
                    }

                    if (response.size) {
                        $('.alert-fixed').append(error_alert_jq(response.size));

                        close_alert_jq();
                    }
                    if (response.quantity) {
                        $('.alert-fixed').append(error_alert_jq(response.quantity));

                        close_alert_jq();
                    }

                    if (response.success) {
                        if ($('span.number-product').length == 0) {
                            let span = document.createElement('span');
                            span.classList.add('number-product');
                            span.textContent = response.number;
                            document.querySelector(".cart>a.number-item").appendChild(span);
                        } else
                            $('span.number-product').text(response.number);

                        $('.alert-fixed').append(success_alert_jq(response.success));

                        close_alert_jq();
                    }

                    if (response.buy) {
                        let redirect = document.createElement('a');
                        redirect.href = "?mod=checkout&code=" + response.code +
                            "&size=" + response.size + "&quantity=" + response.quantity;
                        document.body.appendChild(redirect);
                        redirect.click();
                        document.body.removeChild(redirect);
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