<?php
class blogDetailcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelblogdetail");
       $this->view("viewHom",["page"=>"blogdetail"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("modelblogdetail");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

