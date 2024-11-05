<?php
class signupController extends Controller {

    public function Sayhi() {
        $teo = $this->model("modellongin");  // Gọi model signup
        $this->view("signup");  // Gọi view signup
    }
}
?>
