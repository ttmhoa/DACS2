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
                    <h2>Blog</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#" id="searchForm">
                            <input type="text" name="search_name" id="search_name" class="form-control" placeholder="What do you need?">
                        </form>




                    </div>

                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="/ogani-master/MVC/views/pages/crateblog.php">Create Blog</a></li>
                            <li><a href="/blogcontroller/showBlog">All</a></li>
                            <li><a class="search_Type" data-value="Beauty">Beauty</a></li>
                            <li><a class="search_Type" data-value="Food">Food</a></li>
                            <li><a class="search_Type" data-value="Vegetables">Vegetables (9)</a></li>
                            <li><a class="search_Type" data-value="Fruit">Fruit</a></li>
                        </ul>

                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="/ogani-master/img/blog/sidebar/sr-1.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="/ogani-master/img/blog/sidebar/sr-2.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>Tips You To Balance<br /> Nutrition Meal Day</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="/ogani-master/img/blog/sidebar/sr-3.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>4 Principles Help You Lose <br />Weight With Vegetables</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Search By</h4>
                        <div class="blog__sidebar__item__tags">
                            <a href="#">Apple</a>
                            <a href="#">Beauty</a>
                            <a href="#">Vegetables</a>
                            <a href="#">Fruit</a>
                            <a href="#">Healthy Food</a>
                            <a href="#">Lifestyle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="product__discount">
                    <!-- <div class="section-title product__discount__title">
                        <h2>Products Search</h2>
                    </div>
                    <div class="container">
                        <div class="row" id="output_search">


                        </div>
                    </div>
                    <hr /> Đường kẻ ngang -->

                    <!-- ========================================================== -->

                </div>
                <div class="section-title product__discount__title">
                    <h2>List Blog</h2>
                </div> <?php if (isset($data['listblog']) && is_array($data['listblog']) && !empty($data['listblog'])): ?>
                    <div class="row" id="row">
                        <?php foreach ($data['listblog'] as $blog): ?>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="<?php echo $blog['image']; ?>" alt="Blog Image">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i><?php echo date('d-m-Y H:i', strtotime($blog['created_at'])); ?></li>
                                            <li><i class="fa fa-comment-o"></i> <?php echo $blog['count_comment']; ?></li>
                                        </ul>
                                        <h5><a href="<?php echo "/blogDetailcontroller/getBlog/" . $blog['id']; ?>"><?php echo htmlspecialchars($blog['title']); ?></a></h5>
                                        <p><?php echo $blog['descript']; ?></p>
                                        <!-- Liên kết đọc thêm -->
                                        <a href="#" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Danh sách blog rỗng hoặc có lỗi khi lấy dữ liệu.</p>
                <?php endif; ?>
            </div>

        </div>


        <div class="col-lg-12">
            <div class="product__pagination blog__pagination">
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</section>
<script type="text/javascript">
    document.getElementById("search_name").addEventListener("input", async function(event) {
        event.preventDefault(); // Ngăn chuyển trang khi người dùng nhập

        const search_name = this.value; // Lấy giá trị từ trường input với name="search_name"

        if (!search_name) {
            console.log("Vui lòng nhập từ khóa tìm kiếm.");
            return; // Nếu không có giá trị, không gửi yêu cầu
        }

        try {
            const response = await fetch("/blogcontroller/search", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    search_name: search_name // Gửi dữ liệu dưới dạng JSON
                }),
            });

            const responseText = await response.text(); // Đọc phản hồi dưới dạng văn bản

            // Kiểm tra nếu phản hồi rỗng
            if (!responseText) {
                console.error("Phản hồi từ server rỗng");
                alert("Không nhận được dữ liệu từ server.");
                return;
            }

            // Kiểm tra nếu phản hồi là JSON hợp lệ
            try {
                const data = JSON.parse(responseText);

                if (data.success) {
                    const rowElement = document.getElementById("row");
                    if (rowElement) {
                        rowElement.innerHTML = data.html; // Giả sử server trả về HTML trong data.html
                        rowElement.hidden = false;
                    } else {
                        console.error("Phần tử #row không tồn tại.");
                    }
                } else {
                    alert("Không tìm thấy kết quả.");
                }
            } catch (jsonError) {
                console.error("Lỗi khi parse JSON:", jsonError);
                console.log("Phản hồi từ server:", responseText); // In ra nội dung phản hồi từ server
                alert("Lỗi khi phân tích dữ liệu từ server.");
            }

        } catch (error) {
            console.error("Fetch error:", error);
            alert("Lỗi khi kết nối tới Server: " + error.message);
        }
    });


    document.querySelectorAll(".search_Type").forEach(function(element) {
        element.addEventListener("click", async function(event) {
            event.preventDefault(); // Ngăn chuyển trang

            // Lấy giá trị từ thuộc tính data-value
            const category = this.getAttribute("data-value");

            try {
                const response = await fetch("/blogcontroller/search_Type", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        search_name: category
                    }),
                });

                if (!response.ok) {
                    throw new Error("Lỗi kết nối tới Server");
                }

                const data = await response.json();

                // Kiểm tra nếu data.success và cập nhật nội dung
                if (data.success) {
                    const rowElement = document.getElementById("row");
                    if (rowElement) {
                        rowElement.innerHTML = data.html; // Giả sử server trả về HTML ở data.html
                        rowElement.hidden = false;
                    } else {
                        console.error("Phần tử #row không tồn tại.");
                    }
                } else {
                    alert("Không tìm thấy kết quả.");
                }
            } catch (error) {
                console.error("Fetch error:", error);
                alert("Lỗi khi kết nối tới Server: " + error.message);
            }
        });
    });
</script>


<!-- Blog Section End -->