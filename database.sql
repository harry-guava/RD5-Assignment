create database member default character set utf8;

use member;

create table mem
(
    `memberId` int auto_increment not NULL primary key,
    `muse` varchar(15) NOT NULL,
    `paswd` varchar(15) NOT NULL,
    `username` varchar(30) NOT NULL,
    `money` int NOT NULL default 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table moneylist
(
     memberId int auto_increment not NULL primary key,
    `change` varchar (30) not NULL,
     date timestamp NULL default NULL
);


insert into mem (muse,paswd,username,money) values
('banana','1234','老王',1000),('apple','3456','小明',500);

insert into moneylist(`change`,`date`) values
('+1000',current_timestamp()),('+500',current_timestamp());





