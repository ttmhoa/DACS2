<?php
class  orders extends DB
{

    public function get_list_orders()
    {
        $sql = "SELECT * FROM orders";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }
    public function update_status($order_id, $data)
    {
        $sql = "UPDATE orders SET order_status = $data WHERE id = $order_id";
        $kq = mysqli_query($this->con, $sql);

        if ($kq) {
            header("Location: /orderscontroller");
        }
        echo "Error: " . $sql . "<br>" . mysqli_error($this->con);
    }
    public function get_order_byid($order_id)
    {
        if (!is_numeric($order_id)) {
            die("Invalid order ID.");
        }

        $sql = "SELECT * FROM orders WHERE id = $order_id";
        $kq = mysqli_query($this->con, $sql);

        if (!$kq) {
            die("Query failed: " . mysqli_error($this->con));
        }

        if (mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return null; // Không có dữ liệu
        }
    }

    public function get_total_cancelled_orders($order_id)
    {
        $sql = "SELECT product_id, num FROM order_details WHERE order_id = $order_id";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }

    public function get_list_orderdetail($order_id)
    {
        $sql = "SELECT * FROM order_details WHERE order_id = $order_id";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }
    public function get_total_orders($order_id){
        $sql= "SELECT total_money FROM orders WHERE id = $order_id";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }


    public function update_stock($order_id)
    {
        $result = $this->get_total_cancelled_orders($order_id);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $quantity = $row['num'];

                // Kiểm tra xem sản phẩm có tồn tại không
                $check_sql = "SELECT id FROM product WHERE id = $product_id";
                $check_result = mysqli_query($this->con, $check_sql);

                if ($check_result && mysqli_num_rows($check_result) > 0) {
                    // Cập nhật lại số lượng sản phẩm
                    $update_sql = "UPDATE product SET stock = stock + $quantity WHERE id = $product_id";

                    if (mysqli_query($this->con, $update_sql)) {
                      header("Location: /productscontroller");
                    } else {
                        echo "Lỗi khi cập nhật số lượng sản phẩm ID $product_id: " . mysqli_error($this->con) . "<br>";
                    }
                } else {
                    echo "Sản phẩm ID $product_id không tồn tại hoặc đã bị xóa.<br>";
                }
            }
        } else {
            echo "Không tìm thấy sản phẩm trong đơn hàng.";
        }
    }
}
