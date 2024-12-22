<?php
class shopdetailcontroller extends Controller
{
    function Sayhi()
    {
        $teo = $this->model("modelshopDT");
        $id = $teo->id_splatest();
        $id_cate = $teo->getcategory_id($id);
        $kq = $teo->getcategory_id_ct($id_cate);
        $review = $this->model("modelRating");
        $reviews = $review->showRatingproduct($id);
        print_r($reviews); // Lấy review theo product ID

        // view
        $this->view(
            "viewHom",
            [
                "page" => "shopdetail",
                "detailsp" => $teo->getLatestProduct(),
                "list_sp_ct" => $kq, // Gọi đúng phương thức
                "detailsp2" => $teo->getProduct($id),
                "departments" => $teo->department(),
                "departmentlist" => $teo->department()

            ]
        );
    }

    function Viewnews($parampage, $id)
    { 
        $teo = $this->model("modelshopDT");

        // Lấy chi tiết sản phẩm
        $sp = $teo->getProduct($id);

        // Lấy ID danh mục của sản phẩm
        $id_category = $teo->getcategory_id($id);

        // Lấy danh sách sản phẩm theo danh mục
        $getcategory_id = $teo->getcategory_id_ct($id_category);
        // die($id);
        $review = $this->model("modelRating");
        $reviews = $review->showRatingproduct($id);
       

        // Debug thông tin đánh giá (nếu cần)
        // print_r($reviews);

        // Render view với dữ liệu
        $this->view("viewHom", [
            "page" => $parampage,
            "detailsp" => $sp,
            "detailsp2" => $sp, // Sử dụng lại `$sp` thay vì gọi `getProduct` lần nữa
            "reviews" => $reviews, // Truyền đánh giá vào view
            "list_sp_ct" => $getcategory_id, // Danh sách sản phẩm theo danh mục
            "departments" => $teo->department(),
            "departmentlist" => $teo->department(), // Truyền danh sách phòng ban
           
        ]);
    }

    function Detail_sp($parampage, $id_cateRequest)
    {
        $teo = $this->model("modelshopDT");
        $get_sp = $teo->getcategory_id_ct($id_cateRequest);
        $get_onesp = $teo->get_onesp($id_cateRequest);
        $this->view(
            "viewHom",
            [
                "page" => $parampage,
                "departments" => $teo->department(),
                "departmentlist" => $teo->department(),
                "detailsp2" => $teo->get_onesp($id_cateRequest),
                "detailsp" => $get_onesp,
                "list_sp_ct" => $get_sp
            ]
        );
    }

    function img_click($parampage, $id_cateRequest, $id)
    {
        $teo = $this->model("modelshopDT");
        $get_sp = $teo->getcategory_id_ct($id_cateRequest);
        $get_onesp = $teo->getProduct($id);
        $this->view(
            "viewHom",
            [
                "page" => $parampage,
                "departments" => $teo->department(),
                "departmentlist" => $teo->department(),
                "detailsp2" => $teo->getProduct($id),
                "detailsp" => $get_onesp,
                "list_sp_ct" => $get_sp
            ]
        );
    }
}
