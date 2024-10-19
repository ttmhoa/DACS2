<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Dangki</title>
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
    <link rel="stylesheet" href="/ogani-master/public/css/log-sign.css" type="text/css">



</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="container">
            <div class="header-top sticky">

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
                                    <li><a href="/shopCardcontroller">Shoping Cart</a></li>
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
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
</header>
        </div>
            <div class="signup-container">
                <h2>Tạo tài khoản mới</h2>
                <form id="signup-form" action="#">
                    <input type="text" id="new-username" placeholder="Tên đăng nhập" required>
                    <input type="password" id="new-password" placeholder="Mật khẩu" required>
                    <input type="password" id="confirm-password" placeholder="Xác nhận mật khẩu" required>
                    <input type="submit" value="Đăng ký">
                </form>
                <div id="success-message" class="success-message"></div>
                <div class="login-link">
                    <p>Đã có tài khoản? <a href="./dangnhap.html">Đăng nhập ngay</a></p>
                </div>
            </div>
            <!-- =========Sử dụng js để đăng ký tài khoản-->
            <script>
                document.getElementById("signup-form").addEventListener("submit", function(event) {
                    event.preventDefault();
                    var newUsername = document.getElementById("new-username").value;
                    var newPassword = document.getElementById("new-password").value;
                    var confirmPassword = document.getElementById("confirm-password").value;
                    var successMessage = document.getElementById("success-message");

                    // Kiểm tra xác nhận mật khẩu
                    if (newPassword !== confirmPassword) {
                        successMessage.textContent = "Mật khẩu xác nhận không khớp!";
                        return;
                    }

                    setTimeout(function() {
                        successMessage.textContent = "Tạo tài khoản thành công!";
                        alert("Tài khoản được đăng ký thành công");
                        setTimeout(function() {
                            window.location.href = "trangchu.html";
                        }, 2000); // Chuyển hướng sau 2 giây
                    }, 1000);
                });
            </script>
        </div>

    <!-- Tablet/mobile header -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="#"><img src="/ogani-master/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="/ogani-master/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
<!-- max layout -->