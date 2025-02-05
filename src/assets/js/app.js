//! ========== ElevateZoom ==========   

$("img[id^='zoom']").each(function () {
    $(this).ezPlus({
        easing: true,
        scrollZoom: true
    });
});

$(document).ready(function () {
    //! ========== Click Link No Reload ==========

    $('a').click(function () {
        if ($(this).attr('href') != '#') {
            window.location = $(this).attr('href');
            return false;
        }
    });

    //! ========== Animation Header + Nav ==========

    $('nav .brand').css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out' });
    setTimeout(function () {
        $('nav .brand').css('transition', 'all 0.2s ease-out');
    }, 1000);

    $('nav li').eq(0).css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out 0.15s' });
    $('nav li').eq(1).css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out 0.3s' });
    $('nav li').eq(2).css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out 0.45s' });
    $('nav li').eq(3).css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out 0.6s' });
    setTimeout(function () {
        $('nav li').each(function () {
            $(this).css('transition', '');
        });
    }, 1600);

    $('nav #search-icon').css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out 0.75s' });
    setTimeout(function () {
        $('nav #search-icon').css('transition', '');
    }, 1750);
    $('nav .cart').css({ 'transform': 'translateX(0)', 'opacity': '1', 'transition': 'all 1s ease-out 0.9s' });
    setTimeout(function () {
        $('nav .cart').css('transition', '');
    }, 1900);

    //! ========== Search ==========

    $('form.search').on('submit', function (e) {
        e.preventDefault();
        let load;

        let result = $(this).find('input').val();
        data = {
            result: result
        }

        $.ajax({
            url: '?mod=pages&controller=search&act=search',
            type: 'POST',
            data: data,
            dataType: 'text',
            beforeSend: function () {
                load = setTimeout(function () {
                    $('.loading').css('display', 'flex');
                }, 500);
            },
            success: function (response) {
                $('.loading').css('display', 'none');
                clearTimeout(load);

                let nav = document.createElement('a');
                nav.setAttribute('href', '?mod=pages&controller=search&search=' + response);
                document.body.appendChild(nav);
                nav.click();
                nav.remove();
            },
            error: function (xhr, status, error) {
                console.log(xhr.status);
                console.log(status);
                console.log(error);
            },
        });
    });
});

//! ========== Keyframes Categories Bound ==========

let categories = document.querySelectorAll(".product-list");

if (categories) {
    categories.forEach((value) => {
        value.addEventListener("mouseover", () => {
            if (value.previousElementSibling.nodeName == 'H2')
                value.previousElementSibling.classList.add("text-bound");
        });

        value.addEventListener("mouseout", () => {
            if (value.previousElementSibling.nodeName == 'H2')
                value.previousElementSibling.classList.remove("text-bound");
        });
    });
}

//! ========== Sticky ==========

let header = document.querySelector('header');
let nav = document.querySelector('#main-nav');
let navOffsetY = nav.offsetHeight + header.offsetHeight;

window.addEventListener('scroll', () => {
    if (window.scrollY >= navOffsetY)
        nav.classList.add('sticky');
    else
        nav.classList.remove('sticky');
});

//! ========== Show Search Input ==========

let searchBtn = document.querySelector('#search-icon');
let searchInput = document.querySelector('form.search');
let line = document.querySelector('#search-icon>.line');

let clicked = 0;
searchBtn.addEventListener('click', () => {
    if (!clicked) {
        clicked = 1;

        line.style.left = `-0.5em`;
        line.style.opacity = `1`;
        setTimeout(() => {
            searchInput.style.transform = `translateX(0)`;
        }, 550);
    }
    else {
        clicked = 0;

        searchInput.style.transform = `translateX(110%)`;

        setTimeout(() => {
            line.style.left = `0`;
            line.style.opacity = `0`;
        }, 550)
    }
});

//! ========== Show Product Scroll ==========

let hiddenLeft = document.querySelectorAll('.hidden-left');
let hiddenRight = document.querySelectorAll('.hidden-right');
let hiddenBot = document.querySelectorAll('.hidden-bot');
let hiddenTop = document.querySelectorAll('.hidden-top');
let hiddenRotate = document.querySelectorAll('.hidden-rotate');
let activeHeight = window.innerHeight / 5 * 4.95;

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

    if (hiddenRotate) {
        hiddenRotate.forEach((value) => {
            if (value.getBoundingClientRect().top < activeHeight) {
                value.classList.add('show-rotate');
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

    if (hiddenRotate) {
        hiddenRotate.forEach((value) => {
            if (value.getBoundingClientRect().top < activeHeight) {
                value.classList.add('show-rotate');
            }
        });
    }
});

//! ========== Scroll to Top ==========

let scrollBtn = document.querySelector('.scroll-on-top');

window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300)
        scrollBtn.style.display = "flex";
    else
        scrollBtn.style.display = "none";
});

scrollBtn.addEventListener('click', () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

//! ========== Close Alert ==========

let alert = document.querySelectorAll('.alert');

if (alert) {
    alert.forEach((value) => {
        value.style.animation = `show-alert 5.5s cubic-bezier(0.68, -0.6, 0.32, 1.6)`;

        let exit = value.querySelector('.exit');

        exit.addEventListener('click', () => {
            value.style.animation = `close-alert 0.5s cubic-bezier(0.32, -0.22, 0.24, -0.18)`;
        });
    });
}