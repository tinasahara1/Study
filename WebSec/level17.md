# Level Seventeen
>strcasecmp ()
>
## Ta có source code đề bài như sau : 
![sou1](https://github.com/tinasahara1/Study/blob/a09e36f2401c2b3af13f132af799f50c16be8537/WebSec/image/sou1.PNG)

Điều ta cần làm là `strcasecmp ($_POST['flag'], $flag)` làm hàm so sánh này trả về true 

**strcasecmp ($value, $key)** hàm này hoạt động như sau:
Value nhập vào sẽ được so sánh với key (so sánh 2 chuỗi) => nhưng nó lại có 1 lỗ hổng rằng nếu là mảng thì auto trả về true 

Cách bypass 
![bypass](https://github.com/tinasahara1/Study/blob/a09e36f2401c2b3af13f132af799f50c16be8537/WebSec/image/payload.PNG)

Flag: `WEBSEC{It_seems_that_php_could_use_a_stricter_typing_system}`
