use ent_shop;

drop table if exists ent_customer;
create table ent_customer(
    id int(10) primary key auto_increment,
    name varchar(20) not null,
    email varchar(25),
    phone int(15),
    address varchar(100)
);
insert into ent_customer(name,email,phone,address)values('Nahid Khan','nahid@gmail.com',01738040304,"Rajsahi,Pabna,Dopkula");
insert into ent_customer(name,email,phone,address)values('Palash Rahaman','palash@gmail.com',01738030204,"Dhaka,Mirpur");
insert into ent_customer(name,email,phone,address)values('Ariful Islam','arif@gmail.com',01638040304,"Dhaka,Badda");
insert into ent_customer(name,email,phone,address)values('Ridoy Khan','ridoy@gmail.com',0163993304,"Symoli,Dhaka");


drop table if exists ent_salse;
create table ent_salse(
    id int(10) primary key auto_increment,
    customer_id int(10),
    created_at timestamp
);
drop table if exists ent_salse_details;
create table ent_salse_details(
    id int(10) primary key auto_increment,
    salse_id int(10),
    product_id int(10),
    qty float,
    price float
);
select s.id,p.name,cu.name as customer,s.created_at,sd.qty,sd.price from ent_products p,ent_salse s,ent_customer cu,ent_salse_details sd where sd.product_id=p.id and s.customer_id=cu.id and sd.salse_id=s.id and sd.salse_id=1;
select s.id,p.name,cu.name as customer,s.created_at,sd.qty,sd.price from ent_products p,ent_salse s,ent_customer cu,ent_salse_details sd where sd.product_id=p.id and s.customer_id=cu.id and sd.salse_id=s.id