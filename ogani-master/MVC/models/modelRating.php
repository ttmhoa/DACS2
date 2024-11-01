<?php
class modelRating extends DB {
    public function rating($userId, $productId, $rating, $review, $imagePath, $videoPath) {
        if ($userId === null) {
            return 1;
        }
        $query = "INSERT INTO Review (product_id, user_id, rating, comment, image_url, video_url, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($this->con, $query);
        if (!$stmt) {
            error_log("Prepare failed: " . mysqli_error($this->con));
            return false;
        }
        mysqli_stmt_bind_param($stmt, "iiisss", $productId, $userId, $rating, $review, $imagePath, $videoPath);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            $updateQuery = "UPDATE User_Purchases SET review_status = 1 WHERE user_id = ? AND product_id = ?";
            $updateStmt = mysqli_prepare($this->con, $updateQuery);
            
            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "ii", $userId, $productId);
                mysqli_stmt_execute($updateStmt);
                mysqli_stmt_close($updateStmt);
            } else {
                error_log("Prepare failed for update: " . mysqli_error($this->con));
            }
    
            return true; 
        } else {
            error_log("Execute failed: " . mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
            return false;
        }
    }    
    public function getRatingno($user_id) {
        $query = "
        SELECT p.id, p.title, p.thumbnail, p.description 
        FROM Product p
        INNER JOIN User_Purchases up ON p.id = up.product_id
        WHERE up.user_id = ? AND (up.review_status = 0 OR up.review_status IS NULL)
    ";
        $stmt = mysqli_prepare($this->con, $query);
        $stmt->bind_param("i", $user_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();
    
        return $products; 
    }
    public function getRatingyes($user_id) {
        $query = "
            SELECT 
                Product.id, 
                Product.title, 
                Product.price, 
                Product.thumbnail AS image_url,  -- Lấy hình ảnh sản phẩm
                Review.rating, 
                Review.comment,
                Review.created_at AS review_date, -- Thêm ngày đánh giá
                Review.image_url AS review_image, -- Lấy hình ảnh review (nếu có)
                Review.video_url AS review_video
            FROM 
                User_Purchases 
            JOIN 
                Product ON User_Purchases.product_id = Product.id 
            JOIN 
                Review ON Product.id = Review.product_id AND Review.user_id = User_Purchases.user_id 
            WHERE 
                User_Purchases.user_id = ? AND 
                User_Purchases.review_status = 1
        ";
        $stmt = mysqli_prepare($this->con, $query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row; 
        }
        $stmt->close();
        // foreach ($products as $product) {
        //     // In thông tin sản phẩm
        //     echo "<div class='product'>";
        //     echo "<h2>" . htmlspecialchars($product['title']) . "</h2>";
        //     echo "<p>Price: " . htmlspecialchars($product['price']) . " VND</p>";
        //     echo "<img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['title']) . "' />";
        //     echo "<p>Rating: " . htmlspecialchars($product['rating']) . " stars</p>";
        //     echo "<p>Comment: " . htmlspecialchars($product['comment']) . "</p>";
        //     echo "<p>Review Date: " . htmlspecialchars(date('d-m-Y', strtotime($product['review_date']))) . "</p>"; // Hiển thị ngày đánh giá
            
        //     // Hiển thị hình ảnh review nếu có
        //     if (!empty($product['review_image'])) {
        //         echo "<img src='" . htmlspecialchars($product['review_image']) . "' alt='Review image' />";
        //     }
    
        // Trả về mảng chứa các sản phẩm đã được đánh giá
        return $products;
    
}
}   
?>
