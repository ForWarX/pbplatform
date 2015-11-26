<?php
namespace API\Controller;
use Think\Controller\RestController;
class IndexController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function rest() {
        $username = I("username");
        $password = I('password');

        switch ($this->_method){
            case 'get':
                if ($this->_type == 'html') {
                    $data = array(
                        "status" => true,
                        "type" => $this->_type,
                        "method" => $this->_method,
                        "user" => $username,
                        "pass" => $password,
                        "data" => I("get.")
                    );
                    $this->response($data, "json");
                }
                break;
            case 'put':
                break;
            case 'post':
                if ($this->_type == 'html') {
                    $data = array(
                        "status" => true,
                        "type" => $this->_type,
                        "method" => $this->_method,
                        "user" => $username,
                        "pass" => $password,
                        "data" => I("post.")
                    );
                    $this->response($data, "json");
                }
                break;
        }
    }
}