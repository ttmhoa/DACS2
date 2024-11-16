<?php
class Hom extends Controller{


    function Sayhi(){
        $teo = $this->model("SanPhamHom");
        $kq= $teo->GetSP();
       $this->view("viewHom",
       ["page"=>"news",
       "categories"=>$kq,
       "feature"=>$teo->GetSP(),
       "detail"=>$teo->getAll(),
       "get3latest"=>$teo->get3latest(),
       "get3related"=>$teo->get3related(),
       "departments"=>$teo->GetSP(),
       
    ]);
    }
    function Viewnews($parampage,$id){
        // model
        $teo = $this->model("SanPhamHom");
        $kq= $teo->GetSP();
        $product= $teo->getProduct($id);
        // view
        $this->view("viewHom",
        ["page"=>$parampage,
        "categories"=>$kq,
        "feature"=>$teo->GetSP(),
        "detail"=>$product,
        "get3latest"=>$teo->get3latest(),
        "get3related"=>$teo->get3related(),
        "departments"=>$teo->GetSP(),
    ]);
    }

}
?>

