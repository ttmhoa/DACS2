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
<!-- dua du lieu tu model vao hom de hien thi , dua view vao home de hien thi
 lay du lieu thong qua Sanphamhom lop controller dung de thuc thi nhieu lan  -->
 <!-- o lop hom goi lai controller de lay du lieu thong qua doi tuong -->
  <!-- co bao nhieu controllers thi co bay nhieu models views -->