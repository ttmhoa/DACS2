<?php
class orderscontroller extends Controller{

    function Sayhi(){
        $teo = $this->model("orders");
       $this->view(
        "viewAdmin",
        [
            "page"=>"orders",
            "orders_list" => $teo->get_list_orders(),
        
        ]);
    }

    function process_status($order_id){
        $teo = $this->model("orders");
        if( isset($_REQUEST['Confirm'])){
            $data= $_REQUEST['Confirm'];
            $teo->update_status($order_id,$data);
        }else if( isset($_REQUEST['Cancell'])){
            $data= $_REQUEST['Cancell'];
            $teo->update_status($order_id,$data);
            $teo->update_stock($order_id);

        }elseif( isset($_REQUEST['Delivering'])){
            $data= $_REQUEST['Delivering'];
            $teo->update_status($order_id,$data);
        }

    }
    function orderDetail($order_id){
        $teo = $this->model("orders");
        $this->view(
            "viewAdmin",
            [
                "page"=>"orderdetail",
                "order_byid"=>$teo->get_order_byid($order_id),
                "Invoice"=>$teo->get_order_byid($order_id),
                "total_orders"=>$teo->get_total_orders($order_id),
                "get_list_orderdetail" => $teo->get_list_orderdetail($order_id),
            ]);
    }

}
?>

