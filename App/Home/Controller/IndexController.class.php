<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
//require_once('api.php'); 

    public function index(){
        $this->display();
    }
	public function language(){
        $this->display();
    }

	public function body(){
        $this->display();
    }
    
    public function login() {

        $this->display();
    }
	
	public function show() {
        $this->display();
    }


}