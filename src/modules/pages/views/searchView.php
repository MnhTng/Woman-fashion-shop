<?php get_header(); ?>

<main>
    <?php show_result_search($search, $page); ?>
</main>

<?php get_footer(); ?>

<script>
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
</script>