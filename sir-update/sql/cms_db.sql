create database if not exists cms;
use cms;
drop table if exists cms_courses;
create table cms_courses(
   id int(10) primary key auto_increment,
   title varchar(50) not null,
   price float,
   user_id int(10)
);

insert into cms_courses(title,price,user_id)values('Web development with PHP',15000,1);
insert into cms_courses(title,price,user_id)values('Android Application Development',12000,1);
insert into cms_courses(title,price,user_id)values('ASP.NET Application Development',20000,2);

drop table if exists cms_students;
create table cms_students(
id int(10) primary key auto_increment,
name varchar(20) not null,
mobile varchar(15),
email varchar(20),
created_at timestamp
);

insert into cms_students(name,mobile,email)values('Rana Miah','01777664786','miahmudrana21@gmail.com');
insert into cms_students(name,mobile,email)values('Md Azizul Islam','01738040305','azizul65689@gmail.com');

drop table if exists cms_admission;
create table cms_admission(
id int(10) primary key auto_increment,
student_id int(10),
course_id int(10),
created_at timestamp
);

insert into cms_admission(student_id,course_id)values(1,1);
insert into cms_admission(student_id,course_id)values(2,1);
insert into cms_admission(student_id,course_id)values(1,2);

drop table if exists cms_payment;
create table cms_payment(
  id int(10) primary key auto_increment,
  student_id int(10),
  amount float,
  discount float,
  created_at timestamp,
  remark varchar(20),
  method varchar(20)
);

insert into cms_payment(student_id,amount,discount,remark,method)values(1,10000,5000,'Txs344333','BKash');
insert into cms_payment(student_id,amount,discount,remark,method)values(2,15000,0,'Txs334533','Cash');


drop table if exists cms_roles;
create table cms_roles(
  id int(10) primary key auto_increment,
  name varchar(20) not null
);

insert into cms_roles(name)values('Admin');
insert into cms_roles(name)values('Editor');
insert into cms_roles(name)values('Member');

drop table if exists cms_users;
create table cms_users(
  id int(10) primary key auto_increment,
  username varchar(20) not null,
  role_id int(10),
  password varchar(50),
  inactive tinyint(1) default 0
);

insert into cms_users(username,password,role_id)values('jahid',md5('111111'),1);
insert into cms_users(username,password,role_id)values('yasin',md5('222222'),2);