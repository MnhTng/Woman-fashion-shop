<?php
get_header();

$sql = "SELECT * FROM `order` WHERE user = {$_SESSION['user_id']} AND `status` != 'Cancelled' ORDER BY order_date DESC";
$_SESSION['order'] = db_fetch_array($sql);

$sql = "SELECT * FROM `cancel_order` WHERE user = {$_SESSION['user_id']}";
$_SESSION['cancel_order'] = db_fetch_array($sql);
?>

<main>
    <div class="account-container">
        <h1>User Infomation</h1>

        <div class="hidden-rotate acc-inner">
            <div class="acc-front">
                <div class="acc-image">
                    <form enctype="multipart/form-data">
                        <label for="avt">
                            <img src='<?php if (empty($_SESSION['account']['avt'])) echo "./src/assets/images/no-avt.jpg";
                                        else echo $_SESSION['account']['avt']; ?>' alt="avatar">
                            <div>Choose Image</div>
                        </label>

                        <input type="file" id="avt" name="avt">

                        <span><?php echo $_SESSION['account']['username']; ?></span>

                        <button name="upload_avt">
                            <span>Upload</span>
                        </button>
                    </form>
                </div>

                <div class="acc-content">
                    <div class="fullname">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"
                            width="2em" height="2em">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span><?php echo $_SESSION['account']['fullname']; ?></span>
                    </div>

                    <div class="gender">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" width="2em"
                            height="2em">
                            <path
                                d="M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1l0 34.9 32 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0 0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-32 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l32 0 0-34.9C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0L616 0c13.3 0 24 10.7 24 24l0 112c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z" />
                        </svg>

                        <span><?php if (empty($_SESSION['account']['gender'])) echo "Empty";
                                else echo $_SESSION['account']['gender']; ?></span>
                    </div>

                    <div class="birthday">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" width="2em"
                            height="2em">
                            <path
                                d="M86.4 5.5L61.8 47.6C58 54.1 56 61.6 56 69.2L56 72c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L105.6 5.5C103.6 2.1 100 0 96 0s-7.6 2.1-9.6 5.5zm128 0L189.8 47.6c-3.8 6.5-5.8 14-5.8 21.6l0 2.8c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L233.6 5.5C231.6 2.1 228 0 224 0s-7.6 2.1-9.6 5.5zM317.8 47.6c-3.8 6.5-5.8 14-5.8 21.6l0 2.8c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L361.6 5.5C359.6 2.1 356 0 352 0s-7.6 2.1-9.6 5.5L317.8 47.6zM128 176c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48c-35.3 0-64 28.7-64 64l0 71c8.3 5.2 18.1 9 28.8 9c13.5 0 27.2-6.1 38.4-13.4c5.4-3.5 9.9-7.1 13-9.7c1.5-1.3 2.7-2.4 3.5-3.1c.4-.4 .7-.6 .8-.8l.1-.1s0 0 0 0s0 0 0 0s0 0 0 0s0 0 0 0c3.1-3.2 7.4-4.9 11.9-4.8s8.6 2.1 11.6 5.4c0 0 0 0 0 0s0 0 0 0l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c3-3.5 7.4-5.4 12-5.4s9 2 12 5.4l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c2.9-3.4 7.1-5.3 11.6-5.4s8.7 1.6 11.9 4.8c0 0 0 0 0 0s0 0 0 0s0 0 0 0l.1 .1c.2 .2 .4 .4 .8 .8c.8 .7 1.9 1.8 3.5 3.1c3.1 2.6 7.5 6.2 13 9.7c11.2 7.3 24.9 13.4 38.4 13.4c10.7 0 20.5-3.9 28.8-9l0-71c0-35.3-28.7-64-64-64l0-48c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48-64 0 0-48c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48-64 0 0-48zM448 394.6c-8.5 3.3-18.2 5.4-28.8 5.4c-22.5 0-42.4-9.9-55.8-18.6c-4.1-2.7-7.8-5.4-10.9-7.8c-2.8 2.4-6.1 5-9.8 7.5C329.8 390 310.6 400 288 400s-41.8-10-54.6-18.9c-3.5-2.4-6.7-4.9-9.4-7.2c-2.7 2.3-5.9 4.7-9.4 7.2C201.8 390 182.6 400 160 400s-41.8-10-54.6-18.9c-3.7-2.6-7-5.2-9.8-7.5c-3.1 2.4-6.8 5.1-10.9 7.8C71.2 390.1 51.3 400 28.8 400c-10.6 0-20.3-2.2-28.8-5.4L0 480c0 17.7 14.3 32 32 32l384 0c17.7 0 32-14.3 32-32l0-85.4z" />
                        </svg>

                        <span><?php if ($_SESSION['account']['birthday'] == '0000-00-00') echo "Empty";
                                else echo $_SESSION['account']['birthday']; ?></span>
                    </div>

                    <div class="email">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="2em"
                            height="2em">
                            <path
                                d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                        </svg>

                        <span><?php echo $_SESSION['account']['email']; ?></span>
                    </div>

                    <div class="tel">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"
                            width="2em" height="2em">
                            <path fill-rule="evenodd"
                                d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span><?php echo $_SESSION['account']['tel']; ?></span>
                    </div>

                    <button class="flip-btn" onclick="flipForm()">Update</button>
                </div>
            </div>

            <div class="acc-back">
                <div class="acc-content">
                    <form>
                        <div>
                            <label for="name">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6" width="2em" height="2em">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>

                            <input type="text" class="valid" id="name" name="name" minlength="2" placeholder="Name"
                                autocomplete="off" spellcheck="false">
                        </div>

                        <div>
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor"
                                    width="2em" height="2em">
                                    <path
                                        d="M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1l0 34.9 32 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0 0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-32 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l32 0 0-34.9C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0L616 0c13.3 0 24 10.7 24 24l0 112c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z" />
                                </svg>
                            </label>

                            <div class="escape">
                                <input type="radio" id="male" name="gender" value="male">
                                <label class="escape" for="male">Male</label>

                                <input type="radio" id="female" name="gender" value="female">
                                <label class="escape" for="female">Female</label>
                            </div>
                        </div>

                        <div>
                            <label for="date">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="2em" height="2em">
                                    <path
                                        d="M86.4 5.5L61.8 47.6C58 54.1 56 61.6 56 69.2L56 72c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L105.6 5.5C103.6 2.1 100 0 96 0s-7.6 2.1-9.6 5.5zm128 0L189.8 47.6c-3.8 6.5-5.8 14-5.8 21.6l0 2.8c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L233.6 5.5C231.6 2.1 228 0 224 0s-7.6 2.1-9.6 5.5zM317.8 47.6c-3.8 6.5-5.8 14-5.8 21.6l0 2.8c0 22.1 17.9 40 40 40s40-17.9 40-40l0-2.8c0-7.6-2-15-5.8-21.6L361.6 5.5C359.6 2.1 356 0 352 0s-7.6 2.1-9.6 5.5L317.8 47.6zM128 176c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48c-35.3 0-64 28.7-64 64l0 71c8.3 5.2 18.1 9 28.8 9c13.5 0 27.2-6.1 38.4-13.4c5.4-3.5 9.9-7.1 13-9.7c1.5-1.3 2.7-2.4 3.5-3.1c.4-.4 .7-.6 .8-.8l.1-.1s0 0 0 0s0 0 0 0s0 0 0 0s0 0 0 0c3.1-3.2 7.4-4.9 11.9-4.8s8.6 2.1 11.6 5.4c0 0 0 0 0 0s0 0 0 0l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c3-3.5 7.4-5.4 12-5.4s9 2 12 5.4l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c2.9-3.4 7.1-5.3 11.6-5.4s8.7 1.6 11.9 4.8c0 0 0 0 0 0s0 0 0 0s0 0 0 0l.1 .1c.2 .2 .4 .4 .8 .8c.8 .7 1.9 1.8 3.5 3.1c3.1 2.6 7.5 6.2 13 9.7c11.2 7.3 24.9 13.4 38.4 13.4c10.7 0 20.5-3.9 28.8-9l0-71c0-35.3-28.7-64-64-64l0-48c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48-64 0 0-48c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 48-64 0 0-48zM448 394.6c-8.5 3.3-18.2 5.4-28.8 5.4c-22.5 0-42.4-9.9-55.8-18.6c-4.1-2.7-7.8-5.4-10.9-7.8c-2.8 2.4-6.1 5-9.8 7.5C329.8 390 310.6 400 288 400s-41.8-10-54.6-18.9c-3.5-2.4-6.7-4.9-9.4-7.2c-2.7 2.3-5.9 4.7-9.4 7.2C201.8 390 182.6 400 160 400s-41.8-10-54.6-18.9c-3.7-2.6-7-5.2-9.8-7.5c-3.1 2.4-6.8 5.1-10.9 7.8C71.2 390.1 51.3 400 28.8 400c-10.6 0-20.3-2.2-28.8-5.4L0 480c0 17.7 14.3 32 32 32l384 0c17.7 0 32-14.3 32-32l0-85.4z" />
                                </svg>
                            </label>

                            <input type="date" class="valid" id="date" name="date">
                        </div>

                        <div>
                            <label for="email">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                    width="2em" height="2em">
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                            </label>

                            <input type="email" class="valid" id="email" name="email" placeholder="Email"
                                autocomplete="off" spellcheck="false">
                        </div>

                        <div>
                            <label for="phone">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6" width="2em" height="2em">
                                    <path fill-rule="evenodd"
                                        d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>

                            <input type="tel" class="valid" id="phone" name="phone" placeholder="Phone Number"
                                autocomplete="off" spellcheck="false">
                        </div>

                        <button type="submit" name="update_account">Submit</button>
                    </form>

                    <button class="flip-btn" onclick="flipForm()">User Info</button>
                </div>

                <div class="acc-image">
                    <form enctype="multipart/form-data">
                        <label for="avt">
                            <img src='<?php if (empty($_SESSION['account']['avt'])) echo "./src/assets/images/no-avt.jpg";
                                        else echo $_SESSION['account']['avt']; ?>' alt="">
                            <div>Choose Image</div>
                        </label>

                        <input type="file" id="avt" name="avt">

                        <span><?php echo $_SESSION['account']['username']; ?></span>

                        <button name="upload_avt">
                            <span>Upload</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class='dialog'>
        <div id="order-detail-content">
            <img class="order-img"
                src="https://product.hstatic.net/200000182297/product/3_0b22ab20dd3c4733be2fb0c9415a23fb_master.jpg"
                alt="">

            <div class="order-info">
                <div class="info">
                    <span class="title order-code">Order: ADF623127D</span>
                    <span class="order-date">12/3/2025 20:1:13</span>
                    <span>
                        <span class="order-payment">COD - </span>
                        <span class="order-status">Pending</span>
                    </span>
                </div>

                <div class="info">
                    <span class="addr">Ha Noi</span>
                    <span class="email">domanhtung@gmail.com</span>
                    <span class="tel">0123456789</span>
                    <span class="message">Đơn hàng chưa thanh toán</span>
                </div>
            </div>

            <div class="vr"></div>

            <div class="product-info">
                <div class="info">
                    <span class="title name">Quần Jeans Lửng</span>
                    <span class="code" style="font-size: 1.2em;">AD7712</span>
                    <span class="size">Size: XL</span>
                </div>

                <div class="item">
                    <div class="price">
                        <span class="price-new">399,000đ</span>
                        <span class="price-old">799,000đ</span>
                    </div>
                </div>

                <div class="info">
                    <span class="qty">Quantity: 1</span>
                    <span class="title total">Total: 399,000đ</span>
                </div>
            </div>
        </div>

        <div id="cancel-order-form">
            <form action="?mod=pages&controller=account&act=cancelOrder" method="POST">
                <h2>Cancel Order Reason</h2>

                <div id="list-reason">
                    <input type="radio" id="cancel1" name="cancel_reason" value="Change your mind" required>
                    <label for="cancel1">I don't want to buy this product anymore</label>

                    <input type="radio" id="cancel2" name="cancel_reason" value="Product damage during transportation"
                        required>
                    <label for="cancel2">This product is damaged or not as described</label>

                    <input type="radio" id="cancel3" name="cancel_reason" value="Confusion when ordering" required>
                    <label for="cancel3">I'm confused when ordering this product</label>

                    <input type="radio" id="cancel4" name="cancel_reason" value="Delivery time too long" required>
                    <label for="cancel4">Delivery time is too long, and I'm not sure if I will receive it on
                        time</label>

                    <input type="radio" id="cancel5" name="cancel_reason" value="Unable to pay" required>
                    <label for="cancel5">Unable to pay for the product</label>
                </div>

                <input type="hidden" name="order_code" value="">

                <button type="submit" name="cancel_order" value="cancel_order_submit">Submit</button>
            </form>
        </div>

        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1' stroke='currentColor'
            class='size-6'>
            <path stroke-linecap='round' stroke-linejoin='round'
                d='m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
        </svg>
    </div>

    <div class="order-container">
        <div class="order-title">
            <h1>Order History</h1>
        </div>

        <?php
        if (empty($_SESSION['order'])) { ?>
        <div class="cart-container">
            <div class="cart-content-empty hidden-bot">
                <div class="icon">
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/lwumwgrp.json" trigger="loop" state="morph-fill"
                        colors="primary:#ffc738,secondary:#f24c00,tertiary:#d1e3fa" style="width:250px;height:250px">
                    </lord-icon>
                </div>

                <p>Looks like you haven't added any order yet.</p>

                <a href="?">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" width="2.5em"
                        height="2.5em">
                        <path
                            d="M547.6 103.8L490.3 13.1C485.2 5 476.1 0 466.4 0L109.6 0C99.9 0 90.8 5 85.7 13.1L28.3 103.8c-29.6 46.8-3.4 111.9 51.9 119.4c4 .5 8.1 .8 12.1 .8c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.2 0 49.3-11.4 65.2-29c16 17.6 39.1 29 65.2 29c4.1 0 8.1-.3 12.1-.8c55.5-7.4 81.8-72.5 52.1-119.4zM499.7 254.9c0 0 0 0-.1 0c-5.3 .7-10.7 1.1-16.2 1.1c-12.4 0-24.3-1.9-35.4-5.3L448 384l-320 0 0-133.4c-11.2 3.5-23.2 5.4-35.6 5.4c-5.5 0-11-.4-16.3-1.1l-.1 0c-4.1-.6-8.1-1.3-12-2.3L64 384l0 64c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-64 0-131.4c-4 1-8 1.8-12.3 2.3z" />
                    </svg>

                    <p>Continue shopping</p>
                </a>
            </div>
        </div>
        <?php } else { ?>
        <div style="width: 100%;">
            <table class="order-content">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($_SESSION['order'] as $key => $order) { ?>
                    <tr>
                        <td><?php echo $order['code']; ?></td>
                        <td>
                            <?php
                                    $sql = "SELECT * FROM product as p WHERE p.pcode = '{$order['product']}'";
                                    $filter = db_fetch_array($sql);
                                    echo mb_convert_case($filter[0]['name'], MB_CASE_TITLE);
                                    ?>
                        </td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo currency_format($order['total']); ?></td>
                        <td>
                            <?php
                                    $date = date_create($order['order_date']);
                                    echo date_format($date, "F j, Y");
                                    ?>
                        </td>
                        <td><?php echo $order['status']; ?></td>
                        <td>
                            <button class="order-detail" data-order-code="<?php echo $order['code']; ?>">Detail</button>
                            <button class="cancel-order"
                                data-cancel-order="<?php echo $order['code']; ?>">Cancel</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>

    <?php if (!empty($_SESSION['cancel_order'])) { ?>
    <div class="cancel-container">
        <div class="cancel-title">
            <h1>Cancel Order</h1>
        </div>

        <div style="width: 100%;">
            <table class="cancel-content">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($_SESSION['cancel_order'] as $key => $cancel) { ?>
                    <tr>
                        <td><?php echo $cancel['order_code']; ?></td>
                        <td>
                            <?php
                                    $date = date_create($cancel['date']);
                                    echo date_format($date, "H:i:s d/m/Y");
                                    ?>
                        </td>
                        <td><?php echo $cancel['reason']; ?></td>
                        <td>
                            <button class="order-detail"
                                data-order-code="<?php echo $cancel['order_code']; ?>">Detail</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</main>

<?php get_footer(); ?>

<script src="./src/lib/validation.js"></script>

<script>
//! ========== Flip Form ==========
function flipForm() {
    let formFlip = document.querySelector('.account-container');
    formFlip.classList.toggle('flip');
}

//! ========== Empty Info ==========
let gender = document.querySelector('.gender');
let birthday = document.querySelector('.birthday');

let emptyGender = <?php
                        if (empty($_SESSION['account']['gender'])) echo 0;
                        else echo 1;
                        ?>;
let emptyBirthday = <?php
                        if ($_SESSION['account']['birthday'] == '0000-00-00') echo 0;
                        else echo 1;
                        ?>;

if (emptyGender) {
    if (gender.lastElementChild.classList.contains('create'))
        gender.lastElementChild.classList.remove('create');
} else {
    gender.lastElementChild.classList.add('create');
}


if (emptyBirthday) {
    if (birthday.lastElementChild.classList.contains('create'))
        birthday.lastElementChild.classList.remove('create');
} else {
    birthday.lastElementChild.classList.add('create');
}

//! ========== Ajax Handle ==========
$(document).ready(function() {
    //! ========== Change Avt ==========
    $('input[type=file]').each(function() {
        $(this).on('change', function() {
            let avt = this.files[0];
            let name = $(this).val().split('\\').pop();
            let extension = name.split('.').pop();

            let allowTypes = ['png', 'jpg', 'jpeg'];
            if ($.inArray(extension, allowTypes) !== -1) {
                let allowSize = 1024 * 1024 * 20;

                if (avt.size > allowSize) {
                    $('.alert-fixed').append(error_alert_jq(
                        "File allow accept the size image small than 20MB!"));

                    close_alert_jq();
                } else {
                    let formData = new FormData();
                    formData.append('avt', avt);

                    $.ajax({
                        url: '?mod=pages&controller=account&act=avt',
                        method: 'POST',
                        data: formData,
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('.loading').css('display', 'flex');
                        },
                        success: function(response) {
                            $('.loading').css('display', 'none');

                            $('.alert-fixed').append(success_alert_jq(
                                "Change avatar success!"));

                            close_alert_jq();

                            $('.acc-image img').attr('src', response);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.status);
                            console.log(status);
                            console.log(error);
                        }
                    });
                }
            } else {
                $('.alert-fixed').append(error_alert_jq(
                    "File allow accept the extend file: .png, .jpg, .jpeg!"));

                close_alert_jq();
            }
        });
    });

    $('.acc-image button').each(function() {
        $(this).on('click', function(e) {
            e.preventDefault();

            $(this).parent().children(':first').trigger('click');
        });
    });

    //! ========== Update UserInfo ==========
    $('.acc-back .acc-content form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();
        $.ajax({
            url: '?mod=pages&controller=account&act=info_update',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.name || response.date || response.email || response.phone) {
                    for (let key in response) {
                        $('.alert-fixed').append(error_alert_jq(response[key]));

                        close_alert_jq();
                    }
                }

                if (response.warning) {
                    $('.alert-fixed').append(info_alert_jq(response.warning));

                    close_alert_jq();
                }

                if (response.success) {
                    $('.alert-fixed').append(success_alert_jq(response.success));

                    close_alert_jq();

                    for (let key in response.info) {
                        $('.acc-front .acc-content').children("." + key).children('span')
                            .text(response.info[key]);
                    }

                    $('.acc-back .acc-content form input:not(input[type=radio])').val('');
                    $('.acc-back .acc-content form input[type=radio]:checked').prop(
                        'checked', false);
                    $('.acc-back .acc-content button.flip-btn').trigger('click');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.status);
                console.log(status);
                console.log(error);
            },
        });
    });

    //! ========== Valid - Invalid Input ==========
    $('.valid').each(function() {
        $(this).on('input focus', function() {
            value = $(this).val();

            if ($(this).attr('id') == 'name' && name_regex_jq(value))
                $(this).css('box-shadow', '0 0 0 2px #0a7b5d');
            else if ($(this).attr('id') == 'date' && date_regex_jq(value))
                $(this).css('box-shadow', '0 0 0 2px #0a7b5d');
            else if ($(this).attr('id') == 'email' && email_regex_jq(value))
                $(this).css('box-shadow', '0 0 0 2px #0a7b5d');
            else if ($(this).attr('id') == 'phone' && phone_regex_jq(value))
                $(this).css('box-shadow', '0 0 0 2px #0a7b5d');
            else
                $(this).css('box-shadow', '0 0 0 2px #ff4000');
        });

        $(this).on('blur', function() {
            $(this).css('box-shadow', '0 0 0 2px #0a7b5d');
        });
    });

    //! ========== Limit Order ==========
    if ($('.order-content tbody tr').length > 5) {
        $('.order-content').parent().addClass('limit-order');

        $('.order-content tbody').css({
            'overflow-y': 'scroll',
            'height': $('.order-content tbody tr').first().innerHeight() * 5 + 'px',
        });
    }

    //! ========== Limit Cancel ==========
    if ($('.cancel-content tbody tr').length > 5) {
        $('.cancel-content').parent().addClass('limit-order');

        $('.cancel-content tbody').css({
            'overflow-y': 'scroll',
            'height': $('.cancel-content tbody tr').first().innerHeight() * 5 + 'px',
        });
    }
});

