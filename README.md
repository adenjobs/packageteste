# PHP常用辅助函数库

<a href="https://packagist.org/packages/liberram/packagetest"><img src="https://img.shields.io/packagist/dt/liberram/packagetest" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/liberram/packagetest"><img src="https://img.shields.io/packagist/v/liberram/packagetest" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/liberram/packagetest"><img src="https://img.shields.io/packagist/l/liberram/packagetest" alt="License"></a>
## 安装
```composer require liberram/packagetest```

## 内置函数

### json字符串解析
```Helper::analyJson($json_str)```
### 生成随机汉字字符串
```Helper::getHanChar($num)```
### 判断颜色是深色还是浅色
```Helper::darkOrLight($color_r , $color_g , $color_b)```
### 16进制颜色转rgb
```Helper::hex2rgb($color)```
### 颜色反转，由浅色转深色或由深色转浅色
```Helper::colorReverse($color ,$to_dark_or_light = 1)```
### 生成随机色块头像
```Helper::randAvatar($str = '' , $width = 200)```
![image](data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADIAQMAAACXljzdAAAABlBMVEX///80jJ1vKKaMAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAOklEQVRYhe3JwQkAMAgAMfdf2tJXRZyg5l4HiRjK2wSEkK8lh4oTQrbJeISQbfK2RQhZJ8VbhJBlcgAzmx5voykbYgAAAABJRU5ErkJggg==)
