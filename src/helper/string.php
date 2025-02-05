<?php
function create_slug($string)
{
    $search = array(
        '#(à|á|ả|ã|ạ|â|ầ|ấ|ẩ|ẫ|ậ|ă|ằ|ắ|ẳ|ẵ|ặ)#',
        '#(è|é|ẻ|ẽ|ẹ|ê|ề|ế|ể|ễ|ệ)#',
        '#(ì|í|ỉ|ĩ|ị)#',
        '#(ò|ó|ỏ|õ|ọ|ô|ồ|ố|ổ|ỗ|ộ|ơ|ờ|ớ|ở|ỡ|ợ)#',
        '#(ù|ú|ủ|ũ|ụ|ô|ồ|ố|ổ|ỗ|ộ|ơ|ờ|ớ|ở|ỡ|ợ)#',
        '#(ỳ|ý|ỷ|ỹ|ỵ)#',
        '#(đ)#',
        '#(À|Á|Ả|Ã|Ạ|Â|Ầ|Ấ|Ẩ|Ẫ|Ậ|Ă|Ằ|Ắ|Ẳ|Ẵ|Ặ)#',
        '#(È|É|Ẻ|Ẽ|Ẹ|Ê|Ề|Ế|Ể|Ễ|Ệ)#',
        '#(Ì|Í|Ỉ|Ĩ|Ị)#',
        '#(Ò|Ó|Ỏ|Õ|Ọ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ)#',
        '#(Ù|Ú|Ủ|Ũ|Ụ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ)#',
        '#(Ỳ|Ý|Ỷ|Ỹ|Ỵ)#',
        '#(Đ)#',
        '/[^a-zA-Z0-9]+/'
    );

    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-'
    );

    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');
    return strtolower($string);
}
