<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

    const TRANSFER_NUM = 1;
    const ORDER_LESSON_ID = 0;
    const ORDER_AMOUNT = 1;
    const ORDER_MSG = '巨蟹行动';
    const ORDER_SOURCE = 'jxxd';
    public $desc = '用户中心';

    public $js = [
        'jquery-weui.min.js',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public $css = [
        'jquery-weui.css'
    ];

    public function login()
    {
        $redirect_url = $_GET['redirect_url'];
        if (isset($_GET['code'])) {
            $wechat = new WeChat();
            $rtn = $wechat->get_auth_access_token($_GET['code']);
            if (isset($rtn['access_token'])) {
                //成功
                $this->session->access_token = $rtn['access_token'];
                $this->session->expires_in = date('U') + $rtn['expires_in'];
                $this->session->openid = $rtn['openid'];
                $this->session->refresh_token = $rtn['refresh_token'];

                $this->load->model('User_model', 'user');
                $user = $this->user->get_one([
                    'openid' => $rtn['openid']
                ]);
                if (isset($user['id'])) {
                    //老用户更新用户信息
                    $userinfo = $wechat->get_user_info($rtn['access_token'], $rtn['openid']);
                    if (isset($userinfo['openid']) && $this->user->update([
                        'nickname' => $userinfo['nickname'],
                        'sex' => $userinfo['sex'],
                        'province' => $userinfo['province'],
                        'city' => $userinfo['city'],
                        'country' => $userinfo['country'],
                        'headimgurl' => $userinfo['headimgurl'],
                    ], [
                        'openid' => $user['openid']
                    ])) {
                        if (empty($redirect_url))
                            redirect('index/index');
                        else
                            redirect(urldecode($redirect_url));
                    }
                } else {
                    //新用户 添加用户
                    $user = $wechat->get_user_info($rtn['access_token'], $rtn['openid']);
                    if (isset($user['openid']) && $this->user->add([
                        'openid' => $user['openid'],
                        'nickname' => $user['nickname'],
                        'sex' => $user['sex'],
                        'province' => $user['province'],
                        'city' => $user['city'],
                        'country' => $user['country'],
                        'headimgurl' => $user['headimgurl'],
                        'source' => self::ORDER_SOURCE,
                    ])) {
                        if (empty($redirect_url))
                            redirect('home/index');
                        else
                            redirect(urldecode($redirect_url));
                    }
                }
            }
        }
        $this->_error('400001', '登录失败');
    }


    public function get_png()
    {
        $draw = new Draw();
        $draw->jc_draw();
    }

    public function get_result_png()
    {
        $user = $this->get_user();
        $image_file = APPPATH . '/images/report/entertaiment_' . $user['id'] . '.png';
        if (file_exists($image_file)) {
            header('Content-type: image/png');
            echo file_get_contents($image_file);
        } else {
            $this->load->model('Jxxd_model', 'jxxd');
            $jxxd = $this->jxxd->get_one([
                'uid' => $user['id'],
                'state' => 1
            ]);

            if (!isset($jxxd['id'])) {
                $this->_error('400001', '没有检测报告');
            }
            $report = json_decode($jxxd['report_parsed'], true);
            $draw = new Draw();
            $draw->jc_draw_png($user['id'], $user['nickname'], $report);
        }
    }

    public function get_result_professional_png()
    {
        //首先验证 是否有权限查看
        if (!$this->check_if_professional()) {
            $this->_error('400000', '木有权限');
        }

        $user = $this->get_user();

        $this->load->model('Feedback_model', 'feedback');
        $feedback = $this->feedback->get_one([
            'uid' => $user['id'],
            'source' => self::ORDER_SOURCE,
            'state' => 1
        ]);
        $ypj = 0;
        if (isset($feedback['id'])) {
            $ypj = 1;
            $image_file = APPPATH . '/images/report/professional_ypj_' . $user['id'] . '.png';
        } else {
            $image_file = APPPATH . '/images/report/professional_' . $user['id'] . '.png';
        }


        if (file_exists($image_file)) {
            header('Content-type: image/png');
            echo file_get_contents($image_file);
        } else {
            $this->load->model('Jxxd_model', 'jxxd');
            $jxxd = $this->jxxd->get_one([
                'uid' => $user['id'],
                'state' => 1
            ]);

            if (!isset($jxxd['id'])) {
                $this->_error('400001', '没有检测报告');
            }
            $report = json_decode($jxxd['report_parsed'], true);

            $date_time_array = explode(' ', $jxxd['birthday']);
            $date_array = isset($date_time_array[0]) ? explode('-', $date_time_array[0]) : [];
            $time_array = isset($date_time_array[1]) ? explode(':', $date_time_array[1]) : [];

            if (count($date_array) != 3 || count($time_array) != 2) {
                $this->_error('400002', '出生时间格式错误!');
            }
            $data = [];
            list($data['year'], $data['month'], $data['day'], $data['hour'], $data['minute']) = array_merge($date_array, $time_array);

            $params = [
                'location' => $jxxd['location'],
                'longitude' => $jxxd['longitude'],
                'latitude' => $jxxd['latitude'],
//                'callbackFun' => 'test',
                'name' => 'nidaye',
                'sex' => 0,
                'zon' => urlencode('+08:00'),
            ];


            $draw = new Draw();
            $draw->jc_draw_professional_png($user['id'], $user['nickname'], $report, array_merge($params, $data), $ypj);
        }
    }

    public function result()
    {
        $nickname = '';
        $uid = 0;
        $if_view_professional = 0;
        //先判断用户 有没有3个以上的转发  或者有支付
        if ($this->check_if_professional($nickname, $uid)) {
//            redirect('user/result_professional');
//            exit();
            $if_view_professional = 1;
        }

        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $uid,
            'state' => 1
        ]);

        if (!isset($jxxd['id'])) {
            $this->_error('400001', '没有检测报告');
        }
        $report = json_decode($jxxd['report_parsed'], true);

        //nickname为测试结果  变量名就这样吧
        $result = $this->get_test_result($report);

        $this->view('user/result', [
            'token' => $this->generateToken(),
            'nickname' => $nickname,
            'result' => $result,
            'if_view_professional' => $if_view_professional
        ]);
    }


    private function get_test_result($report)
    {
        $result = '';
        $lighted_count = 0;
        foreach ($report as $v) {
            if ($v['lighted']) {
                $lighted_count ++;
            }
        }
//        $lighted_count = 6;
        if ($lighted_count <= 2) {
            $result = '你就老实呆着吧, 别瞎折腾了';
        } elseif ($lighted_count <= 3) {
            $result = '你的创业成功率为50%';
        } elseif ($lighted_count <= 4) {
            $result = '你的创业成功率为65%';
        } elseif ($lighted_count <= 5) {
            $result = '你的创业成功率为80%';
        } else {
            $result = '你现在不创业，还在等什么';
        }
        return $result;
    }


    public function result_professional()
    {
        $user = $this->get_user();

        $this->load->model('Feedback_model', 'feedback');

        $feedback = $this->feedback->get_one([
            'uid' => $user['id'],
            'source' => self::ORDER_SOURCE,
            'state' => 1
        ]);

        $ypj = 0;
        if (isset($feedback['id'])) {
            $ypj = 1;
        }

        $nickname = $user['nickname'];

        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id'],
            'state' => 1
        ]);

        if (!isset($jxxd['id'])) {
            $this->_error('400001', '没有检测报告');
        }
        $report = json_decode($jxxd['report_parsed'], true);

        $result = $this->get_test_result($report);

        $this->view('user/result_professional', [
            'ypj' => $ypj,
            'token' => $this->generateToken(),
            'nickname' => $nickname,
            'result' => $result,
        ]);
    }

    public function test()
    {
        $user = $this->get_user();
        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id'],
            'state' => 1
        ]);
        if (isset($jxxd['id'])) {
            $this->_error('400000', '您已经做过测试!');
        }

        $params = $this->post_params([
            'location', 'birthday',
        ]);
        $addresses = explode(' ', $params['location']);
        if (isset($addresses[0]) && in_array($addresses[0], [
                '上海', '北京', '天津', '重庆',
            ])) {
            $address = $addresses[1] . $addresses[2];
        } else {
            $address = $addresses[0] . $addresses[1] . $addresses[2];
        }
        $location = new Location();
        $data = [];
        $geo = $location->geoII($address);
        list($data['longitude'], $data['latitude']) = $geo;
        if ($data['longitude'] == 0 && $data['latitude'] == 0) {
            $this->_error('400001', '获取地理位置失败,请重试!');
        }

        $date_time_array = explode(' ', $params['birthday']);
        $date_array = isset($date_time_array[0]) ? explode('-', $date_time_array[0]) : [];
        $time_array = isset($date_time_array[1]) ? explode(':', $date_time_array[1]) : [];

        if (count($date_array) != 3 || count($time_array) != 2) {
            $this->_error('400002', '出生时间格式错误,请重试!');
        }
        list($data['year'], $data['month'], $data['day'], $data['hour'], $data['minute']) = array_merge($date_array, $time_array);

        //默认参数
        $data['sex'] = 0;
        $data['reportKey'] = 'CARP';
        $data['zon'] = 8;

        $jcsy = new JSCY();
        $result = json_decode($jcsy->jxxd($data), true);

        if (!isset($result['status']) || $result['status'] != 'OK') {
            $this->_error('400003', '获取测试结果失败,请重试!');
        }

