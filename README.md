# PHP常用辅助函数库
## json字符串解析
```Helper::analyJson($json_str)```
## 生成随机汉字字符串
```Helper::getHanChar($num)```
## 判断颜色是深色还是浅色
```Helper::darkOrLight($color_r , $color_g , $color_b)```
## 16进制颜色转rgb
```Helper::hex2rgb($color)```
## 颜色反转，由浅色转深色或由深色转浅色
```Helper::colorReverse($color ,$to_dark_or_light = 1)```
## 生成随机色块头像
```Helper::randAvatar($str = '' , $width = 200)```