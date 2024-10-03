<?php
class contactcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelcontact");
       $this->view("viewHom",["page"=>"contact"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("modelcontact");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

