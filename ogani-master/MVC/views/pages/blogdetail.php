<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/ogani-master/public/css/coment.css" type="text/css">
</head>
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
                            <input type="text" name="search_name" id="search_name" class="form-control" placeholder="What do yo u need?">
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

<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="/ogani-master/img/blog/details/details-hero.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>The Moment You Need To Remove Garlic From The Menu</h2>
                    <ul>
                        <li>By Michael Scofield</li>
                        <li>January 14, 2019</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
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
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <div style="max-height: 1000px; overflow-y: scroll; overflow-x: hidden; padding-right: 10px;">
                        <?php echo ($data['contendblog']); ?>
                    </div>
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="<?php echo $data['image']; ?>" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6><?php echo $data['fullname']; ?></h6>
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span> Food</li>
                                    <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-item" id="comments">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <form>
                    <h3 class="pull-left">New Comment</h3>
                    <button type="submit" id="submitButton" class="btn btn-normal pull-right">Submit</button>
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-3 col-lg-2 hidden-xs">
                                <img class="img-responsive" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            </div>
                            <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                <textarea class="form-control" id="message" placeholder="Your message" required=""></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <h3><?php echo $data['count_comment']; ?> Comments</h3>
                <div id="commentListContainer" style="max-height: 800px; overflow-y: auto; overflow-x: hidden; padding-right: 10px; border: 1px solid #ddd; padding: 10px;">
                    <div id="commentList">
                        <?php if (!empty($data['comments'])) : ?>
                            <?php foreach ($data['comments'] as $comment): ?>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="<?php echo $comment['image']; ?>" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $comment['fullname']; ?></h4>
                                        <p><?php echo $comment['comment']; ?></p>
                                        <ul class="list-unstyled list-inline media-detail pull-left">
                                            <li><i class="fa fa-calendar"></i> <?php echo $comment['created_at']; ?></li>
                                            <li class="like-button"
                                                data-comment-id="<?php echo $comment['id']; ?>"
                                                data-user-id="<?php echo $comment['user_id']; ?>"
                                                data-likes="<?php echo $comment['like']; ?>">
                                                <!-- Kiểm tra trạng thái "like" -->
                                                <i class="fa fa-thumbs-up <?php echo $data['likeColors'][$comment['id']] == 1 ? 'text-success' : 'text-muted'; ?>"></i>
                                                <span class="like-count"><?php echo $comment['like']; ?></span>
                                            </li>
                                        </ul>
                                        <ul class="list-unstyled list-inline media-detail pull-right">
                                            <li><a href="">Reply</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>



            </div>
        </div>
</section>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
</script>

