<?php
class  categories extends DB
{

    public function get_list_categories(){
        $sql = "SELECT * FROM category";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }
    public function delete($id) {
        // Bước 1: Xóa sản phẩm liên quan
        $stmt1 = $this->con->prepare("DELETE FROM product WHERE category_id = ?");
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();
    
        // Bước 2: Xóa danh mục
        $stmt2 = $this->con->prepare("DELETE FROM category WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $result = $stmt2->execute();
        $stmt2->close();
    
        return $result; // Trả về kết quả của việc xóa danh mục
    }

}
