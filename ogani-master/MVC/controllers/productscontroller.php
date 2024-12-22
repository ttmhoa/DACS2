<?php

class productscontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("products");
        $current_page=1;
       $this->view(
        "viewAdmin",
       [
        "page"=>"products",
        "products_list"=>$teo->get_list_products(),
        "Products"=>$teo->phantrang_click_model($current_page),
       ]
    );
    }
    function phantrang_click($parampage,$current_page){
        $teo = $this->model("products");
        
       $this->view(
        "viewAdmin",
       [
        "page"=>$parampage,
        
        "Products"=>$teo->phantrang_click_model($current_page),
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
   

  
    public function update($id) { 
        $teo = $this->model("products");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Define required fields
            $requiredFields = ['id', 'name', 'price', 'description', 'stock'];
            $data = [];
        
            // Collect and trim input data
            foreach ($requiredFields as $field) {
                if (isset($_POST[$field])) {
                    $data[$field] = trim($_POST[$field]);
                } else {
                    $data[$field] = null; // Default to null if not set
                }
            }
        
            $fileImage = $_FILES['fileimage'];
        
            // Check for empty required fields
            if (in_array(null, $data) || $fileImage['error'] == UPLOAD_ERR_NO_FILE) {
                header("Location: /productscontroller");
                exit();
            }
        
            // File upload path
            $uploadDir = 'ogani-master/img/categories/';
            $fileName = pathinfo($fileImage['name'], PATHINFO_FILENAME);
            $fileExt = pathinfo($fileImage['name'], PATHINFO_EXTENSION);
        
            // Create a new file name
            $newFileName = "cat-" . uniqid() . "." . $fileExt;
        
            // Check if the file already exists and rename if necessary
            while (file_exists($uploadDir . $newFileName)) {
                $newFileName = "cat-" . uniqid() . "." . $fileExt;
            }
        
            // Move the uploaded file to the designated directory
            if (move_uploaded_file($fileImage['tmp_name'], $uploadDir . $newFileName)) {
                $modify_cate_data = [
                    "id" => $data['id'],
                    "name" => $data['name'],
                    "price" => $data['price'],
                    "image" => "/ogani-master/img/categories/" . $newFileName,
                    "description" => $data['description'],
                    "stock" => $data['stock'],
                ];
        
                if ($teo->modify_product_model($modify_cate_data, $id)) {
                    header("Location: /productscontroller");
                    exit();
                }
            } else {
                echo "Error uploading file.";
            }
        }
       
        }
    
}
?>

