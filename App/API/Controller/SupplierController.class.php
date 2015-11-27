<?php
namespace API\Controller;
use Think\Controller\RestController;
class SupplierController extends RestController {
    protected $allowType = array('json'); // REST允许请求的资源类型列表

    public function basic() {
        $lang = $_POST["lang"];
        if ($lang == '') $lang = C("API_DEFAULT_LANG");
        $api = I("api");
        $db = "supplier_" . $lang;

        $res = array('status'=>false);
        if ($this->_method == 'post') {
            switch ($api) {
                case 'get':
                    $res['status'] = true;
                    $id = I("id");
                    $Model = M($db);
                    if ($id == '') $data = $Model->select();
                    else $data = $Model->where("id=%d", $id)->select();
                    $res['data'] = $data;
                    break;
                case 'update':
                    $id = I("id");
                    $name = I("name");
                    $address = I("address");
                    $phone = I("phone");
                    $email = I("email");
                    $contacts = I("contacts");
                    if ($id == '') {
                        $res['err'] = 'Require "id"';
                    } else {
                        $Model = M($db);
                        $data = array();
                        if ($name != '') $data['name'] = $name;
                        if ($address != '') $data['address'] = $address;
                        if ($phone != '') $data['phone'] = $phone;
                        if ($email != '') $data['email'] = $email;
                        if ($contacts != '') $data['contacts'] = $contacts;
                        if ($Model->where("id=%d", $id)->save($data) !== false) $res['status'] = true;
                        else $res['err'] = 'Update failed';
                    }
                    break;
                case 'add':
                    $name = I("name");
                    $address = I("address");
                    $phone = I("phone");
                    $email = I("email");
                    $contacts = I("contacts");
                    if ($name == '') {
                        $res['err'] = 'Require "name"';
                    } else {
                        $Model = M($db);
                        $data = array(
                            "name" => $name,
                            "address" => $address,
                            "phone" => $phone,
                            "email" => $email,
                            "contacts" => $contacts
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
}