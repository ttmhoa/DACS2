<?php
class catogoriescontroller extends Controller
{

    function Sayhi()
    { $current_page=1;
        $teo = $this->model("categories");
        $this->view(
            "viewAdmin",
            [
                "page" => "categories",
                "categories_list" => $teo->get_list_categories(),
                "Categories"=>$teo->phantrang_click_model($current_page),
            ]
        );
    }
    function phantrang_click($parampage,$current_page)
    {
        $teo = $this->model("categories");
        $this->view(
            "viewAdmin",
            [
                "page" => $parampage,
                "categories_list" => $teo->get_list_categories(),
                "Categories"=>$teo->phantrang_click_model($current_page),
            ]
        );
    }
    function createCategory($page)
    {
        $teo = $this->model("categories");
        $this->view(
            "viewAdmin",
            [
                "page" => $page,
            ]
        );
    }

    function addnewcategory()
    {
        $teo = $this->model("categories");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $fileImage = $_FILES['fileimage'];

            // Kiểm tra nếu giá trị rỗng
            if (empty($title) || empty($description) || $fileImage['error'] == UPLOAD_ERR_NO_FILE) {
                header("Location: /catogoriescontroller");
                exit();
            }

            // Đường dẫn lưu ảnh
            $uploadDir = 'ogani-master/img/categories/';
            $fileName = pathinfo($fileImage['name'], PATHINFO_FILENAME);
            $fileExt = pathinfo($fileImage['name'], PATHINFO_EXTENSION);

            // Tạo tên file mới
            $newFileName = "cat-" . uniqid() . "." . $fileExt; // Đổi tên với ID duy nhất

            // Kiểm tra nếu file đã tồn tại và đổi tên nếu cần thiết
            while (file_exists($uploadDir . $newFileName)) {
                $newFileName = "cat-" . uniqid() . "." . $fileExt; // Đổi tên nếu trùng
            }

            // Di chuyển file đến thư mục đã chỉ định
            if (move_uploaded_file($fileImage['tmp_name'], $uploadDir . $newFileName)) {
                $create_cate = [
                    "name" => $title,
                    "image" => "/ogani-master/img/categories/" . $newFileName,
                    "description" => $description,
                ];

                if ($teo->create_newcategory($create_cate)) {
                    header("Location: /catogoriescontroller");
                    exit();
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }

    function deleteCategory($id)
    {

        $teo = $this->model("categories");
        $result = $teo->delete($id);

        if ($result) {
            // Xử lý khi xóa thành công
            header("Location: /catogoriescontroller");
        }
    }
    function modify_sp($page, $id)
    {
        $teo = $this->model("categories");
        $this->view(
            "viewAdmin",
            [
                "page" => $page,
                "infor_categories" => $teo->get_categories($id),
            ]
        );
    }
    function modify_cate($id)
    {
        $teo = $this->model("categories");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $fileImage = $_FILES['fileimage'];

            // Kiểm tra nếu giá trị rỗng
            if (empty($title) || empty($description) || $fileImage['error'] == UPLOAD_ERR_NO_FILE) {
                header("Location: /catogoriescontroller");
                exit();
            }

            // Đường dẫn lưu ảnh
            $uploadDir = 'ogani-master/img/categories/';
            $fileName = pathinfo($fileImage['name'], PATHINFO_FILENAME);
            $fileExt = pathinfo($fileImage['name'], PATHINFO_EXTENSION);

            // Tạo tên file mới
            $newFileName = "cat-" . uniqid() . "." . $fileExt; // Đổi tên với ID duy nhất

            // Kiểm tra nếu file đã tồn tại và đổi tên nếu cần thiết
            while (file_exists($uploadDir . $newFileName)) {
                $newFileName = "cat-" . uniqid() . "." . $fileExt; // Đổi tên nếu trùng
            }

            // Di chuyển file đến thư mục đã chỉ định
            if (move_uploaded_file($fileImage['tmp_name'], $uploadDir . $newFileName)) {
                $modify_cate_data = [
                    "name" => $title,
                    "image" => "/ogani-master/img/categories/" . $newFileName,
                    "description" => $description,
                ];

                if ($teo->modify_cate_model($modify_cate_data, $id)) {
                    header("Location: /catogoriescontroller");
                    exit();
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }
}
