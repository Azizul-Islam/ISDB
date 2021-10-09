drop database if not exists cms;

use cms;
drop table if exists cms_courses;
create table cms_courses(
    id int(10) primary key auto_increment,
    title varchar(50),
    user_id int(10),
    price float
);
insert into cms_courses(title,price,user_id)values('Web application development',10000,1);
insert into cms_courses(title,price,user_id)values('web design',8000,2);
insert into cms_courses(title,price,user_id)values('Java programming',20000,3);

drop table if exists cms_roles;
create table cms_roles(
    id int(10) primary key auto_increment,
    name varchar(50) not null
);
insert into cms_roles(name)values('Admin');
insert into cms_roles(name)values('Writter');
insert into cms_roles(name)values('Member');
drop table if exists cms_users;
create table cms_users(
    id int(10) primary key auto_increment,
    username varchar(50) not null,
    role_id int(10),
    password varchar(50) not null
);
insert into cms_users(username,password,role_id)values('Azizul Islam',md5('12345'),1);
insert into cms_users(username,password,role_id)values('Rasel Mia',md5('4578'),2);
insert into cms_users(username,password,role_id)values('Sohag',md5('34567'),3);

drop table if exists cms_students;
create table cms_students(
	id int(10) primary key auto_increment,
	name varchar(25) not null,
	phone varchar(25),
	email varchar(25),
	created_at timestamp
);
insert into cms_students(name,phone,email)values("Rana Mia","0177112233","mahamudrana@gmail.com");
insert into cms_students(name,phone,email)values("Azizul islam","01738040305","azizul656589@gmail.com");
drop table if exists cms_admission;
create table cms_admission(
	id int(10) primary key auto_increment,
	student_id int(10),
	course_id int(10),
	created_at timestamp
);
insert into cms_admission(student_id,course_id)values(1,1);
insert into cms_admission(student_id,course_id)values(2,1);
insert into cms_admission(student_id,course_id)values(1,3);

drop table if exists cms_payment;
create table cms_payment(
	id int(10) primary key auto_increment,
	student_id int(10),
	amount float,
	discount float,
	remark varchar(20),
	method varchar(20),
	created_at timestamp
);
insert into cms_payment(student_id,amount,discount,remark,method)values(1,10000,0,"tax0004","Bkash");
insert into cms_payment(student_id,amount,discount,remark,method)values(2,8000,0,"tax0005","Bkash");
insert into cms_payment(student_id,amount,discount,remark,method)values(1,18000,3000,"tax0006","Bkash");