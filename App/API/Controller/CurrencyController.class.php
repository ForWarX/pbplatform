<?php
namespace API\Controller;
use Think\Controller\RestController;
class CurrencyController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $api = I("api");
        $db = "currency";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $code = I("code");
                    $Model = M($db);
                    if ($id == '') $data = $Model->select();
                    elseif ($code != "") $data = $Model->where("code='%s'", $code)->select();
                    else $data = $Model->where("id=%d", $id)->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $id = I("id");
                    $code = I("code");
                    $desc = I("desc");
                    if ($id == '') {
                        $res['err'] = 'Require "id"';
                    } else {
                        $Model = M($db);
                        $data = array();
                        if ($code != '') $data['code'] = $code;
                        if ($desc != '') $data['desc'] = $desc;
                        if ($Model->where("id=%d", $id)->save($data) !== false) $res['status'] = true;
                        else $res['err'] = 'Update failed';
                    }
                    break;
                case 'add':
                    $code = I("code");
                    $desc = I("desc");
                    if ($code == '') {
                        $res['err'] = 'Require "code"';
                    } else {
                        $Model = M($db);
                        $data = array(
                            "code" => $code,
                            "desc" => $desc
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
                        $Model = M($db);
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

    public function exchange() {
        $api = I("api");
        $db = "exchange_rate";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $src = I("src");
                    $dest = I("dest");
                    $Model = M($db);
                    if ($src != '' && $dest != '') $data = $Model->where("src=%d and dest=%d", $src, $dest)->select();
                    else $data = $Model->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $src = I("src");
                    $dest = I("dest");
                    $rate = I("rate");
                    if ($src == '' || $dest == '' || $rate) {
                        $res['err'] = 'Require "src", "dest" and "rate"';
                    } else {
                        $Model = M($db);
                        $date = I("date") == "" ? date("Y-m-d") : I("date");
                        $data = array(
                            "rate" => $rate,
                            "date" => $date
                        );
                        if ($Model->where("src=%d and dest=%d", $src, $dest)->save($data) !== false) $res['status'] = true;
                        else $res['err'] = "Update failed";
                    }
                    break;
                case 'add':
                    $src = I("src");
                    $dest = I("dest");
                    $rate = I("rate");
                    if ($src == '' || $dest == '' || $rate) {
                        $res['err'] = 'Require "src", "dest" and "rate"';
                    } else {
                        $Model = M($db);
                        $date = I("date") == "" ? date("Y-m-d") : I("date");
                        $data = array(
                            "src" => $src,
                            "dest" => $dest,
                            "rate" => $rate,
                            "date" => $date
                        );
                        if ($Model->add($data) > 0) $res['status'] = true;
                        else $res['err'] = 'Add failed';
                    }
                    break;
                case 'delete':
                    $src = I("src");
                    $dest = I("dest");
                    if ($src == '' && $dest == '') {
                        $res['err'] = 'Require "src" and/or "dest"';
                    } else {
                        $Model = M($db);
                        if ($src != '' && $dest != '') $Model->where("src=%d and dest=%d", $src, $dest)->delete();
                        elseif ($src != '') $Model->where("src=%d", $src)->delete();
                        else $Model->where("dest=%d", $dest)->delete();
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