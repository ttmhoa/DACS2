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
            $requiredFields = ['title', 'category_id', 'price', 'description', 'stock'];
            $missingFields = [];

            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                $missingFieldsString = implode(", ", $missingFields);

                // Thay vì sử dụng header để chuyển hướng, hãy lưu thông báo vào session
                session_start();
                $_SESSION['error'] = "LACKING FIELDS " . $missingFieldsString;

                // Chuyển hướng đến trang sản phẩm
                header("Location: /add_spcontroller");
                exit();
            } else {
                // Xử lý tải lên tệp
                if (isset($_FILES['fileimage']) && $_FILES['fileimage']['error'] == UPLOAD_ERR_OK) {
                    $uploadsDir = 'ogani-master/img/'; // Thư mục lưu trữ ảnh
                    $imageName = basename($_FILES['fileimage']['name']);
                    $imagePath = $uploadsDir . $imageName;

                    // Di chuyển tệp tải lên vào thư mục
                    if (move_uploaded_file($_FILES['fileimage']['tmp_name'], $imagePath)) {
                        // Tạo mảng dữ liệu để thêm sản phẩm
                        $create_sp = [

                            'title' => $_POST['title'],
                            'description' => $_POST['description'],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'created_at' => date('Y-m-d H:i:s'),
                            'image' => $imagePath,
                            'thumbnail' => $imagePath, // Đường dẫn lưu ảnh
                            'stock' => $_POST['stock'],
                            'price' => $_POST['price'],
                            'category_id' => $_POST['category_id']  // Đảm bảo có category_id
                        ];

                        // Gọi phương thức thêm sản phẩm
                        if ($teo->create_newpProduct($create_sp)) {
                            // Chuyển hướng đến trang danh sách sản phẩm
                            header("Location: /productscontroller");
                            exit();
                        } else {
                            session_start();
                            $_SESSION['error'] = "CANNOT ADD PRODUCT";

                            // Chuyển hướng đến trang sản phẩm
                            header("Location: /add_spcontroller");
                            exit();
                        }
                    } else {
                        session_start();
                        $_SESSION['error'] = "PLEASE CHOOSE IMAGE";

                        // Chuyển hướng đến trang sản phẩm
                        header("Location: /add_spcontroller");
                        exit();
                    }
                } else {
                    session_start();
                    $_SESSION['error'] = "PLEASE CHOOSE IMAGE";

                    // Chuyển hướng đến trang sản phẩm
                    header("Location: /add_spcontroller");
                    exit();
                }
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
