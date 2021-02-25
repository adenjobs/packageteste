<?php
/**
 * Created by PhpStorm.
 * User: maker
 * Date: 2021/2/25
 * Time: 12:19 PM
 */

namespace liberram\packagetest;


class Helper
{
    /**
     * 解析json串
     * @param $json_str
     * @return mixed|null
     */
    public static function analyJson($json_str) {
        $json_str = str_replace('＼＼', '', $json_str);
        $out_arr = array();
        preg_match('/{.*}/', $json_str, $out_arr);
        if (!empty($out_arr)) {
            $result = json_decode($out_arr[0], true);
        } else {
            return null;
        }
        return $result;
    }

    /**
     * 生成随机汉字
     * @param $num  [生成汉字的数量]
     * @return string   [返回的汉字串]
     */
    public static function getHanChar($num){
        $b = '';
        for ($i=0; $i<$num; $i++) {
            // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
            $a = chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1, 0xF0));
            // 转码
            $b .= iconv('GB2312', 'UTF-8', $a);
        }
        return $b;
    }


    /**
     * 判断颜色是深色还是浅色
     *
     * @param $color_r
     * @param $color_g
     * @param $color_b
     * @return int
     */
    public static function darkOrLight($color_r , $color_g , $color_b)
    {
        if($color_r*0.299 + $color_g*0.578 + $color_b*0.114 >= 192){ //浅色
            return 0;
        }else{  //深色
            return 1;
        }
    }

    /**
     * 16进制颜色转rgb
     * @param $color
     * @return array|bool
     */
    public static function hex2rgb($color) {
        $hexColor = str_replace('#', '', $color);
        $lens = strlen($hexColor);
        if ($lens != 3 && $lens != 6) {
            return false;
        }
        $newcolor = '';
        if ($lens == 3) {
            for ($i = 0; $i < $lens; $i++) {
                $newcolor .= $hexColor[$i] . $hexColor[$i];
            }
        } else {
            $newcolor = $hexColor;
        }
        $hex = str_split($newcolor, 2);
        $rgb = [];
        foreach ($hex as $key => $vls) {
            $rgb[] = hexdec($vls);
        }
        return $rgb;
    }

    /**
     * 颜色反转，由浅色转深色或由深色转浅色
     * @param $color
     * @param int $to_dark_or_light [转深色值为1，转浅色值为0]
     *
     * @return string
     */
    public static function colorReverse($color ,$to_dark_or_light = 1)
    {
        // 判断是不是16进制颜色值

        $result = self::hex2rgb($color);
        if(!is_array($result)){
            return "000000";
        }

        $dark_or_light = self::darkOrLight($result[0],$result[1],$result[2]);

        if($dark_or_light == $to_dark_or_light){
            return "000000";
        }else{
            $color = str_replace('#', '', $color);
            if (strlen($color) != 6){ return '000000'; }
            $rgb = '';
            for ($x=0;$x<3;$x++){
                $c = 255 - hexdec(substr($color,(2*$x),2));
                $c = ($c < 0) ? 0 : dechex($c);
                $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
            }
            return $rgb;
        }

    }

    /**
     * 生成随机色块头像
     *
     * @param string $str
     * @param int $width
     * @return string
     */
    public static function randAvatar($str = '' , $width = 200)
    {
        $str = $str ?$str: md5(time().rand());

        $piece_w_h = $width / 5;

        $md5 = md5($str);

        // 获取决定颜色位置的25个字符
        $str_25 = substr($md5,0,25);

        // 获取颜色
        $color = substr($md5,strlen($md5) - 6,6);
        list($color_r,$color_g,$color_b) = self::hex2rgb($color);
        $dark_or_light = self::darkOrLight($color_r, $color_g , $color_b);

        // 判断颜色是浅色还是深色
        if($dark_or_light == 0){
            // 浅色颜色反转为深色
            $color = self::colorReverse($color , 1);
            list($color_r,$color_g,$color_b) = self::hex2rgb($color);
        }

        // 创建背景图
        $img = imagecreate($width, $width);
        // 创建色块
        $piece_img = imagecreate($piece_w_h , $piece_w_h);
        imagecolorallocate($img , 255 , 255 , 255);
        imagecolorallocate($piece_img , $color_r , $color_g , $color_b);

        for ($i = 0 ; $i < strlen($str_25) ; $i++){
            $line = intval($i / 5);
            $place = $i % 5;
            $beta_10 = hexdec($str_25[$i]);

            if($beta_10 <= 7){
                // 带色的块覆盖到背景图上
                imagecopy($img,$piece_img , $place*$piece_w_h,$line*$piece_w_h,$width , $width,$piece_w_h,$piece_w_h);
            }
        }

        ob_start();
        imagepng ($img);
        $image_data = ob_get_contents ();
        ob_end_clean ();

        return "data:image/png;base64,". base64_encode ($image_data);
    }
}