<?php
class userscontroller extends Controller{

    function Sayhi(){
        $current_page=1;
        $teo = $this->model("users");
       $this->view("viewAdmin",
       [
        "page"=>"users",
        "users_get_list"=>$teo->phantrang_click_model($current_page),
        ]
    );
    }

    function phantrang_click($parampage,$current_page){
        
        $teo = $this->model("users");
       $this->view("viewAdmin",
       [
        "page"=>"users",
        "users_get_list"=>$teo->phantrang_click_model($current_page),
        ]
    );
    }
    
    function Delete_user($id){
        $teo = $this->model("users");
        $result = $teo->delete($id);
        if($result){
            header("Location: /userscontroller");
        }else{
            echo "xoa that bai";
        }
    }
}
?>

