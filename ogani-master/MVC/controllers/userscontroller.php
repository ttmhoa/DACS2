<?php
class userscontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("users");
       $this->view("viewAdmin",["page"=>"users"]);
    }

    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("users");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewAdmin",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

