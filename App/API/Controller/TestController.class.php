<?php
/**
 * 如何测试：
 * 域名/根目录/API/Test/index/type/get/api/Category/func/basic
 * type：get/add/update/delete，默认get
 * api：API控制器，默认无
 * func：API控制器里的方法，默认basic
 *
 * API参数在每个测试方法里自行修改
 */

namespace API\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index($type="get", $api="", $func="basic"){
        $api_url = C("API_URL");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url . "API/$api/$func");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if ($type == 'add') {
            // API参数
            $data = array(
                "name" => "供货商A",
                "phone" => "123-456-789",
                "email" => "supplier@pbcc.ca",
                "lang" => "cn",
                "api" => "add"
            );

            echo "add<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($type == 'delete') {
            // API参数
            $data = array(
                "id" => "1",
                "lang" => "cn",
                "api" => "delete"
            );

            echo "delete<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($type == 'update') {
            // API参数
            $data = array(
                "id" => "3",
                "name" => "首饰",
                "lang" => "cn",
                "api" => "update"
            );

            echo "update<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($type == 'get') {
            // API参数
            $data = array(
                "id" => "",
                "lang" => json_encode(array("cn")),
                "api" => "get"
            );

            echo "get<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        $data = curl_exec($curl);
        curl_close($curl);

        header("Content-type: text/html; charset=utf-8");
        print_r($data);
        echo "<br>";
        print_r(json_decode($data, true));
    }

    public function test() {
        $data = json_encode(array("cn", "en"));
        echo is_array(json_decode($data));
    }
}