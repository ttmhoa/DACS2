<?php
class pagescontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("pages");
       $this->view("viewAdmin",["page"=>"pages"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("pages");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewAdmin",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