//        $this->parse_report($result['moduleTree']);die();
        //保存测试结果
        $jxxd_data = [
            'uid' => $user['id'],
            'location' => $address,
            'birthday' => $params['birthday'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
            'result' => json_encode($result['moduleTree']),
            'report_parsed' => json_encode($this->parse_report($result['moduleTree'])),
        ];

        if (!$this->jxxd->add($jxxd_data)) {
            $this->_error('400004', '保存测试结果失败, 请重试!');
        }
        $this->_success();
    }

    private function check_if_professional(&$nickname, &$uid)
    {
        $user = $this->get_user();
        $nickname = $user['nickname'];
        $uid = $user['id'];

//        $this->load->model('Visitor_model', 'visitor');
//        $visitor_num = $this->visitor->get_visitor_num($user['id']);
//        if ($visitor_num >= 3) {
//            return true;
//        }
        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id']
        ]);
        if (isset($jxxd['transfers']) && $jxxd['transfers'] >= self::TRANSFER_NUM) {
            return true;
        }

        $this->load->model('Order_model', 'order');
        $order = $this->order->get_one([
            'uid' => $user['id'],
            'lesson_id' => self::ORDER_LESSON_ID,
            'source' => self::ORDER_SOURCE,
            'state' => 1,
        ]);
        if (isset($order['id'])) {
            return true;
        }
        return false;
    }

    private function parse_report($data)
    {
        $rtn = [
//            '309' => [
//                'name' => '内驱'
//                'lighted' => 0,
//                'entertainment' => '',
//                'professional' => ''
//            ]
        ];
        $energy = [
            'rz' => 0,
            'lgdw' => 0,
            'gj' => '',
            'zj' => '',
        ];
        foreach ($data['Children'] as $entry) {
            if ($entry['ID'] == 331) {
                foreach ($entry['Children'] as $v) {
                    switch ($v['ID']) {
                        case 332:
                            $energy['rz'] = $v['Explanation'];
                            break;
                        case 333:
                            $energy['lgdw'] = $v['Explanation'];
                            break;
                        case 334:
                            $energy['gj'] = $v['Explanation'];
                            break;
                        case 335:
                            $energy['zj'] = $v['Explanation'];
                            break;
                    }
                }
                continue;
            }
            $data_index = [];
            foreach ($entry['Children'] as $row) {
                $keys = explode('-', $row['NodeName']);
                if (!isset($keys[1])) $keys[1] = 'nidaye';

                $tmp = empty($row['Explanation']) ? [] : explode('|', $row['Explanation']);

                $data_index[$keys[0]][$keys[1]] = isset($data_index[$keys[0]][$keys[1]]) ?
                    array_merge($data_index[$keys[0]][$keys[1]], $tmp) : $tmp;

            }

            if (isset($data_index['娱乐版释义'])) {
//                print_r($data_index);
                $rtn[$entry['ID']] = [
                    'name' => $entry['NodeName'],
                    'lighted' => 0,
                    'entertainment' => $data_index['娱乐版释义']['nidaye'][rand(0, count($data_index['娱乐版释义']['nidaye']) - 1)],
                    'professional' => $data_index['专业版释义']['nidaye'][rand(0, count($data_index['专业版释义']['nidaye']) - 1)],
                ];
            } else {
                $index = rand(0, count($data_index) - 1);
                $count = 0;
                foreach ($data_index as $v) {
                    if ($index == $count) {
                        $rtn[$entry['ID']] = [
                            'name' => $entry['NodeName'],
                            'lighted' => 0,
                            'entertainment' => $v['娱乐版释义'][rand(0, count($v['娱乐版释义']) - 1)],
                            'professional' => $v['专业版释义'][rand(0, count($v['专业版释义']) - 1)],
                        ];
                    }
                    $count ++;
                }

            }
        }
        //判断是否点亮
        foreach ($rtn as $k => &$v) {
            $lighted = 0;
            switch ($k) {
                case 309:
                    if ($energy['rz'] >= 600 || $energy['lgdw'] > 0) {
                        $lighted = 1;
                    }
                    break;
                case 314:
                    if ($energy['rz'] >= 600) {
                        $lighted = 1;
                    }
                    break;
                case 317:
                    if ($energy['gj'] == '七杀') {
                        $lighted = 1;
                    }
                    break;
                case 320:
                    if ($energy['zj'] == '包含') {
                        $lighted = 1;
                    }
                    break;
                case 323:
                    if ($energy['rz'] >= 600 || $energy['lgdw'] > 0) {
                        $lighted = 1;
                    }
                    break;
                case 328:
                    if ($energy['rz'] >= 600) {
                        $lighted = 1;
                    }
                    break;
            }
            $v['lighted'] = $lighted;
        }
        return $rtn;
    }

    public function t()
    {
//        var_dump($this->generateToken());
//        var_dump($this->parseToken('kPYwUeBlaO399qara5MRUPIAQLJ7y1_jrm0eDPOtk3CXZglLAeKSds8YYNCcEo18'));

//        $img = imagecreatetruecolor(600, 600);
//        $white = imagecolorclosestalpha($img, 255, 255, 255, 127);
//        $red = imagecolorclosestalpha($img, 255, 0, 0, 0);
//
////        $style = array($red, $red, $red, $red, $red, $white, $white, $white, $white, $white);
////        imagesetstyle($img, $style);
//        imagesetthickness($img, 5);
////        imageline($img, 20, 20, 500, 20, IMG_COLOR_STYLED);
//
//        $this->MDashedLine ($img , 20 , 20 , 100 , 100, $red );
//        $this->MDashedLine ($img , 100 , 100 , 200 , 20, $red );
//        $this->MDashedLine ($img , 200 , 20 , 20 , 20, $red );
//
//
//        header("content-type:image/png");
//        imagepng($img);



        // Create a 200x100 image
        $im = imagecreatetruecolor(400, 400);
        $w = imagecolorclosestalpha($im, 0xFF, 0xFF, 0xFF, 127);
        $red = imagecolorclosestalpha($im, 0xFF, 0x00, 0x00, 0);

        $length1 = 10;
        $length2 = 20;

        $style = array_merge(array_fill(0, $length1, $red), array_fill(0, $length2, $w));
//        $style = array($red, $red, $red, $red, $red, $w, $w, $w, $w, $w);

        imagesetthickness($im, 3);
        imagesetstyle($im, $style);
        imageline($im, 0, 0, 100, 100, IMG_COLOR_STYLED);




        // Output image to the browser
        header('Content-Type: image/png');

        imagepng($im);
        imagedestroy($im);

    }



    /**
     * @desc 提交订单
     * 订单重复提交 可以使用前端传递token的方式来防止
     * 在这里 我使用前端干掉click事件 后端3s内禁止 对同一商品下订单来防止重复订单
     */
    public function order()
    {
        $user = $this->get_user();

        if (!isset($user['id'])) {
            $this->_error('400003', '用户信息错误');
        }
        $this->load->model('Order_model', 'order');
        $order = $this->order->get_one([
            'uid' => $user['id'],
            'lesson_id' => self::ORDER_LESSON_ID,
            'created_at >' => date('Y-m-d H:i:s', date('U') - 3)
        ]);
        if (isset($order['id'])) {
            $this->_error('400003', '重复订单');
        }

        $order_id = $user['id'] . '-' . self::ORDER_LESSON_ID . '-' . date('YmdHis');
        $data = [
            'uid' => $user['id'],
            'lesson_id' => self::ORDER_LESSON_ID,
            'amount' => self::ORDER_AMOUNT * 100,
            'order_id' => $order_id,
            'msg' => self::ORDER_MSG,
            'source' => self::ORDER_SOURCE,
        ];
        $this->load->model('Order_model', 'order');
        if (!$this->order->add_order($data)) {
            $this->_error('400003', '添加订单失败');
        }

        $wepay = new WeixinPay();
        //统一下单
        $order = $wepay->unifiedorder($user['openid'], $data['order_id'], $data['amount']);
        if (!isset($order['prepay_id'])) {
            $this->_error('400003', '统一下单失败');
        }
        $jspay = new JsApiPay();
        $jsparams = $jspay->GetJsApiParameters($order);
//        $sms = new SMS();
        $this->_json([
            'code' => '0',
            'jsparams' => json_decode($jsparams, true),
            'msg' => '',
            'tips' => 'ok'
        ]);
    }

    public function feedback()
    {
        $params = $this->post_params(['msg']);
        if (!in_array($params['msg'], [
            '准', '不准', '不确定'
        ])) {
            $this->_error('400000', '参数错误');
        }
        $user = $this->get_user();
        $this->load->model('Feedback_model', 'feedback');
        $feedback = $this->feedback->get_one([
            'uid' => $user['id'],
            'source' => self::ORDER_SOURCE,
            'state' => 1
        ]);
        if (isset($feedback['id'])) {
            $this->feedback->update([
                'msg' => $params['msg']
            ], [
                'id' => $feedback['id'],
            ]);
        } else {
            $this->feedback->add([
                'uid' => $user['id'],
                'msg' => $params['msg'],
                'source' => self::ORDER_SOURCE,
            ]);
        }
        $this->_success();
    }

    public function get_partner_png()
    {
        $user = $this->get_user();
        $image_file = APPPATH . '/images/report/partner_' . $user['id'] . '.png';
        if (file_exists($image_file)) {
            header('Content-type: image/png');
            echo file_get_contents($image_file);
        } else {
            $this->load->model('Jxxd_model', 'jxxd');
            $jxxd = $this->jxxd->get_one([
                'uid' => $user['id'],
                'state' => 1
            ]);

            if (!isset($jxxd['id'])) {
                $this->_error('400001', '没有检测报告');
            }
            $date_time_array = explode(' ', $jxxd['birthday']);
            $date_array = isset($date_time_array[0]) ? explode('-', $date_time_array[0]) : [];
            $time_array = isset($date_time_array[1]) ? explode(':', $date_time_array[1]) : [];

            if (count($date_array) != 3 || count($time_array) != 2) {
                $this->_error('400002', '出生时间格式错误!');
            }
            $data = [];
            list($data['year'], $data['month'], $data['day'], $data['hour'], $data['minute']) = array_merge($date_array, $time_array);

            $params = [
                'location' => $jxxd['location'],
                'longitude' => $jxxd['longitude'],
                'latitude' => $jxxd['latitude'],
                'name' => 'nidaye',
                'sex' => 0,
                'zon' => 8,
            ];


            $draw = new Draw();
            $draw->jc_draw_other_png($user['id'], $user['nickname'], array_merge($params, $data));
        }
    }

    public function partner()
    {
        $user = $this->get_user();
        $nickname = $user['nickname'];

        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id'],
            'state' => 1
        ]);

        if (!isset($jxxd['id'])) {
            $this->_error('400001', '没有检测报告');
        }
        $report = json_decode($jxxd['report_parsed'], true);

        $result = $this->get_test_result($report);

        $this->view('user/partner', [
            'token' => $this->generateToken(),
            'nickname' => $nickname,
            'result' => $result,
        ]);
    }

    public function transfer()
    {
        $user = $this->get_user();
        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id'],
            'state' => 1
        ]);
        if (isset($jxxd['id'])) {
            $this->jxxd->update([
                'transfers' => $jxxd['transfers'] + 1,
            ], [
                'id' => $jxxd['id'],
            ]);
            if ($jxxd['transfers'] + 1 >= self::TRANSFER_NUM) {
                $this->_success();
            }
        }
        $this->_error('400000', '');
    }

    public function restart()
    {
        $user = $this->get_user();
        $uid = $user['id'];
        //删除jxxds记录
        $this->load->model('Jxxd_model', 'jxxd');
        var_dump($this->jxxd->update([
            'state' => 0
        ], [
            'uid' => $uid,
            'state' => 1
        ]));
        //删除visitors记录
        $this->load->model('Visitor_model', 'visitor');
        var_dump($this->visitor->update([
            'state' => 0
        ], [
            'from_uid' => $uid,
            'state' => 1,
            'source' => self::ORDER_SOURCE,
        ]));
        //删除feedbacks记录
        $this->load->model('Feedback_model', 'feedback');
        var_dump($this->feedback->update([
            'state' => 0
        ], [
            'uid' => $uid,
            'source' => self::ORDER_SOURCE,
            'state' => 1
        ]));
        //删除orders
        $this->load->model('Order_model', 'order');
        var_dump($this->order->update([
            'state' => -1
        ], [
            'state' => 1,
            'lesson_id' => self::ORDER_LESSON_ID,
            'source' => self::ORDER_SOURCE,
            'uid' => $uid
        ]));

        unlink(APPPATH . '/images/report/entertaiment_' . $uid . '.png');
        unlink(APPPATH . '/images/report/professional_' . $uid . '.png');
        unlink(APPPATH . '/images/report/professional_ypj_' . $uid . '.png');
        unlink(APPPATH . '/images/report/partner_' . $uid . '.png');

        echo '重新开始测试!<script>setTimeout(function(){window.location.href="' . config_item('index_url') . '"}, 2000)</script>';
    }
}
