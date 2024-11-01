<?php
class shopcontroller extends Controller{

    function Sayhi(){
        $current_page=1;
        $teo = $this->model("modelshop");
        $this->view("viewHom",[
        "page"=>"shop",
        "departments"=>$teo->Get_departments(),
        "departments_body"=>$teo->Get_departments(),
        "feature"=>$teo->get3latest(),
        "feature2"=>$teo->get3related(),
        "Products"=>$teo->phantrang_click_model($current_page),
        

    ]);
    }
    function phantrang_click($parampage,$current_page){
        $teo = $this->model("modelshop");
        $this->view("viewHom",[
        "page"=>$parampage,
        "departments"=>$teo->Get_departments(),
        "departments_body"=>$teo->Get_departments(),
        "feature"=>$teo->get3latest(),
        "feature2"=>$teo->get3related(),
        "Products"=>$teo->phantrang_click_model($current_page),
        
    ]);
    }

    public function search() {
        $teo = $this->model("modelshop");
        
        if (isset($_POST['action'])) {
            $search_name = $_POST['search_name'];
            $result = $teo->search_model($search_name);
            $output = "";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $output .= ' 
                    <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" style="background-image: url(' . $row["image"] . ');">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">' . $row["title"] . '</a></h6>
                            <h5>$' . $row["price"] . '</h5>
                        </div>
                    </div>
                    </div>
                ';
                }
            } else {
                $output .= '<div class="col-lg-12">Không tìm thấy sản phẩm nào.</div>';
            }
    
            echo $output;
        }
    }


}
?>