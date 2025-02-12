<?php
//! =============== MULTI_LEVEL MENU ===============

function has_child_category($categories, $id)
{
    foreach ($categories as $cat) {
        if ($cat['parent_id'] == $id)
            return true;
    }
    return false;
}

function multi_level($categories, $parentID = 0, $level = 0)
{
    $result = [];

    foreach ($categories as $cat) {
        if ($cat['parentID'] == $parentID) {
            $cat['level'] = $level;
            $result[] = $cat;

            if (has_child_category($categories, $cat['id']))
                $result = array_merge($result, multi_level($categories, $cat['id'], $level + 1));
        }
    }

    return $result;
}

//! =============== HOME ===============

function show_banner()
{
    echo "
    <div class='banner'>
        <div class='list'>
    ";

    foreach ($_SESSION['banner'] as $banner) {
        $src = $banner['src'];

        echo "
            <div class='item'>
                <img src='$src' alt=''>
            </div>
        ";
    }

    echo "
        </div>

        <div class='buttons'>
            <button id='prev'>
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='3' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M15.75 19.5 8.25 12l7.5-7.5' />
                </svg>
            </button>

            <button id='next'>
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='3' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />
                </svg>
            </button>
        </div>

        <ul class='dots'>
    ";

    $count = count($_SESSION['banner']);
    for ($i = 0; $i < $count; $i++) {
        if (!$i)
            echo "<li class='active'></li>";
        else
            echo "<li></li>";
    }
    echo "
        </ul>
    </div>
    ";
}

function show_home_product($i)
{
    if (isset($_SESSION['product']) && !empty($_SESSION['product'][$i]['type'])) {
        foreach ($_SESSION['category'] as $types) {
            if (!empty($types['type'])) {
                $type = explode(', ', $types['type']);

                if (in_array($_SESSION['product'][$i]['type'], $type)) {
                    $cat = array_search($_SESSION['product'][$i]['type'], $type);
                    break;
                }
            }

            if (isset($cat))
                break;
        }

        echo "
        <div class='product'>
        <div class='img'>
            <a href='?mod=posts&controller=detail&id={$_SESSION['product'][$i]['id']}&cat={$cat}&code={$_SESSION['product'][$i]['pcode']}'>
                <span class='price'>
                    <span>";
        echo $_SESSION['product'][$i]['sale'] ? currency_format($_SESSION['product'][$i]['sale']) : currency_format($_SESSION['product'][$i]['price']);
        echo "
                    </span>
                    <span>";
        echo $_SESSION['product'][$i]['sale'] ? currency_format($_SESSION['product'][$i]['sale']) : currency_format($_SESSION['product'][$i]['price']);
        echo "
                    </span>
                </span>
            </a>
            <img src='{$_SESSION['product'][$i]['image']}' alt='{$_SESSION['product'][$i]['name']} {$_SESSION['product'][$i]['pcode']}'>
        </div>
        <h3>" . mb_convert_case($_SESSION['product'][$i]['name'], MB_CASE_UPPER) . "</h3>
        <p>" . mb_convert_case($_SESSION['product'][$i]['intro'], MB_CASE_TITLE) . "</p>
        <a href='?mod=posts&controller=detail&id={$_SESSION['product'][$i]['id']}&cat={$cat}&code={$_SESSION['product'][$i]['pcode']}' class='btn'>View Details</a>
        </div>
        ";
    } else {
        echo "
        <div class='product'>
        <div class='img'>
            <a href='?mod=posts&controller=detail&id={$_SESSION['product'][$i]['id']}&code={$_SESSION['product'][$i]['pcode']}'>
                <span class='price'>
                    <span>";
        echo $_SESSION['product'][$i]['sale'] ? currency_format($_SESSION['product'][$i]['sale']) : currency_format($_SESSION['product'][$i]['price']);
        echo "
                    </span>
                    <span>";
        echo $_SESSION['product'][$i]['sale'] ? currency_format($_SESSION['product'][$i]['sale']) : currency_format($_SESSION['product'][$i]['price']);
        echo "
                    </span>
                </span>
            </a>
            <img src='{$_SESSION['product'][$i]['image']}' alt='{$_SESSION['product'][$i]['name']} {$_SESSION['product'][$i]['pcode']}'>
        </div>
        <h3>" . mb_convert_case($_SESSION['product'][$i]['name'], MB_CASE_UPPER) . "</h3>
        <p>{$_SESSION['product'][$i]['intro']}</p>
        <a href='?mod=posts&controller=detail&id={$_SESSION['product'][$i]['id']}&code={$_SESSION['product'][$i]['pcode']}' class='btn'>View Details</a>
        </div>
        ";
    }
}

