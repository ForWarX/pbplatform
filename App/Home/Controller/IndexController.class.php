<?php
namespace Home\Controller;
use Think\Controller;
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

    public function test() {
        $api_url = C("API_URL");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url . "API/Index/rest");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // post start
        curl_setopt($curl, CURLOPT_POST, 1);
        $post_data = array(
            "username" => "admin",
            "password" => "12345"
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        // post end
        $data = curl_exec($curl);
        curl_close($curl);
        header("Content-type: text/html; charset=utf-8");
        print_r(json_decode($data, true));
    }
}