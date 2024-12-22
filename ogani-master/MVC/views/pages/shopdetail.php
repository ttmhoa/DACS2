 <!-- Hero Section Begin -->

 <body>
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
                             <!-- php -->
                             <?php while ($row = mysqli_fetch_array($data["departments"])) { ?>
                                 <li><a href="#"><?php echo $row["name"]; ?></a></li>
                             <?php } ?>
                             <!-- end php -->
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-9">
                     <div class="hero__search">
                         <div class="hero__search__form">
                             <!-- <form action="#">
                             <div class="hero__search__categories">
                                 All Categories
                                 <span class="arrow_carrot-down"></span>
                             </div>
                             
                         </form> -->
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
                         <h2>Vegetable’s Package</h2>
                         <div class="breadcrumb__option">
                             <a href="./index.html">Home</a>
                             <a href="./index.html">Vegetables</a>
                             <span>Vegetable’s Package</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- Breadcrumb Section End -->

     <!-- Product Details Section Begin -->
     <section class="product-details spad">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-6">
                     <div class="product__details__pic">
                         <div class="product__details__pic__item">
                             <?php if ($data["detailsp"]): ?>
                                 <img style="width: 250px; height: 460px" class="product__details__pic__item--large"
                                     src="<?php echo htmlspecialchars($data["detailsp"]['image']); ?>" alt="">
                             <?php endif; ?>

                             <div class="product__details__pic__slider owl-carousel">
                                 <?php if ($data["list_sp_ct"]): ?>
                                     <?php while ($row4 = mysqli_fetch_assoc($data["list_sp_ct"])): ?>
                                         <img style="width: 250px; height: 160px;"
                                             data-imgbigurl="<?php echo htmlspecialchars($row4['image']); ?>"
                                             src="<?php echo htmlspecialchars($row4['image']); ?>"
                                             alt="Product Image"
                                             onclick="window.location.href='/shopdetailcontroller/img_click/shopdetail/<?php echo htmlspecialchars($row4['category_id']); ?>/<?php echo htmlspecialchars($row4['id']); ?>'">
                                     <?php endwhile; ?>
                                 <?php else: ?>
                                     <p>Không có sản phẩm nào để hiển thị.</p>
                                 <?php endif; ?>
                             </div>

                         </div>

                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6">
                     <div class="product__details__text">
                         <?php if ($data["detailsp2"]): ?>
                             <h3><?php echo htmlspecialchars($data["detailsp2"]['title']); ?></h3>
                             <div class="product__details__rating">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-half-o"></i>
                                 <span>(18 reviews)</span>
                             </div>
                             <div class="product__details__price">$<?php echo htmlspecialchars($data["detailsp2"]['price']); ?></div>
                             <p><?php echo htmlspecialchars($data["detailsp2"]['description']); ?></p>
                         <?php endif; ?>


                         <div class="product__details__quantity">
                             <div class="quantity">
                                 <div class="pro-qty">
                                     <input type="text" value="1">
                                 </div>
                             </div>
                         </div>
                         <a href="#" class="primary-btn">ADD TO CARD</a>
                         <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                         <ul>
                             <li><b>Availability</b> <span>In Stock</span></li>
                             <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                             <li><b>Weight</b> <span>0.5 kg</span></li>
                             <li><b>Share on</b>
                                 <div class="share">
                                     <a href="#"><i class="fa fa-facebook"></i></a>
                                     <a href="#"><i class="fa fa-twitter"></i></a>
                                     <a href="#"><i class="fa fa-instagram"></i></a>
                                     <a href="#"><i class="fa fa-pinterest"></i></a>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-12">
                     <div class="product__details__tab">
                         <ul class="nav nav-tabs" role="tablist">
                             <li class="nav-item">
                                 <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                     aria-selected="true">Description</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                     aria-selected="false">Information</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                     aria-selected="false">Reviews <span>(1)</span></a>
                             </li>
                         </ul>
                         <div class="tab-content">
                             <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                 <div class="product__details__tab__desc">
                                     <h6>Products Infomation</h6>
                                     <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                         Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                         suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                         vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                         Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                         accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                         pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                         elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                         et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                         vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                     <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                         ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                         elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                         porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                         nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                         Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                         porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                         sed sit amet dui. Proin eget tortor risus.</p>
                                 </div>
                             </div>
                             <div class="tab-pane" id="tabs-2" role="tabpanel">
                                 <div class="product__details__tab__desc">
                                     <h6>Products Infomation</h6>
                                     <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                         Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                         Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                         sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                         eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                         Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                         sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                         diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                         ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                         Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                         Proin eget tortor risus.</p>
                                     <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                         ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                         elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                         porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                         nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                 </div>
                             </div>
                             <div class="tab-pane" id="tabs-3" role="tabpanel">
                                 <style>
                                     .review-list {
                                         max-height: 400px;
                                         /* Giới hạn chiều cao */
                                         overflow-y: auto;
                                         /* Thanh cuộn dọc */
                                         margin-top: 20px;
                                         padding: 10px;
                                         background-color: #f9f9f9;
                                         border-radius: 8px;
                                         scrollbar-width: thin;
                                         /* Thanh cuộn mỏng hơn (Firefox) */
                                         scrollbar-color: #ccc #f9f9f9;
                                         /* Màu thanh cuộn (Firefox) */
                                     }

                                     .review-list::-webkit-scrollbar {
                                         width: 8px;
                                         /* Độ rộng */
                                     }

                                     .review-list::-webkit-scrollbar-thumb {
                                         background: #ccc;
                                         /* Màu thanh cuộn */
                                         border-radius: 4px;
                                         /* Bo góc */
                                     }

                                     .review-list::-webkit-scrollbar-thumb:hover {
                                         background: #aaa;
                                         /* Màu khi hover */
                                     }

                                     .review-list::-webkit-scrollbar-track {
                                         background: #f9f9f9;
                                         /* Nền thanh cuộn */
                                     }

                                     .review-item {
                                         margin-bottom: 15px;
                                         padding: 10px;
                                         border: 1px solid #ddd;
                                         border-radius: 8px;
                                         background-color: #fff;
                                     }

                                     .review-header {
                                         display: flex;
                                         justify-content: space-between;
                                         align-items: center;
                                         margin-bottom: 10px;
                                     }

                                     .user-info {
                                         display: flex;
                                         align-items: center;
                                         gap: 10px;
                                     }

                                     .user-avatar {
                                         width: 50px;
                                         height: 50px;
                                         border-radius: 50%;
                                         object-fit: cover;
                                         border: 2px solid #ccc;
                                     }

                                     .name {
                                         font-weight: bold;
                                         font-size: 16px;
                                     }

                                     .stars {
                                         color: #ffc107;
                                         font-size: 14px;
                                     }

                                     .date {
                                         font-size: 12px;
                                         color: #888;
                                     }

                                     .review-content p {
                                         margin: 0;
                                         font-size: 14px;
                                         line-height: 1.5;
                                     }

                                     .review-footer {
                                         display: flex;
                                         gap: 10px;
                                         /* Khoảng cách giữa ảnh và video */
                                     }

                                     .review-footer img,
                                     .review-footer video {
                                         width: 120px;
                                         height: 120px;
                                         object-fit: cover;
                                         /* Cắt nội dung vừa khung */
                                         border-radius: 5px;
                                         /* Bo góc */
                                     }
                                 </style>
                                 <div class="review-list">
                                     <?php if (!empty($data['reviews'])): ?>
                                         <?php foreach ($data['reviews'] as $review): ?>
                                             <div class="review-item">
                                                 <div class="review-header">
                                                     <div class="user-info">
                                                         <img src="<?php echo $review['user_Infor']; ?>" class="user-avatar" alt="User Avatar">
                                                         <div>
                                                             <div class="name"><?php echo $review['fullname']; ?></div>
                                                             <div class="stars">
                                                                 <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                     <?php echo $i <= $review['rating'] ? '★' : '☆'; ?>
                                                                 <?php endfor; ?>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="date"><?php echo date('d-m-Y H:i', strtotime($review['review_date'])); ?></div>
                                                 </div>
                                                 <div class="review-content">
                                                     <p><?php echo $review['comment']; ?></p>
                                                 </div>
                                                 <div class="review-footer">
                                                     <?php if (!empty($review['review_image'])): ?>
                                                         <img src="<?php echo $review['review_image']; ?>" alt="Sản phẩm" width="100" height="100">
                                                     <?php endif; ?>
                                                     <?php if (!empty($review['review_video'])): ?>
                                                         <video src="<?php echo $review['review_video']; ?>" type="video/mp4" width="100" height="100" controls></video>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
                                         <?php endforeach; ?>
                                     <?php else: ?>
                                         <p>Không có đánh giá nào để hiển thị.</p>
                                     <?php endif; ?>
                                 </div>
                             </div>

                             <!-- Review List Section End -->

                             <!-- Related Product Section Begin -->
                             <section class="related-product">
                                 <div class="container">
                                     <div class="row">
                                         <div class="col-lg-12">
                                             <div class="section-title related__product__title">
                                                 <h2>Related Product</h2>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="row">
                                         <?php if (!empty($data["departmentlist"])): ?>
                                             <?php while ($row = mysqli_fetch_array($data["departmentlist"])): ?>
                                                 <div class="col-lg-3 col-md-4 col-sm-6">
                                                     <div class="product__item">
                                                         <div class="product__item__pic set-bg" data-setbg="<?php echo htmlspecialchars($row["image"]); ?>">
                                                             <ul class="product__item__pic__hover">
                                                                 <li>
                                                                     <a href="/Hom/Viewnews/news/<?php echo $row['id']; ?>">
                                                                         <i class="fa-solid fa-eye" style="color: #06000a;"></i>
                                                                     </a>
                                                                 </li>
                                                                 <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                                 <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                                 <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                             </ul>
                                                         </div>
                                                         <div class="product__item__text">
                                                             <h6>
                                                                 <a href="/shopdetailcontroller/Detail_sp/shopdetail/<?php echo $row['id']; ?>">
                                                                     <?php echo htmlspecialchars($row["name"]); ?>
                                                                 </a>
                                                             </h6>
                                                             <h5>SL</h5>
                                                         </div>
                                                     </div>
                                                 </div>
                                             <?php endwhile; ?>
                                         <?php else: ?>
                                             <p>Không có sản phẩm nào liên quan.</p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                             </section>
                             <!-- Related Product Section End -->

                         </div>
                     </div>
                 </div>
             </div>
     </section>
     <!-- Product Details Section End -->

     <!-- Related Product Section Begin -->
     <section class="related-product">
         <div class="container">
             <div class="row">
                 
             </div>

             <div class="row">
                 <?php while ($row = mysqli_fetch_array($data["departmentlist"])) { ?>
                     <div class="col-lg-3 col-md-4 col-sm-6">
                         <div class="product__item ">
                             <div class="product__item__pic set-bg" data-setbg="<?php echo $row["image"]; ?>">
                                 <ul class="product__item__pic__hover">
                                     <li><a href="/Hom/Viewnews/news/<?php echo $row['id']; ?>">
                                             <i class="fa-solid fa-eye" style="color: #06000a;"></i>
                                         </a></li>
                                     <li><a href="#"><i class="fa fa-heart "></i></a></li>
                                     <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                     <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                 </ul>
                             </div>
                             <div class="product__item__text">
                                 <h6><a href="/shopdetailcontroller/Detail_sp/shopdetail/<?php echo $row['id']; ?>"> <?php echo $row["name"]; ?></a></h6>
                                 <h5>SL</h5>
                             </div>
                         </div>
                     </div>
                 <?php } ?>
             </div>


         </div>
     </section>
     <!-- Related Product Section End -->