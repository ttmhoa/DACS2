<?php
class  users extends DB
{
    public function GetUser()
    {
        $sql = "SELECT * FROM user where role_id ";
        $kq = mysqli_query($this->con ,$sql); 
        return $kq;
    }

    public function phantrang_click_model($current_page_click)
    {
        $item_per_page = 4;
        $current_page = $current_page_click;
        $offset = ($current_page - 1) * $item_per_page;
    
        // Fetch total number of products
        $totalQuery = "SELECT COUNT(*) as total FROM user where role_id = 1";
        $totalResult = mysqli_query($this->con, $totalQuery);
        $totalRow = mysqli_fetch_assoc($totalResult);
        $totalRecords = $totalRow['total'];
    
        // Fetch products for the current page
        $products = "SELECT * FROM user where role_id =1 ORDER BY id ASC LIMIT $item_per_page OFFSET $offset";
        $kq = mysqli_query($this->con, $products);
    
        // Calculate total pages
        $totalPages = ceil($totalRecords / $item_per_page);
    
        return [
            'products' => $kq,
            'totalPages' => $totalPages
        ];
    }
    public function delete($id) {
        $stmt = $this->con->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param("i", $id); 
        $kq = $stmt->execute(); 
        $stmt->close();  
        return $kq;
      }


}
