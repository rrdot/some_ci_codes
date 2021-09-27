db name: vsms_db


CREATE TABLE users(
user_id INT AUTO_INCREMENT PRIMARY KEY,
usertype enum('admin', 'user') default 'user',
username VARCHAR(50),
fname VARCHAR(50),
lname VARCHAR(50),
password VARCHAR(50)
);

CREATE TABLE patients(
patient_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50),
address VARCHAR(50),
diagnosis VARCHAR(50),
monitoring_id int,
FOREIGN KEY (monitoring_id) REFERENCES monitoring(monitoring_id)
);

CREATE TABLE rooms(
room_id INT AUTO_INCREMENT PRIMARY KEY,
room int,
r_availability enum('Available', 'Occupied') default 'Available'
);

CREATE TABLE devices(
device_id INT AUTO_INCREMENT PRIMARY KEY,
device VARCHAR(50),
d_availability enum('Available', 'Used') default 'Available',
d_status enum('ON', 'OFF') default 'OFF'
);


CREATE TABLE monitoring(
    monitoring_id int AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    device_id int,
    room_id int,
    vs_id int,
    intrvl int default '4',
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (device_id) REFERENCES devices(device_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id),
    FOREIGN KEY (vs_id) REFERENCES vitalsigns(vs_id)
);

create table vitalsigns(
vs_id int AUTO_INCREMENT PRIMARY KEY,
o2_sat DECIMAL(5,2),
pulse_rate DECIMAL(5,2),
temperature DECIMAL(5,2),
datetime timestamp,
int monitoring_id,
FOREIGN KEY (monitoring_id) REFERENCES monitoring(monitoring_id)
);