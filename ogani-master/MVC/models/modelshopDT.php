<?php
class modelshopDT extends DB
{
    public function getProduct($id)
{
    $sql = "SELECT * FROM product WHERE id = $id";
    $kq = mysqli_query($this->con, $sql);
    
    if ($kq) {
        return mysqli_fetch_assoc($kq); // Trả về bản ghi duy nhất
    }
    
    return null; // Trả về null nếu không tìm thấy sản phẩm
}

public function department() {
    $sql = "SELECT * FROM category";
    $kq = mysqli_query($this->con ,$sql); 
    return $kq;
}

    public function getLatestProduct()
    {
        $sql = "SELECT * FROM product ORDER BY created_at DESC LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        
        if ($result) {
            return mysqli_fetch_assoc($result); // Trả về bản ghi mới nhất
        }
        
        return null; 
    }

    public function get_onesp($id_cateRequest)
    {
        $sql = "SELECT * FROM product WHERE category_id = $id_cateRequest ORDER BY created_at DESC LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        
        if ($result) {
            return mysqli_fetch_assoc($result); // Trả về bản ghi mới nhất
        }
        
        return null; 
    }

    public function id_splatest() 
    {
        $sql = "SELECT id FROM product ORDER BY created_at DESC LIMIT 1";
        $kq = mysqli_query($this->con, $sql);
        
        if ($kq) {
            if ($row = mysqli_fetch_assoc($kq)) {
                return $row['id']; // Trả về ID của sản phẩm mới nhất
            }
        }
        
        return null; 
    }

    public function AllProduct()
    {
        $sql = "SELECT * FROM product";
        $result = mysqli_query($this->con, $sql);
        
        if ($result) {
            $products = []; 
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row; 
            }
            return $products; 
        }
        
        return []; // Trả về mảng rỗng nếu không có kết quả
    }

    public function getcategory_id($id) 
    {
        $sql = "SELECT category_id FROM product WHERE id = $id";
        $kq = mysqli_query($this->con, $sql);
        
        if ($row = mysqli_fetch_assoc($kq)) {
            return $row['category_id'];
        }
        
        return null; 
    }

    public function getcategory_id_ct($category_id) 
    {
        $sql = "SELECT * FROM product WHERE category_id = $category_id";
        $kq = mysqli_query($this->con, $sql);
        
        return $kq; // Trả về đối tượng mysqli_result
    }
}
