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
        $contendBlogModel = $this->model("modelblogdetail");
        $contendblog = $contendBlogModel->getBlog($id);
        $commentModel = $this->model("modelblogdetail");
        $comments = $commentModel->getCommentsByBlogId($id);
        $userModel = $this->model("modelblogdetail");
        $user = $userModel->getUserInfo($user_Id);
        $topBlog = $contendBlogModel->getLatestBlogs();


        //  var_dump($comments);
        $likeColors = [];
        foreach ($comments as $comment) {
            $comment_id = $comment['id'];
            $likeColorModel = $this->model("modelblogdetail");
            $likeColors[$comment_id] = $likeColorModel->checkComment($user_Id, $comment_id)['like'] ?? 0;
        }

        $this->view("viewHom", [
            "page" => "blogdetail",
            "contendblog" => $contendblog['content'],
            "comments" => $comments,
            "likeColors" => $likeColors,
            'fullname' => $user['fullname'],
            "count_comment" => $contendblog['count_comment'],
            'image' => $user['image'],
            "topBlog" => $topBlog ,
        ]);
    }



    public function comment()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $comment = isset($input['comment']) ? trim($input['comment']) : '';
        $blog_id = isset($input['blog_id']) ? intval($input['blog_id']) : null;

        if (empty($blog_id) || empty($comment)) {
            echo json_encode(['success' => false, 'message' => 'Blog ID hoặc nội dung bình luận không hợp lệ']);
            return;
        }

        if (!isset($_SESSION['user']['id'])) {
            echo json_encode(['success' => false, 'message' => 'User chưa đăng nhập']);
            return;
        }
        $user_id = $_SESSION['user']['id'];

        $blogdetail = $this->model('modelblogdetail');
        $comment_id = $blogdetail->comment($user_id, $blog_id, $comment);

        if ($comment_id) {
            $userInfo = $blogdetail->getUserInfo($user_id);


            if ($userInfo) {
                echo json_encode([
                    'success' => true,
                    'comment_id' => $comment_id,
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
        header('Content-Type: application/json');


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inputData = file_get_contents('php://input');
            $data = json_decode($inputData, true);


            if ($data === null) {
                echo json_encode(['error' => 'Dữ liệu JSON không hợp lệ']);
                exit;
            }


            if (isset($data['comment_id'])) {
                $comment_id = $data['comment_id'];
                $user_Id = $_SESSION['user']['id'] ?? null;


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
