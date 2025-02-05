<?php
function success_alert($alert)
{
    echo "
    <div class='alert alert-one success-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>{$alert}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    ";
}

function error_alert($error)
{
    echo "
    <div class='alert alert-one error-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>{$error}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    ";
}

function warning_alert($error)
{
    echo "
    <div class='alert alert-one warning-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>{$error}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    ";
}

function info_alert($info)
{
    echo "
    <div class='alert alert-one info-alert'>
        <div class='alert-icon'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' class='size-6' width='1.5em' height='1.5em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z' />
            </svg>
        </div>

        <p>{$info}</p>

        <div class='exit'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6' width='1.2em' height='1.2em'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
            </svg>
        </div>

        <div class='time-line'></div>
    </div>
    ";
}