//! =============== MAIN ===============

function get_focus_category($id, $cat)
{
    if (isset($id) && $id !== 0) {
        if (isset($cat)) {
            if (!empty($_SESSION['category'][$id - 1]['type'])) {
                $type = explode(', ', $_SESSION['category'][$id - 1]['type']);

                $catName = $type[$cat];
            }

            echo "
            <span class='cate-focus-icon'>
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='currentColor' class='size-6' width='15px' height='15px'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />
                </svg>
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='currentColor' class='size-6' width='15px' height='15px'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />
                </svg>
                {$catName}
            </span>
            ";
        } else {
            echo "
            <span class='cate-focus-icon'>
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='currentColor' class='size-6' width='15px' height='15px'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />
                </svg>
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='currentColor' class='size-6' width='15px' height='15px'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='m8.25 4.5 7.5 7.5-7.5 7.5' />
                </svg>
                {$_SESSION['category'][$id - 1]['name']}
            </span>
            ";
        }
    }
}

function show_list_product_by_category($id, $cat, $page)
{
    $quantityPerPage = 9;

    // Contain id
    if (isset($id) && $id !== 0) {
        // Contain cat
        if (isset($cat)) {
            $type = explode(', ', $_SESSION['category'][$id - 1]['type']);
            $totalPost = db_num_rows("SELECT * FROM product as p WHERE p.id = $id AND p.type = '{$type[$cat]}'");
            $totalPage = ceil($totalPost / $quantityPerPage);

            $start = ($page - 1) * $quantityPerPage;
            $sql = "SELECT * FROM product as p WHERE p.id = $id AND p.type = '{$type[$cat]}' LIMIT {$start}, {$quantityPerPage}";
            $filter = db_fetch_array($sql);

            echo "<div class='product-list hidden-bot'>";
            foreach ($filter as $item) {
                if ($item['id'] == $id && $item['type'] == $type[$cat]) {
                    echo "
                    <div class='product'>
                    <div class='img'>
                        <a href='?mod=posts&controller=detail&id={$id}&cat={$cat}&code={$item['pcode']}'>
                            <span class='price'>
                                <span>";
                    echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
                    echo "
                                </span>
                                <span>";
                    echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
                    echo "
                                </span>
                            </span>      
                        </a>
                        <img src='{$item['image']}' alt='{$item['name']} {$item['pcode']}'>
                    </div>
                    <h3>" . mb_convert_case($item['name'], MB_CASE_UPPER) . "</h3>
                    <p>" . mb_convert_case($item['intro'], MB_CASE_TITLE) . "</p>
                    <a href='?mod=posts&controller=detail&id={$id}&cat={$cat}&code={$item['pcode']}' class='btn'>View Details</a>
                    </div>
                    ";
                }
            }
            echo "</div>";

            echo "<div class='pagination'>";
            if ($page > 1) {
                $prePage = $page - 1;
                echo "
                <span class='prev'>
                    <a href='?mod=posts&id={$id}&cat={$cat}&page={$prePage}'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                            <path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z' />
                        </svg>
                    </a>
                </span>
                ";
            }

            if ($page - 1 > 2)
                echo "
                <span class='page'><a href='?mod=posts&id={$id}&cat={$cat}&page=1'>1</a></span>

                <span class='page page-node'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                        <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                    </svg>
                </span>
                ";
            else if ($page - 1 == 2)
                echo "<span class='page'><a href='?mod=posts&id={$id}&cat={$cat}&page=1'>1</a></span>";

            for ($i = max($page - 1, 1); $i <= min($page + 1, $totalPage); $i++) {
                if ($i == $page)
                    echo "<span class='page'><a class='current-page' href='?mod=posts&id={$id}&cat={$cat}&page={$i}'>{$i}</a></span>";
                else
                    echo "<span class='page'><a href='?mod=posts&id={$id}&cat={$cat}&page={$i}'>{$i}</a></span>";
            }

            if ($totalPage - $page > 2)
                echo "
                <span class='page page-node'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                        <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                    </svg>
                </span>

                <span class='page'><a href='?mod=posts&id={$id}&cat={$cat}&page={$totalPage}'>{$totalPage}</a></span>
                ";
            else if ($totalPage - $page == 2)
                echo "<span class='page'><a href='?mod=posts&id={$id}&cat={$cat}&page={$totalPage}'>{$totalPage}</a></span>";

            if ($page < $totalPage) {
                $nextPage = $page + 1;
                echo "
                <span class='next'>
                    <a href='?mod=posts&id={$id}&cat={$cat}&page={$nextPage}'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                            <path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z' />
                        </svg>
                    </a>
                </span>
                ";
            }
            echo "</div>";
        }
        // Not contain cat
        else {
            $totalPost = db_num_rows("SELECT * FROM product as p WHERE p.id = $id");
            $totalPage = ceil($totalPost / $quantityPerPage);

            $start = ($page - 1) * $quantityPerPage;
            $sql = "SELECT * FROM product as p WHERE p.id = $id LIMIT {$start}, {$quantityPerPage}";
            $filter = db_fetch_array($sql);

            echo "<div class='product-list hidden-bot'>";
            foreach ($filter as $item) {
                if ($item['id'] == $id) {
                    echo "
                    <div class='product'>
                    <div class='img'>
                        <a href='?mod=posts&controller=detail&id={$id}&code={$item['pcode']}'>
                            <span class='price'>
                                <span>";
                    echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
                    echo "
                                </span>
                                <span>";
                    echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
                    echo "
                                </span>
                            </span>      
                        </a>
                        <img src='{$item['image']}' alt='{$item['name']} {$item['pcode']}'>
                    </div>
                    <h3>" . mb_convert_case($item['name'], MB_CASE_UPPER) . "</h3>
                    <p>" . mb_convert_case($item['intro'], MB_CASE_TITLE) . "</p>
                    <a href='?mod=posts&controller=detail&id={$id}&code={$item['pcode']}' class='btn'>View Details</a>
                    </div>
                    ";
                }
            }
            echo "</div>";

            echo "<div class='pagination'>";
            if ($page > 1) {
                $prePage = $page - 1;
                echo "
                <span class='prev'>
                    <a href='?mod=posts&id={$id}&page={$prePage}'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                            <path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z' />
                        </svg>
                    </a>
                </span>
                ";
            }

            if ($page - 1 > 2)
                echo "
                <span class='page'><a href='?mod=posts&id={$id}&page=1'>1</a></span>
    
                <span class='page page-node'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                        <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                    </svg>
                </span>
                ";
            else if ($page - 1 == 2)
                echo "<span class='page'><a href='?mod=posts&id={$id}&page=1'>1</a></span>";

            for ($i = max($page - 1, 1); $i <= min($page + 1, $totalPage); $i++) {
                if ($i == $page)
                    echo "<span class='page'><a class='current-page' href='?mod=posts&id={$id}&page={$i}'>{$i}</a></span>";
                else
                    echo "<span class='page'><a href='?mod=posts&id={$id}&page={$i}'>{$i}</a></span>";
            }

            if ($totalPage - $page > 2)
                echo "
                <span class='page page-node'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                        <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                    </svg>
                </span>
    
                <span class='page'><a href='?mod=posts&id={$id}&page={$totalPage}'>{$totalPage}</a></span>
                ";
            else if ($totalPage - $page == 2)
                echo "<span class='page'><a href='?mod=posts&id={$id}&page={$totalPage}'>{$totalPage}</a></span>";

            if ($page < $totalPage) {
                $nextPage = $page + 1;
                echo "
                <span class='next'>
                    <a href='?mod=posts&id={$id}&page={$nextPage}'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                            <path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z' />
                        </svg>
                    </a>
                </span>
                ";
            }
            echo "</div>";
        }
    }
    // Not contain id
    else {
        $totalPost = db_num_rows("SELECT * FROM product as p");
        $totalPage = ceil($totalPost / $quantityPerPage);

        $start = ($page - 1) * $quantityPerPage;
        $sql = "SELECT * FROM product as p ORDER BY RAND() LIMIT {$start}, {$quantityPerPage}";
        $filter = db_fetch_array($sql);

        echo "<div class='product-list hidden-bot'>";
        foreach ($filter as $item) {
            echo "
            <div class='product'>
            <div class='img'>
                <a href='?mod=posts&controller=detail&id=0&code={$item['pcode']}'>
                    <span class='price'>
                        <span>";
            echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
            echo "
                        </span>
                        <span>";
            echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
            echo "
                        </span>
                    </span>  
                </a>
                <img src='{$item['image']}' alt='{$item['name']} {$item['pcode']}'>
            </div>
            <h3>" . mb_convert_case($item['name'], MB_CASE_UPPER) . "</h3>
            <p>" . mb_convert_case($item['intro'], MB_CASE_TITLE) . "</p>
            <a href='?mod=posts&controller=detail&id=0&code={$item['pcode']}' class='btn'>View Details</a>
            </div>
            ";
        }
        echo "</div>";

        echo "<div class='pagination'>";
        if ($page > 1) {
            $prePage = $page - 1;
            echo "
            <span class='prev'>
                <a href='?mod=posts&page={$prePage}'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                        <path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z' />
                    </svg>
                </a>
            </span>
            ";
        }

        if ($page - 1 > 2)
            echo "
            <span class='page'><a href='?mod=posts&page=1'>1</a></span>

            <span class='page page-node'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                    <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                </svg>
            </span>
            ";
        else if ($page - 1 == 2)
            echo "<span class='page'><a href='?mod=posts&page=1'>1</a></span>";

        for ($i = max($page - 1, 1); $i <= min($page + 1, $totalPage); $i++) {
            if ($i == $page)
                echo "<span class='page'><a class='current-page' href='?mod=posts&page={$i}'>{$i}</a></span>";
            else
                echo "<span class='page'><a href='?mod=posts&page={$i}'>{$i}</a></span>";
        }

        if ($totalPage - $page > 2)
            echo "
            <span class='page page-node'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                    <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                </svg>
            </span>

            <span class='page'><a href='?mod=posts&page={$totalPage}'>{$totalPage}</a></span>
            ";
        else if ($totalPage - $page == 2)
            echo "<span class='page'><a href='?mod=posts&page={$totalPage}'>{$totalPage}</a></span>";

        if ($page < $totalPage) {
            $nextPage = $page + 1;
            echo "
            <span class='next'>
                <a href='?mod=posts&page={$nextPage}'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                        <path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z' />
                    </svg>
                </a>
            </span>
            ";
        }
        echo "</div>";
    }
}

