<?php
class  modelBlog extends DB
{
    public function createBlog($userId, $title, $text, $imagePath, $descript, $category)
    {

        $query = "INSERT INTO blog (title, content, author_id, image, created_at, descript, category) 
                  VALUES (?, ?, ?, ?, NOW(), ?, ?)";

        $stmt = mysqli_prepare($this->con, $query);
        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }


        mysqli_stmt_bind_param($stmt, 'ssisss', $title, $text, $userId, $imagePath, $descript, $category);

        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            return true;
        } else {
            error_log("Thực thi câu lệnh thất bại: " . mysqli_stmt_error($stmt));
            return false;
        }
    }

    public function getBlog($offset, $limit)
    {
        $query = "SELECT * FROM blog LIMIT ?, ?";
        $stmt = mysqli_prepare($this->con, $query);

        if (!$stmt) {
            error_log("Chuẩn bị câu lệnh thất bại: " . mysqli_error($this->con));
            return false;
        }

        // Liên kết tham số để truy vấn
        mysqli_stmt_bind_param($stmt, 'ii', $offset, $limit);

        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            // error_log("Thực thi câu lệnh thất bại: " . mysqli_error($this->con));
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



    public function getTotalBlogs()
    {
        $query = "SELECT COUNT(*) AS total FROM blog";
        $result = mysqli_query($this->con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        }

        return 0;
    }
   


    public function search_model($name)
    {

        $stmt = $this->con->prepare("SELECT * FROM blog WHERE title LIKE ?");

        if ($stmt === false) {

            return false;
        }


        $searchTerm = "%$name%";


        $stmt->bind_param("s", $searchTerm);


        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {

            return false;
        }


        return $result;
    }

    public function search_Type($name)
    {

        $name = '%' . $name . '%';


        $query = "SELECT * FROM BLOG WHERE category LIKE ?";
        $stmt = mysqli_prepare($this->con, $query);

        if (!$stmt) {
            die("Lỗi chuẩn bị câu truy vấn: " . mysqli_error($this->con));
        }


        mysqli_stmt_bind_param($stmt, 's', $name);


        if (!mysqli_stmt_execute($stmt)) {
            die("Lỗi thực thi câu truy vấn: " . mysqli_stmt_error($stmt));
        }


        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Lỗi lấy kết quả: " . mysqli_stmt_error($stmt));
        }

        return $result;
    }
}
