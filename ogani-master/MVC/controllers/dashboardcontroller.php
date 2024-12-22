<?php
class DashboardController extends Controller
{

    // // Phương thức mặc định
    // function Sayhi()
    // {
    //     // Gọi View "viewAdmin" với trang mặc định là "dashboard"
    //     $this->view("viewAdmin", ["page" => "dashboard"]);
    // }

    // Phương thức xử lý ViewNews
    function Viewnews($parampage, $name, $password)
    {
        // Gọi Model "dashboard" để xử lý dữ liệu
        $teo = $this->model("dashboard");
        $tong = $teo->addSP($name, $password);

        // Truyền dữ liệu đến View "viewAdmin"
        $this->view("viewAdmin", ["page" => $parampage, "Number" => $tong, "Number2" => "hihui"]);
    }

    // Phương thức xử lý Discount
    function CreateDiscount()
    {
        // Kiểm tra xem dữ liệu discount có trong cookie không
        if (isset($_COOKIE['discountData'])) {
            $discountData = json_decode($_COOKIE['discountData'], true);

            // Gọi Model Discount để lưu dữ liệu vào cơ sở dữ liệu
            $model = $this->model("dashboard");
            $result = $model->saveDiscount($discountData);

            // Xóa cookie sau khi xử lý xong
            setcookie('discountData', '', time() - 3600, '/');

            // Phản hồi kết quả
            if ($result) {
                echo "Discount created successfully!";
            } else {
                echo "Failed to create discount!";
            }
        } else {
            echo "No data found!";
        }
    }
    public function getDiscount()
    {
        // Lấy thời gian từ yêu cầu AJAX hoặc sử dụng thời gian hiện tại
        $time = $_POST['current_time'] ?? date('Y-m-d H:i:s');

        // Lấy dữ liệu từ model
        $model = $this->model("dashboard");
        $discounts = $model->getDiscount($time);

        // Nếu không có dữ liệu, gán mảng rỗng
        if (empty($discounts)) {
            $discounts = [];
        }

        // Tạo HTML để gửi lại
        $html = '';

        if (!empty($discounts)) {
            foreach ($discounts as $discount) {
                $statusClass = $discount['status'] === 'Active Discount' ? 'badge-success' : 'badge-danger';
                $statusText = $discount['status'] === 'Active Discount' ? 'Active' : 'Expired';

                $html .= '
				<div class="col-lg-4 col-6">
					<div class="small-box card">
						<div class="inner">
							<h3>' . htmlspecialchars($discount['discount_amount']) . '</h3>
							<p>' . htmlspecialchars($discount['name']) . '</p>
							<div class="status">
								<span class="badge ' . $statusClass . '">' . $statusText . '</span>
							</div>
						</div>
						<a href="#" class="small-box-footer text-dark">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			';
            }
        } else {
            $html = '<div class="col-12 text-center"><p>Hiện tại không có khuyến mãi nào.</p></div>';
        }

        // Trả về HTML
        echo $html;
    }
}
