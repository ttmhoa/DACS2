<?php
class blogcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelblog");
       $this->view("viewHom",["page"=>"blog"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("blog");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

