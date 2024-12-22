<?php
class  products extends DB
{
 public function get_list_products(){
  $sql = "SELECT 
    p.*, 
    c.name AS category_name
FROM 
    product p
JOIN 
    category c 
    
    ON p.category_id = c.id;";
  $result = mysqli_query($this->con, $sql);
  return $result;
 }

 public function delete($id) {
  $stmt = $this->con->prepare("DELETE FROM product WHERE id = ?");
  $stmt->bind_param("i", $id); 
  $kq = $stmt->execute(); 
  $stmt->close();  
  return $kq;
}

public function get_list_products_byid($id){
  $sql = "SELECT * FROM product WHERE id = $id";
  $result = mysqli_query($this->con, $sql);
  return $result;
}
public function phantrang_click_model($current_page_click)
{
    $item_per_page = 4;
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

public function modify_product_model($modify_product_data, $id) {
    $sql = "UPDATE product SET title = ?, description = ?, updated_at = ?, image = ?, stock = ?, price = ? WHERE id = ?";
    $stmt = mysqli_prepare($this->con, $sql);

    if ($stmt === false) {
        die("Error preparing statement: " . mysqli_error($this->con));
    }

    // Bind parameters
    mysqli_stmt_bind_param(
        $stmt,
        "ssdsdsi", // Updated to match the types: title, description (s), updated_at (d), image (s), stock (d), price (d), id (i)
        $modify_product_data['title'],
        $modify_product_data['description'],
        $modify_product_data['updated_at'], // Ensure this is in the correct format
        $modify_product_data['image'],
        $modify_product_data['stock'],
        $modify_product_data['price'],
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        return true; 
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
        return false;
    }

    mysqli_stmt_close($stmt);
}



}
