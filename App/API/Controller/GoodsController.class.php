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
                        // 多语言表使用的字段名一样，所以要给字段设别名
                        // 设置要获取的字段
                        $field = $Model->getDbFields();
                        $sql = "";
                        foreach ($field as $f) {
                            if ($sql == "") $sql = $f;
                            else $sql .= "," . $f;
                        }
                        // 拼接数据表
                        foreach($lang as $v) {
                            $db2 = '__' . strtoupper($db . '_' . $v) . '__';
                            $Model = $Model->join('LEFT JOIN ' . $db2 . ' ON ' . $db3 . '.id=' . $db2 . '.good_id');
                            // 设置要获取的字段
                            $field = M($db . '_' . $v)->getDbFields();
                            foreach ($field as $f) {
                                $f = $f . " as " . $f . "_" . $v;
                                if ($sql == "") $sql = $f;
                                else $sql .= "," . $f;
                            }
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
                    $Model = M($db);
                    if ($Model->create()) {
                        $Model->updated = time();
                        if ($Model->save() !== false) {
                            $res['status'] = true;
                        }
                        else {
                            $res['err'] = "[$db]Add failed";
                        }
                    } else {
                        $res['err'] = "[$db]Cannot create data";
                    }
                    break;
                case 'add':
                    $Model = M($db);
                    if ($Model->create()) {
                        $time = time();
                        $Model->created = $time;
                        $Model->updated = $time;
                        $good_id = $Model->add();
                        if ($good_id > 0) {
                            $res['status'] = true;
                            $res['good_id'] = $good_id;
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
                        // 获取产品特殊属性
                        $special = $Model->where("id=%d", $id)->select();
                        $special = $special[0]['special'];
                        // 删除产品
                        $Model->where("id=%d", $id)->delete();
                        // 删除产品描述信息和特殊属性
                        $all_lang = C("API_ALL_LANG");
                        foreach($all_lang as $lang) {
                            $Model = M($db . '_' . $lang);
                            $Model->where("good_id=%d", $id)->delete();
                            $Model = M('special_' . $special . '_' . $lang);
                            $Model->where("good_id=%d", $id)->delete();
                        }
                        // 删除箱规
                        $Model = M("carton_spec");
                        $Model->where("good_id=%d", $id)->delete();
                        // 删除客户
                        $Model = M("customer_relation");
                        $Model->where("good_id=%d", $id)->delete();
                        // 删除标签
                        $Model = M("label");
                        $Model->where("good_id=%d", $id)->delete();
                        // 删除包装
                        $Model = M("package_relation");
                        $Model->where("good_id=%d", $id)->delete();
                        // 删除采购信息
                        $Model = M("purchase");
                        $Model->where("good_id=%d", $id)->delete();
                        // 删除备案
                        $Model = M("record");
                        $Model->where("good_id=%d", $id)->delete();
                        // 删除运输信息
                        $Model = M("transport");
                        $Model->where("good_id=%d", $id)->delete();

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