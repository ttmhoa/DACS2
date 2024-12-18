<?php
class dashboardcontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("dashboard");
       $this->view("viewAdmin",["page"=>"dashboard"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("dashboard");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewAdmin",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

