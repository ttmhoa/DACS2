
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ogani-master/public/css/rating.css" type="text/css">
    <title>Đánh giá của tôi - Đã đánh giá</title>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>Đánh giá của tôi</h1>
    </div>

    <!-- Tab điều hướng -->
    <div class="tab-container">
        <a href="/ogani-master/MVC/views/rating/myRatingno.php">Chưa đánh giá</a>
        <a href="/ogani-master/MVC/views/rating/myRatingyes.php" class="active">Đã đánh giá</a>
    </div>

    <!-- Danh sách đánh giá đã thực hiện -->
    <div class="review-list">
        <?php if (!empty($data['listpdno'])): ?>
            <?php foreach ($data['listpdno'] as $product): ?>
                <div class="review-item">
                    <div class="review-header">
                        <div class="user-info">
                            <img src="https://via.placeholder.com/40" alt="User Avatar">
                            <div>
                                <div class="name"><?php echo $_SESSION['user']['fullname']; ?></div>
                                <div class="stars">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $product['rating']) {
                                            echo '★';
                                        } else {
                                            echo '☆';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="date"><?php echo date('d-m-Y H:i', strtotime($product['review_date'])); ?></div>
                    </div>

                    <div class="review-content">
                        <p><?php echo $product['comment']; ?></p>
                    </div>

                    <div class="review-footer">
                        <img src="<?php echo $product['review_image']; ?>" alt="Sản phẩm">
                        <video src="<?php echo $product['review_video']; ?>" type="video/mp4" width="100" height="100" controls>
                        </video>
                    </div>



                    <div class="product-container">
                        <div class="product-info">
                            <img src="<?php echo $product['image_url']; ?>" alt="Sản phẩm">
                            <span><?php echo $product['title']; ?></span>
                        </div>
                        <button class="btn-edit">Sửa</button>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const editButton = document.querySelector('.btn-edit');

                        editButton.addEventListener('click', function() {
                            window.location.href = '/ogani-master/MVC/views/rating/rating.php'; // Chuyển hướng đến trang cần thiết
                        });
                    });
                </script>



    </div>
<?php endforeach; ?>
<?php else: ?>
    <div class="no-more">Không còn đánh giá nào</div>
<?php endif; ?>
</div>

</body>

</html>
