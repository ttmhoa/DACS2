<?php

class App
{
    protected $controller = "Hom"; // Giá trị mặc định của controller
    protected $action = "Sayhi";    // Giá trị mặc định của action
    protected $params = [];         // Tham số cho action

    public function __construct()
    {
        // Xử lý các thành phần của URL
        $arr = $this->UrlProccess();

        // Kiểm tra và thiết lập controller nếu tồn tại
        if (!empty($arr[0]) && file_exists("./ogani-master/MVC/controllers/" . $arr[0] . ".php")) {
            $this->controller = $arr[0];
            unset($arr[0]); // Xóa controller khỏi mảng
        }

        // Require file controller
        require_once "./ogani-master/MVC/controllers/" . $this->controller . ".php";

        // Tạo một thể hiện của controller
        $this->controller = new $this->controller();

        // Kiểm tra và thiết lập action nếu tồn tại
        if (isset($arr[1]) && method_exists($this->controller, $arr[1])) {
            $this->action = $arr[1];
            unset($arr[1]); // Xóa action khỏi mảng
        }

        // Thiết lập các tham số còn lại
        $this->params = $arr ? array_values($arr) : [];

        // Gọi action với các tham số
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    private function UrlProccess()
    {
        // Kiểm tra nếu URL được set và xử lý
        if (isset($_GET['url'])) {
            return explode("/", filter_var(trim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }
        return []; // Trả về mảng rỗng nếu không có URL
    }
}
