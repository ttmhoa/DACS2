<?php
class  modelblogdetail extends DB
{
    public function GetSP()
    {
        // kết nối cơ sở dữ liệu
        return "sanpham1";
    }

    public function addSP($a, $b)
    {
        // Nối chuỗi thay vì cộng
        return $a . $b;
    }
    public function getBlog($id)
    {
        $query = "SELECT content, count_comment FROM blog WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $query);
        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        // Gắn giá trị tham số `id` vào câu truy vấn
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Thực thi truy vấn
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        // Lấy kết quả trả về
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result); // Lấy dòng đầu tiên trong kết quả
        mysqli_stmt_close($stmt);

        // Trả về dữ liệu gồm `content` và `count_comment`
        return [
            'content' => $data['content'],
            'count_comment' => $data['count_comment']
        ];
    }

    public function comment($user_id, $blog_id, $comment)
    {
        $sql = "INSERT INTO comments (user_id, blog_id, comment, created_at, `like`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->con, $sql);

        if ($stmt) {
            // Gán giá trị cho các tham số
            $created_at = date('Y-m-d H:i:s');
            $like = 0; // Giá trị mặc định cho like
            $stmt->bind_param('iissi', $user_id, $blog_id, $comment, $created_at, $like);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                // Lấy ID của bình luận vừa được thêm
                $comment_id = $stmt->insert_id;

                // Câu lệnh INSERT vào bảng like với giá trị mặc định là 0
                $like_sql = "INSERT INTO `like` (user_id, id_comment, `like`) VALUES (?, ?, ?)";
                $like_stmt = mysqli_prepare($this->con, $like_sql);

                if ($like_stmt) {
                    $like = 0; // Mặc định like = 0
                    $like_stmt->bind_param('iii', $user_id, $comment_id, $like);

                    if ($like_stmt->execute()) {
                        $like_stmt->close();
                        return $comment_id; // Trả về ID của bình luận vừa chèn
                    } else {
                        error_log("MySQL Error (Like Insert): " . $like_stmt->error);
                        return false; // Lỗi khi thực thi câu lệnh insert vào bảng like
                    }
                } else {
                    error_log("MySQL Prepare Error (Like Insert): " . $this->con->error);
                    return false; // Lỗi khi chuẩn bị câu lệnh insert vào bảng like
                }
            } else {
                error_log("MySQL Error (Comment Insert): " . $stmt->error);
                return false; // Lỗi khi thực thi câu lệnh insert vào bảng comments
            }

            $stmt->close();
        } else {
            error_log("MySQL Prepare Error (Comment Insert): " . $this->con->error);
            return false; // Lỗi khi chuẩn bị câu lệnh insert vào bảng comments
        }
    }

    public function getUserInfo($user_id)
    {
        $sql = "SELECT fullname, image FROM user WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $sql);

        if (!$stmt) {
            error_log("MySQL Prepare Error (Get User Info): " . $this->con->error);
            return false;
        }

        $stmt->bind_param('i', $user_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Trả về mảng kết hợp chứa fullname và image
            }
        } else {
            error_log("MySQL Error (Get User Info): " . $stmt->error);
        }

        return false;
    }
    public function getCommentsByBlogId($id)
    {
        // Kiểm tra giá trị của $id
        // var_dump($id); // In ra giá trị của $id để kiểm tra đầu vào

        // Truy vấn lấy bình luận kèm tên người dùng
        $query = "
        SELECT comments.id, comments.*, user.fullname, user.image
        FROM comments
        JOIN user ON comments.user_id = user.id
        JOIN blog ON comments.blog_id = blog.id
        WHERE blog.id = ?
    ";


        // In ra câu truy vấn để kiểm tra
        // var_dump($query);

        // Chuẩn bị và thực thi câu lệnh SQL
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        // Lấy kết quả và lưu vào mảng $comments
        $result = mysqli_stmt_get_result($stmt);
        $comments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row; // Lưu bình luận và tên người dùng
        }

        // Kiểm tra kết quả truy vấn
        // var_dump($comments); // In ra mảng $comments để kiểm tra dữ liệu lấy được

        // Đóng câu lệnh
        mysqli_stmt_close($stmt);

        // Kiểm tra nếu không có bình luận
        if (empty($comments)) {
            echo "Không có bình luận nào cho bài viết này.";
        }

        return $comments; // Trả về danh sách bình luận
    }
    public function checkComment($user_Id, $comment_id)
    {
        $sql = "SELECT `like` FROM `like` WHERE `user_id` = ? AND `id_comment` = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $user_Id, $comment_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $check = mysqli_fetch_assoc($result);

        return $check ? $check : null; // Trả về null nếu không có bản ghi nào khớp
    }
    public function Check($id)
    {
        $sql = "SELECT `like` FROM `like` WHERE `id_comment` = ?";
        $stmt = mysqli_prepare($this->con, $sql);

        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        // Gán tham số vào câu lệnh
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Thực thi câu lệnh
        if (!mysqli_stmt_execute($stmt)) {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        // Lấy kết quả truy vấn
        $result = mysqli_stmt_get_result($stmt);
        $check = mysqli_fetch_assoc($result);

        // Kiểm tra kết quả
        if (!$check) {
            error_log("Không tìm thấy dữ liệu cho id_comment = $id");
            return null;
        }

        return $check['like'] ?? null; // Trả về giá trị `like` hoặc null nếu không tồn tại
    }


    // Hàm thực hiện tăng/giảm lượt thích hoặc thêm mới nếu chưa có bản ghi nào
    public function getLike($user_Id, $comment_id)
    {
        $check = $this->checkComment($user_Id, $comment_id);

        if ($check === null) {
            // Thêm bản ghi mới vào bảng `like`
            $sqlInsert = "INSERT INTO `like` (`user_id`, `id_comment`, `like`) VALUES (?, ?, 1)";
            $stmtInsert = mysqli_prepare($this->con, $sqlInsert);
            mysqli_stmt_bind_param($stmtInsert, "ii", $user_Id, $comment_id);
            mysqli_stmt_execute($stmtInsert);
            mysqli_stmt_close($stmtInsert);

            // Tăng lượt thích trong bảng `comments`
            $likeCount = $this->getCountLike($comment_id);
            $likeCount += 1;

            $sqlUpdateComment = "UPDATE `comments` SET `like` = ? WHERE `id` = ?";
            $stmtUpdateComment = mysqli_prepare($this->con, $sqlUpdateComment);
            mysqli_stmt_bind_param($stmtUpdateComment, "ii", $likeCount, $comment_id);
            mysqli_stmt_execute($stmtUpdateComment);
            mysqli_stmt_close($stmtUpdateComment);
        } elseif ($check['like'] == 0) {
            // Tăng lượt thích nếu trước đó chưa thích
            $likeCount = $this->getCountLike($comment_id);
            $likeCount += 1;

            $sqlUpdateComment = "UPDATE `comments` SET `like` = ? WHERE `id` = ?";
            $stmtUpdateComment = mysqli_prepare($this->con, $sqlUpdateComment);
            mysqli_stmt_bind_param($stmtUpdateComment, "ii", $likeCount, $comment_id);
            mysqli_stmt_execute($stmtUpdateComment);
            mysqli_stmt_close($stmtUpdateComment);

            $sqlUpdateLike = "UPDATE `like` SET `like` = 1 WHERE `user_id` = ? AND `id_comment` = ?";
            $stmtUpdateLike = mysqli_prepare($this->con, $sqlUpdateLike);
            mysqli_stmt_bind_param($stmtUpdateLike, "ii", $user_Id, $comment_id);
            mysqli_stmt_execute($stmtUpdateLike);
            mysqli_stmt_close($stmtUpdateLike);
        } elseif ($check['like'] == 1) {
            // Giảm lượt thích nếu đã thích trước đó
            $likeCount = $this->getCountLike($comment_id);
            $likeCount -= 1;

            $sqlUpdateComment = "UPDATE `comments` SET `like` = ? WHERE `id` = ?";
            $stmtUpdateComment = mysqli_prepare($this->con, $sqlUpdateComment);
            mysqli_stmt_bind_param($stmtUpdateComment, "ii", $likeCount, $comment_id);
            mysqli_stmt_execute($stmtUpdateComment);
            mysqli_stmt_close($stmtUpdateComment);

            $sqlUpdateLike = "UPDATE `like` SET `like` = 0 WHERE `user_id` = ? AND `id_comment` = ?";
            $stmtUpdateLike = mysqli_prepare($this->con, $sqlUpdateLike);
            mysqli_stmt_bind_param($stmtUpdateLike, "ii", $user_Id, $comment_id);
            mysqli_stmt_execute($stmtUpdateLike);
            mysqli_stmt_close($stmtUpdateLike);
        }

        // Trả về thông tin lượt thích
        $updatedLike = $this->checkComment($user_Id, $comment_id); // Lấy lại giá trị `like` trong bảng `like`
        $likeCount = $this->getCountLike($comment_id); // Lấy số lượt thích tổng cộng

        return [
            'likeCount' => $likeCount,   // Số lượt thích trong bảng `comments`
            'userLike'  => $updatedLike['like'] // Giá trị `like` của người dùng trong bảng `like`
        ];
    }

    // Hàm lấy số lượt thích hiện tại từ bảng `comments`
    public function getCountLike($comment_id)
    {
        $sql = "SELECT `like` FROM comments WHERE `id` = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $comment_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);

        return isset($row['like']) ? (int)$row['like'] : 0;  // Trả về số lượt thích hoặc 0 nếu không tồn tại
    }
    public function search_model($name)
    {
        $stmt = $this->con->prepare("SELECT * FROM blog WHERE title LIKE ?");
        $searchTerm = "%$name%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        return $stmt->get_result();
    }
}
