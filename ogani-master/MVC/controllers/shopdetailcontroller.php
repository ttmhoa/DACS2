<?php
class shopdetailcontroller extends Controller
{
    function Sayhi()
    {
        $teo = $this->model("modelshopDT");
        $id = $teo->id_splatest();
        $id_cate= $teo->getcategory_id($id);
        $kq= $teo->getcategory_id_ct($id_cate);
        $this->view("viewHom", 
        [
            "page" => "shopdetail",
            "detailsp" => $teo->getLatestProduct(),
            "list_sp_ct" => $kq, // Gọi đúng phương thức
            "detailsp2" => $teo->getProduct($id),
            "departments" =>$teo->department(),
            "departmentlist"=>$teo->department()
        ]);
    }

    function Viewnews($parampage, $id)
    { 
        $teo = $this->model("modelshopDT");
        $sp = $teo->getProduct($id);
        $id_category = $teo->getcategory_id($id);
        $getcategory_id = $teo->getcategory_id_ct($id_category);
        $this->view("viewHom",
         [
            "page" => $parampage,
            "detailsp" => $sp,
            "detailsp2" => $teo->getProduct($id), // Lấy chi tiết sản phẩm
            "list_sp_ct" => $getcategory_id ,// Danh sách sản phẩm theo category
            "departments" =>$teo->department(),
            "departmentlist"=>$teo->department(),
        ]);
    }
    function Detail_sp($parampage,$id_cateRequest){
        $teo = $this->model("modelshopDT");
        $get_sp= $teo->getcategory_id_ct($id_cateRequest);
        $get_onesp=$teo-> get_onesp($id_cateRequest);
        $this->view("viewHom",
         [
            "page" => $parampage,
            "departments" =>$teo->department(),
            "departmentlist"=>$teo->department(),
            "detailsp2" =>$teo->get_onesp($id_cateRequest),
            "detailsp"=>$get_onesp,
            "list_sp_ct"=>$get_sp
        ]);
    }

    function img_click($parampage,$id_cateRequest,$id){
        $teo = $this->model("modelshopDT");
        $get_sp= $teo->getcategory_id_ct($id_cateRequest);
        $get_onesp=$teo-> getProduct($id);
        $this->view("viewHom",
         [
            "page" => $parampage,
            "departments" =>$teo->department(),
            "departmentlist"=>$teo->department(),
            "detailsp2" =>$teo->getProduct($id),
            "detailsp"=>$get_onesp,
            "list_sp_ct"=>$get_sp
        ]);
    }
}
