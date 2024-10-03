<?php
class shopdetailcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelshopDT");
       $this->view("viewHom",["page"=>"shopdetail"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("modelshopDT");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>