//! ========== Order Success Alert ==========
let orderSuccess = "<?php echo $ordered; ?>";
let orderFailed = "<?php echo $order_fail; ?>";

if (orderSuccess) {
    if (orderFailed) {
        $('.alert-fixed').append(error_alert_jq(orderFailed));
        close_alert_jq();
    } else {
        $('.alert-fixed').append(success_alert_jq(orderSuccess));
        close_alert_jq();
    }

    let orderHistory = document.querySelector('.order-container');

    // Scroll to Order History
    window.scroll({
        top: orderHistory.offsetTop,
        behavior: 'smooth'
    });

    // Update URL
    let url = new URL(window.location.href);
    url.searchParams.delete('order');
    window.history.replaceState({}, '', url);
}

//! ========== Cancel Order Success Alert ==========
let cancelSuccess = "<?php echo $canceled; ?>";

if (cancelSuccess) {
    $('.alert-fixed').append(success_alert_jq(cancelSuccess));
    close_alert_jq();

    let cancelHistory = document.querySelector('.cancel-container');

    window.scroll({
        top: cancelHistory.offsetTop,
        behavior: 'smooth'
    });

    let url = new URL(window.location.href);
    url.searchParams.delete('cancel_order');
    window.history.replaceState({}, '', url);
}

//! ========== Order Detail ==========
let orderDetail = document.querySelectorAll('.order-detail');
let dialog = document.querySelector('.dialog');
let exit = dialog.querySelector('svg');

