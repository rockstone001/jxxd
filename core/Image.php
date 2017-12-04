<?php
/**
 * 扩展CI_Controller类, 目的是在处理请求逻辑之前统一为每个请求做处理
 * @author zhuang
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Image {

    private $imgHandler;
    private $text_bg_width;
    private $text_bg_height;
    private $font_file;
    private $font_size;
    private $color;

	public function __construct($file)
    {
        $this->imgHandler = imagecreatefrompng($file);
        $this->color = imagecolorallocate($this->imgHandler, 0, 0, 0);
    }

    public function set_text_params($width, $height, $font, $font_size)
    {
        $this->text_bg_width = $width;
        $this->text_bg_height = $height;
        $this->font_file = $font;
        $this->font_size = $font_size;
    }

    public function set_color($r, $g, $b, $a)
    {
        $this->color = imagecolorclosestalpha($this->imgHandler, $r, $g, $b, $a);
    }

    public function set_font_size($font_size)
    {
        $this->font_size = $font_size;
    }

    public function set_font_file($font_file)
    {
        $this->font_file = $font_file;
    }

    public function get_text_size($text)
    {
        return imagettfbbox($this->font_size, 0, $this->font_file, $text);
    }

    public function add_image($source_image, $x=0, $y=0)
    {
        $dst_im = $this->imgHandler;

        $src_im = imagecreatefrompng($source_image);
        $width = imagesx($src_im);
        $height = imagesy($src_im);

        $this->imagecopymerge_alpha($dst_im, $src_im, $x, $y, 0, 0, $width, $height, 100);
    }

    public function set_text($text, $x=0, $y=0) {
        imagettftext($this->imgHandler, $this->font_size, 0, $x, $y, $this->color, $this->font_file, $text);
    }

    private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
    {
        $cut = imagecreatetruecolor($src_w, $src_h);
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    public function filledPolygon($points, $num = 3)
    {
        $color = imagecolorallocatealpha($this->imgHandler, 246, 192, 45, 30);
        imagefilledpolygon($this->imgHandler, $points, $num, $color);
    }

    public function drawline($x1, $y1, $x2, $y2)
    {
        $color = imagecolorallocatealpha($this->imgHandler, 0, 0, 0, 0);
        imageline($this->imgHandler, $x1, $y1, $x2, $y2, $color);
    }

    public function get_image_width()
    {
        return imagesx($this->imgHandler);
    }

    public function output()
    {
        imagesavealpha($this->imgHandler, true);
        header('Content-type: image/png');
        imagepng($this->imgHandler);
    }

    public function save($file)
    {
        imagesavealpha($this->imgHandler, true);
        imagepng($this->imgHandler, $file);
    }

    public function circle($x, $y, $width, $height)
    {
        imagefilledarc($this->imgHandler, $x, $y, $width, $height, 0, 360, $this->color, IMG_ARC_PIE);
    }

    public function dashline($x1, $y1, $x2, $y2)
    {
        echo "x1=$x1, y1=$y1; x2=$x2, y2=$y2\n";
        var_dump(imagedashedline($this->imgHandler, $x1, $y1, $x2, $y2, $this->color));
    }

    public function dashline2($points)
    {
//        imagedashedline($this->imgHandler, 483.98522628062, 619.5, 483.98522628062, 746.5, $this->color);
//        imagedashedline($this->imgHandler, 483.98522628062, 746.5, 437.5, 573.01477371938, $this->color);
//        imagedashedline($this->imgHandler, 437.5, 573.01477371938, 483.98522628062, 619.5, $this->color);
//        $this->set_color(255, 255, 255, 0);
        $length1 = 15;
        $length2 = 5;
        $w = imagecolorclosestalpha($this->imgHandler, 254, 208, 50, 0);
        $red = imagecolorclosestalpha($this->imgHandler, 255, 0, 0, 0);

        $style = array_merge(array_fill(0, $length1, $red), array_fill(0, $length2, $w));

        imagesetthickness($this->imgHandler, 3);
        imagesetstyle ($this->imgHandler, $style);

        for ($i = 0; $i < count($points); $i ++) {
            $p1 = $points[$i];
            $p2 = $points[($i+1)%count($points)];
            imageline($this->imgHandler, $p1['x'], $p1['y'], $p2['x'], $p2['y'], IMG_COLOR_STYLED);
//            for ($ii = 0; $ii < $thickness; $ii ++) {
//                imageline($this->imgHandler, $p1['x'], $p1['y'] + (1 + $ii), $p2['x'], $p2['y'] + (1 + $ii), IMG_COLOR_STYLED);
//                imageline($this->imgHandler, $p1['x'], $p1['y'] - (1 - $ii), $p2['x'], $p2['y'] - (1 - $ii), IMG_COLOR_STYLED);
//            }
        }
    }

    public function t()
    {

    }
}
