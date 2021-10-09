use ent_shop;

drop table if exists ent_roles;
create table ent_roles(
	id int(11) primary key auto_increment,
	name varchar(25) not null
);
insert into ent_roles(name)values('Admin');
insert into ent_roles(name)values('Editor');
insert into ent_roles(name)values('Modaretor');
insert into ent_roles(name)values('User');

drop table if exists ent_users;
create table ent_users(
	id int(11) primary key auto_increment,
	name varchar(25) not null unique,
	photo varchar(25),
	role_id int(10) default 4,
	password varchar(50),
    active_status tinyint(1) default 0

);
insert into ent_users(name,photo,role_id,password,active_status)values('azizul','1.jpeg',1,md5('111'),0);
insert into ent_users(name,photo,role_id,password,active_status)values('rana','2.jpeg',2,md5('222'),0);
insert into ent_users(name,photo,role_id,password,active_status)values('rasel','3.jpeg',3,md5('333'),0);


drop table if exists ent_products;
create table ent_products(
	id int(12) primary key auto_increment,
	name varchar(100) not null,
	price float not null,
	old_price float,
	code varchar(50),
	quantity float,
	short_desc varchar(1000),
	photo varchar(100),
	user_id int(11),
	category_id int(11),
	manufacturer varchar(50),
	review varchar(100),
	update_date timestamp
	
);

insert into ent_products(name,price,old_price,code,quantity,short_desc,photo,user_id,category_id,manufacturer,review)values('Keyboard',500,500,'C-01',10,'Black key board','1.jpeg',2,1,'A4-Tech','This is Good condition');
insert into ent_products(name,price,old_price,code,quantity,short_desc,photo,user_id,category_id,manufacturer,review)values('Mouse',400,400,'C-02',15,'Black mouse','2.jpeg',2,1,'A4-Tech','This is Good condition');
insert into ent_products(name,price,old_price,code,quantity,short_desc,photo,user_id,category_id,manufacturer,review)values('Lenovo G40-70',50000,50000,'C-03',5,'This is a intake laptop','3.jpeg',1,2,'Lenovo','This is Good condition');
insert into ent_products(name,price,old_price,code,quantity,short_desc,photo,user_id,category_id,manufacturer,review)values('Matherboard',4000,5000,'C-04',5,'Gigabyte matherboard','4.jpeg',2,1,'Gigabyte','This is Good condition');
insert into ent_products(name,price,old_price,code,quantity,short_desc,photo,user_id,category_id,manufacturer,review)values('Keyboard',500,600,'C-01',10,'Black key board','1.jpeg',2,1,'A4-Tech','This is Good condition');

drop table if exists ent_categories;
create table ent_categories(
	id int(11) primary key auto_increment,
	category_name varchar(50)
);
insert into ent_categories(category_name)values('Mobile Phones');
insert into ent_categories(category_name)values('Accessories');
insert into ent_categories(category_name)values('Computer & Laptop');
insert into ent_categories(category_name)values('Electronics & Home Appliances');
insert into ent_categories(category_name)values('Kitchen Appliances');
insert into ent_categories(category_name)values('Smart Products');
insert into ent_categories(category_name)values('Fashion Accessories');


select p.id,p.name,pu.purchase_date,v.name,pd.cost,pd.Qty from ent_products p,ent_vendor v,ent_purchase pu,ent_purchasedetails pd where pd.purchase_id=pu.id and pd.product_id=p.id and p.id=1;