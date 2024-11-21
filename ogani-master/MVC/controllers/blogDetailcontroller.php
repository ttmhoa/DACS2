<?php
class blogDetailcontroller extends Controller
{

    function Sayhi()
    {
        $teo = $this->model("modelblogdetail");
        $this->view("viewHom", ["page" => "blogdetail"]);
    }

    function Viewnews($parampage, $name, $password)
    {
        // model
        $teo = $this->model("modelblogdetail");
        $tong = $teo->addSP($name, $password);
        // view
        $this->view("viewHom", ["page" => $parampage, "Number" => $tong, "Number2" => "hihui"]);
    }
    public function getBlog($id)
    {
        $user_Id = $_SESSION['user']['id'];
        // Lấy bài viết từ model blogdetail
        $contendBlogModel = $this->model("modelblogdetail");
        $contendblog = $contendBlogModel->getBlog($id);

        // Lấy các bình luận từ model comment (sửa lại từ modelblogdetail thành modelComment)
        $commentModel = $this->model("modelblogdetail"); // Đảm bảo đây là model đúng
        $comments = $commentModel->getCommentsByBlogId($id);
        //  $commentModel = $this->model("modelblogdetail"); // Đảm bảo đây là model đúng
        // $comments = $commentModel->getCommentsByBlogId($id);
        $userModel = $this->model("modelblogdetail"); // Đảm bảo đây là model đúng
        $user = $userModel->getUserInfo($user_Id);
        //  var_dump($comments);
        $likeColors = []; // Mảng lưu trạng thái "like" cho từng bình luận
        foreach ($comments as $comment) {
            $comment_id = $comment['id'];
            // Gọi model để kiểm tra trạng thái "like"
            $likeColorModel = $this->model("modelblogdetail");
            $likeColors[$comment_id] = $likeColorModel->checkComment($user_Id, $comment_id)['like'] ?? 0;
        }

        // Truyền cả bài viết, bình luận và trạng thái "like" vào View
        $this->view("viewHom", [
            "page" => "blogdetail",
            "contendblog" => $contendblog['content'],  // Lấy nội dung bài viết
            "comments" => $comments,
            "likeColors" => $likeColors, // Truyền trạng thái "like" cho View
            'fullname' => $user['fullname'],
            "count_comment" => $contendblog['count_comment'],
            'image' => $user['image'],
        ]);
    }



    public function comment()
    {
        header('Content-Type: application/json'); // Phản hồi JSON

        // Kiểm tra phương thức request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        // Đọc dữ liệu từ JSON payload
        $input = json_decode(file_get_contents('php://input'), true);
        $comment = isset($input['comment']) ? trim($input['comment']) : '';
        $blog_id = isset($input['blog_id']) ? intval($input['blog_id']) : null;

        // Kiểm tra dữ liệu đầu vào
        if (empty($blog_id) || empty($comment)) {
            echo json_encode(['success' => false, 'message' => 'Blog ID hoặc nội dung bình luận không hợp lệ']);
            return;
        }

        // Lấy user_id từ session (yêu cầu session được khởi tạo trước đó)
        if (!isset($_SESSION['user']['id'])) {
            echo json_encode(['success' => false, 'message' => 'User chưa đăng nhập']);
            return;
        }
        $user_id = $_SESSION['user']['id'];

        // Tương tác với model
        $blogdetail = $this->model('modelblogdetail');
        $comment_id = $blogdetail->comment($user_id, $blog_id, $comment);

        if ($comment_id) {
            // Lấy thông tin fullname và image từ model
            $userInfo = $blogdetail->getUserInfo($user_id);
            // var_dump($userInfo);


            if ($userInfo) {
                echo json_encode([
                    'success' => true,
                    'comment_id' => $comment_id,  // Trả về comment_id
                    'comment' => $comment,
                    'user_id' => $user_id,
                    'fullname' => $userInfo['fullname'],
                    'image' => $userInfo['image'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không lấy được thông tin người dùng']);
            }
        } else {
            error_log("Failed to save comment for user_id: $user_id, blog_id: $blog_id");
            echo json_encode(['success' => false, 'message' => 'Failed to save comment']);
        }
    }


    public function likeComment()
    {
        header('Content-Type: application/json'); // Đặt tiêu đề trả về là JSON

        // Kiểm tra nếu phương thức yêu cầu là POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inputData = file_get_contents('php://input');
            $data = json_decode($inputData, true);

            // Kiểm tra nếu dữ liệu JSON hợp lệ
            if ($data === null) {
                echo json_encode(['error' => 'Dữ liệu JSON không hợp lệ']);
                exit;
            }

            // Kiểm tra nếu có 'comment_id' trong dữ liệu
            if (isset($data['comment_id'])) {
                $comment_id = $data['comment_id'];
                $user_Id = $_SESSION['user']['id'] ?? null;

                // Kiểm tra xem người dùng đã đăng nhập hay chưa
                if (!$user_Id) {
                    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để thực hiện hành động này.']);
                    exit;
                }
                $commentModel = $this->model('modelblogdetail');
                $likeCount = $commentModel->getLike($user_Id, $comment_id);
                if ($likeCount !== null) {
                    echo json_encode([
                        'success' => true,
                        'likeCount' => $likeCount['likeCount'],
                        'userLike' => $likeCount['userLike']
                        // Trả về số lượt thích mới
                    ]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Không thể cập nhật lượt thích.']);
                }
                exit;
            } else {
                echo json_encode(['error' => 'Không có comment_id trong yêu cầu.']);
            }
        }
        exit;
    }
    public function search()
    {
        if (isset($_POST['action'])) {
            $search_name = $_POST['search_name'];
            $searchModel = $this->model('modelblogdetail');
            $result = $searchModel->search_model($search_name);
            $output = "";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $output .= ' 
                    <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" style="background-image: url(' . $row["image"] . ');">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">' . $row["title"] . '</a></h6>
                        </div>
                    </div>
                    </div>
                ';
                }
            } else {
                $output .= '<div class="col-lg-12">Không tìm thấy sản phẩm nào.</div>';
            }

            echo $output;
        }
    }
}
