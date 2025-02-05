let input = document.querySelectorAll("input");

input.forEach((value) => {
    if (!value.hasAttribute('id')) {
        if (value.value !== "")
            value.parentElement.firstElementChild.classList.add("active");

        value.addEventListener("focus", () => {
            value.parentElement.firstElementChild.classList.add("active");
            value.parentElement.style.boxShadow = "0 0 0 1px rgba(190, 148, 249), 0 0 10px 3px #fff";
        });

        value.addEventListener("blur", () => {
            if (value.value === "") {
                value.parentElement.firstElementChild.classList.remove("active");
                value.parentElement.style.boxShadow = "0 0 0 1px #fff";
            }
            else {
                value.parentElement.style.boxShadow = "0 0 0 1px #fff";
            }
        });
    }
    else {
        value.addEventListener("change", () => {
            if (value.checked) {
                value.parentElement.lastElementChild.style.marginLeft = "0.7em";
                value.parentElement.lastElementChild.style.color = "rgba(190, 148, 249)";
                value.parentElement.lastElementChild.style.textShadow = "0 0 1px #000, 0 0 1px #000, 0 0 2px #000, 0 0 2px #000";
            }
            else {
                value.parentElement.lastElementChild.style.marginLeft = "0.2em";
                value.parentElement.lastElementChild.style.color = "#000";
                value.parentElement.lastElementChild.style.textShadow = "0 0 1px #fff";
            }
        });
    }
});

//! ========== Open password ==========

let openPassword = document.querySelectorAll('.open-pass');
let closePassword = document.querySelectorAll('.close-pass');

openPassword.forEach((value) => {
    value.addEventListener('click', () => {
        let pass = value.parentElement.previousElementSibling;

        pass.type = 'text';
        value.style.display = "none";
        value.parentElement.firstElementChild.style.display = "block";
    });
});

closePassword.forEach((value) => {
    value.addEventListener('click', () => {
        let pass = value.parentElement.previousElementSibling;

        pass.type = 'password';
        value.style.display = "none";
        value.parentElement.lastElementChild.style.display = "block";
    });
});