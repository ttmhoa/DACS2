<?php
class shopCardcontroller extends Controller{

    function  Sayhi(){
        
        $teo = $this->model("modelshopCard");
        $product=$_SESSION['cart'] ?? []; //kiem tra gia tri sesion neu null?empty =>mang rongrong
        $this->view("viewHom",[
        "page"=>"shopping-card",
        'product'=>$product,
        
    ]);
       
    }
    public function destroy(){
        unset($_SESSION['cart']);
        header("Location: /shopCardcontroller");
    }
    

    public function  delete($id){
        $id= $id ?? null;
        unset($_SESSION['cart'][$id]);
        header("Location: /shopCardcontroller");
    }

    public function update() {
        // Kiểm tra xem có dữ liệu từ POST không
        if (isset($_POST['qty']) && is_array($_POST['qty'])) {
            foreach ($_POST['qty'] as $productId => $qty) {
                $sl= $this->model("modelshopCard")->getStock($productId);

                // Kiểm tra xem qty có phải là số dương không
                if (is_numeric($qty) && $qty > 0 && $qty <= $sl) {

                    $_SESSION['cart'][$productId]['qty'] = (int)$qty; // Chỉ lưu số nguyên

                } else {

                    $_SESSION['error_message'] = 'the quality of product ' . $productId . ' is not enough. we have ' . $sl . ' in stock';
                    header("Location: /shopCardcontroller");
                    exit();
                     // Bỏ sản phẩm nếu qty không hợp lệ
                }
            }
        }
        
        header("Location: /shopCardcontroller");
        exit(); // Đảm bảo dừng thực thi tiếp theo
    }
    
    public function  store($id){
        $user_id = $_SESSION['user']['id'] ?? null;
        if (!$user_id) {
            header("Location: /ogani-master/MVC/views/login.php");
            exit;
        }else{
            $productId= $id ?? null;
            $product= $this->model("modelshopCard")->getProduct($productId);
            if(empty($_SESSION['cart']) || !array_key_exists($productId, $_SESSION['cart'])){
                $product['qty']=1;
                $_SESSION['cart'][$productId]= $product;
                
            }else{
                $product['qty'] = $_SESSION['cart'][$productId]['qty'] +1;
                $_SESSION['cart'][$productId]= $product;
            }
            header("Location: /shopCardcontroller");
        }
      
    
    }
    


}
?>