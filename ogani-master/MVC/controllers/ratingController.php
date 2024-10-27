<?php
class ratingController extends Controller {
    public function rating() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $response = [];
            $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
            $review = isset($_POST['review']) ? $_POST['review'] : '';
            $product_ids = isset($_POST['product_ids']) ? json_decode($_POST['product_ids'], true) : []; 
            $imageUploadPath = '';
            $videoUploadPath = ''; 
            $imageDirectory = 'D:/XAMP/htdocs/DACS2/ogani-master/img/rating/image';
            $videoDirectory = 'D:/XAMP/htdocs/DACS2/ogani-master/img/rating/video';
            if (!is_dir($imageDirectory)) {
                mkdir($imageDirectory, 0777, true);
            }
            if (!is_dir($videoDirectory)) {
                mkdir($videoDirectory, 0777, true);
            }
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imageUploadPath = '/ogani-master/img/rating/image/' . $imageName;
                if (move_uploaded_file($imageTmpPath, $imageDirectory . '/' . $imageName)) {
                    $response['image'] = $imageUploadPath; 
                } else {
                    $response['error'] = 'Failed to upload image.';
                }
            } else {
                $response['image'] = null; 
            }
            if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
                $videoTmpPath = $_FILES['video']['tmp_name'];
                $videoName = $_FILES['video']['name'];
                $videoUploadPath = '/ogani-master/img/rating/video/' . $videoName; 
                if (move_uploaded_file($videoTmpPath, $videoDirectory . '/' . $videoName)) {
                    $response['video'] = $videoUploadPath; 
                } else {
                    $response['error'] = 'Failed to upload video.';
                }
            } else {
                $response['video'] = null; 
            }
            error_log("Dữ liệu POST nhận được:\n" . print_r($_POST, true));
            error_log("Dữ liệu FILES nhận được:\n" . print_r($_FILES, true));
            $response['success'] = true;
            $response['data'] = [
                'rating' => $rating,
                'review' => htmlspecialchars($review),
                'image' => $response['image'], 
                'video' => $response['video'] 
            ];
            $userId = $_SESSION['user']['id']; 
            $ratingModel = $this->model("modelRating");
            foreach ($product_ids as $product_id) {
                $Saved = $ratingModel->rating($userId, $product_id, $rating, $review, $response['image'], $response['video']);
                
                if ($Saved) {
                    $response['message'] = 'Rating for product ID ' . $product_id . ' saved successfully.';
                } else {
                    $response['message'] = 'Failed to save rating for product ID ' . $product_id . '.';
                }
            }
            echo json_encode($response);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
    }
    
    public function ratingNo() {
        $user_id = $_SESSION['user']['id'] ?? null;
    
        if (!$user_id) {
            header("Location: /ogani-master/MVC/views/login.php");
            exit;
        }
        $listProductModel = $this->model("modelRating");
        $listpd = $listProductModel->getRatingno($user_id);
    
        if (empty($listpd)) {
            $this->view("rating/myRatingno", ['listpdno' => $listpd]);
            return;
        }
        $_SESSION['product_ids'] = []; 
        foreach ($listpd as $product) {
            $_SESSION['product_ids'][] = $product['id']; 
        }
        $this->view("rating/myRatingno", ['listpdno' => $listpd]);
    }
    public function getProductIdsFromSession() {
        if (isset($_SESSION['product_ids'])) {
            echo json_encode(['product_ids' => $_SESSION['product_ids']]);
        } else {
            echo json_encode(['product_ids' => []]);
        }
    }
    public function ratingYes(){
        $user_id = $_SESSION['user']['id'] ?? null;
        $listProductModel = $this->model("modelRating");
        $listpd = $listProductModel->getRatingyes($user_id);
        if (empty($listpd)) {
            $this->view("rating/myRatingno", ['listpdno' => $listpd]);
            return;
        }
        $this->view("rating/myRatingyes", ['listpdno' => $listpd]);
    }
}
?>