//! =============== DETAILS ===============

function show_breadcrumb($id, $cat, $code)
{
    echo "<a class='underline_center' href='?'>Home</a>";
    echo "<span>&#62;</span>";
    echo "<a class='underline_center' href='?mod=posts'>Products</a>";

    if (isset($id) && $id !== 0) {
        echo "<span>&#62;</span>";
        echo "<a class='underline_center' href='?mod=posts&id={$id}'>{$_SESSION['category'][$id - 1]['name']}</a>";
    }

    if ($cat) {
        $type = explode(', ', $_SESSION['category'][$id - 1]['type']);

        echo "<span>&#62;</span>";
        echo "<a class='underline_center' href='?mod=posts&id={$id}&cat={$cat}'>{$type[$cat]}</a>";
    }

    if (isset($code)) {
        $name = '';

        foreach ($_SESSION['product'] as $item) {
            if (array_search($code, $item) !== false) {
                $name = mb_convert_case($item['name'], MB_CASE_TITLE);
                break;
            }
        }

        if (isset($cat)) {
            echo "<span>></span>";
            echo "<a class='underline_center' href='?mod=posts&controller=detail&id={$id}&cat={$cat}&code={$code}'>{$name}</a>";
        } else {
            echo "<span>></span>";
            echo "<a class='underline_center' href='?mod=posts&controller=detail&id={$id}&code={$code}'>{$name}</a>";
        }
    }
}

