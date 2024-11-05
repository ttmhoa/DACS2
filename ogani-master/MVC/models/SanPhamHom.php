<?php
class SanPhamHom extends DB{
    public function GetSP() {
        $sql = "SELECT * FROM category";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq;
    }
    // public function GetDetail() {
    //     $sql = "SELECT * FROM product";
    //     $kq = mysqli_query($this->con ,$sql); 
    //     return $kq;
    // }
    public function getAll() {
        $sql = "SELECT * FROM product";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq;
        
    }

    public function getProduct($id) {
        $sql = "SELECT * FROM product where category_id=$id";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq;
        
    }

    public function get3latest() {
        $sql = "SELECT *FROM product ORDER BY created_at DESC LIMIT 3;";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq;
        
    }
    public function get3related() {
        $sql = "SELECT *FROM product ORDER BY created_at DESC LIMIT 3 OFFSET 3;";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq; 
    }

    public function addSP($a) {
        // Nối chuỗi thay vì cộng
        return (int)$a; // Sử dụng toán tử . để nối chuỗi
    }  
}
?>