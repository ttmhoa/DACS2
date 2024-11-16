<?php

class productscontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("products");
       $this->view(
        "viewAdmin",
       [
        "page"=>"products",
        "products_list"=>$teo->get_list_products(),
       ]
    );
    }
    function delete($id){
        $teo = $this->model("products");
        $result = $teo->delete($id);
        if($result){
            header("Location: /productscontroller");
        }else{
            echo "xoa that bai";
        }
    }
    function edit($id){
        $teo = $this->model("products");
        $this->view(
            "viewAdmin",
            [
                "page"=>"formRectifySp",
                "products_list"=>$teo->get_list_products_byid($id),
            ]
            );
    }
   

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("products");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view(
            "viewAdmin",[
            "page"=>$parampage,
            "Number"=>$tong,
            "Number2"=>"hihui"]
        );
    }

    public function update() {
        $teo = $this->model("products");
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $requiredFields = ['id', 'name', 'price', 'description', 'stock'];
            $missingFields = [];
    
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missingFields[] = $field;
                }
            }
    
            if (!empty($missingFields)) {
                $missingFieldsString = implode(", ", $missingFields);
                echo "Các trường sau đây còn thiếu: " . $missingFieldsString;
                header("Location: /productscontroller/edit/" . $_POST['id']);
                exit();
            } else {
                $oldImagePath = $_POST['image'];
                $imagePath = $oldImagePath; // Mặc định sử dụng ảnh cũ
    
                // Xóa file ảnh cũ nếu có file mới được upload
                if (isset($_FILES['fileimage']) && $_FILES['fileimage']['error'] == 0) {
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Xóa file ảnh cũ
                    }
    
                    $target_dir = "ogani-master/img/";
                    $target_file = $target_dir . basename($_FILES["fileimage"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
                    $check = getimagesize($_FILES["fileimage"]["tmp_name"]);
                    if ($check === false) {
                        echo "File không phải là hình ảnh.";
                        $uploadOk = 0;
                    }
    
                    if (file_exists($target_file)) {
                        echo "File đã tồn tại. Sử dụng file ảnh cũ.";
                        $uploadOk = 0;
                    }
    
                    if ($_FILES["fileimage"]["size"] > 500000) {
                        echo "Xin lỗi, file quá lớn.";
                        $uploadOk = 0;
                    }
    
                    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo "Xin lỗi, chỉ cho phép các định dạng JPG, JPEG, PNG & GIF.";
                        $uploadOk = 0;
                    }
    
                    if ($uploadOk == 0) {
                        echo "Không upload file mới. Sử dụng file ảnh cũ.";
                    } else {
                        if (move_uploaded_file($_FILES["fileimage"]["tmp_name"], $target_file)) {
                            echo "File " . htmlspecialchars(basename($_FILES["fileimage"]["name"])) . " đã được tải lên.";
                            $imagePath = '/' . $target_file; // Gán đường dẫn theo yêu cầu
                        } else {
                            echo "Xin lỗi, có lỗi trong việc tải file lên.";
                        }
                    }
                }
    
                $updatedata = [
                    'id' => $_POST['id'],
                    'title' => $_POST['name'],
                    'description' => $_POST['description'],
                    'updated_at' => date('Y-m-d H:i:s'),
                    'image' => $imagePath,
                    'stock' => $_POST['stock'],
                    'price' => $_POST['price'],
                ];
    
                if ($teo->update_product($updatedata)) {
                    header("Location: /productscontroller");
                    exit();
                } else {
                    echo "Có lỗi trong việc cập nhật sản phẩm.";
                    header("Location: /productscontroller");
                    exit();
                }
            }
        }
    }
}
?>

