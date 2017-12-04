<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends Base_Controller {
    const NUMBER_PER_PAGE = 10;

    public $desc = '主页';
//    public $title = "巨蟹行动";

    public $js = [
        'jquery-weui.min.js?v=1.0.5',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public $css = [
        'jquery-weui.css'
    ];

	public function index()
	{
        $user = $this->get_user();
        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id'],
            'state' => 1
        ]);

        if (isset($jxxd['id'])) {
            redirect('user/result');
            exit();
        }

        $token = isset($_GET['token']) ? $_GET['token'] : '';
        if (!empty($token)) {
            $openid = $this->parseToken($token);
            if (!empty($openid)) {
                $this->load->model('User_model', 'user');
                $from_user = $this->user->get_one([
                    'openid' => $openid,
                ]);
                $user = $this->get_user();
                if (isset($from_user['id']) && $from_user['id'] != $user['id']) {
                    //添加转发访问记录
                    $this->load->model('Visitor_model', 'visitor');
                    $visitor = $this->visitor->get_one([
                        'from_uid' => $from_user['id'],
                        'uid' => $user['id'],
                        'source' => 'jxxd',
                    ]);
                    if (!isset($visitor['id'])) {
                        $this->visitor->add([
                            'from_uid' => $from_user['id'],
                            'uid' => $user['id'],
                            'source' => 'jxxd',
                        ]);
                    }
                }
            }
        }
		$this->view('index/index');
	}

    public function input()
    {
        $user = $this->get_user();
        $this->load->model('Jxxd_model', 'jxxd');
        $jxxd = $this->jxxd->get_one([
            'uid' => $user['id'],
            'state' => 1
        ]);

        if (isset($jxxd['id'])) {
            redirect('user/result');
            exit();
        }


        $this->js = array_merge($this->js, [
            'city-picker.min.js?v=1.0.1'
        ]);
        $this->view('index/input');
    }
}





