# Made by: Mason Hadley
# Contributions: Miguel Velasco Espinosa
# Final Code
# Makes a UI for the signage systemt hat updates whenever it recieves new information
# Future Update will consist of making the text Yellow.
#
#
#

import tkinter
import customtkinter as ctk
import socket
import time

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect(('169.254.37.17',2000))


#######################################################################
disp = ctk.CTk()
disp.geometry("1600x800")
disp.title("CTk example")
frame = ctk.CTkFrame(master=disp, width=200, height=200)

train_list = [] # [0-3PxxxxNxxExxxx]
time_list = [] # [xPxxxxNxxE##(:)##]
tickets_list = [] # [xPxxxxN##Exxxx]
prices_list = [] # [xP($)##(.)##NxxExxxx]
Update_list = [] # single string sets [#P####N##E####]

# Will eventually call the Server and initialize the starter variables
for iteration in range(4):
        time_list.append(tkinter.StringVar(value='[No Data] '))
        tickets_list.append(tkinter.IntVar(value = 0))
        prices_list.append(tkinter.StringVar(value='  $0.00'))
        train_list.append('Train' + str(iteration+1) + ' -- ETA: ')
                
#To be put on an update timer with the server (Server will send datapackets with this info)
def Updater():
    if len(Update_list) != 0:
        temp = Update_list.pop() # Pop next queue item
        p = int(temp[temp.find('P')+1:temp.find('N')]) #process string into separate parts
        n = int(temp[temp.find('N')+1:temp.find('E')])
        e = str(temp[temp.find('E')+1:])

        price = "$"+str(p/100) # Convert all of the data into proper formatting
        ticket_num = n
        eta_time = str(e[:-2] + ":" + e[-2:])
        
        # set all of the reformatted values into the UI
        tickets_list[int(temp[0])].set(ticket_num)
        time_list[int(temp[0])].set(eta_time)
        prices_list[int(temp[0])].set(price)
        
def SocketRecv():
    msg = s.recv(1024) # Adds the recieved data to the queue [Update_list]
    Update_list.append(str(msg.decode("utf-8")))
    msg = 0

ctk.set_appearance_mode("dark")

for entry in range(len(time_list)): # Dynamically creates each datarow in the UI
    ctk.CTkLabel(disp, text=train_list[entry],font=('Arial',50,'bold')).grid(column=0, row=entry)
    ctk.CTkLabel(disp, text=' -- Seat Tickets: ',font=('Arial',50,'bold')).grid(column=2, row=entry)
    ctk.CTkLabel(disp, text=' Price: ',font=('Arial',50,'bold')).grid(column=4, row=entry)
    ctk.CTkLabel(disp, textvariable=time_list[entry],font=('Arial',50,'bold')).grid(column=1, row=entry)
    ctk.CTkLabel(disp, textvariable=tickets_list[entry],font=('Arial',50,'bold')).grid(column=3, row=entry)
    ctk.CTkLabel(disp, textvariable=prices_list[entry],font=('Arial',50,'bold')).grid(column=5, row=entry)
    
while(True): # Recieve Data --> Update Data-tables --> Update Display Accordingly
    SocketRecv() 
    Updater()
    disp.update_idletasks()
    disp.update()
