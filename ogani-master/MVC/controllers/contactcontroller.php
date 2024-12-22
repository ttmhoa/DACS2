<?php
class contactcontroller extends Controller
{
    // Hiển thị trang liên hệ
    function Sayhi()
    {
        $teo = $this->model("modelcontact");
        $this->view("viewHom", ["page" => "contact"]);
    }

    // Hiển thị các thông tin theo trang
    function Viewnews($parampage, $name, $password)
    {
        // model
        $teo = $this->model("modelcontact");
        $tong = $teo->addSP($name, $password);

        // view
        $this->view("viewHom", ["page" => $parampage, "Number" => $tong, "Number2" => "hihui"]);
    }

    // Xử lý form liên hệ
    function handleContactForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form và lọc
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $message = isset($_POST['message']) ? trim($_POST['message']) : '';

            // In ra để kiểm tra dữ liệu
            echo "<h3>Debugging Form Data:</h3>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Message:</strong> $message</p>";
            echo "<hr>";

            // Kiểm tra dữ liệu đầu vào
            if (empty($name) || empty($email) || empty($message)) {
                echo "<p style='color: red;'>All fields are required!</p>";
                return;
            }

            // Gọi hàm gửi email
            $this->sendEmail($name, $email, $message);
        } else {
            echo "<p>This is not a POST request.</p>";
        }
    }

    // Gửi email
    function sendEmail($name, $email, $message)
    {
        // Email nhận thông báo
        $to = "vythcsvp@gmail.com"; // Địa chỉ email nhận thông báo

        // Tiêu đề email
        $subject = "New Message from Contact Form";

        // Nội dung email
        $body = "You have received a new message.\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Message: $message\n";

        // Cài đặt headers cho email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";
        $headers .= "From: $email" . "\r\n";  // Địa chỉ người gửi
        $headers .= "Reply-To: $email" . "\r\n";  // Địa chỉ trả lời

        // Gửi email và ghi log
        if (mail($to, $subject, $body, $headers)) {
            // Ghi log vào file khi gửi thành công
            $this->logEmail("Message sent successfully from $name <$email>");
            echo "<p>Message sent successfully!</p>";
        } else {
            // Ghi log vào file khi có lỗi
            $this->logEmail("Error sending message from $name <$email>");
            echo "<p>There was an error sending your message.</p>";
        }
    }

    // Ghi log vào file email_log.txt
    function logEmail($message)
    {
        $logFile = "D:/XAMP/apache/logemail.txt"; // Đường dẫn tới file log

        // Mở file và ghi log
        $date = date("Y-m-d H:i:s");
        $logMessage = "[$date] $message" . "\n";

        file_put_contents($logFile, $logMessage, FILE_APPEND); // Ghi vào cuối file log
    }

    // Hiển thị log từ file email_log.txt
    function showLog()
    {
        $logFile = "email_log.txt"; // Đường dẫn tới file log
        if (file_exists($logFile)) {
            $logContent = file_get_contents($logFile);  // Đọc nội dung file log
            echo "<pre>" . htmlspecialchars($logContent) . "</pre>";  // Hiển thị nội dung file
        } else {
            echo "Log file does not exist.";  // Nếu file log không tồn tại
        }
    }
}
?>
