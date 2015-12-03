<?php
namespace API\Controller;
use Think\Controller\RestController;
class LabelController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $api = I("api");
        $db = "label";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $good_id = I("good_id");
                    $Model = M($db);
                    if ($id != '') $data = $Model->where("id=%d", $id)->select();
                    elseif ($good_id != '') $data = $Model->where("good_id='%s'", $good_id)->select();
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
                    $label = I("label");
                    if ($good_id == '' || $label == '') {
                        $res['err'] = 'Require "good_id" and "label"';
                    } else {
                        $Model = M($db);
                        if (strpos($label, '[') !== false) $label = json_decode($label, true);
                        if (is_string($label)) {
                            $data = array(
                                "good_id" => $good_id,
                                "label" => $label
                            );
                            if ($Model->add($data) > 0) $res['status'] = true;
                            else $res['err'] = 'Add failed';
                        } else {
                            $data = array();
                            foreach($label as $l) {
                                $data[] = array(
                                    "good_id" => $good_id,
                                    "label" => $l
                                );
                            }
                            if ($Model->addAll($data)) $res['status'] = true;
                            else $res['err'] = 'Add failed';
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