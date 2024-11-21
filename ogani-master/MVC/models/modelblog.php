<?php
class  modelBlog extends DB
{
    public function createBlog($userId, $title, $text, $imagePath, $descript, $category)
    {
        // Cập nhật câu lệnh SQL để chèn category
        $query = "INSERT INTO blog (title, content, author_id, image, created_at, descript, category) 
                  VALUES (?, ?, ?, ?, NOW(), ?, ?)";

        $stmt = mysqli_prepare($this->con, $query);
        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        // Gắn các tham số vào câu lệnh SQL
        mysqli_stmt_bind_param($stmt, 'ssisss', $title, $text, $userId, $imagePath, $descript, $category);

        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            return true;
        } else {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_stmt_error($stmt));
            return false;
        }
    }

    public function getBlog()
    {
        $query = "SELECT * FROM blog";
        $stmt = mysqli_prepare($this->con, $query);

        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        $stmt->close();
        return $data;
    }
    public function search_model($name)
    {
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->con->prepare("SELECT * FROM blog WHERE title LIKE ?");

        if ($stmt === false) {
            // Xử lý lỗi nếu câu lệnh SQL không thể chuẩn bị
            return false;
        }

        // Tạo giá trị tìm kiếm với dấu "%"
        $searchTerm = "%$name%";

        // Gắn tham số vào câu lệnh SQL
        $stmt->bind_param("s", $searchTerm);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy kết quả truy vấn
        $result = $stmt->get_result();

        if ($result === false) {
            // Xử lý lỗi nếu không thể lấy kết quả từ câu lệnh
            return false;
        }

        // Trả về kết quả tìm kiếm
        return $result;
    }

    public function search_Type($name)
    {
        // Thêm ký tự % để tìm kiếm khớp một phần
        $name = '%' . $name . '%';

        // Sửa lỗi trong câu truy vấn
        $query = "SELECT * FROM BLOG WHERE category LIKE ?";
        $stmt = mysqli_prepare($this->con, $query);

        if (!$stmt) {
            die("Lỗi chuẩn bị câu truy vấn: " . mysqli_error($this->con));
        }

        // Gán tham số
        mysqli_stmt_bind_param($stmt, 's', $name);

        // Thực thi câu truy vấn
        if (!mysqli_stmt_execute($stmt)) {
            die("Lỗi thực thi câu truy vấn: " . mysqli_stmt_error($stmt));
        }

        // Lấy kết quả
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Lỗi lấy kết quả: " . mysqli_stmt_error($stmt));
        }

        return $result;
    }
}
