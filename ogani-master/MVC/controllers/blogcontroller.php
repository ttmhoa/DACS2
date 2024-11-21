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

            
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $text = isset($_POST['text']) ? $_POST['text'] : '';
            $descript = isset($_POST['descript']) ? $_POST['descript'] : '';
            $category = isset($_POST['category']) ? $_POST['category'] : ''; 

            
            $imageUploadPath = '';
            $imageDirectory = 'D:/XAMP/htdocs/DACS2/ogani-master/img/blog';

            
            if (!is_dir($imageDirectory)) {
                mkdir($imageDirectory, 0777, true);
            }

            
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

        
            $response['success'] = true;
            $response['data'] = [
                'title' => $title,
                'text' => $text,
                'image' => $response['image'],
                'descript' => $descript,
                'category' => $category 
            ];

            
            $user_id = $_SESSION['user']['id'];

            
            $blogModel = $this->model('modelBlog');

            
            $save = $blogModel->createBlog($user_id, $title, $text, $response['image'], $descript, $category); 

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
    
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['search_name'])) {
        $search_name = $data['search_name'];

        
        if ($search_name == 'Food' || $search_name == 'Beauty' || $search_name == 'Vegetables' || $search_name == 'Fruit') {
            $this->search_Type($search_name);
        } elseif ($search_name == 'All') {
            
            $this->showBlog();
        }

        
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

    
        echo json_encode(['success' => true, 'html' => $output]);
        exit;
    } else {
        
        echo json_encode(['success' => false, 'html' => '']);
    }
}



    public function search_Type()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $search_name = $data['search_name'] ?? '';

            
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

            
            echo json_encode(['success' => true, 'html' => $output]);
            exit;
        } else {
            
            echo json_encode(['success' => false, 'message' => 'Chỉ hỗ trợ POST request']);
            exit;
        }
    }
}
