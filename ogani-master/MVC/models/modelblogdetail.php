<?php
class  modelblogdetail extends DB
{
    public function GetSP()
    {
        //
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

        
        mysqli_stmt_bind_param($stmt, "i", $id);

    
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        
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
            
            $created_at = date('Y-m-d H:i:s');
            $like = 0; 
            $stmt->bind_param('iissi', $user_id, $blog_id, $comment, $created_at, $like);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                
                $comment_id = $stmt->insert_id;

                
                $like_sql = "INSERT INTO `like` (user_id, id_comment, `like`) VALUES (?, ?, ?)";
                $like_stmt = mysqli_prepare($this->con, $like_sql);

                if ($like_stmt) {
                    $like = 0; 
                    $like_stmt->bind_param('iii', $user_id, $comment_id, $like);

                    if ($like_stmt->execute()) {
                        $like_stmt->close();
                        return $comment_id; 
                    } else {
                        error_log("MySQL Error (Like Insert): " . $like_stmt->error);
                        return false; 
                    }
                } else {
                    error_log("MySQL Prepare Error (Like Insert): " . $this->con->error);
                    return false; 
                }
            } else {
                error_log("MySQL Error (Comment Insert): " . $stmt->error);
                return false; 
            }

            $stmt->close();
        } else {
            error_log("MySQL Prepare Error (Comment Insert): " . $this->con->error);
            return false; 
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
                return $result->fetch_assoc(); 
            }
        } else {
            error_log("MySQL Error (Get User Info): " . $stmt->error);
        }

        return false;
    }
    public function getCommentsByBlogId($id)
    {
        
        $query = "
        SELECT comments.id, comments.*, user.fullname, user.image
        FROM comments
        JOIN user ON comments.user_id = user.id
        JOIN blog ON comments.blog_id = blog.id
        WHERE blog.id = ?
    ";

        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $comments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row; 
        }
        mysqli_stmt_close($stmt);
        if (empty($comments)) {
            echo "Không có bình luận nào cho bài viết này.";
        }

        return $comments; 
    }
    public function checkComment($user_Id, $comment_id)
    {
        $sql = "SELECT `like` FROM `like` WHERE `user_id` = ? AND `id_comment` = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $user_Id, $comment_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $check = mysqli_fetch_assoc($result);

        return $check ? $check : null; 
    }
    public function Check($id)
    {
        $sql = "SELECT `like` FROM `like` WHERE `id_comment` = ?";
        $stmt = mysqli_prepare($this->con, $sql);

        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        
        mysqli_stmt_bind_param($stmt, "i", $id);

    
        if (!mysqli_stmt_execute($stmt)) {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        
        $result = mysqli_stmt_get_result($stmt);
        $check = mysqli_fetch_assoc($result);

    
        if (!$check) {
            error_log("Không tìm thấy dữ liệu cho id_comment = $id");
            return null;
        }

        return $check['like'] ?? null; 
    }

    public function getLike($user_Id, $comment_id)
    {
        $check = $this->checkComment($user_Id, $comment_id);

        if ($check === null) {
            $sqlInsert = "INSERT INTO `like` (`user_id`, `id_comment`, `like`) VALUES (?, ?, 1)";
            $stmtInsert = mysqli_prepare($this->con, $sqlInsert);
            mysqli_stmt_bind_param($stmtInsert, "ii", $user_Id, $comment_id);
            mysqli_stmt_execute($stmtInsert);
            mysqli_stmt_close($stmtInsert);

            $likeCount = $this->getCountLike($comment_id);
            $likeCount += 1;

            $sqlUpdateComment = "UPDATE `comments` SET `like` = ? WHERE `id` = ?";
            $stmtUpdateComment = mysqli_prepare($this->con, $sqlUpdateComment);
            mysqli_stmt_bind_param($stmtUpdateComment, "ii", $likeCount, $comment_id);
            mysqli_stmt_execute($stmtUpdateComment);
            mysqli_stmt_close($stmtUpdateComment);
        } elseif ($check['like'] == 0) {
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

        $updatedLike = $this->checkComment($user_Id, $comment_id); 
        $likeCount = $this->getCountLike($comment_id); 

        return [
            'likeCount' => $likeCount,   
            'userLike'  => $updatedLike['like'] 
        ];
    }

    public function getCountLike($comment_id)
    {
        $sql = "SELECT `like` FROM comments WHERE `id` = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $comment_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    

        return isset($row['like']) ? (int)$row['like'] : 0;  
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
