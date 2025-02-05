<?php
function construct()
{
    load_model('index');
    load('helper', 'product');
}

function indexAction()
{
    load('helper', 'format');
    load_view('index');
}
