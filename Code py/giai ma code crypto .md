# Những loại mã hóa thông dụng (encoding)   
[Link tham khao](https://www.facebook.com/media/set/?set=a.447496096975592&type=3)

## ASCII
 - Ascii là một hệ thống mã hóa được dùng để hiển thị văn bản trên máy tính và các thiết bị điện tử.
 - Mã sd 7bit là các số trong khoảng từ 0 -> 127) để biểu diễn hầu hết các kí tự
 - Các kí tự có thể in ra được nằm trong khoảng 32 - 126
 - Mã ASCII đc dùng phổ biến hiện nay là 8 bit (tương đương với các số từ 0-255)
 - Nhận biết : thường dùng các ktu có thể in ra đc nằm trong khoảng 32-126 và cách nhau `" ","-","_"  ` 
 Ví dụ: 99 111 109 115 101 99
  - Tool tra cứu bảng mã 
 [Tool](https://www.lookuptables.com/text/ascii-table)
 
 Code decode 
 ```py
 def ascii_decode(ct,delimiter=" ",toString=False):
	pt=b""
	for c in ct.split(delimiter):
		pt+=chr(int(c)).encode()
	
	if toString:
		return pt.decode()
	return pt


print(ascii_decode("99-111-109-115-101-99","-",True))  #=>comsec

'''
ct: chuỗi ascii cần mã hóa 
delimiter : cách nhau bởi dấu gì 
toString=False vì không phải lúc nào dịch ngược từ một loại mã cũng cho ra một string ascii hoàn hảo
Vì thế để cho an toàn thì các hàm chỉ trả về kiểu bytearray và chỉ trả về kiểu string khi cần thiết.
pt : chuỗi sau khi decode 

'''
 ```
 

## Binary
 - Mã cơ số 2: Sử dụng 2 số 0 và 1 để mã hóa các số ASCII
 - Ngta dùng 8 bit binary để mã hóa các số từ 0 - 255
 - Thường có dạng:  bit 0 ở đầu + 7 bit sau tương ứng với ktự nằm trong bảng ASCII
 - Nhận biết : thường là một chuỗi các bit 0 và 1 liên tục hoặc được nhóm lại thành nhóm 8 bit
Ví dụ:  01100011 01101111 01101101 01110011 01100101 01100011

Code decode :
```py
def bin_decode(ct,delimiter=" ",toString=False):
   ct = ct.replace(delimiter,"")  #ghép chuỗi 
   pt=b""
   print(ct)
   for i in range(0,len(ct),8):
      pt+=chr(int(ct[i:i+8],2)).encode()    
      # tách chuỗi thành từng chuỗi nhỏ 8 kí tự và đổi kiểu sang int => sau khi đổi sang int 01100011 8 ktu sẽ còn 7 ktu do kiểu int sẽ bỏ số 0 ở đầu 
      # rồi mã hóa theo mã ascii chr(...,2) theo cơ số 2

   
   if toString:
   	return pt.decode()
   return pt



print(bin_decode("01100011 01101111 01101101 01110011 01100101 01100011",toString=True))

```


## Base32 (mã cơ số 32)
 - Bảng mã gồm 32 kí tự theo thứ tự `từ A-Z từ 2-7` 
 - Mã hóa dùng để rút ngắn độ dài của chuỗi binary 
 - 1 ktự (base32) mã hóa đc 5 ktự (binary) => 8 bit (base32) == 40bits mã hóa đc 5 chữ cái trong mã ASCII 
 - Nếu độ dài string mã hóa ko đủ thì thường sẽ có ktự padding `"="` ở cuối string  
Ví dụ: MNXW243FMM======
 - Giải mã logic : 
     + Bỏ phần padding, chuyển mỗi kí tự thành một số tương ứng: 12 13 23 22 28 30 29 5 12 12
     + Chuyển mỗi số thành chuỗi 5 bit binary: 01100 01101 10111 10110 11100 11110 11101 00101 01100 01100
     + Ghép chuỗi lại và nhóm lại thành nhóm 8, bỏ nhóm padding cuối cùng (nếu có) gồm các kí tự 0: 01100011 01101111 01101110 01111011 10100101 01100011
     + Plaintext: `comsec`
 

## Base64 (mã cơ số 64):
 - Bảng mã gồm 64 kí tự theo thứ tự `từ A-Z từ a-z từ 0-9 + , / `
 - Mã hóa cũng đc dùng để rút ngắn độ dài của chuỗi binary 
 - 1 ktự (base64) mã hóa đc 6 ktự (binary) 
 => 4 bit (base64) == 24bits mã hóa đc 3 chữ cái trong mã ASCII 
 => 8 bit (base64) == 48bits mã hóa đc 6 chữ cái trong mã ASCII 
 - Nếu độ dài string mã hóa ko đủ thì thường sẽ có ktự padding `"="` ở cuối string  
Ví dụ: Y29tc2Vj