//! =============== SEARCH ===============

function show_result_search($search, $page)
{
    $quantityPerPage = 9;

    $totalPost = db_num_rows("SELECT * FROM product as p WHERE p.name LIKE '%$search%'");
    $totalPage = ceil($totalPost / $quantityPerPage);

    $start = ($page - 1) * $quantityPerPage;
    $sql = "SELECT p.* FROM product AS p JOIN category AS c ON p.id = c.id AND p.name LIKE '%$search%' LIMIT {$start}, {$quantityPerPage}";
    $filter = db_fetch_array($sql);

    echo "<h2 class='hidden-left search'>Search Results: {$search}</h2>";

    if (!empty($filter)) {
        echo "<div class='product-list hidden-left'>";

        foreach ($filter as $item) {
            echo "
                <div class='product'>
                <div class='img'>
                    <a href='?mod=posts&controller=detail&id=0&code={$item['pcode']}'>
                        <span class='price'>
                            <span>";
            echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
            echo "
                            </span>
                            <span>";
            echo $item['sale'] ? currency_format($item['sale']) : currency_format($item['price']);
            echo "
                            </span>
                        </span>  
                    </a>
                    <img src='{$item['image']}' alt='{$item['name']} {$item['pcode']}'>
                </div>
                <h3>" . mb_convert_case($item['name'], MB_CASE_UPPER) . "</h3>
                <p>{$item['intro']}</p>
                <a href='?mod=posts&controller=detail&id=0&code={$item['pcode']}' class='btn'>View Details</a>
                </div>
            ";
        }
        echo "</div>";

        echo "<div class='pagination'>";
        if ($page > 1) {
            $prePage = $page - 1;
            echo "
                <span class='prev'>
                    <a href='?mod=pages&controller=search&search={$search}&page={$prePage}'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                            <path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z' />
                        </svg>
                    </a>
                </span>
                ";
        }

        if ($page - 1 > 2)
            echo "
                <span class='page'><a href='?mod=pages&controller=search&search={$search}&page=1'>1</a></span>
    
                <span class='page page-node'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                        <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                    </svg>
                </span>
                ";
        else if ($page - 1 == 2)
            echo "<span class='page'><a href='?mod=pages&controller=search&search={$search}&page=1'>1</a></span>";

        for ($i = max($page - 1, 1); $i <= min($page + 1, $totalPage); $i++) {
            if ($i == $page)
                echo "<span class='page'><a class='current-page' href='?mod=pages&controller=search&search={$search}&page={$i}'>{$i}</a></span>";
            else
                echo "<span class='page'><a href='?mod=pages&controller=search&search={$search}&page={$i}'>{$i}</a></span>";
        }

        if ($totalPage - $page > 2)
            echo "
                <span class='page page-node'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' width='1em' height='1em'>
                        <path d='M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z' />
                    </svg>
                </span>
    
                <span class='page'><a href='?mod=pages&controller=search&search={$search}&page={$totalPage}'>{$totalPage}</a></span>
                ";
        else if ($totalPage - $page == 2)
            echo "<span class='page'><a href='?mod=pages&controller=search&search={$search}&page={$totalPage}'>{$totalPage}</a></span>";

        if ($page < $totalPage) {
            $nextPage = $page + 1;
            echo "
                <span class='next'>
                    <a href='?mod=pages&controller=search&search={$search}&page={$nextPage}'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='1em' height='1em'>
                            <path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z' />
                        </svg>
                    </a>
                </span>
                ";
        }

        echo "</div>";
    } else {
        echo "
        <div class='search-empty hidden-bot'>
            <div class='icon'>
                <script src='https://cdn.lordicon.com/lordicon.js'></script>
                <lord-icon src='https://cdn.lordicon.com/lwumwgrp.json' trigger='loop' state='morph-fill' colors='primary:#ffc738,secondary:#f24c00,tertiary:#d1e3fa' style='width:250px;height:250px'>
                </lord-icon>
            </div>

            <p>No suitable product match search result.</p>
            <a href='?'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' fill='currentColor' width='2.5em' height='2.5em'>
                    <path d='M547.6 103.8L490.3 13.1C485.2 5 476.1 0 466.4 0L109.6 0C99.9 0 90.8 5 85.7 13.1L28.3 103.8c-29.6 46.8-3.4 111.9 51.9 119.4c4 .5 8.1 .8 12.1 .8c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.2 0 49.3-11.4 65.2-29c16 17.6 39.1 29 65.2 29c4.1 0 8.1-.3 12.1-.8c55.5-7.4 81.8-72.5 52.1-119.4zM499.7 254.9c0 0 0 0-.1 0c-5.3 .7-10.7 1.1-16.2 1.1c-12.4 0-24.3-1.9-35.4-5.3L448 384l-320 0 0-133.4c-11.2 3.5-23.2 5.4-35.6 5.4c-5.5 0-11-.4-16.3-1.1l-.1 0c-4.1-.6-8.1-1.3-12-2.3L64 384l0 64c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-64 0-131.4c-4 1-8 1.8-12.3 2.3z' />
                </svg>

                <p>Continue shopping</p>
            </a>
        </div>
        ";
    }
}