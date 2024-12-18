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

public function update_product($updatedata) {
  $sql = "UPDATE product SET title = ?, description = ?, updated_at = ?, image = ?, stock = ?, price = ? WHERE id = ?";
  $stmt = mysqli_prepare($this->con, $sql);

  // Kiểm tra nếu câu lệnh đã được chuẩn bị thành công
  if ($stmt === false) {
      die("Lỗi chuẩn bị câu lệnh: " . mysqli_error($this->con));
  }

  // Liên kết tham số
  mysqli_stmt_bind_param(
      $stmt,
      "sssssii", // Kiểu dữ liệu: 5 string, 1 integer
      $updatedata['title'],
      $updatedata['description'],
      $updatedata['updated_at'],
      $updatedata['image'],
      $updatedata['stock'],
      $updatedata['price'],
      $updatedata['id'] // Thêm ID vào cuối
  );

  // Thực thi câu lệnh
  if (mysqli_stmt_execute($stmt)) {
      return true; // Trả về true nếu cập nhật thành công
  } else {
      echo "Lỗi: " . mysqli_stmt_error($stmt);
      return false; // Trả về false nếu có lỗi
  }

  // Đóng statement
  mysqli_stmt_close($stmt);
}



}
