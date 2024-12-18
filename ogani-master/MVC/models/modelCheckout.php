<?php
class  modelCheckout extends DB
{
    public function GetSP()
    {
        // kết nối cơ sở dữ liệu
        return "sanpham1";
    }

    public function create_oders($orderData)
    {
        // Câu lệnh SQL để thêm đơn hàng
        $sql = "INSERT INTO orders (user_id, fullname, email, address, phone_number, note, total_money, code, order_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Chuẩn bị câu lệnh
        $stmt = mysqli_prepare($this->con, $sql);

        // Kiểm tra nếu câu lệnh đã được chuẩn bị thành công
        if ($stmt === false) {
            die("Lỗi chuẩn bị câu lệnh: " . mysqli_error($this->con));
        }

        // Liên kết tham số
        mysqli_stmt_bind_param(
            $stmt,
            "issssssis",
            $orderData['user_id'],
            $orderData['fullname'],
            $orderData['email'],
            $orderData['address'],
            $orderData['phone'],
            $orderData['note'],
            $orderData['total_money'],
            $orderData['code'],
            $orderData['order_date'],
        );

        // Thực thi câu lệnh
        if (mysqli_stmt_execute($stmt)) {

            // Lấy ID của bản ghi vừa chèn
            $lastId = mysqli_insert_id($this->con);
            return $lastId; // Trả về ID của bản ghi vừa chèn
        } else {
            echo "Lỗi: " . mysqli_stmt_error($stmt);
            return false; // Trả về false nếu có lỗi
        }

        // Đóng statement
        mysqli_stmt_close($stmt);
    }
    public function create_odersdetail($orderData)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, price, num, product_name) 
                VALUES (?, ?, ?, ?, ?)";
        
        // Chuẩn bị câu lệnh
        $stmt = mysqli_prepare($this->con, $sql);
    
        // Kiểm tra nếu câu lệnh đã được chuẩn bị thành công
        if ($stmt === false) {
            die("Lỗi chuẩn bị câu lệnh: " . mysqli_error($this->con));
        }
    
        // Liên kết tham số
        mysqli_stmt_bind_param(
            $stmt,
            "issss", // Sửa kiểu dữ liệu nếu cần
            $orderData['order_id'],
            $orderData['product_id'],
            $orderData['price'],
            $orderData['num'],
            $orderData['product_name']
        );
    
        // Thực thi câu lệnh
        if (mysqli_stmt_execute($stmt)) {
           
        } else {
            echo "Lỗi: " . mysqli_stmt_error($stmt);
            return false; // Trả về false nếu có lỗi
        }

        // Đóng statement
        mysqli_stmt_close($stmt);
    }
    public function updatecompleteSp($orderData)
    {
        // Kiểm tra dữ liệu đầu vào
        if (!isset($orderData['num']) || !isset($orderData['product_id']) || !is_numeric($orderData['num'])) {
            die("Số lượng hoặc ID sản phẩm không hợp lệ.");
        }
    
        $sql = "UPDATE product SET stock = stock - ? WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        
        if ($stmt === false) {
            die("Lỗi chuẩn bị câu lệnh: " . mysqli_error($this->con));
        }
    
        // Sử dụng "ii" cho hai tham số kiểu số nguyên
        mysqli_stmt_bind_param($stmt, "ii", $orderData['num'], $orderData['product_id']);
    
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Đóng câu truy vấn sau khi thực thi
            return true;
        } else {
            echo "Lỗi: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt); // Đảm bảo đóng câu truy vấn ngay cả khi có lỗi
            return false;
        }
    }
}
