<?php
class checkoutcontroller extends Controller{

    function Sayhi(){
       $teo = $this->model("modelCheckout");
       $this->view("viewHom",["page"=>"checkout"]);
    }


function store() {
    $teo = $this->model("modelCheckout");

    // Kiểm tra xem giỏ hàng có rỗng không
    if (!empty($_SESSION['cart'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Kiểm tra các giá trị trong $_POST
            $requiredFields = ['fullName', 'email', 'address', 'phone', 'note'];
            $missingFields = [];

            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missingFields[] = $field; // Lưu lại trường thiếu
                }
            }

            // Nếu có trường thiếu, thông báo cho người dùng
            if (!empty($missingFields)) {
                $missingFieldsString = implode(", ", $missingFields);
                echo $missingFieldsString;
                header("Location: /checkoutcontroller");
                exit(); // Dừng thực thi nếu có trường thiếu
            }

            // Nếu không thiếu trường nào, tiến hành xử lý đơn hàng
            $orderData = [
                'user_id' => $_SESSION['user']['id'] ?? null,
                'fullname' => $_POST['fullName'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'note' => $_POST['note'],
                'total_money' => $_SESSION['total'],
                'code' => rand(100, 10000),
                'order_date' => date('Y-m-d H:i:s')
            ];

            // Tạo đơn hàng và lấy ID
            $id_orders = $teo->create_oders($orderData);
            if ($id_orders) {
                // Nếu tạo đơn hàng thành công, gọi storeOrderDetail
                $this->storeOrderDetail($id_orders);

                // Chuyển hướng sau khi hoàn thành
                header("Location: /checkoutcontroller");
                exit(); // Dừng thực thi mã
            } else {
                echo "Có lỗi xảy ra khi tạo đơn hàng.";
            }
        }
    } else {
        echo "Giỏ hàng không rỗng.";
    }
}
    public function storeOrderDetail($id_orders)
    {
        $teo = $this->model("modelCheckout");
        foreach ($_SESSION['cart'] as $product) {
            if (!isset($product['id'], $product['price'], $product['qty'], $product['title'])) {
                echo "Dữ liệu sản phẩm không hợp lệ.";
                continue; // Bỏ qua sản phẩm nếu không hợp lệ
            }
        
            $orderData = [
                'order_id' => $id_orders,
                'price' => $product['price'],
                'product_id' => $product['id'],
                'num' => $product['qty'],
                'product_name' => $product['title'],
            ];
            $teo->create_odersdetail($orderData);
            $teo->updatecompleteSp($orderData);
        }
        unset($_SESSION['cart']);
        header("Location: /shopCardcontroller");
        exit();
        

    }

}
?> 

