<?php
class  orders_user extends DB
{
    public function getAllOders()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        if (!$user_id) {
            header("Location: /ogani-master/MVC/views/login.php");
            exit;
        }else{
            
        $sql = "SELECT * FROM orders WHERE user_id = $user_id";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
        }
    }

}
 