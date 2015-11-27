<?php
namespace API\Controller;
use Think\Controller\RestController;
class CategoryController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $lang = I("lang");
        if ($lang == '') $lang = C("API_DEFAULT_LANG");
        $api = I("api");

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $Model = M("category_" . $lang);
                    if ($id == '') $data = $Model->select();
                    else $data = $Model->where("id=%d", $id)->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $id = I("id");
                    $name = I("name");
                    if ($id == '' || $name == '') {
                        $res['err'] = 'Require "id" and "name"';
                    } else {
                        $Model = M("category_" . $lang);
                        $data = array(
                            "name" => $name
                        );
                        if ($Model->where("id=%d", $id)->save($data) !== false) $res['status'] = true;
                        else $res['err'] = 'Update failed';
                    }
                    break;
                case 'add':
                    $name = I("name");
                    if ($name == '') {
                        $res['err'] = 'Require "name"';
                    } else {
                        $Model = M("category_" . $lang);
                        $data = array(
                            "name" => $name
                        );
                        if ($Model->add($data) > 0) $res['status'] = true;
                        else $res['err'] = 'Add failed';
                    }
                    break;
                case 'delete':
                    $id = I("id");
                    if ($id == '') {
                        $res['err'] = 'Require "id"';
                    } else {
                        $Model = M("category_" . $lang);
                        $Model->where("id=%d", $id)->delete();
                        $res['status'] = true;
                    }
                    break;
                default:
                    $res['err'] = "Undefined api";
            }
        } else {
            $res['err'] = "Unknown method";
        }

        // 返回结果
        $this->response($res, "json");
    }
}