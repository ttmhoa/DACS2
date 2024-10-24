
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/ogani-master/public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/ogani-master/public/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="/ogani-master/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="/ogani-master/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanish</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
            <li>Email: <?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Chưa đăng nhập'; ?></li>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/Hom">Home 1</a></li>
                <li><a href="/shopcontroller">Shop</a></li>
                <li><a href="/Hom">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="/shopdetailcontroller">Shop Details</a></li>
                        <li><a href="/shopCardcontroller">Shopping Cart</a></li>
                        <li><a href="/checkoutcontroller">Check Out</a></li>
                        <li><a href="/blogDetailcontroller">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="/blogcontroller">Blog</a></li>
                <li><a href="/contactcontroller">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
            <li>Email: <?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Chưa đăng nhập'; ?></li>
            <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                            <li>Hello,<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Chưa đăng nhập'; ?></li>
                            <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="#" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                    <a href="/loginController/logout"><i class="fa fa-user"></i> Logout</a>
                                    <a href="/ogani-master/MVC/views/login.php"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="#"><img src="/ogani-master/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/Hom">Home</a></li>
                            <li><a href="/shopcontroller">Shop</a></li>
                            <li><a href="/Hom">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="/shopdetailcontroller">Shop Details</a></li>
                                    <li><a href="/shopCardcontroller">Shopping Cart</a></li>
                                    <li><a href="/checkoutcontroller">Check Out</a></li>
                                    <li><a href="/blogDetailcontroller">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="/blogcontroller">Blog</a></li>
                            <li><a href="/contactcontroller">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <?php include 'pages/'.$data["page"].'.php'; ?>
    
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="/ogani-master/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>myhoa@mail.com</li>
<!-- Thêm địa chỉ email vào đây -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Our Services</h6>
                        <ul>
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">Sed nisl eros</a></li>
                            <li><a href="#">Curabitur tortor</a></li>
                            <li><a href="#">Pellentesque dignissim</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Newsletter</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your email">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/ogani-master/public/js/jquery-3.3.1.min.js"></script>
    <script src="/ogani-master/public/js/bootstrap.min.js"></script>
    <script src="/ogani-master/public/js/jquery.nice-select.min.js"></script>
    <script src="/ogani-master/public/js/jquery-ui.min.js"></script>
    <script src="/ogani-master/public/js/jquery.slicknav.js"></script>
    <script src="/ogani-master/public/js/mixitup.min.js"></script>
    <script src="/ogani-master/public/js/owl.carousel.min.js"></script>
    <script src="/ogani-master/public/js/main.js"></script>
</body>

</html>
