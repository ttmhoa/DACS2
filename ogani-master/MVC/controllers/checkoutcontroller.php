<?php
class checkoutcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("modelCheckout");
       $this->view("viewHom",["page"=>"checkout"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("modelCheckout");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