<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Post You May Like</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <style>
                .blog__item__pic img {
                    width: 100%;
                    /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của container */
                    height: 350px;
                    /* Cố định chiều cao */
                    object-fit: cover;
                    /* Giữ tỷ lệ ảnh, cắt phần thừa nếu cần */
                    border-radius: 5px;
                    /* Tùy chọn: làm mềm góc cạnh của ảnh */
                }
            </style>
            <?php foreach ($data['topBlog'] as $blog): ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="<?php echo ($blog['image']); ?>" alt="Hình ảnh bài viết">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li>
                                    <i class="fa fa-calendar-o"></i>
                                    <?php echo date("F j, Y", strtotime($blog['created_at'])); ?>
                                </li>
                                <li><i class="fa fa-comment-o"></i><?php echo ($blog['count_comment']); ?> bình luận</li>
                            </ul>
                            <h5><a href="#"><?php echo ($blog['title']); ?></a></h5>
                            <p><?php echo ($blog['descript']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
    // Xử lý sự kiện khi nhấn nút "submit"
    document.getElementById("submitButton").addEventListener('click', async function(event) {
        event.preventDefault();
        const pathArray = window.location.pathname.split('/');
        const blog_id = pathArray[pathArray.length - 1];
        let commentInput = document.getElementById('message').value;

        try {
            const response = await fetch('/blogDetailcontroller/comment', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    comment: commentInput,
                    blog_id: blog_id
                })
            });

            if (!response.ok) {
                throw new Error("Lỗi kết nối tới server");
            }

            const data = await response.json();
            if (data.success) {
                addToComment(data);
                document.getElementById('message').value = "";
            } else {
                console.error("Server response error:", data.message);
                alert("Lỗi khi gửi bình luận: " + data.message);
            }
            if (data.message === "User chưa đăng nhập") {
                window.location.href = "/ogani-master/MVC/views/login.php";
            }
        } catch (error) {
            console.error("Fetch error:", error);
            alert('Lỗi khi gửi bình luận: ' + error.message);
        }
    });

    // Hàm thêm bình luận mới vào danh sách
    function addToComment(data) {
        const commentList = document.getElementById('commentList');
        if (!commentList) {
            console.error('Không tìm thấy phần tử commentList.');
            return;
        }

        // Tạo phần tử HTML cho bình luận mới
        const newComment = document.createElement('div');
        newComment.className = 'media';
        newComment.innerHTML = `
    <a class="pull-left" href="#">
        <img class="media-object" src="${data.image || 'default-avatar.jpg'}" alt="User Avatar">
    </a>
    <div class="media-body">
        <h4 class="media-heading">${data.fullname || 'Anonymous'}</h4>
        <p>${data.comment || ''}</p>
        <ul class="list-unstyled list-inline media-detail pull-left">
            <li><i class="fa fa-calendar"></i> ${data.created_at || new Date().toLocaleString()}</li>
            <li class="like-button"
                data-comment-id="${data.comment_id}"
                data-likes="${data.like || 0}"
                data-user-id="${data.user_id || 'default-user-id'}">
                <i class="fa fa-thumbs-up text-muted"></i> 
                <span class="like-count">${data.like || 0}</span>
            </li>
        </ul>
        <ul class="list-unstyled list-inline media-detail pull-right">
            <li><a href="#">Reply</a></li>
        </ul>
    </div>
`;



        commentList.prepend(newComment);


        attachLikeEvents();
    }

    // Hàm gắn sự kiện like cho các nút like
    function attachLikeEvents() {
        document.querySelectorAll('.like-button').forEach(button => {

            button.removeEventListener('click', likeButtonHandler);
            button.addEventListener('click', likeButtonHandler);
        });
    }


    async function likeButtonHandler(event) {
        event.preventDefault();

        const button = this;
        const likeIcon = button.querySelector('.fa-thumbs-up');
        const likeCountSpan = button.querySelector('.like-count');
        const commentId = button.getAttribute('data-comment-id');

        if (!likeCountSpan) {
            console.error("Không tìm thấy phần tử .like-count trong nút like.");
            return;
        }

        try {
            const response = await fetch('/blogDetailcontroller/likeComment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    comment_id: commentId
                })
            });

            if (!response.ok) {
                throw new Error("Lỗi khi kết nối tới server");
            }

            const data = await response.json();
            console.log("Server response: ", data);

            if (data.success) {

                if (data.liked) {
                    likeIcon.classList.add('text-success'); // Thêm màu xanh
                    likeIcon.classList.remove('text-muted'); // Bỏ màu xám
                } else {
                    likeIcon.classList.add('text-muted'); // Thêm màu xám
                    likeIcon.classList.remove('text-success'); // Bỏ màu xanh
                }

                // Cập nhật số lượt like
                const newLikeCount = data.likeCount || 0;
                button.setAttribute('data-likes', newLikeCount);
                likeCountSpan.textContent = newLikeCount;
            } else {
                console.error("Server response error:", data.message);
            }
            if (data.message === "Bạn cần đăng nhập để thực hiện hành động này.") {
                window.location.href = "/ogani-master/MVC/views/login.php";
            }

        } catch (error) {
            console.error("Fetch error:", error);
            alert('Lỗi khi gửi yêu cầu: ' + error.message);
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        attachLikeEvents();
    });
    async function likeButtonHandler(event) {
        event.preventDefault();

        const button = this;
        const likeIcon = button.querySelector('.fa-thumbs-up'); // Biểu tượng like
        const likeCountSpan = button.querySelector('.like-count'); // Phần tử hiển thị số lượt like
        const commentId = button.getAttribute('data-comment-id');

        if (!likeCountSpan) {
            console.error("Không tìm thấy phần tử .like-count trong nút like.");
            return;
        }

        try {
            const response = await fetch('/blogDetailcontroller/likeComment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    comment_id: commentId
                })
            });

            if (!response.ok) {
                throw new Error("Lỗi khi kết nối tới server");
            }

            const data = await response.json();
            console.log("Server response: ", data);

            if (data.success) {

                if (data.userLike === 1) { // Kiểm tra nếu trạng thái 'like' là 1
                    likeIcon.classList.add('text-success'); // Thêm màu xanh
                    likeIcon.classList.remove('text-muted'); // Bỏ màu xám
                } else {
                    likeIcon.classList.add('text-muted'); // Thêm màu xám
                    likeIcon.classList.remove('text-success'); // Bỏ màu xanh
                }


                // Cập nhật số lượt like
                const newLikeCount = data.likeCount || 0;
                button.setAttribute('data-likes', newLikeCount); // Cập nhật `data-likes`
                likeCountSpan.textContent = newLikeCount; // Cập nhật hiển thị số lượt like
            } else {
                console.error("Server response error:", data.message);
            }
            if (data.message === "Bạn cần đăng nhập để thực hiện hành động này.") {
                window.location.href = "/ogani-master/MVC/views/login.php";
            }

        } catch (error) {
            console.error("Fetch error:", error);
            alert('Lỗi khi gửi yêu cầu: ' + error.message);
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        attachLikeEvents();
    });
    document.querySelectorAll(".search_Type").forEach(function(element) {
        element.addEventListener("click", async function(event) {
            event.preventDefault();

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


                if (data.success) {
                    const rowElement = document.getElementById("row");
                    if (rowElement) {
                        rowElement.innerHTML = data.html;
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

</body>

</html>
<!-- Related Blog Section End -->
<!-- Related Blog Section End -->