<?php
class  modelshopCard extends DB{
    public function GetSP() {
        // kết nối cơ sở dữ liệu
        return "sanpham1";
    }

    public function getStock($productId){
        $sql = "SELECT stock FROM product WHERE id = $productId";
        $kq= mysqli_query($this->con, $sql);
        $row= mysqli_fetch_assoc($kq);
        return $row['stock'];

    }
 
    public function getProduct($id)
    {
        $sql = "SELECT * FROM product WHERE id = $id";
        $kq = mysqli_query($this->con, $sql);
        
        if ($kq) {
            return mysqli_fetch_assoc($kq); // Trả về bản ghi duy nhất
        }
        
        return null; // Trả về null nếu không tìm thấy sản phẩm
    } 
}
?>