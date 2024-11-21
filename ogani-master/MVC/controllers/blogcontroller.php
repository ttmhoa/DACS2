<?php
class blogcontroller extends Controller
{

    function Sayhi()
    {
        $teo = $this->model("modelblog");
        $this->view("viewHom", ["page" => "blog"]);
    }
    function Viewnews($parampage, $name, $password)
    {
        // model
        $teo = $this->model("blog");
        $tong = $teo->addSP($name, $password);
        $this->view("viewHom", ["page" => $parampage, "Number" => $tong, "Number2" => "hihui"]);
    }
    public function createBlog()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $response = [];

            // Lấy dữ liệu từ POST
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $text = isset($_POST['text']) ? $_POST['text'] : '';
            $descript = isset($_POST['descript']) ? $_POST['descript'] : '';
            $category = isset($_POST['category']) ? $_POST['category'] : ''; // Lấy category từ POST

            // Xử lý ảnh
            $imageUploadPath = '';
            $imageDirectory = 'D:/XAMP/htdocs/DACS2/ogani-master/img/blog';

            // Tạo thư mục nếu không tồn tại
            if (!is_dir($imageDirectory)) {
                mkdir($imageDirectory, 0777, true);
            }

            // Kiểm tra và xử lý tệp ảnh
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imageUploadPath = '/ogani-master/img/blog/' . $imageName;

                if (move_uploaded_file($imageTmpPath, $imageDirectory . '/' . $imageName)) {
                    $response['image'] = $imageUploadPath;
                } else {
                    $response['error'] = 'Upload ảnh thất bại';
                }
            } else {
                $response['image'] = null;
            }

            // Gửi phản hồi dữ liệu
            $response['success'] = true;
            $response['data'] = [
                'title' => $title,
                'text' => $text,
                'image' => $response['image'],
                'descript' => $descript,
                'category' => $category // Thêm category vào dữ liệu phản hồi
            ];

            // Lấy user_id từ session
            $user_id = $_SESSION['user']['id'];

            // Tạo đối tượng blogModel
            $blogModel = $this->model('modelBlog');

            // Lưu bài viết vào CSDL
            $save = $blogModel->createBlog($user_id, $title, $text, $response['image'], $descript, $category); // Thêm category vào phương thức

            if ($save) {
                $response['message'] = "Tạo bài viết thành công";
                echo json_encode(['success' => true, 'message' => $response['message']]);
            } else {
                $response['message'] = "Tạo bài viết thất bại";
                echo json_encode(['success' => false, 'message' => $response['message']]);
            }
        }
    }

    public function showBlog()
    {
        $listBlogModel = $this->model("modelBlog");
        $listblog = $listBlogModel->getBlog();        
        $this->view("viewHom", ["page" => "blog", "listblog" => $listblog]);
    }
    public function search()
{
    // Lấy dữ liệu JSON từ request body
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['search_name'])) {
        $search_name = $data['search_name'];

        // Kiểm tra nếu tìm kiếm theo loại blog
        if ($search_name == 'Food' || $search_name == 'Beauty' || $search_name == 'Vegetables' || $search_name == 'Fruit') {
            $this->search_Type($search_name);
        } elseif ($search_name == 'All') {
            // Hiển thị tất cả các blog nếu chọn 'All'
            $this->showBlog();
        }

        // Lấy kết quả tìm kiếm từ mô hình
        $searchModel = $this->model('modelBlog');
        $result = $searchModel->search_model($search_name);
        $output = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output .= '
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="' . htmlspecialchars($row['image']) . '" alt="Blog Image">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i>' . date('d-m-Y H:i', strtotime($row['created_at'])) . '</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="/blogDetailcontroller/getBlog/' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></h5>
                                <p>' . htmlspecialchars($row['descript']) . '</p>
                                <a href="#" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output .= '<p>Không tìm thấy kết quả nào.</p>';
        }

        // Trả về kết quả dưới dạng JSON
        echo json_encode(['success' => true, 'html' => $output]);
        exit;
    } else {
        // Nếu không nhận được dữ liệu tìm kiếm, trả về lỗi
        echo json_encode(['success' => false, 'html' => '']);
    }
}



    public function search_Type()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $search_name = $data['search_name'] ?? '';

            // Gọi model để tìm kiếm theo loại
            $serchModel = $this->model('modelBlog');
            $result = $serchModel->search_Type($search_name);

            $output = '';
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $output .= '
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="' . ($row['image']) . '" alt="Blog Image">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i>' . date('d-m-Y H:i', strtotime($row['created_at'])) . '</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="/blogDetailcontroller/getBlog/' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></h5>
                                    <p>' . ($row['descript']) . '</p>
                                    <a href="#" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            } else {
                $output = '<p>Không tìm thấy kết quả nào.</p>';
            }

            // Trả về dữ liệu dưới dạng JSON
            echo json_encode(['success' => true, 'html' => $output]);
            exit;
        } else {
            // Trả về lỗi nếu không phải POST request
            echo json_encode(['success' => false, 'message' => 'Chỉ hỗ trợ POST request']);
            exit;
        }
    }
}
