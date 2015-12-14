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
        ///获得语言变量信息
        $this->assign('lang',L());
        $this->display();
}
    public function body(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function productall(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function product_add(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function backup_info() {
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
 public function export(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function import(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function package() {
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function picture(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function price(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function product(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function purchase() {
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function special(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function logic(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function transport(){
        //获得语言变量信息
        $this->assign('lang',L());
        $this->display();
    }
    public function carton(){
        //获得语言变量信息
        $this->assign('lang',L());
        //api
        if (IS_POST){
            $data=I("post.");
            $result=api_request("Carton",$data);
            if ($result['status']){
                $this->success("成功","carton.html");
            } else {
                $this->error($result['err']);
            }
            exit();
        }
        $result = api_request("Carton");

        $this->assign("car", $result['data']);
        $this->assign("result", $result);
        $this->display();
    }
    public function customer_info(){
        //获得语言变量信息
        $this->assign('lang',L());
        //api
        if (IS_POST){
            $data=I("post.");
            $result=api_request("Customer",$data);
            if ($result['status']){
                $this->success("成功","customer_info.html");
            } else {
                $this->error($result['err']);
            }
            exit();
        }
        $result = api_request("Customer");

        $this->assign("cus", $result['data']);
        $this->assign("result", $result);
        $this->display();
    }
    public function supplier(){
        //获得语言变量信息
        $this->assign('lang',L());
       //api
        if (IS_POST){
            $data=I("post.");
            $result=api_request("Supplier",$data);
            if ($result['status']){
                $this->success("成功","supplier.html");
            } else {
                $this->error($result['err']);
            }
            exit();
        }
        $result = api_request("Supplier");

        $this->assign("sup", $result['data']);
        $this->assign("result", $result);
        $this->display();
    }
    public function category(){
        //获得语言变量信息
        $this->assign('lang',L());
        //api
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
    public function brand(){
        //获得语言变量信息
        $this->assign('lang',L());
        //api
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

    //分页
    public function page(){
        $user = M('User'); // 实例化User对象
        $count= $user->count();//显示总条数
        $page=new Page($count,10);//10为每页分的条数
        $show=$page->show();//显示每页的条数
        $list=$user->order('date')->
            limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
        var_dump($show);
    }








}
