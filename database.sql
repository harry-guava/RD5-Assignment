create database member default character set utf8;

use member;

create table mem
(
    `memberId` int auto_increment not NULL primary key,
    `muse` varchar(30) NOT NULL,
    `paswd` varchar(30) NOT NULL,
    `username` varchar(30) NOT NULL,
    `money` int NOT NULL default 0,
    `iden` varchar(15)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table moneylist
(
     memberId int not NULL,
     move varchar (30) not NULL,
     usemoney varchar (30) NOT NULL,
     money int NOT NULL,
     date timestamp NULL default NULL
);


insert into mem (muse,paswd,username,`money`,iden) values
('banana1234','1234','老王',1000,'T124123456'),('apple1234','3456','小明',500,'T224123456');

insert into moneylist(`memberId`,`move`,`usemoney`,`money`,`date`) values
(1,'存款','+1000 元',1000,current_timestamp()),(2,'存款','+500 元',500,current_timestamp());





