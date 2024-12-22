<?php
class  add_sp extends DB
{

    public function get_list_categories()
    {
        $sql = "SELECT * FROM category";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }
    public function create_newpProduct($create_cate)
    {
        $sql = "INSERT INTO product (title, description, updated_at, created_at, image, thumbnail, stock, price, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->con, $sql);
    
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssddssiii", // Adjusted to match the types: title (s), description (s), updated_at (s), created_at (s), image (s), thumbnail (s), stock (d), price (d), category_id (i)
                $create_cate['title'],
                $create_cate['description'],
                $create_cate['updated_at'],
                $create_cate['created_at'],
                $create_cate['image'],
                $create_cate['thumbnail'],
                $create_cate['stock'],
                $create_cate['price'],
                $create_cate['category_id']
            );
    
            if (mysqli_stmt_execute($stmt)) {
                return "Sản phẩm đã được thêm thành công.";
            } else {
                return "Có lỗi trong việc thêm sản phẩm: " . mysqli_stmt_error($stmt);
            }
    
            mysqli_stmt_close($stmt);
        } else {
            return "Có lỗi trong việc chuẩn bị câu lệnh: " . mysqli_error($this->con);
        }
    }
}
