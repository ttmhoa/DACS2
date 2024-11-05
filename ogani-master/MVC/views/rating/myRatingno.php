<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ogani-master/public/css/rating.css" type="text/css">
    <title>Đánh giá của tôi</title>
</head>

<body>

    <div class="header">
        <h1>Đánh giá của tôi</h1>
    </div>

    <div class="tab-container">
        <a href="/ratingController/ratingNo" class="active">Chưa đánh giá</a>
        <a href="/ratingController/ratingYes">Đã đánh giá</a>
    </div>


    <div class="product-list">
        <?php if (!empty($data['listpdno'])): ?>
            <?php foreach ($data['listpdno'] as $product): ?>
                <div class="product-item">
                    <div class="product-info">
                        <img src="<?php echo $product['thumbnail']; ?>"
                            alt="<?php echo $product['title']; ?>"
                            title="<?php echo $product['title']; ?>">
                        <div class="text">
                            <h4><?php echo $product['title']; ?></h4>
                            <p><?php echo $product['description']; ?></p>
                        </div>
                    </div>
                    <div class="product-action">
                        <button class="btn-rate" data-product-id="<?php echo $product['id']; ?>">Đánh giá</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-more">Không còn sản phẩm để đánh giá.</div>
        <?php endif; ?>
    </div>

    <script>
        // Thêm sự kiện click cho các nút đánh giá
        const rateButtons = document.querySelectorAll('.btn-rate');

        rateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id'); // Lấy ID sản phẩm
                // Chuyển hướng đến trang rating.php với ID sản phẩm
                window.location.href = '/ogani-master/MVC/views/rating/rating.php?product_id=' + productId;
            });
        });
    </script>

</body>

</html>