orderDetail.forEach(detail => {
    detail.addEventListener('click', function() {
        let load;
        let orderCode = this.getAttribute('data-order-code');

        let data = {
            order_code: orderCode
        };

        $.ajax({
            url: '?mod=pages&controller=account&act=orderDetail',
            method: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                load = setTimeout(function() {
                    $('.loading').css('display', 'flex');
                }, 500);
            },
            success: function(response) {
                $('.loading').css('display', 'none');
                clearTimeout(load);

                $('.order-img').attr('src', response.order_img);
                $('.order-code').text("Order: " + response.order_code);
                $('.order-date').text(response.order_date);
                $('order-payment').text(response.order_payment + " - ");
                $('.order-status').text(response.order_status);
                $('.addr').text(response.addr);
                $('.email').text(response.email);
                $('.tel').text(response.tel);
                if (response.message)
                    $('.message').text(response.message);
                else
                    $('.message').css('display', 'none');
                $('.name').text(response.product_name);
                $('.code').text("Code: " + response.product_code);
                $('.size').text("Size: " + response.product_size);
                if (response.product_price_new !== "0đ") {
                    $('.price-new').text(response.product_price_new);
                    $('.price-old').text(response.product_price_old);
                } else {
                    $('.price-new').text(response.product_price_old);
                    $('.price-old').text(' ');
                }
                $('.qty').text("Qty: " + response.product_quantity);
                $('.total').text("Total: " + response.order_total);
            },
            error: function(xhr, status, error) {
                console.log(xhr.status);
                console.log(status);
                console.log(error);
            }
        });

        dialog.style.width = "100%";
        dialog.style.height = "100%";
        dialog.style.opacity = "1";
        dialog.style.zIndex = 9999;
        dialog.querySelector("#order-detail-content").style.display = "flex";
        exit.style.display = "block";

        exit.addEventListener('click', () => {
            dialog.style.width = "0";
            dialog.style.height = "0";
            dialog.style.opacity = "0";
            dialog.style.zIndex = -1;
            dialog.querySelector("#order-detail-content").style.display = "none";
            exit.style.display = "none";

            $('.message').css('display', 'block');
        });
    });
});

//! ========== Cancel Order ==========
let cancelOrder = document.querySelectorAll('.cancel-order');

cancelOrder.forEach(cancel => {
    cancel.addEventListener('click', function() {
        let orderCode = this.getAttribute('data-cancel-order');

        dialog.style.width = "100%";
        dialog.style.height = "100%";
        dialog.style.opacity = "1";
        dialog.style.zIndex = 9999;
        dialog.querySelector("#cancel-order-form").style.display = "flex";
        exit.style.display = "block";

        exit.addEventListener('click', () => {
            dialog.style.width = "0";
            dialog.style.height = "0";
            dialog.style.opacity = "0";
            dialog.style.zIndex = -1;
            dialog.querySelector("#cancel-order-form").style.display = "none";
            exit.style.display = "none";
        });

        dialog.querySelector("#cancel-order-form form").addEventListener("submit", function(e) {
            $('input[type=hidden]').val(orderCode);
        });
    });
});
</script>