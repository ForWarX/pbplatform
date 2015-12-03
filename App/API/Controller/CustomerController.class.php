<?php
namespace API\Controller;
use Think\Controller\RestController;
class CustomerController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $api = I("api");
        $db = "customer";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $no = I("no");
                    $Model = M($db);
                    if ($id != '') $data = $Model->where("id=%d", $id)->select();
                    elseif ($no != '') $data = $Model->where("no='%s'", $no)->select();
                    else $data = $Model->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $id = I("id");
                    $name = I("name");
                    $no = I("no");
                    if ($id == '' && $no == '') {
                        $res['err'] = 'Require "id" or "customer No."';
                    } else {
                        $Model = M($db);
                        $data = array();
                        if ($name != '') $data['name'] = $name;
                        if ($no != '') $data['no'] = $no;
                        if ($id != '') {
                            if ($Model->where("id=%d", $id)->save($data) !== false) $res['status'] = true;
                        } elseif ($no != '') {
                            if ($Model->where("no='%s", $no)->save($data) !== false) $res['status'] = true;
                        } else $res['err'] = 'Update failed';
                    }
                    break;
                case 'add':
                    $name = I("name");
                    $no = I("no");
                    if ($no == '') {
                        $res['err'] = 'Require "customer No."';
                    } else {
                        $Model = M($db);
                        if ($Model->where("no='%s'", $no)->find()) {
                            $res['err'] = 'Data exists';
                        } else {
                            $data = array(
                                "name" => $name,
                                "no" => $no,
                                "created" => time()
                            );
                            if ($Model->add($data) > 0) $res['status'] = true;
                            else $res['err'] = 'Add failed';
                        }
                    }
                    break;
                case 'delete':
                    $id = I("id");
                    $no = I("no");
                    if ($id == '' && $no == '') {
                        $res['err'] = 'Require "id" or "customer No."';
                    } else {
                        $Model = M($db);
                        if ($id != '') $Model->where("id=%d", $id)->delete();
                        else $Model->where("no='%s'", $no)->delete();
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

    public function relation() {
        $api = I("api");
        $db = "customer_relation";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $good_id = I("good_id");
                    $customer_id = I("customer_id");
                    $Model = M($db);
                    if ($id != '') $data = $Model->where("id=%d", $id)->select();
                    elseif ($good_id != '') $data = $Model->where("good_id=%d", $good_id)->select();
                    elseif ($customer_id != '') $data = $Model->where("customer_id=%d", $customer_id)->select();
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
                            if ($Model->save() !== false) $res['status'] = true;
                            else $res['err'] = 'Update failed';
                        } else {
                            $res['err'] = 'Create data failed';
                        }
                    }
                    break;
                case 'add':
                    $good_id = I("good_id");
                    $customer_id = I("customer_id");
                    if ($good_id == '' || $customer_id == '') {
                        $res['err'] = 'Require "good_id" and "customer_id"';
                    } else {
                        $Model = M($db);
                        if ($Model->create()) {
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
                    $customer_id = I("customer_id");
                    if ($id == '' && $good_id == '' && $customer_id == '') {
                        $res['err'] = 'Require "id" or "good_id" or "customer_id"';
                    } else {
                        $Model = M($db);
                        if ($id != '') $Model->where("id=%d", $id)->delete();
                        elseif ($good_id != '') $Model->where("good_id='%s'", $good_id)->delete();
                        else $Model->where("customer_id='%s'", $customer_id)->delete();
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