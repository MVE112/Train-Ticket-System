# Made by: Miguel Velasco Espinosa
# Contributions: Mason Hadley, Jacob Rothschild
# Final Version of Network Code.
# Connects two sockets together and sends encrypted information through a LAN network with No access to Internet.
#
#
#
#
#
#

import mariadb
import sys
import socket
import time
try:
    con = mariadb.connect(user ="root", password = "1234", host = "127.0.0.1", port = 3306, database = "db")
except mariadb.Error as e:
    print(f"Error connecting to MariaDB Platform: {e}")
    sys.ext(1)
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s2 = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

s.bind(('169.254.37.17',2000))
s2.bind(('169.254.37.17', 2001))
cur = con.cursor()
s.listen(5)
s2.listen(5)
clientsocket, address = s.accept()
clientsocket2, address2 = s2.accept()
print(f"Connection from {address} has been established")
print(f"Connection from {address2} has been established")
i = 1
while True:
    routeN = 0
    tp = 0
    tn = 0
    eta = 0
    if(i > 4):
        i = 1
    cur.execute("SELECT ticketP, ticketN, et FROM rou WHERE routeN = ?", (i,))
    for ticketP , ticketN, et in cur:
        tp = ticketP
        tn = ticketN
        eta = et
    print(tp)
    print(tn)
    print(eta)
    con.commit()
    data = str(i-1) + 'P' + str(tp) + 'N' + str(tn) + "E" + str(eta)
    print(data)
    clientsocket.send(bytes(data,"utf-8"))
    clientsocket2.send(bytes(data,"utf-8"))
    time.sleep(1)
    i = i + 1
