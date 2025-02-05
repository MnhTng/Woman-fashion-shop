<?php get_header(); ?>

<main>
    <section class="contact">
        <div id="contact" class="hidden-bot">
            <h2>Contact Us</h2>
            <form action="" method="POST">
                <fieldset>
                    <legend>Name</legend>
                    <input class="input" type="text" name="name" autocomplete="off" required>
                </fieldset>

                <fieldset>
                    <legend>Email</legend>
                    <input class="input" type="email" name="email" autocomplete="off" required>
                </fieldset>

                <fieldset>
                    <legend>Message</legend>
                    <textarea class="input" name="message" required></textarea>
                </fieldset>

                <button type="submit" class="submit_btn" name="btn_contact" value="submit_contact">Submit</button>
            </form>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<script>
    //! ========== Interact with form ==========
    let input = document.querySelectorAll(".input");

    input.forEach((value) => {
        if (value.value !== "")
            value.parentElement.firstElementChild.classList.add("active");

        value.addEventListener("focus", () => {
            value.parentElement.firstElementChild.classList.add("active");
            value.parentElement.style.border = "2px solid rgba(0, 0, 0, 0.5)";
            value.parentElement.style.boxShadow = "0 0 10px 2px rgba(0, 0, 0, 0.7)";
        });

        value.addEventListener("blur", () => {
            if (value.value === "") {
                value.parentElement.firstElementChild.classList.remove("active");
                value.parentElement.style.border = "2px solid transparent";
                value.parentElement.style.boxShadow = "0 0 0 1px rgba(0, 0, 0, 0.7)";
            } else {
                value.parentElement.style.border = "2px solid rgba(0, 0, 0, 0.5)";
                value.parentElement.style.boxShadow = "0 0 10px 2px rgba(0, 0, 0, 0.7)";
            }
        });
    });
</script>