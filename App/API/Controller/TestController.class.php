<?php
namespace API\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index($type="get"){
        $api_url = C("API_URL");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url . "API/Category/basic");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if ($type == 'post') {
            echo "post<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            $data = array(
                "name" => "食品",
                "lang" => "cn",
                "api" => "add"
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($type == 'delete') {
            echo "delete<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            $data = array(
                "id" => "2",
                "lang" => "cn",
                "api" => "delete"
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($type == 'update') {
            echo "update<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            $data = array(
                "id" => "3",
                "name" => "首饰",
                "lang" => "cn",
                "api" => "update"
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($type == 'get') {
            echo "get<br>";
            curl_setopt($curl, CURLOPT_POST, 1);
            $data = array(
                "id" => "",
                "lang" => "cn",
                "api" => "get"
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $data = curl_exec($curl);
        curl_close($curl);

        header("Content-type: text/html; charset=utf-8");
        print_r($data);
        echo "<br>";
        print_r(json_decode($data, true));
    }
}