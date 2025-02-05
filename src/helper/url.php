<?php
function base_url($url = "")
{
    global $config;
    return $config['base_url'] . $url;
}

function redirect($url = "")
{
    global $config;
    header("Location: " . $config['base_url'] . $url);
}
