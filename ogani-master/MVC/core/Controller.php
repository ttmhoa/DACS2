<?php
// tra ve tat ca cac model hop le
class Controller{

public function model($model){
    require_once "./ogani-master/MVC/models/".$model.".php";
    return new $model;
}

public function view($view, $data=[]){
     require_once "./ogani-master/MVC/views/".$view.".php";
}

}
?>