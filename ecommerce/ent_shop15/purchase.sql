use ent_shop;
drop table if exists ent_vendor;
create table ent_vendor(
    id int(11) primary key auto_increment,
    name varchar(30) not null,
    phone int(15),
    address varchar(50)
);
insert into ent_vendor(name,phone,address)values('Akmol Hossain',01738040301,'West Rajabazar 48/i');
insert into ent_vendor(name,phone,address)values('Rasel Hossain',0173804019,'Mirpur-10');
insert into ent_vendor(name,phone,address)values('Ridoy Khan',01738040309,'Shymoli ');
insert into ent_vendor(name,phone,address)values('Ariful Islam',0162934541,'Middle Baddah');
insert into ent_vendor(name,phone,address)values('Akmol Hossain',01738040301,'West Rajabazar 48/i');
drop table if exists ent_purchase;
create table ent_purchase(
    id int(11) primary key auto_increment,
    vendor_id int(11),
    ref_no varchar(20),
    purchase_date date,
    due_date date
);
insert into ent_purchase(vendor_id,ref_no,purchase_date,due_date)values(1,'ent-01','2020-11-01','2020-11-01');
insert into ent_purchase(vendor_id,ref_no,purchase_date,due_date)values(2,'ent-02','2020-11-01','2020-11-01');
insert into ent_purchase(vendor_id,ref_no,purchase_date,due_date)values(3,'ent-11','2020-11-01','2020-11-01');
insert into ent_purchase(vendor_id,ref_no,purchase_date,due_date)values(4,'ent-21','2020-11-01','2020-11-01');
drop table if exists ent_purchaseDetails;
create table ent_purchaseDetails(
    id int(11) primary key auto_increment,
    purchase_id int(11),
    product_id int(11),
    Qty float,
    cost float
);
insert into ent_purchaseDetails(purchase_id,product_id,Qty,cost)values(1,1,10,300);
insert into ent_purchaseDetails(purchase_id,product_id,Qty,cost)values(2,2,15,200);
insert into ent_purchaseDetails(purchase_id,product_id,Qty,cost)values(2,2,5,200);
insert into ent_purchaseDetails(purchase_id,product_id,Qty,cost)values(3,3,5,40000);
drop table if exists ent_uom;
create table ent_uom(
    id int(11) primary key auto_increment,
    name varchar(15)
);
insert into ent_uom(name)values('Pice');
insert into ent_uom(name)values('Kg');
insert into ent_uom(name)values('Li');


select p.name,v.name as vendor_name,v.address,v.phone,pu.purchase_date,pu.due_date,pu.ref_no,pd.Qty,pd.cost from ent_products p,ent_vendor v,ent_purchase pu,ent_purchasedetails pd where pd.product_id=p.id and pd.purchase_id=pu.id and pu.vendor_id=v.id and pd.purchase_id=10