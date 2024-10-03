<?php
class shopCardcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelshopCard");
       $this->view("viewHom",["page"=>"shopping-card"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("modelshopCard");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>