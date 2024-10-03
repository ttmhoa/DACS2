<?php
class Hom extends Controller{

    function Sayhi(){
        $teo = $this->model("SanPhamHom");
       $this->view("viewHom",["page"=>"news"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("SanPhamHom");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

