<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
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