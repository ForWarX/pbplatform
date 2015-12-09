<?php
namespace Home\Controller;
use Think\Controller;
require_once('App/Home/Controller/API/api.php'); 
class IndexController extends Controller {
    public function index(){
    //获得语言变量信息
    //L()获得全部语言,L(username)获得指定语言
        $this->assign('lang',L());//把语言值传进页面
        $this->display();
    }
    public function productview() {
    $this->assign('lang',L());
    $this->display();
}
    public function body(){
        $this->assign('lang',L());
        $this->display();
    }
    public function productall(){
        $this->assign('lang',L());
        $this->display();
    }
    public function product_add(){
        $this->assign('lang',L());
        $this->display();
    }
    public function backup_info() {
        $this->assign('lang',L());
        $this->display();
    }
    public function customer_info(){
        $this->assign('lang',L());
        $this->display();
    }
    public function export(){
        $this->assign('lang',L());
        $this->display();
    }
    public function import(){
        $this->assign('lang',L());
        $this->display();
    }
    public function package() {
        $this->assign('lang',L());
        $this->display();
    }
    public function picture(){
        $this->assign('lang',L());
        $this->display();
    }
    public function price(){
        $this->assign('lang',L());
        $this->display();
    }
    public function product(){
        $this->assign('lang',L());
        $this->display();
    }
    public function purchase() {
        $this->assign('lang',L());
        $this->display();
    }
    public function special(){
        $this->assign('lang',L());
        $this->display();
    }
    public function supplier(){
        $this->assign('lang',L());
        $this->display();
    }
    public function transport(){
        $this->assign('lang',L());
        $this->display();
    }

    //api
    public function brand(){
        if (IS_POST) {
            $data = I("post.");
            /*
            $_POST = array(
                "id"   => 3,
                "name" => "???",
                "desc" => "???",
                "api"  => "update"
            );*/
            $result = api_request("Brand", $data);
            if ($result['status']) {
                $this->success("添加成功", "brand.html");
            } else {
                $this->error($result['err']);
            }
            exit();
        }
        $result = api_request("Brand");
/*
        $result = array(
            "status" => true,
            "data" => array(
                0 => array("id"=>1, "name"=>"SISU", "desc"=>"..."),
                1 => array(....),
                2 => array("id"=>3, "name"=>"Nike", "desc"=>"...")
            )
        );
*/
        $this->assign("brands", $result['data']);
        $this->assign("result", $result);
        $this->display();
    }
/*
  public function brand(){
        if (IS_POST) {
            $data = I("post.");
            $data['api'] = "add";
            $result = api_request("Brand", $data);
            if ($result['status']) {
                $this->success("添加成功", "brand.html");
            } else {
                $this->error("添加出错");
            }
            exit();
        }

        $result = api_request("Brand");
        $this->assign("brands", $result);
        $this->display();
    }

public function brand(){
        /*$data = array(
            "name" => "Nike",
            "api" => "add"
        );
        $result = api_request("Brand");
        $this->assign("brands", $result);
        //$this->display();
        header("Content-type: text/html; charset=utf-8");
        print_r($result);
    }
 */


    public function category(){
        if (IS_POST){
            $data=I("post.");
            $result=api_request("Category",$data);
            if ($result['status']){
                $this->success("成功","category.html");
            } else {
                $this->error($result['err']);
            }
            exit();
        }
        $result = api_request("Category");

        $this->assign("cats", $result['data']);
        $this->assign("result", $result);
        $this->display();
        }






}
