<?php
class  dashboard extends DB
{
    public function GetSP()
    {
        // kết nối cơ sở dữ liệu
        return "sanpham1";
    }

    public function addSP($a, $b)
    {
        // Nối chuỗi thay vì cộng
        return $a . $b; // Sử dụng toán tử . để nối chuỗi
    }
    public function saveDiscount($data)
    {
        // Câu lệnh truy vấn
        $query = "
            INSERT INTO discounts (code, name, max_uses, max_uses_user, discount_amount, min_amount, status, starts_at, expires_at, description, type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        // Chuẩn bị truy vấn
        $stmt = mysqli_prepare($this->con, $query);

        if (!$stmt) {
            // Nếu không thể chuẩn bị truy vấn, ghi log lỗi
            die("Prepare statement failed: " . mysqli_error($this->con));
        }

        // Gán giá trị cho các placeholder trong câu truy vấn
        mysqli_stmt_bind_param(
            $stmt,
            "ssiiiddssss",
            $data['code'],            // code
            $data['name'],            // name
            $data['maxUses'],         // max_uses
            $data['maxUsesUser'],     // max_uses_user
            $data['discountAmount'],  // discount_amount
            $data['minAmount'],       // min_amount
            $data['status'],          // status
            $data['startsAt'],        // starts_at
            $data['expiresAt'],       // expires_at
            $data['description'],     // description
            $data['type']             // type
        );

        // Thực thi truy vấn và kiểm tra kết quả
        if (mysqli_stmt_execute($stmt)) {
            return true; // Thành công
        } else {
            // Ghi log lỗi nếu thất bại
            error_log("Query execution failed: " . mysqli_stmt_error($stmt));
            return false;
        }
    }
    public function getDiscount($time)
    {
        // Câu lệnh SQL để lấy toàn bộ dữ liệu
        $query = "SELECT * FROM discounts";

        // Chuẩn bị câu lệnh
        $stmt = mysqli_prepare($this->con, $query);

        // Thực thi câu lệnh
        mysqli_stmt_execute($stmt);

        // Lấy kết quả
        $result = mysqli_stmt_get_result($stmt);

        // Chuyển đổi kết quả thành mảng
        $discounts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            if (strtotime($row['expires_at']) > strtotime($time)) {
                $row['status'] = 'Active Discount';
            } else {
                $row['status'] = 'Expired Discount';
            }
            $discounts[] = $row;
        }

        // Đóng câu lệnh
        mysqli_stmt_close($stmt);

        return $discounts;
    }
}
