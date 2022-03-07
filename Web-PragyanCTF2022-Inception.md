# Inception

>Đề bài cho source code html
>

## Bước 1: Ta copy source code về và debug xem từng phần biến 

[index.html](https://github.com/tinasahara1/Study/blob/1d909a74d52dc977d73bab7e4312a3769ce67945/file/index.html)

Ta có source code gồm những biến sau :
![source code]()


### Flag1 : 
Để xem giá trị của mảng : `console.log(_0xa965)` 

![debug1]()


Ta thêm hàm `alert(_0x31e3x2)` để in một thông báo chứa tham số ta truyền vào :

![debug2]()


=> `Flag Part 1: p_ctf{INfjnity5`


### Flag2 : 

Do hàm eval() làm cho mảng ko thể hiển thị => `_0xd4d0 is not defined` 

=>  Vì vậy ta xóa nó đi và `console.log(_0xd4d0)` lại là có thể xem được hoặc có thể thêm `document.write(_0xd4d0)` vào source để xem toàn bộ nội dung của tham số đó 

![debug2]()

Nội dung đầu ra dạng base64 => ta decode và nhận được 

![flag2]()

=> `PCTF Flag Part 2: _b3g1n5_w1th_4n_`


### Flag3 : 

Đoạn cuối của mảng `_0xd4d0` là 1 đoạn code như sau :
```js
var DontChange=[66,-19,-20,36,-38,-65,6,-13,-74,-114];
var user="securesite";
var YourAnswer=[0,0,0,0,0,0,0,0,0,0];
for(var i=0;i< DontChange.length;i++){
	if((DontChange[i]+ YourAnswer[i]+ i* 10)!== user.charCodeAt(i)){
		break
		};
	if(i=== DontChange[_0xfd39[1]]- 1){
		console.log("You have your answer")}}
```

Phân tích đoạn code : 
- Kết quả ta cần tìm là hàm `YourAnswer` 
- Mà `YourAnswer[i]= user.charCodeAt(i) - DontChange[i] -i*10` => Flag 

Ta có code khai thác như sau :
```py
DontChange=[66,-19,-20,36,-38,-65,6,-13,-74,-114]
user="securesite"
userCharCode=[115,101,99,117,114,101,115,105,116,101]
YourAnswer=[]
i=0

for a in DontChange:
	x=userCharCode[i]-i*10-a;
	i+=1
	YourAnswer.append(chr(x))
	

tuple(YourAnswer)
YourAnswer="".join(YourAnswer)
print(YourAnswer)
```

=> `Flag Part 3: 1nc3pt10n}`

==> Flag:  `p_ctf{INfjnity5_b3g1n5_w1th_4n_1nc3pt10n}`
