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
}