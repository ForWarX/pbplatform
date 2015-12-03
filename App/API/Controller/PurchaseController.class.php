<?php
namespace API\Controller;
use Think\Controller\RestController;
class PurchaseController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $api = I("api");
        $db = "purchase";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $good_id = I("good_id");
                    $Model = M($db);
                    if ($id != '') $data = $Model->where("id=%d", $id)->select();
                    elseif ($good_id != '') $data = $Model->where("good_id=%d", $good_id)->select();
                    else $data = $Model->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $id = I("id");
                    if ($id == '') {
                        $res['err'] = 'Require "id"';
                    } else {
                        $Model = M($db);
                        if ($Model->create()) {
                            $Model->updated = time();
                            if ($Model->save() !== false) $res['status'] = true;
                            else $res['err'] = 'Update failed';
                        } else {
                            $res['err'] = 'Create data failed';
                        }
                    }
                    break;
                case 'add':
                    if (I("good_id") == '' || I("supplier_id") == '') {
                        $res['err'] = 'Require "good_id" and "supplier_id"';
                    } else {
                        $Model = M($db);
                        if ($Model->create()) {
                            $time = time();
                            $Model->created = $time;
                            $Model->updated = $time;
                            if ($Model->add() > 0) $res['status'] = true;
                            else $res['err'] = 'Add failed';
                        } else {
                            $res['err'] = 'Create data failed';
                        }
                    }
                    break;
                case 'delete':
                    $id = I("id");
                    $good_id = I("good_id");
                    if ($id == '' && $good_id == '') {
                        $res['err'] = 'Require "id" or "good_id"';
                    } else {
                        $Model = M($db);
                        if ($id != '') $Model->where("id=%d", $id)->delete();
                        else $Model->where("$good_id=%d", $good_id)->delete();
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