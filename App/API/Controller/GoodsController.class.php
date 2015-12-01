<?php
namespace API\Controller;
use Think\Controller\RestController;
class GoodsController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $lang = $_POST["lang"];
        if ($lang == '') $lang = C("API_DEFAULT_LANG");
        elseif (strpos($lang, '[') !== false) $lang = json_decode($lang, true);
        $api = I("api");
        $db = "goods";

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    // 获取参数
                    $id = I("id");
                    $order = I("order");
                    if ($order == '') $order = 'created desc';
                    $page = I("page");

                    $Model = M($db);
                    // 拼接数据表
                    $db3 = '__' . strtoupper($db) . '__';
                    if (is_array($lang)) {
                        foreach($lang as $v) {
                            $db2 = '__' . strtoupper($db . '_' . $v) . '__';
                            $Model = $Model->join('LEFT JOIN ' . $db2 . ' ON ' . $db3 . '.id=' . $db2 . '.good_id');
                        }
                    } else {
                        $db2 = '__' . strtoupper($db . '_' . $lang) . '__';
                        $Model = $Model->join('LEFT JOIN ' . $db2 . ' ON ' . $db3 . '.id=' . $db2 . '.good_id');
                    }
                    // 获取数据`
                    if ($id != '') $Model = $Model->where("id=%d", $id);
                    $Model = $Model->order($order);
                    if ($page != '') $Model = $Model->page($page);
                    $data = $Model->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $id = I("id");
                    $name = I("name");
                    $desc = I("desc");
                    if ($id == '') {
                        $res['err'] = 'Require "id"';
                    } else {
                        $Model = M($db);
                        $data = array();
                        if ($name != '') $data['name'] = $name;
                        if ($desc != '') $data['desc'] = $desc;
                        if ($Model->where("id=%d", $id)->save($data) !== false) $res['status'] = true;
                        else $res['err'] = 'Update failed';
                    }
                    break;
                case 'add':
                    $Model = M($db);
                    if ($Model->create()) {
                        $good_id = $Model->add();
                        if ($good_id > 0) {
                            // 按语言添加文本数据
                            if (is_array($lang)) {
                                $db .= '_';
                                $err = false;
                                foreach($lang as $v) {
                                    $db2 = $db . $v;
                                    $Model = M($db2);
                                    if ($Model->create()) {
                                        $Model->good_id = $good_id;
                                        if ($Model->add() > 0) {
                                            $res['status'] = true;
                                        } else {
                                            $res['err'] = "[$db2]Add failed";
                                            $err = true;
                                            break;
                                        }
                                    } else {
                                        $res['err'] = "[$db2]Cannot create data";
                                        $err = true;
                                        break;
                                    }
                                }
                                if (!$err) {
                                    $res['status'] = true;
                                }
                            } else {
                                $db .= "_" . $lang;
                                $Model = M($db);
                                if ($Model->create()) {
                                    $Model->good_id = $good_id;
                                    if ($Model->add() > 0) {
                                        $res['status'] = true;
                                    } else {
                                        $res['err'] = "[$db]Add failed";
                                    }
                                } else {
                                    $res['err'] = "[$db]Cannot create data";
                                }
                            }
                        }
                        else {
                            $res['err'] = "[$db]Add failed";
                        }
                    } else {
                        $res['err'] = "[$db]Cannot create data";
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
}