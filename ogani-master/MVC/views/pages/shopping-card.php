<?php
if (isset($_SESSION['error_message'])) {
    echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
    unset($_SESSION['error_message']); // Xóa thông điệp sau khi hiển thị
}
?>
<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <li><a href="#">Fresh Meat</a></li>
                        <li><a href="#">Vegetables</a></li>
                        <li><a href="#">Fruit & Nut Gifts</a></li>
                        <li><a href="#">Fresh Berries</a></li>
                        <li><a href="#">Ocean Foods</a></li>
                        <li><a href="#">Butter & Eggs</a></li>
                        <li><a href="#">Fastfood</a></li>
                        <li><a href="#">Fresh Onion</a></li>
                        <li><a href="#">Papayaya & Crisps</a></li>
                        <li><a href="#">Oatmeal</a></li>
                        <li><a href="#">Fresh Bananas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="/ogani-master/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <form action="/shopCardcontroller/update" method="post">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data['product'])) : foreach ($data['product'] as $product): ?>
                                    
                                        <tr>

                                            <td class="shoping__cart__item">
                                                <img style="width: 100px;" src="<?php echo $product['image'] ?>" alt="">
                                                <h5><?php echo $product['title'] ?></h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                $<?php echo $product['price'] ?>
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input   type="number" name="qty[<?php echo $product['id'] ?>]" value="<?php echo $product['qty'] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                <?php
                                                $total = $product['qty'] * $product['price'];
                                                echo $total;
                                                ?>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="/shopCardcontroller/delete/<?php echo $product['id'] ?>"><i class="fa-solid fa-trash " style="color: #010204;"></i></a>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>

                            </tbody>
                        </table>
                        <a class="primary-btn cart-btn" href="/shopCardcontroller/destroy">Delete my cart</a>
                        <button style="border: none;" class="primary-btn cart-btn cart-btn-right ">Upadate Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="/Hom" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>

                        <li>Subtotal <span>
                                <?php
                                
                                $total = 0; // Khởi tạo biến tổng
                                if (!empty($data['product'])) :
                                    foreach ($data['product'] as $product):
                                        $total += $product['qty'] * $product['price']; // Cộng dồn vào tổng
                                    endforeach;
                                endif;
                                $_SESSION['total'] = $total;
                                echo $_SESSION['total']; // In tổng sau vòng lặp
                                ?>
                            </span></li>
                        
                    </ul>
                    <a href="/checkoutcontroller" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
 