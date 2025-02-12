<?php
get_header();
show_banner();
?>

<main>
    <section>
        <h2 class="hidden-left">Featured Products</h2>
        <div class="product-list hidden-left">
            <?php
            $i = 0;
            for ($i; $i < 30; $i += 10)
                show_home_product($i);
            ?>
        </div>

        <h2 class="hidden-left">Best Seller</h2>
        <div class="product-list hidden-left">
            <?php
            for ($i; $i < 45; $i += 5)
                show_home_product($i);
            ?>
        </div>

        <h2 class="hidden-left">Most Popular</h2>
        <div class="product-list hidden-left">
            <?php
            for ($i; $i > 21; $i -= 4)
                show_home_product($i);
            ?>
        </div>

        <h2 class="hidden-left">Highest Rating</h2>
        <div class="product-list hidden-left">
            <?php
            for ($i; $i > 11; $i -= 5)
                show_home_product($i);
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<script>
//! ========== Banner ==========
let slider = document.querySelector('.banner .list');
let items = document.querySelectorAll('.banner .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.banner .dots li');

let lengthItems = items.length - 1;
let active = 0;

function reloadSlider() {
    slider.style.left = -items[active].offsetLeft + 'px';
    let last_active_dot = document.querySelector('.banner .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click()
    }, 5000);
}

window.addEventListener('resize', () => {
    reloadSlider();
});

next.addEventListener('click', () => {
    active = (active + 1) <= lengthItems ? active + 1 : 0;
    reloadSlider();
});

prev.addEventListener('click', () => {
    active = (active - 1) >= 0 ? active - 1 : lengthItems;
    reloadSlider();
});

let refreshInterval = setInterval(() => {
    next.click();
}, 5000);


dots.forEach((element, index) => {
    element.addEventListener('click', () => {
        active = index;
        reloadSlider();
    });
});

//! ========== Show Product Price ==========
let productImg = document.querySelectorAll('.img');

productImg.forEach((img) => {
    let price = img.firstElementChild.firstElementChild;

    if (parseFloat(price.textContent) >= 700)
        price.style.color = "#ff1111";
    else if (parseFloat(price.textContent) >= 300)
        price.style.color = "#ffd711";
    else
        price.style.color = "#60ff11";

    img.parentElement.addEventListener('mouseenter', () => {
        price.style.opacity = "1";
        price.style.backdropFilter = `brightness(0.6)`;

        price.firstElementChild.style.transition = `all 0.3s ease-out`;
        price.firstElementChild.style.opacity = `1`;
        price.firstElementChild.style.transform = `translate(-50%, -50%)`;

        price.lastElementChild.style.transition = `all 0.3s ease-out`;
        price.lastElementChild.style.opacity = `1`;
        price.lastElementChild.style.transform = `translate(-50%, -50%)`;
    });

    img.parentElement.addEventListener('mouseleave', () => {
        price.style.opacity = "0";
        price.style.backdropFilter = `brightness(1)`;

        price.firstElementChild.style.transition = `all 0s`;
        price.firstElementChild.style.opacity = `0`;
        price.firstElementChild.style.transform = `translate(-50%, 400px)`;

        price.lastElementChild.style.transform = `translate(-50%, -400px)`;
        setTimeout(() => {
            price.lastElementChild.style.transition = `all 0s`;
            price.lastElementChild.style.transform = `translate(-50%, 400px)`;
        }, 100);
    });
});

$(document).ready(function() {
    $('.banner a').on('click', function(e) {
        e.preventDefault();
    });
});
</script>