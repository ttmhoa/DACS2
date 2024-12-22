<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <!-- "departments"=>$teo->Get_departments(),-->
                        <span>All departments</span>
                    </div>
                    <ul>
                        <?php while ($row = mysqli_fetch_array($data["departments"])) { ?>
                            <li><a href="#"><?php echo $row["name"]; ?></a></li>
                        <?php } ?>
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
                            <input type="text" name="search_name" id="search_name" class="form-control" placeholder="What do you need?">
                            <!-- <button type="submit" class="site-btn">SEARCH</button> -->
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
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            <!--      "departments_body"=>$teo->Get_departments(), -->
                            <?php while ($row = mysqli_fetch_array($data["departments_body"])) { ?>
                                <li><a href="#"><?php echo $row["name"]; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item sidebar__item__color--option">
                        <h4>Colors</h4>
                        <div class="sidebar__item__color sidebar__item__color--white">
                            <label for="white">
                                White
                                <input type="radio" id="white">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--gray">
                            <label for="gray">
                                Gray
                                <input type="radio" id="gray">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--red">
                            <label for="red">
                                Red
                                <input type="radio" id="red">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--black">
                            <label for="black">
                                Black
                                <input type="radio" id="black">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--blue">
                            <label for="blue">
                                Blue
                                <input type="radio" id="blue">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--green">
                            <label for="green">
                                Green
                                <input type="radio" id="green">
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <h4>Popular Size</h4>
                        <div class="sidebar__item__size">
                            <label for="large">
                                Large
                                <input type="radio" id="large">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="medium">
                                Medium
                                <input type="radio" id="medium">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="small">
                                Small
                                <input type="radio" id="small">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="tiny">
                                Tiny
                                <input type="radio" id="tiny">
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">

                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-product__slider owl-carousel">
                                <!-- "feature"=>$teo->get3latest(), -->
                                <div class="latest-prdouct__slider__item">
                                    <?php while ($row4 = mysqli_fetch_array($data["feature"])) { ?>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $row4['image']; ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo $row4['title']; ?></h6>
                                                <span>$<?php echo $row4['price']; ?></span>
                                            </div>
                                        </a>
                                    <?php } ?>

                                </div>
                                <!-- "feature2"=>$teo->get3related(), -->
                                <div class="latest-prdouct__slider__item">
                                    <?php while ($row5 = mysqli_fetch_array($data["feature2"])) { ?>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $row5['image']; ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo $row5['title']; ?></h6>
                                                <span>$<?php echo $row5['price']; ?></span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Products Search</h2>
                    </div>
                    <div class="container">
                        <div class="row" id="output_search">
                            

                        </div>
                    </div>
                    <!-- ========================================================== -->

                </div>
                <!-- row gt index -->
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>16</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sp -->
                <div class="row">
                    <!-- "Products"=>$teo->phantrang(), -->
                    <?php while ($row5 = mysqli_fetch_array($data["Products"]['products'])) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo $row5['image']; ?>">
                                    <ul class="product__item__pic__hover">
                                    <li><a href="/shopdetailcontroller/Viewnews/shopdetail/<?php echo $row5['id']; ?>">
                                         <i class="fa-solid fa-eye" style="color: #06000a;"></i>
                                     </a></li>
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="/shopCardcontroller/store/<?php echo $row5['id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?php echo $row5['title']; ?></a></h6>
                                    <h5><?php echo $row5['price']; ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="product__pagination">

                    <?php
                    for ($i = 1; $i <= $data["Products"]['totalPages']; $i++) { ?>
                        <a href="/shopcontroller/phantrang_click/shop/<?php echo $i; ?>"><?= $i ?></a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>
