<?php
include_once('functions.php');
$link = connect();
$ct = [
    'create table countries(
id int not null auto_increment primary key,
country varchar(64) unique
)default charset="utf8"',
    'create table cities(
id int not null auto_increment primary key,
city varchar(64),
countryid int,
foreign key(countryid) references countries(id)
on delete cascade,
ucity varchar(128),
unique index ucity(city, countryid))default
charset="utf8"',
    'create table hotels(
id int not null auto_increment primary key,
hotel varchar(64),
countryid int,
foreign key(countryid) references countries(id) on delete cascade,
cityid int,
foreign key(cityid) references cities(id) on delete cascade,
stars int not null,
cost float not null, 
info varchar(512) not null
)default charset="utf8"',
    'create table images(
id int not null auto_increment primary key,
hotelid int,
foreign key(hotelid) references hotels(id) on delete cascade,
imagePath varchar(64) not null
)default charset="utf8"',
    'create table roles(
id int not null auto_increment primary key,
role varchar(64)
)default charset="utf8"',
    'create table users(
id int not null auto_increment primary key,
login varchar(64) unique not null,
pass varchar(64) not null,
email varchar(64) not null,
roleid int, 
foreign key(roleid) references roles(id) on delete cascade,
discount int,
imagePath varchar(64) not null
)default charset="utf8"'
];

for ($i = 0; $i < 6; $i++) {
    mysqli_query($link, $ct[$i]);
    show_error(mysqli_errno($link), 'Error code 6:');
}
