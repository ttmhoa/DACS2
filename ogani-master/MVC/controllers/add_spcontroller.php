<?php
class add_spcontroller extends Controller
{

    function Sayhi()
    {
        $teo = $this->model("add_sp");
        $this->view(
            "viewAdmin",
            [
                "page" => "add_sp",
                "categories_list" => $teo->get_list_categories(),

            ]
        );
    }

    function create_newProduct()
    {
        $teo = $this->model("add_sp");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Define required fields
            $requiredFields = ['title', 'description', 'stock', 'price', 'category_id'];
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
                header("Location: /catogoriescontroller");
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
                $imagePath = "/ogani-master/img/categories/" . $newFileName;
    
                $create_cate = [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'image' => $imagePath,
                    'thumbnail' => $imagePath, // Use the same path for thumbnail if needed
                    'stock' => $data['stock'],
                    'price' => $data['price'],
                    'category_id' => $data['category_id']
                ];
    
                if ($teo->create_newpProduct($create_cate)) {
                    header("Location: /add_spcontroller");
                    exit();
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }

    function Viewnews($parampage, $name, $password)
    {
        // model
        $teo = $this->model("add_sp");
        $tong = $teo->addSP($name, $password);
        // view
        $this->view("viewAdmin", ["page" => $parampage, "Number" => $tong, "Number2" => "hihui"]);
    }
}
