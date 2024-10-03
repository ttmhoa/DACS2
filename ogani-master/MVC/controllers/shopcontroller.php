<?php
class shopcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelshop");
       $this->view("viewHom",["page"=>"shop"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("modelshop");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>