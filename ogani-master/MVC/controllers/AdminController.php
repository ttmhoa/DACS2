<?php
class AdminController extends Controller{
    public function eidtUser(){

    }
    public function showUser(){
        $id=$_SESSION["user"]["id"];
        $userModell= $this->model("modelUser");
        $user= $userModell->showUser($id);
        $this-> view("admin/editAdmin",['pro5User'=>$user]);
        
    }
    public function editUser() {
        $id = $_SESSION["user"]["id"];
    
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone_number'];
    
            // Khởi tạo đường dẫn lưu ảnh
            $imageDirectory = 'D:/XAMP/htdocs/DACS2/ogani-master/img/user/';
            $imagePath = null; // Khởi tạo giá trị mặc định là null
    
            // Tạo thư mục nếu chưa tồn tại
            if (!is_dir($imageDirectory)) {
                mkdir($imageDirectory, 0777, true);
            }
    
            // Kiểm tra xem có file ảnh nào được tải lên không
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $imageTmpPath = $_FILES['avatar']['tmp_name'];
                $imageExtension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION); // Lấy phần mở rộng của file
                $imageName = $id . '.' . $imageExtension; // Tạo tên file bằng ID và phần mở rộng
    
                $imageUploadPath = $imageDirectory . $imageName; // Đường dẫn đầy đủ để lưu ảnh
    
                // Di chuyển file ảnh vào thư mục chỉ định
                if (move_uploaded_file($imageTmpPath, $imageUploadPath)) {
                    $imagePath = '/ogani-master/img/user/' . $imageName; // Đường dẫn ảnh lưu vào DB
                } else {
                    echo json_encode(['success' => false, 'message' => 'Không thể tải ảnh lên']);
                    return;
                }
            } else {
                // Nếu không có tệp ảnh được gửi, hãy xuất thông báo lỗi
                echo json_encode(['success' => false, 'message' => 'Không có tệp ảnh nào được gửi']);
                return;
            }
    
            // Xuất ra đường dẫn ảnh để kiểm tra
            // echo "Đường dẫn ảnh: " . $imagePath . "<br>"; // Xuất ra đường dẫn ảnh
    
            // Gọi đến model để cập nhật thông tin người dùng
            $userModel = $this->model('modelUser');
            $updateStatus = $userModel->uploadUser($id, $fullname, $email, $address, $phone, $imagePath);
    
            if ($updateStatus) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]); 
            }
        }
    }
    public function changePassword() {
        $id = $_SESSION["user"]["id"];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = $_POST["old_password"];
            $newPassword = $_POST["new_password"];
            $confirmPassword = $_POST["confirm_password"];
    
            if (isset($oldPassword) && isset($newPassword) && isset($confirmPassword)) {
                // Kiểm tra xem mật khẩu mới có khớp với xác nhận mật khẩu không
                if ($newPassword === $confirmPassword) {
                    // Kiểm tra để chắc chắn mật khẩu mới không trùng với mật khẩu cũ
                    if ($oldPassword != $newPassword) {
                        $userModel = $this->model("modelUser");
                        $updatePassword = $userModel->updatePassword($id, $newPassword, $oldPassword);
    
                        // Xử lý kết quả từ model
                        if ($updatePassword === true) {
                            echo json_encode(["status" => "success", "message" => "Cập nhật mật khẩu thành công"]);
                        } elseif ($updatePassword === "incorrect_old_password") {
                            echo json_encode(["status" => "error", "message" => "Mật khẩu cũ không đúng"]);
                        } elseif ($updatePassword === "query_failed") {
                            echo json_encode(["status" => "error", "message" => "Lỗi truy vấn cơ sở dữ liệu"]);
                        } elseif ($updatePassword === "update_query_failed") {
                            echo json_encode(["status" => "error", "message" => "Cập nhật mật khẩu thất bại"]);
                        } else {
                            echo json_encode(["status" => "error", "message" => "Có lỗi xảy ra khi cập nhật mật khẩu"]);
                        }
                    } else {
                        echo json_encode(["status" => "error", "message" => "Mật khẩu mới không được trùng với mật khẩu cũ"]);
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Mật khẩu xác nhận không trùng khớp"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Tất cả các trường không được để trống"]);
            }
        }
    }
    
    
}    
?>