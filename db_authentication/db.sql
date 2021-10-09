use users;
drop table if exists users;
create table users(
	id int(10) primary key auto_increment,
	name varchar(25) not null,
	password varchar(50) not null
);
insert into users(name,password)values('azizul',md5('111'));
insert into users(name,password)values('rana',md5('222'));
insert into users(name,password)values('rasel',md5('333'));