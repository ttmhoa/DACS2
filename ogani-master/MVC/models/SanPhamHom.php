<?php
class SanPhamHom extends DB{
    public function GetSP() {
        // kết nối cơ sở dữ liệu
        return "sanpham1";
    }

    public function addSP($a, $b) {
        // Nối chuỗi thay vì cộng
        return $a . $b; // Sử dụng toán tử . để nối chuỗi
    }  
}
?>