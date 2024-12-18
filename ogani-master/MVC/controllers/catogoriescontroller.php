<?php
class catogoriescontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("categories");
       $this->view(
        "viewAdmin",
       [
        "page"=>"categories",
        "categories_list"=>$teo->get_list_categories(),
       ]
    );
    }

    function deleteCategory($id) {
        $teo = $this->model("categories");
        $result = $teo->delete($id);
        
        if ($result) {
            // Xử lý khi xóa thành công
            header("Location: /catogoriescontroller");
        }
    }


    function Viewnews($parampage,$name,$password){
        // model
        $teo = $this->model("categories");
        $tong= $teo->addSP($name,$password);
        // view
        $this->view("viewAdmin",["page"=>$parampage,"Number"=>$tong,"Number2"=>"hihui"]);
    }

}
?>

