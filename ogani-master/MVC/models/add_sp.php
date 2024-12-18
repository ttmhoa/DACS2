<?php
class  add_sp extends DB
{

    public function get_list_categories()
    {
        $sql = "SELECT * FROM category";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }
    public function create_newpProduct($create_sp)
    {
        // Câu lệnh SQL để thêm sản phẩm
        $sql = "INSERT INTO product (title, description, updated_at, created_at, image, thumbnail, stock, price, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Chuẩn bị câu lệnh
        $stmt = mysqli_prepare($this->con, $sql);
        
        if ($stmt) {
            // Liên kết các tham số
            mysqli_stmt_bind_param(
                $stmt,
                "ssssssiii", // Cập nhật kiểu dữ liệu cho category_id
                $create_sp['title'],
                $create_sp['description'],
                $create_sp['updated_at'],
                $create_sp['created_at'],
                $create_sp['image'],
                $create_sp['thumbnail'],
                $create_sp['stock'],
                $create_sp['price'],
                $create_sp['category_id'] // Thêm category_id
            );
    
            // Thực thi câu lệnh
            if (mysqli_stmt_execute($stmt)) {
                // Thêm thành công
                return "Sản phẩm đã được thêm thành công.";
            } else {
                // Lỗi khi thêm sản phẩm
                return "Có lỗi trong việc thêm sản phẩm: " . mysqli_stmt_error($stmt);
            }
    
            // Đóng câu lệnh
            mysqli_stmt_close($stmt);
        } else {
            // Lỗi khi chuẩn bị câu lệnh
            return "Có lỗi trong việc chuẩn bị câu lệnh: " . mysqli_error($this->con);
        }
    }
}
