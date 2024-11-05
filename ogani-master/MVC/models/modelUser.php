<?php
class modelUser extends DB{
    public function showUser($id) {
        $sql = "SELECT * FROM User WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        if (!$stmt) {
            die('Câu lệnh chuẩn bị thất bại: ' . mysqli_error($this->con));
        }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    
        // Fetch result
        $result = mysqli_stmt_get_result($stmt);
        if ($result) {
            $user = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            // print_r($user);
            return $user;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }
    public function uploadUser($id, $fullname, $email, $address, $phone, $imagePath) {
        // In thông tin đầu vào
        // var_dump($imagePath); // Kiểm tra giá trị của imagePath
    
        // Bắt đầu câu truy vấn SQL
        $query = "UPDATE User SET fullname = ?, email = ?, address = ?, phone_number = ?, image = ? WHERE id = ?";
        
        // Chuẩn bị câu lệnh
        $stmt = mysqli_prepare($this->con, $query);
        if (!$stmt) {
            die('Câu lệnh chuẩn bị thất bại: ' . mysqli_error($this->con));
        }
    
        // Binding tham số
        mysqli_stmt_bind_param($stmt, 'sssisi', $fullname, $email, $address, $phone, $imagePath, $id);
    
        // Thực thi câu lệnh
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true; // Trả về true nếu thực thi thành công
        } else {
            mysqli_stmt_close($stmt);
            return false; // Trả về false nếu có lỗi
        }
    }
    public function updatePassword($id, $newPassword, $oldPassword) {
        // Bước đầu tiên: lấy mật khẩu hiện tại của người dùng từ cơ sở dữ liệu
        $query = "SELECT password FROM User WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $query);
    
        if (!$stmt) {
            return "query_failed";
        }
    
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $currentPassword);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    
        // Kiểm tra nếu mật khẩu cũ không khớp
        if ($oldPassword !== $currentPassword) {
            return "incorrect_old_password";
        }
    
        // Cập nhật mật khẩu mới
        $query = "UPDATE User SET password = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $query);
    
        if (!$stmt) {
            return "update_query_failed";
        }
    
        mysqli_stmt_bind_param($stmt, "si", $newPassword, $id);
    
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }
    
    
}    
?>