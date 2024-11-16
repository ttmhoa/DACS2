<?php
class paymentcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("payment");
       $this->view("viewHom",["page"=>"paymentdir/payment"]);
    }

    function Viewnews($parampage){
        // model
        $teo = $this->model("payment");
        // $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewHom",["page"=>$parampage]);
    }

}
?>

