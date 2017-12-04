<?php
/**
 * 扩展CI_Controller类, 目的是在处理请求逻辑之前统一为每个请求做处理
 * @author zhuang
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
    const SIGN_MSG = '1234';
    const SIGN_KEY = 'jxxd-2017-11-180';
    //1234567890123456
    public $desc = '网站描述';
    public $keywords = '关键字';
    public $title = '你负责创业成功，我负责泄露天机';

    protected $uid = 1;

    static $classFilter = array('user', 'home', 'order'); //免验证类名
    static $actionFilter = [
        'login', 'create_menu', 'notify', 'notify_result'
    ]; //免验证方法名

    static $rtn_routes = [
        'home/sign'
    ];

    /**
     * @var array
     * @desc 必须加载的通用css
     */
    private $base_css = [
        'weui.min.css',
//        'mui-icons.css',
//        'mui-icons-extra.css',
    ];

    /**
     * @var array
     * @desc 必须加载的通用js
     */
    private $base_js = [
        'jquery-2.1.4.min.js',
//        'weui.min.js',
        'weixin.1.2.0.js',
        'fastclick.js',
    ];

    /**
     * @var array
     * @desc 各模块自定义css
     */
    public $css = [

    ];

    /**
     * @var array
     * @desc 各模块自定义js
     */
    public $js = [

    ];

    /**
     * Base_Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

        //检查用户是否登录
//        $this->check_login();
        $this->session->openid = 'oG8ZBvzBZZinGWKrzLff59UkZ3oU';


        $this->load->library('layout');
        $this->setLayout('main');
    }

    /**
     * @param $view
     * @param array $data
     * @param bool $return 默认为false 表示无需返回 直接输出
     * @desc 输出view
     */
    protected function view($view, $data = [], $return = false)
    {
        $data = array_merge($data, [
            'keywords' => $this->keywords,
            'desc' => $this->desc,
            'title' => $this->title,
            'js' => array_merge($this->get_full_link($this->base_js, config_item('js_url')), $this->get_full_link($this->js, config_item('js_url'))),
            'css' => array_merge($this->get_full_link($this->base_css, config_item('css_url')), $this->get_full_link($this->css, config_item('css_url'))),
        ]);
        $this->layout->view($view, $data, $return);
    }

    /**
     * @param $layout
     * @desc 设定显示的layout
     */
    protected function setLayout($layout)
    {
        $this->layout->setLayout($layout);
    }

    /**
     * @param $params 参数
     * @param $types 参数类型
     * @desc 检查参数 如有不正确 立刻返回
     */
    protected function check_params($params, $types)
    {
        $index = 0;
        foreach ($params as $k => $v) {
            if (!call_user_func([
                'Tools',
                'is_' . $types[$index]
            ], $v)
            ) {
                $this->_error(Message::PARAM_ERROR['code'], sprintf(Message::PARAM_ERROR['msg'], $k));
            }
            $index++;
        }
    }

    protected function get_params($keys)
    {
        //获取参数
        $get = $this->input->get();
        $params = [];
        foreach ($keys as $k) {
            $params[$k] = isset($get[$k]) ? $get[$k] : '';
        }
        return $params;
    }

    protected function post_params($keys)
    {
        //获取参数
        $post = $get = $this->input->post();
        $params = [];
        foreach ($keys as $k) {
            $params[$k] = isset($post[$k]) ? $post[$k] : '';
        }
        return $params;
    }

    private function get_full_link($files = [], $link_prefix = '')
    {
        $data = [];
        foreach ($files as $v) {
            $data[] = $link_prefix . $v;
        }
        return $data;
    }

    private function check_login()
    {
        $access_token = $this->session->access_token;
        $expires_in = $this->session->expires_in;
        $openid = $this->session->openid;
        $refresh_token = $this->session->refresh_token;

        $class = strtolower($this->router->class);
        $action  = strtolower($this->router->method);
        if(!in_array($class, self::$classFilter) || !in_array($action, self::$actionFilter)) {
//            print_r($_SERVER); die();
            if (empty($access_token) || date('U') < $expires_in) {
                $wechat = new WeChat();
                //token过期 或者 没有token
                if (!empty($refresh_token)) {
                    $rtn = $wechat->refresh_token($refresh_token);
                    if (isset($rtn['access_token'])) {
                        //成功
                        $this->session->access_token = $rtn['access_token'];
                        $this->session->expires_in = date('U') + $rtn['expires_in'];
                        $this->session->openid = $rtn['openid'];
                        $this->session->refresh_token = $rtn['refresh_token'];
                        return;
                    }

                }
                //重新授权登录
                $redirect_url = urlencode($this->router->class . '/' . $this->router->method . '?' . $_SERVER['QUERY_STRING']);
                $wechat->goto_auth('http://www.jclife.com/jxxd/index.php/user/login?redirect_url=' . $redirect_url);
            }
            //已经登录了
        }
        //无需登录
    }

    /**
     * @param $code
     * @param $msg
     * @desc 失败调用后的输出
     */
    protected function _error($code, $msg)
    {
        echo json_encode([
            'code' => $code,
            'msg' => $msg
        ]);
        exit();
    }

    protected function _success($msg = '')
    {
        echo json_encode([
            'code' => 0,
            'msg' => $msg
        ]);
        exit();
    }

    protected function _echo($data = '')
    {
        echo $data;
        exit();
    }

    protected function _json($data = [])
    {
        echo json_encode($data);
        exit();
    }

    protected function get_user()
    {
        $this->load->model('User_model', 'user');
        return $this->user->get_one([
            'openid' => $this->session->openid
        ]);
    }

    /**
     * @desc 生成accessToken
     * @param $id 标识用户的唯一id
     * @return array($accessToken, $timeout)
     */
    public function generateToken()
    {
        //生成token
        return $this->encrypt($this->session->openid . ':' . self::SIGN_MSG, self::SIGN_KEY);
    }

    /**
     * @desc 解析accessToken
     * @param $token
     * @return Array(expireTime, id)
     */
    public function parseToken($token, $key='')
    {
        //解析token
        $token = $this->decrypt($token, $key);
        //返回uid 和 过期时间
        return current(explode(':', $token));
    }

    /**
     * @desc 加密字符串
     * @param $data 要加密的字符串
     * @param $key 加密秘钥, 如果不传参则从配置文件中取
     * @return String
     */
    private function encrypt($data, $key='')
    {
        $key = ($key != '') ? $key : self::SIGN_KEY;

        //第一层加密token
        $token = mcrypt_encrypt(
            MCRYPT_RIJNDAEL_128,
            $key,
            $data,
            MCRYPT_MODE_CBC,
            "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
        //二道加密
        return $this->safe_b64encode($token);
    }

    /**
     * @desc 解密字符串
     * @param $data 要解密的字符串
     * @param $key 解密秘钥, 如果不传参则从配置文件中取
     * @return String
     */
    private function decrypt($data, $key='')
    {
        $key = $key != '' ? $key : self::SIGN_KEY;
        //返回解密后的字符串
        return mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $key,
            $this->safe_b64decode($data),
            MCRYPT_MODE_CBC,
            "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
    }

    /**
     * @desc 处理特殊字符
     * @param String $string
     * @return String
     */
    private  function safe_b64encode($string)
    {
        $data = base64_encode($string);
        //对base64加密后的字符串中的特殊字符做出替换
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    /**
     * @desc 解析特殊字符
     * @param String $string
     * @return String
     */
    private function safe_b64decode($string)
    {
        //还原加密的字符串中的特殊字符
        $data = str_replace(array('-', '_'),array('+', '/'), $string);
        $mod4 = strlen($data)% 4;
        //如果字符串长度不被4整除 则在后面加上字符串长度除4得到的余数个=
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}

