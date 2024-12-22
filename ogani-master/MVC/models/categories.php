<?php
class  categories extends DB
{

    public function get_list_categories()
    {
        $sql = "SELECT * FROM category";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }


    public function delete($id)
    {
        $query = "SELECT COUNT(*) as count FROM product WHERE category_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $productCount = $row['count'];

        if ($productCount > 0) {
            echo "<script>alert('Cannot delete this category because it has related products.');</script>";
            echo "<script>window.location.href='/catogoriescontroller';</script>";
            exit();
        } else {
            $query = "DELETE FROM category WHERE id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $stmt->close();
            $this->con->close();

            header("Location: /catogoriescontroller");
            exit();
        }
    }

    public function phantrang_click_model($current_page_click)
{
    $item_per_page = 3;
    $current_page = $current_page_click;
    $offset = ($current_page - 1) * $item_per_page;

    // Fetch total number of products
    $totalQuery = "SELECT COUNT(*) as total FROM category";
    $totalResult = mysqli_query($this->con, $totalQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalRecords = $totalRow['total'];

    // Fetch products for the current page
    $products = "SELECT * FROM category ORDER BY id ASC LIMIT $item_per_page OFFSET $offset";
    $kq = mysqli_query($this->con, $products);

    // Calculate total pages
    $totalPages = ceil($totalRecords / $item_per_page);

    return [
        'products' => $kq,
        'totalPages' => $totalPages
    ];
}

    public function get_categories($id)
    {
        $sql = "SELECT * FROM category where id =$id";
        $kq = mysqli_query($this->con, $sql);
        return $kq;
    }


    public function create_newcategory($create_cate)
    {
        $sql = "INSERT INTO category (name, image, description) VALUES (?, ? ,?)";
        $stmt = mysqli_prepare($this->con, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $create_cate['name'],
                $create_cate['image'],
                $create_cate['description'],
            );
            if (mysqli_stmt_execute($stmt)) {
                return "Sản phẩm đã được thêm thành công.";
            } else {
                return "Có lỗi trong việc thêm sản phẩm: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            return "Có lỗi trong việc chuẩn bị câu lệnh: " . mysqli_error($this->con);
        }
    }

    public function modify_cate_model($modify_cate_data , $id){
        $sql = "UPDATE category SET name = ?, description = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($this->con, $sql);

    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh: " . mysqli_error($this->con));
    }

    // Liên kết tham số
    mysqli_stmt_bind_param(
        $stmt,
        "sssi",  
        $modify_cate_data['name'],
        $modify_cate_data['description'],
        $modify_cate_data['image'],
        $id 
    );
      
        if (mysqli_stmt_execute($stmt)) {
            return true; 
        } else {
            echo "Lỗi: " . mysqli_stmt_error($stmt);
            return false;
        }
      

        mysqli_stmt_close($stmt);
    }
}
