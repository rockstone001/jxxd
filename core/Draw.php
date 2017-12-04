<?php
/**
 * 扩展CI_Controller类, 目的是在处理请求逻辑之前统一为每个请求做处理
 * @author zhuang
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Draw {

	public function jc_draw()
    {
        $bg_file = APPPATH . 'images/result-bg.png';
//        echo $bg_file;
        $image = new Image($bg_file);
        //添加框框
        $text_bg_positions = [
            [140, 280], [30, 550], [70, 850], [530, 980], [715, 570], [690, 300]
        ];
        foreach ($text_bg_positions as $v) {
            $image->add_image(APPPATH . 'images/text-bg.png', $v[0], $v[1]);
        }

        //写字
        $texts = [
            '尼罗河上的惨案', '东方快车谋杀案', 'ABC谋杀案', '阳光下的罪恶', '罗杰谜案', 'C罗质疑内马尔不诗书'
        ];
        $text_bg_width = 294;
        $text_bg_height = 120;
        $image->set_text_params($text_bg_width, $text_bg_height, APPPATH . 'images/font.ttf', 35);

        $top_adjust_I = 10;
        $top_adjust_II = 15;

        for ($i = 0; $i < count($texts); $i ++) {
            if (mb_strlen($texts[$i]) <= 5) {
                $image->set_font_size(35);

                $text_size = $image->get_text_size($texts[$i]);
                $text_width = $text_size[2] - $text_size[0];
                $text_height = $text_size[1] - $text_size[7];
                $x = $text_bg_positions[$i][0] + ($text_bg_width - $text_width) * 0.5;
                $y = $text_bg_positions[$i][1] + ($text_bg_height - $text_height) * 0.5 + $text_height - $top_adjust_I;
                $image->set_text($texts[$i], $x, $y);
            } else {
                $image->set_font_size(30);

                $text_I = mb_substr($texts[$i], 0, 5);
                $text_II = mb_substr($texts[$i], 5);
//                echo $text_I . '--' . $text_II ."\n";
                $text_size = $image->get_text_size($text_I);
                $text_width_I = $text_size[2] - $text_size[0];
                $text_height_I = $text_size[1] - $text_size[7];

                $text_size = $image->get_text_size($text_II);
                $text_width_II = $text_size[2] - $text_size[0];
                $text_height_II = $text_size[1] - $text_size[7];

                $x = $text_bg_positions[$i][0] + ($text_bg_width - $text_width_I) * 0.5;
                $y = $text_bg_positions[$i][1] + ($text_bg_height - $text_height_I - $text_height_II) * 0.5 + $text_height_I - $top_adjust_II;
                $image->set_text($text_I, $x, $y);

                $x = $text_bg_positions[$i][0] + ($text_bg_width - $text_width_II) * 0.5;
                $y = $text_bg_positions[$i][1] + ($text_bg_height - $text_height_I - $text_height_II) * 0.5 + $text_height_I + $text_height_II - $top_adjust_II;
                $image->set_text($text_II, $x, $y);
            }
        }

        $points = [[
                'x' => 515,
                'y' => 355,
                'selected' => 1
            ], [
                'x' => 305,
                'y' => 470,
                'selected' => 1
            ], [
                'x' => 305,
                'y' => 710,
                'selected' => 1
            ], [
                'x' => 515,
                'y' => 825,
                'selected' => 0
            ], [
                'x' => 725,
                'y' => 700,
                'selected' => 1
            ], [
                'x' => 725,
                'y' => 460,
                'selected' => 0
            ],
        ];

        $star_width = 34;

        //画三角
        $polygon_points = [];
        foreach ($points as $p) {
            if ($p['selected']) {
                $polygon_points[] = $p['x'] + $star_width * 0.5;
                $polygon_points[] = $p['y'] + $star_width * 0.5;
            }
        }
        if (count($polygon_points) > 5) {
            $image->filledPolygon($polygon_points, count($polygon_points) * 0.5);
        }

        //画直线
        $count = count($points);
        for ($i = 0; $i < $count * 0.5; $i ++) {
            $image->drawline($points[$i]['x'] + $star_width * 0.5, $points[$i]['y'] + $star_width * 0.5,
                $points[$count * 0.5 + $i]['x'] + $star_width * 0.5, $points[$count * 0.5 + $i]['y'] + $star_width * 0.5);
        }

        //添加星星
        foreach ($points as $p) {
            if ($p['selected']) {
                $image->add_image(APPPATH . 'images/red-star.png', $p['x'], $p['y']);
            } else {
                $image->add_image(APPPATH . 'images/star.png', $p['x'], $p['y']);
            }
        }

        //添加标题
        $title = "男神经-庄利强男神经-庄利强的的的职业地图";
        $title_top_adjust = 160;
        $image->set_font_size(35);
        $image->set_font_file( APPPATH . 'images/font2.ttf');
        $text_size = $image->get_text_size($title);
        $text_width = $text_size[2] - $text_size[0];
        $text_height = $text_size[1] - $text_size[7];
        $total_width = $image->get_image_width();
        $total_height = 105;
        $x = ($total_width - $text_width) * 0.5;
        $y = ($total_height - $text_height) * 0.5 + $title_top_adjust;

        $image->set_text($title, $x, $y);


        $image->output();
//        $image->save(APPPATH . '/images/result-bg6.png');
    }


    /**
     * @param $uid
     * @param $nickname
     * @param array $report
     * @desc 娱乐版图
     */
    public function jc_draw_png($uid, $nickname, $report = [])
    {
        $bg_file = APPPATH . 'images/result_bg.png';
//        echo $bg_file;
        $image = new Image($bg_file);
        //添加框框
        $text_bg_positions = [
            [80, 180], [10, 360], [70, 570], [350, 650], [485, 390], [460, 185]
        ];
        foreach ($text_bg_positions as $v) {
            $image->add_image(APPPATH . 'images/text_bg.png', $v[0], $v[1]);
        }

        //写字
        $texts = [];
        $points = [
            [
                'x' => 335,
                'y' => 240,
                'selected' => $report['309']['lighted'],
                'text' => $report['309']['entertainment']
            ],
            [
                'x' => 200,
                'y' => 312,
                'selected' => $report['314']['lighted'],
                'text' => $report['314']['entertainment']
            ],
            [
                'x' => 200,
                'y' => 470,
                'selected' => $report['320']['lighted'],
                'text' => $report['320']['entertainment']
            ],
            [
                'x' => 335,
                'y' => 555,
                'selected' => $report['328']['lighted'],
                'text' => $report['328']['entertainment']
            ],
            [
                'x' => 470,
                'y' => 470,
                'selected' => $report['323']['lighted'],
                'text' => $report['323']['entertainment']
            ],
            [
                'x' => 470,
                'y' => 312,
                'selected' => $report['317']['lighted'],
                'text' => $report['317']['entertainment']
            ],
        ];
        foreach ($points as $v) {
            $texts[] = $v['text'];
        }
        $text_bg_width = 196;
        $text_bg_height = 80;
        $image->set_text_params($text_bg_width, $text_bg_height, APPPATH . 'images/font.ttf', 20);

        $top_adjust_I = 10;
        $top_adjust_II = 10;

        for ($i = 0; $i < count($texts); $i ++) {
            if (mb_strlen($texts[$i]) <= 5) {
                $image->set_font_size(25);

                $text_size = $image->get_text_size($texts[$i]);
                $text_width = $text_size[2] - $text_size[0];
                $text_height = $text_size[1] - $text_size[7];
                $x = $text_bg_positions[$i][0] + ($text_bg_width - $text_width) * 0.5;
                $y = $text_bg_positions[$i][1] + ($text_bg_height - $text_height) * 0.5 + $text_height - $top_adjust_I;
                $image->set_text($texts[$i], $x, $y);
            } else {
                $image->set_font_size(20);

                $text_I = mb_substr($texts[$i], 0, 5);
                $text_II = mb_substr($texts[$i], 5);
//                echo $text_I . '--' . $text_II ."\n";
                $text_size = $image->get_text_size($text_I);
                $text_width_I = $text_size[2] - $text_size[0];
                $text_height_I = $text_size[1] - $text_size[7];

                $text_size = $image->get_text_size($text_II);
                $text_width_II = $text_size[2] - $text_size[0];
                $text_height_II = $text_size[1] - $text_size[7];

                $x = $text_bg_positions[$i][0] + ($text_bg_width - $text_width_I) * 0.5;
                $y = $text_bg_positions[$i][1] + ($text_bg_height - $text_height_I - $text_height_II) * 0.5 + $text_height_I - $top_adjust_II;
                $image->set_text($text_I, $x, $y);

                $x = $text_bg_positions[$i][0] + ($text_bg_width - $text_width_II) * 0.5;
                $y = $text_bg_positions[$i][1] + ($text_bg_height - $text_height_I - $text_height_II) * 0.5 + $text_height_I + $text_height_II - $top_adjust_II;
                $image->set_text($text_II, $x, $y);
            }
        }



        $star_width = 22;

        //画三角
        $polygon_points = [];
        foreach ($points as $p) {
            if ($p['selected']) {
                $polygon_points[] = $p['x'] + $star_width * 0.5;
                $polygon_points[] = $p['y'] + $star_width * 0.5;
            }
        }
        if (count($polygon_points) > 5) {
            $image->filledPolygon($polygon_points, count($polygon_points) * 0.5);
        }

        //画直线
        $count = count($points);
        for ($i = 0; $i < $count * 0.5; $i ++) {

            $image->drawline($points[$i]['x'] + $star_width * 0.5, $points[$i]['y'] + $star_width * 0.5,
                $points[$count * 0.5 + $i]['x'] + $star_width * 0.5, $points[$count * 0.5 + $i]['y'] + $star_width * 0.5);
        }



        //添加星星
        foreach ($points as $p) {
            if ($p['selected']) {
                $image->add_image(APPPATH . 'images/red_star.png', $p['x'], $p['y']);
            } else {
                $image->add_image(APPPATH . 'images/star2.png', $p['x'], $p['y']);
            }
        }

        //添加标题
        $title = $nickname . "的职业地图";
        $title_top_adjust = 95;
        $image->set_font_size(25);
        $image->set_font_file( APPPATH . 'images/font2.ttf');
        $text_size = $image->get_text_size($title);
        $text_width = $text_size[2] - $text_size[0];
        $text_height = $text_size[1] - $text_size[7];
        $total_width = $image->get_image_width();
        $total_height = 105;
        $x = ($total_width - $text_width) * 0.5;
        $y = ($total_height - $text_height) * 0.5 + $title_top_adjust;

        $image->set_text($title, $x, $y);

        $image->save(APPPATH . '/images/report/entertaiment_' . $uid . '.png');

        $image->output();
    }

    /**
     * @param $uid
     * @param $nickname
     * @param array $report
     * @desc 专业版图
     */
    public function jc_draw_professional_png($uid, $nickname, $report = [], $params = [], $ypj = 0)
    {
//        print_r($report);
        if (!$ypj) {
            $bg_file = APPPATH . 'images/professional-bg.png';
        } else {
            $bg_file = APPPATH . 'images/professional-bg2.png';
        }

//        echo $bg_file;
        $image = new Image($bg_file);

        //添加标题
        $title = $nickname . "的职业地图";
        $title_top_adjust = 130;
        $image->set_font_size(35);
        $image->set_font_file( APPPATH . 'images/Yuanti.ttc');
        $text_size = $image->get_text_size($title);
        $text_width = $text_size[2] - $text_size[0];
        $text_height = $text_size[1] - $text_size[7];
        $total_width = $image->get_image_width();
        $total_height = 105;
        $x = ($total_width - $text_width) * 0.5;
        $y = ($total_height - $text_height) * 0.5 + $title_top_adjust;
        $image->set_color(0, 0, 0, 127);
        $image->set_text($title, $x, $y);

        //添加文字
        $image->set_color(241, 72, 31, 0);
        $image->set_font_file( APPPATH . 'images/font5.ttf');
        $image->set_font_size(22);
        $texts = [
            [
                'x' => 55, 'y' => 1158, 'text' => $report[309]['professional'],
                'name' => '内驱'
            ], [
                'x' => 55, 'y' => 1448, 'text' => $report[314]['professional'],
                'name' => '毅力'
            ], [
                'x' => 55, 'y' => 1678, 'text' => $report[317]['professional'],
                'name' => '冒险'
            ], [
                'x' => 55, 'y' => 1918, 'text' => $report[320]['professional'],
                'name' => '机会敏感'
            ], [
                'x' => 55, 'y' => 2165, 'text' => $report[323]['professional'],
                'name' => '系统思维'
            ], [
                'x' => 55, 'y' => 2388, 'text' => $report[328]['professional'],
                'name' => '身体力量'
            ],
        ];

        $top_adjust_I = 20;

        for ($i = 0; $i < count($texts); $i ++) {
            $text_III = null;
            if (mb_strlen($texts[$i]['text']) <= 21) {
                $image->set_text($texts[$i]['text'], $texts[$i]['x'], $texts[$i]['y'] + $top_adjust_I);
            } else {
                $text_I = mb_substr($texts[$i]['text'], 0, 21);
                if (mb_strlen($texts[$i]['text']) <= 42 || !in_array($texts[$i]['name'], [
                        '内驱', '冒险'
                    ])) {
                    $text_II = mb_substr($texts[$i]['text'], 21);
                } else {
                    $text_II = mb_substr($texts[$i]['text'], 21, 21);
                    $text_III = mb_substr($texts[$i]['text'], 42);
                }
                $image->set_text($text_I, $texts[$i]['x'], $texts[$i]['y'] + $top_adjust_I);
                $text_size = $image->get_text_size($text_I);
                $text_height = $text_size[1] - $text_size[7];
                $image->set_text($text_II, $texts[$i]['x'], $texts[$i]['y'] + $top_adjust_I + $text_height + 10);
                if (isset($text_III)) {
                    $image->set_text($text_III, $texts[$i]['x'], $texts[$i]['y'] + $top_adjust_I + ($text_height + 10) * 2);
                }
            }
        }

        //添加问题文字
        if (!$ypj) {
            $points = [
                '内驱',
                '毅力',
                '冒险',
                '机会敏感',
                '身体能量',
                '系统思维'
            ];

            $question = sprintf('您觉得“%s”指标对您的描述准确吗？', $points[rand(0, count($points) - 1)]);

            $title_top_adjust = 2720;
            $image->set_font_size(20);
            $image->set_font_file(APPPATH . 'images/font4.ttc');
            $text_size = $image->get_text_size($question);
            $text_width = $text_size[2] - $text_size[0];
            $total_width = $image->get_image_width();
            $x = ($total_width - $text_width) * 0.5;
            $y = $title_top_adjust;
            $image->set_color(0, 0, 0, 127);
            $image->set_text($question, $x, $y);
        } else {
            //添加已评价的图片
//            $image->add_image(APPPATH . 'images/ypj.png', 30, 2650);
        }

        //坐标轴上画虚线
        $this->draw_professional($image, $params);

        if (!$ypj) {
            $image->save(APPPATH . '/images/report/professional_' . $uid . '.png');
        } else {
            $image->save(APPPATH . '/images/report/professional_ypj_' . $uid . '.png');
        }
        $image->output();
    }

    public function jc_draw_other_png($uid, $nickname, $params)
    {
//        print_r($params); die();
        $bg_file = APPPATH . 'images/partner.png';
        $image = new Image($bg_file);
        //x = 374 y = 683   r = 127

        $this->draw_partner($image, $params);

        //画那几句狗屁话
        $jscy = new JSCY();
        $partners = [];
        $data = json_decode($jscy->get_partner($params), true);
        if (isset($data['status']) && strtolower($data['status']) == 'ok') {
            $this->get_partner($data['moduleTree'], $partners);
        }
        //x = 90, y = 825
        $image->set_font_size(25);
        $image->set_font_file( APPPATH . 'images/Yuanti.ttc');
        $image->set_color(0, 0, 0, 0);
        $image->set_text(sprintf('%s适合的伙伴有如下特征：', $nickname), 65, 820);
        $y = 850;
        $x = 25;
        $image->set_font_size(23);
        $image->set_font_file( APPPATH . 'images/font5.ttf');
        for ($i = 0; $i < count($partners); $i ++) {
            $text_III = null;
            $image->add_image(APPPATH . 'images/red-star.png', $x, $y);
            if (mb_strlen($partners[$i]) <= 18) {
                $image->set_text($partners[$i], $x + 40, $y + 30);
                $y += 50;
            } else {
                $text_I = mb_substr($partners[$i], 0, 18);
                if (mb_strlen($partners[$i]) > 36) {
                    $text_II = mb_substr($partners[$i], 18, 18);
                    $text_III = mb_substr($partners[$i], 36);
                } else {
                    $text_II = mb_substr($partners[$i], 18);
                }

                $image->set_text($text_I, $x + 40, $y + 30);
                $y += 35;
                $image->set_text($text_II, $x + 40, $y + 30);
                if (isset($text_III)) {
                    $y += 35;
                    $image->set_text($text_III, $x + 40, $y + 30);
                }
                $y += 50;
            }
        }


        $image->save(APPPATH . '/images/report/partner_' . $uid . '.png');

        $image->output();
    }

    private function get_partner($data, &$partners)
    {
        foreach ($data['Children'] as $v) {
            if ($v['NodeName'] == '团队搭配') {
                foreach ($v['Children'] as $vv) {
                    $partners = array_merge($partners, explode('|', $vv['Explanation']));
                }
            } else {
                $this->get_partner($v, $partners);
            }
        }
    }

    private function drawTwePoints($image, $x, $y, $r1, $r2, &$twePoints, $mainDeg)
    {
        foreach ($twePoints as $name => &$info) {
            $rI = 2 * pi() * ($info['range'] / 360);
            $x1 = $x + $r2*sin($rI);
            $y1 = $y - $r2*cos($rI);
            $x2 = $x + $r1*sin($rI);
            $y2 = $y - $r1*cos($rI);

            $info['pos']['x'] = $x1;
            $info['pos']['y'] = $y1;
            $info['pos']['cx'] = $x2;
            $info['pos']['cy'] = $y2;

            $image->set_color(11, 36, 251, 0);
//            $image->circle($info['pos']['cx'], $info['pos']['cy'], 8, 8);

            $mainrI = 2 * pi() * ($mainDeg / 360);
            $mainX = $x + $r1*sin($mainrI);
            $mainY = $y - $r1*cos($mainrI);
            $image->set_color(255, 0, 0, 0);

            $image->circle($mainX, $mainY, 20, 20);
        }
    }

    private function drawLines($image, $WangShuai)
    {
        usort($WangShuai, function($a, $b) {
            return $a['id'] > $b['id'] ? 1 : ($a['id'] < $b['id'] ? -1 : 0);
        });
        $points = [];
        foreach ($WangShuai as $name => $info) {
            array_push($points, [
                'x' => $info['pos']['cx'],
                'y' => $info['pos']['cy'],
            ]);
        }
//        for ($i = 0; $i < count($diffPoint); $i ++) {
//            $info = $diffPoint[$i];
//            $nexInfo = $diffPoint[($i+1)%count($diffPoint)];
//            $image->dashline($info['pos']['cx'], $info['pos']['cy'], $nexInfo['pos']['cx'], $nexInfo['pos']['cy']);
//        }
        $image->dashline2($points);
    }

    /**
     * @desc 专业版上画虚线
     */
    private function draw_professional($image, $params)
    {
        $twePoints = [
            "帝旺" => [
                'id' => 1,
                'name' => "帝旺",
                'range' => "0",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 1000,
                'direction' => 1
            ],
            "衰" => [
                'id' => 2,
                'name' => "衰",
                'range' => "30",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 800,
                'direction' => 1
            ],
            "病" => [
                'id' => 3,
                'name' => "病",
                'range' => "60",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 600,
                'direction' => 1
            ],
            "死" => [
                'id' => 4,
                'name' => "死",
                'range' => "90",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 400,
                'direction' => 1
            ],
            "墓" => [
                'id' => 5,
                'name' => "墓",
                'range' => "120",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 200,
                'direction' => 1
            ],
            "绝" => [
                'id' => 6,
                'name' => "绝",
                'range' => "150",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 0,
                'direction' => 1
            ],
            "胎" => [
                'id' => 7,
                'name' => "胎",
                'range' => "180",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 0,
                'direction' => -1
            ],
            "养" => [
                'id' => 8,
                'name' => "养",
                'range' => "210",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 200,
                'direction' => -1
            ],
            "长生" => [
                'id' => 9,
                'name' => "长生",
                'range' => "240",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 400,
                'direction' => -1
            ],
            "沐浴" => [
                'id' => 10,
                'name' => "沐浴",
                'range' => "270",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 600,
                'direction' => -1
            ],
            "冠带" => [
                'id' => 11,
                'name' => "冠带",
                'range' => "300",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 800,
                'direction' => -1
            ],
            "临官" => [
                'id' => 12,
                'name' => "临官",
                'range' => "330",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 1000,
                'direction' => -1
            ],

        ];

        $jscy = new JSCY();
        //获取接口数据
        $data = $jscy->get_huaxian($params);
        $infos = [
            'data' => json_decode($data, 1)
        ];

        $baZiinfo = [];
        $baZiinfo["Shizhu"] = $infos['data']['Shizhu'];
        $baZiinfo["Rizhu"] = $infos['data']['Rizhu'];
        $baZiinfo["Yuezhu"] = $infos['data']['Yuezhu'];
        $baZiinfo["Nianzhu"] = $infos['data']['Nianzhu'];


        foreach ($baZiinfo as $name => &$info) {
            $info["TianGan"] = array_slice($info['GanZhi'], 0, 1);
            $info["DiZhi"] = array_slice($info['GanZhi'], -1);
            $info["CangGan"] = [];
            foreach ($info['DiZhiCangGanList'] as $i => $cangan) {
                array_push($info["CangGan"], $cangan['CangGan']);
            }

            $info["ShenSha"] = $info['ShenShaList'];
        }

        $WangShuai = [];
        $fourWangShuai = [];
        $sum = 0; $lnum = 0; $rnum = 0; $monZhi = 0; $direc = "";

        foreach ($baZiinfo as $name => &$info)
        {
            $WangShuai[$info['WangShuai']] = $twePoints[$info['WangShuai']];
            $sinScore = $twePoints[$info['WangShuai']]['score'];

            if($name == "Yuezhu"){
                $sum += 0.4 * floatval($sinScore);
                $monZhi = $twePoints[$info['WangShuai']]['direction'];
                if($monZhi > 0){
                    //right
                    $direc = "right";
                }else{
                    //left
                    $direc = "left";
                }
            }else{
                $sum += 0.2 * floatval($sinScore);
            }

            if($twePoints[$info['WangShuai']]['direction'] > 0){
                $rnum++;
            }else{
                $lnum++;
            }
            array_push($fourWangShuai, $twePoints[$info['WangShuai']]);
        }

        $deg = 0;
        if($lnum == $rnum){
            if($direc == "right"){
                //deg = parseFloat(sum/1000)*180;
                $deg = (180 - floatval($sum/1000)*180)%360;
            }else if($direc == "left"){
                $deg = 180+ floatval($sum/1000)*180;
                // deg = (360 - parseFloat(sum/1000)*180)%360;
            }
        }else{
            if($lnum>$rnum){
                //left
                $deg = 180+ floatval($sum/1000)*180;
            }else{
                //right
                $deg = (180 - floatval($sum/1000)*180)%360;
            }
        }
        //x = 374 y = 683   r = 127
        $x = 375;
        $y = 663;
        $r1 = 127;
        $r2 = $r1 - 40;

        $this->drawTwePoints($image, $x, $y, $r1, $r2, $twePoints, $deg);

        foreach ($baZiinfo as $name => &$info)
        {
            $WangShuai[$info['WangShuai']] = $twePoints[$info['WangShuai']];
            $sinScore = $twePoints[$info['WangShuai']]['score'];

            if($name == "Yuezhu"){
                $sum += 0.4 * floatval($sinScore);
                $monZhi = $twePoints[$info['WangShuai']]['direction'];
                if($monZhi > 0){
                    //right
                    $direc = "right";
                }else{
                    //left
                    $direc = "left";
                }
            }else{
                $sum += 0.2 * floatval($sinScore);
            }

            if($twePoints[$info['WangShuai']]['direction'] > 0){
                $rnum++;
            }else{
                $lnum++;
            }
            array_push($fourWangShuai, $twePoints[$info['WangShuai']]);
        }

        $image->set_color(255, 0, 0, 0);
        $this->drawLines($image, $WangShuai);

    }

    /**
     * @desc 专业版上画虚线
     */
    private function draw_partner($image, $params)
    {
        $twePoints = [
            "帝旺" => [
                'id' => 1,
                'name' => "帝旺",
                'range' => "0",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 1000,
                'direction' => 1
            ],
            "衰" => [
                'id' => 2,
                'name' => "衰",
                'range' => "30",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 800,
                'direction' => 1
            ],
            "病" => [
                'id' => 3,
                'name' => "病",
                'range' => "60",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 600,
                'direction' => 1
            ],
            "死" => [
                'id' => 4,
                'name' => "死",
                'range' => "90",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 400,
                'direction' => 1
            ],
            "墓" => [
                'id' => 5,
                'name' => "墓",
                'range' => "120",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 200,
                'direction' => 1
            ],
            "绝" => [
                'id' => 6,
                'name' => "绝",
                'range' => "150",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 0,
                'direction' => 1
            ],
            "胎" => [
                'id' => 7,
                'name' => "胎",
                'range' => "180",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 0,
                'direction' => -1
            ],
            "养" => [
                'id' => 8,
                'name' => "养",
                'range' => "210",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 200,
                'direction' => -1
            ],
            "长生" => [
                'id' => 9,
                'name' => "长生",
                'range' => "240",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 400,
                'direction' => -1
            ],
            "沐浴" => [
                'id' => 10,
                'name' => "沐浴",
                'range' => "270",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 600,
                'direction' => -1
            ],
            "冠带" => [
                'id' => 11,
                'name' => "冠带",
                'range' => "300",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 800,
                'direction' => -1
            ],
            "临官" => [
                'id' => 12,
                'name' => "临官",
                'range' => "330",
                'pos' => [
                    'x' => 0,
                    'y' => 0,
                    'cx'  => 0,
                    'cy' =>0
                ],
                'score' => 1000,
                'direction' => -1
            ],

        ];

        $jscy = new JSCY();
        //获取接口数据
        $data = $jscy->get_huaxian($params);
        $infos = [
            'data' => json_decode($data, 1)
        ];

        $baZiinfo = [];
        $baZiinfo["Shizhu"] = $infos['data']['Shizhu'];
        $baZiinfo["Rizhu"] = $infos['data']['Rizhu'];
        $baZiinfo["Yuezhu"] = $infos['data']['Yuezhu'];
        $baZiinfo["Nianzhu"] = $infos['data']['Nianzhu'];


        foreach ($baZiinfo as $name => &$info) {
            $info["TianGan"] = array_slice($info['GanZhi'], 0, 1);
            $info["DiZhi"] = array_slice($info['GanZhi'], -1);
            $info["CangGan"] = [];
            foreach ($info['DiZhiCangGanList'] as $i => $cangan) {
                array_push($info["CangGan"], $cangan['CangGan']);
            }

            $info["ShenSha"] = $info['ShenShaList'];
        }

        $WangShuai = [];
        $fourWangShuai = [];
        $sum = 0; $lnum = 0; $rnum = 0; $monZhi = 0; $direc = "";

        foreach ($baZiinfo as $name => &$info)
        {
            $WangShuai[$info['WangShuai']] = $twePoints[$info['WangShuai']];
            $sinScore = $twePoints[$info['WangShuai']]['score'];

            if($name == "Yuezhu"){
                $sum += 0.4 * floatval($sinScore);
                $monZhi = $twePoints[$info['WangShuai']]['direction'];
                if($monZhi > 0){
                    //right
                    $direc = "right";
                }else{
                    //left
                    $direc = "left";
                }
            }else{
                $sum += 0.2 * floatval($sinScore);
            }

            if($twePoints[$info['WangShuai']]['direction'] > 0){
                $rnum++;
            }else{
                $lnum++;
            }
            array_push($fourWangShuai, $twePoints[$info['WangShuai']]);
        }

        $deg = 0;
        if($lnum == $rnum){
            if($direc == "right"){
                //deg = parseFloat(sum/1000)*180;
                $deg = (180 - floatval($sum/1000)*180)%360;
            }else if($direc == "left"){
                $deg = 180+ floatval($sum/1000)*180;
                // deg = (360 - parseFloat(sum/1000)*180)%360;
            }
        }else{
            if($lnum>$rnum){
                //left
                $deg = 180+ floatval($sum/1000)*180;
            }else{
                //right
                $deg = (180 - floatval($sum/1000)*180)%360;
            }
        }
        //x = 374 y = 683   r = 127
        $x = 345;
        $y = 533;
        $r1 = 127;
        $r2 = $r1 - 40;

        $this->drawTwePoints($image, $x, $y, $r1, $r2, $twePoints, $deg);

        foreach ($baZiinfo as $name => &$info)
        {
            $WangShuai[$info['WangShuai']] = $twePoints[$info['WangShuai']];
            $sinScore = $twePoints[$info['WangShuai']]['score'];

            if($name == "Yuezhu"){
                $sum += 0.4 * floatval($sinScore);
                $monZhi = $twePoints[$info['WangShuai']]['direction'];
                if($monZhi > 0){
                    //right
                    $direc = "right";
                }else{
                    //left
                    $direc = "left";
                }
            }else{
                $sum += 0.2 * floatval($sinScore);
            }

            if($twePoints[$info['WangShuai']]['direction'] > 0){
                $rnum++;
            }else{
                $lnum++;
            }
            array_push($fourWangShuai, $twePoints[$info['WangShuai']]);
        }

        $image->set_color(255, 0, 0, 0);
        $this->drawLines($image, $WangShuai);

    }

}
