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
        // Cập nhật trạng thái của đơn hàng trước
        $sql_update_order = "UPDATE orders SET order_status = $data WHERE id = $order_id";
        $update_result = mysqli_query($this->con, $sql_update_order);

        if (!$update_result) {
            echo "Error: " . $sql_update_order . "<br>" . mysqli_error($this->con);
            return;
        }

        // Chỉ tiến hành chèn vào bảng user_purchases nếu trạng thái đơn hàng là 'delivered'
        if ($data == '2') { // Thay đổi giá trị 'delivered' thành giá trị tương ứng với trạng thái mong muốn
            $sql_get_user = "SELECT user_id FROM orders WHERE id = $order_id";
            $result_user = mysqli_query($this->con, $sql_get_user);

            if (!$result_user) {
                echo "Error: " . $sql_get_user . "<br>" . mysqli_error($this->con);
                return;
            }

            $user_data = mysqli_fetch_assoc($result_user);
            if (!$user_data) {
                echo "Order not found.";
                return;
            }

            $user_id = $user_data['user_id'];

            $sql_get_products = "SELECT product_id FROM order_details WHERE order_id = $order_id";
            $result_products = mysqli_query($this->con, $sql_get_products);

            if (!$result_products) {
                echo "Error: " . $sql_get_products . "<br>" . mysqli_error($this->con);
                return;
            }

            $current_date = date('Y-m-d H:i:s');

            while ($product_data = mysqli_fetch_assoc($result_products)) {
                $product_id = $product_data['product_id'];

                $sql_insert_purchase = "
                    INSERT INTO user_purchases (user_id, product_id, purchase_date, review_status)
                    VALUES ($user_id, $product_id, '$current_date', 0)
                ";

                $insert_result = mysqli_query($this->con, $sql_insert_purchase);
                if (!$insert_result) {
                    echo "Error: " . $sql_insert_purchase . "<br>" . mysqli_error($this->con);
                }
            }
        }

        // Chuyển hướng về trang orderscontroller
        header("Location: /orderscontroller");
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

    public function phantrang_click_model($current_page_click)
    {
        $item_per_page = 5;
        $current_page = $current_page_click;
        $offset = ($current_page - 1) * $item_per_page;

        // Fetch total number of products
        $totalQuery = "SELECT COUNT(*) as total FROM orders";
        $totalResult = mysqli_query($this->con, $totalQuery);
        $totalRow = mysqli_fetch_assoc($totalResult);
        $totalRecords = $totalRow['total'];

        // Fetch products for the current page
        $products = "SELECT * FROM orders ORDER BY id ASC LIMIT $item_per_page OFFSET $offset";
        $kq = mysqli_query($this->con, $products);

        // Calculate total pages
        $totalPages = ceil($totalRecords / $item_per_page);

        return [
            'products' => $kq,
            'totalPages' => $totalPages
        ];
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
    public function get_total_orders($order_id)
    {
        $sql = "SELECT total_money FROM orders WHERE id = $order_id";
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
