<?php
class order_usercontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("orders_user");
       $this->view("viewHom",["page"=>"orders_user"]);
    }


}
?>

