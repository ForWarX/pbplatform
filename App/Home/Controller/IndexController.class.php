<?php
namespace Home\Controller;
use Think\Controller;
require_once('App/Home/Controller/API/api.php'); 
class IndexController extends Controller {


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

    //api
    public function brand(){
        $result = api_request("Brand");
        $this->assign("brands", $result);
        $this->display();

    }


}