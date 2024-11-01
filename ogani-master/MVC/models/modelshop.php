<?php
class modelshop extends DB
{
    public function Get_departments(){
        $sql = "SELECT * FROM category";
    $kq = mysqli_query($this->con ,$sql); 
    return $kq;
    }

    public function get3latest() {
        $sql = "SELECT *FROM product ORDER BY created_at DESC LIMIT 3;";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq;
        
    }
    public function search_model($name) {
        $stmt = $this->con->prepare("SELECT * FROM product WHERE title LIKE ?");
        $searchTerm = "%$name%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function get3related() {
        $sql = "SELECT *FROM product ORDER BY created_at DESC LIMIT 3 OFFSET 3;";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq; 
    }

    public function phantrang_click_model($current_page_click)
    {
        $item_per_page = 3;
        $current_page = $current_page_click;
        $offset = ($current_page - 1) * $item_per_page;
    
        // Fetch total number of products
        $totalQuery = "SELECT COUNT(*) as total FROM product";
        $totalResult = mysqli_query($this->con, $totalQuery);
        $totalRow = mysqli_fetch_assoc($totalResult);
        $totalRecords = $totalRow['total'];
    
        // Fetch products for the current page
        $products = "SELECT * FROM product ORDER BY id ASC LIMIT $item_per_page OFFSET $offset";
        $kq = mysqli_query($this->con, $products);
    
        // Calculate total pages
        $totalPages = ceil($totalRecords / $item_per_page);
    
        return [
            'products' => $kq,
            'totalPages' => $totalPages
        ];
    }

}
?>