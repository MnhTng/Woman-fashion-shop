function success_alert_jq(alert) {
    return `
    <div class='alert success-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>${alert}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    `;
}

function error_alert_jq(error) {
    return `
    <div class='alert error-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>${error}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    `;
}

function warning_alert_jq(error) {
    return `
    <div class='alert warning-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>${error}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    `;
}

function close_alert_jq() {
    let time = setTimeout(function () {
        $('.alert-fixed .alert:first').remove();
    }, 5500);

    $('.alert .exit').each(function () {
        $(this).on('click', function () {
            $(this).parent().css('animation', 'close-alert 0.5s cubic-bezier(0.32, -0.22, 0.24, -0.18)');

            setTimeout(function () {
                $('.alert').each(function () {
                    if ($(this).css('animation-name') == "close-alert") {
                        $(this).css('display', 'none');
                    }
                });
            }, 500);
        });
    });
}

function info_alert_jq(info) {
    return `
    <div class='alert info-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>${info}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    `;
}