/*create database if not exists News_website;*/
use News_website;
create table tb_user(
			user_id int(4) not null primary key auto_increment,
            username varchar(20),
            email varchar(50),
			password varchar(200),
			active tinyint(1) default 1
			);

create table tb_company(
			company_id int(4) not null primary key auto_increment,
            name varchar(20),
            email varchar(50),
            phone varchar(50),
            active tinyint(1) default 1
            );
            
create table tb_category(
			category_id int(4) not null primary key auto_increment,
            name varchar(20),
            time timestamp,
            active tinyint default 1
            );

create table tb_news (
			news_id decimal(11,0) not null primary key,
            user_id int(4),
            category_id int(4),
			title varchar(50),
			short_decription varchar(50),
			feartur_image varchar(50),
			create_at timestamp,
            foreign key (user_id) references tb_user(user_id) on delete cascade,
			foreign key (category_id) references tb_category(category_id) on delete cascade
            );
            
            
/*Select who is create news*/ 
select u.username, c.name, n.title, n.short_description, n.description, n.feartur_image, n.create_at 
from tb_user u join tb_category c join tb_news n
on u.user_id = n.user_id and c.category_id = n.category_id;

