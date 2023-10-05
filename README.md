# Train-Ticket-System Project Description
Design and build a digital signage system. 
wall-mounted TVs and monitors.  
connected to a main server system acting as the repository 
Must automatically update as needed in the system
use a SBC to drive the display if you choose.

# Group Plan
Our plan is to use this signage system to create a ticketing and station tracking system for an entire train network.
Keep track of tickets sold and passenger seats for each train
Track the current station of each train in the system
Give estimate ETA times for each train

#Report Explanation
Signage system that will update and track data and be able to communicate with hardware within the network. The signage system will work as a train system tracking tickets, time of arrivals, and availability such as delays or cancels. The system will need to use various hardware and software to be able to communicate with each other and display information to the user. The hardware used is an AML-5905X libre ,otherwise known as Le Potato, which is a single board computer that will be used to display and run the programs the user can buy tickets with. The screens used will be LG-M3202C LCD displays and for backups there are two LN37A550P3F Samsung TVs. The Libre will run Raspbian OS and will be the main architecture with the UI setup and running a web page. The UI will be made using Custom Tkinter for more customizability. The Libre will connect to a server switch and run its own private network where they will be able to communicate and update the screens at the same time while keeping track of ticket sales and times. The website is made to buy tickets. The project will use hardware and software to construct a connected system of displays and kiosks for a train system
