<?php
/**
 * 扩展CI_Controller类, 目的是在处理请求逻辑之前统一为每个请求做处理
 * @author zhuang
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//江村市隐的中文拼音缩写, 我特么写错了
class JSCY {

    private $api_host = '';

    public function jxxd($params)
    {
        $ret = json_decode($this->xls([
            'year' => $params['year'],
            'month' => $params['month'],
            'day' => $params['day'],
            'hour' => $params['hour'],
            'minute' => $params['minute'],
        ]), true);

        if (isset($ret['status']) && strtolower($ret['status']) == 'ok') {
            $date_time_array = explode(' ', $ret['ResultTime']);
            $date_array = isset($date_time_array[0]) ? explode('-', $date_time_array[0]) : [];
            $time_array = isset($date_time_array[1]) ? explode(':', $date_time_array[1]) : [];

            if (count($date_array) != 3 || count($time_array) != 3) {
                $this->_error('400002', '出生时间格式错误,请重试!');
            }
            list($params['year'], $params['month'], $params['day'], $params['hour'], $params['minute'], $a) = array_merge($date_array, $time_array);
        }

        $this->api_host = 'http://api.jclife.com/report/Report/GetReportResult';
        return $this->getResponse('', $params);
    }

    public function get_huaxian($params)
    {
        $this->api_host = 'http://api.jclife.com/mingli/MingLi/CalcMingLi';
        return $this->getResponse('', $params);
    }

    public function get_partner($params)
    {
        $this->api_host = 'http://api.jclife.com/report/InnerReportV2/CalcInnerReport';
        return $this->getResponse('', $params);
    }

    /**
     * @desc 夏令时
     */
    private function xls($params)
    {
        $this->api_host = 'http://api.jclife.com/report/SummerTime/CalcSummerTime';
        //http://api.jclife.com/report/SummerTime/CalcSummerTime?year=2014&month=11&day=29&hour=11&minute=28
        return $this->getResponse('', $params);
    }

    /**
     * 通用接口
     * 调用微信api获取返回
     **/
    private function getResponse($method, $params=array(), $postField='')
    {
        $url = $this->api_host.$method;
        $paramStr = '';
        while (list($key, $val) = each($params)) {
            $paramStr .= '&'.$key.'='.$val;
        }
        $paramStr = empty($paramStr)?'':'?'.substr($paramStr, 1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.$paramStr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false); //输出头文件信息
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($postField)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postField);
        }
        return curl_exec($ch);
    }

}
