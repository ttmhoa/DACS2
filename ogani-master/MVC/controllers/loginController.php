<?php
class loginController extends Controller
{
    function login()
    {
        header('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập và mật khẩu không được để trống.']);
                return;
            }

            $loginModel = $this->model("modellogin_signup");
            $user = $loginModel->login($username, $password);
            switch (true) {
                case is_array($user):
                    $_SESSION['user'] = $user;
                    echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công.']);
                    break;

                case $user === 1:
                    http_response_code(401);
                    echo json_encode(['status' => 'error', 'message' => 'Mật khẩu không đúng.']);
                    break;

                case $user === 2:
                    http_response_code(404);
                    echo json_encode(['status' => 'error', 'message' => 'Tài khoản không tồn tại.']);
                    break;

                default:
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Lỗi máy chủ.']);
                    break;
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ.']);
        }
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location:/ogani-master/MVC/views/login.php");
        exit();
    }
    public function signup()
    {
        header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["fullname"] ?? '';
            $email    = $_POST["email"] ?? '';
            $password = $_POST["password"] ?? '';
            $confirm  = $_POST["confirm"] ?? '';
            $address  = $_POST["address"] ?? '';
            $phone    = $_POST["phone_number"] ?? '';
            $role     = $_POST["role_id"] ?? '';

            if (!empty($username) && !empty($address) && !empty($email) && !empty($password) && !empty($phone) && !empty($role)) {
                if ($password !== $confirm) {
                    echo json_encode(['status' => 'error', 'message' => 'Mật khẩu không trùng khớp']);
                    return;
                }
                $signupModel = $this->model("modellogin_signup");
                $newUser = $signupModel->signup($username, $password, $email, $phone, $address, $role);
                if ($newUser === true) {
                    echo json_encode(['status' => 'success', 'message' => 'Đăng ký thành công.']);
                } elseif ($newUser === 1) {
                    echo json_encode(['status' => 'error', 'message' => 'Email đã tồn tại.']);
                } elseif ($newUser === 2) {
                    echo json_encode(['status' => 'error', 'message' => 'Lỗi khi tạo tài khoản.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Lỗi không xác định.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
        }
    }
}
