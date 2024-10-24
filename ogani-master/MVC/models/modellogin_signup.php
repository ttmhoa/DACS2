<?php
class modellogin_signup extends DB
{
    public function login($username, $password)
    {
        $query = "SELECT * FROM User WHERE fullname = ?";
        $stmt = mysqli_prepare($this->con, $query);
        if (!$stmt) {
            die('Câu lệnh chuẩn bị thất bại: ' . mysqli_error($this->con));
        }

        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if ($password === $user["password"]) {
                    return $user;
                } else {
                    return 1;
                }
            } else {
                die('Không tìm thấy người dùng hoặc lỗi trong truy vấn');
                return 2;
            }
        } else {
            die('Thực thi câu lệnh thất bại: ' . mysqli_error($this->con));
        }
    }
    public function signup($username, $password, $email, $phone, $address, $role)
    {
        $query = "SELECT * FROM User WHERE email = ?";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
            return 1;
        } else {
            $query = "INSERT INTO User (fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted) 
                      VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), 0)";
            $stmt = mysqli_prepare($this->con, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $phone, $address, $password, $role);
            $insert_result = mysqli_stmt_execute($stmt);

            if ($insert_result) {
                return true;
            } else {
                return 2;
            }
        }
    }
}
