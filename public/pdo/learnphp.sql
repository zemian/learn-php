-- Category table for learn-php/pdo demos
select * from category;
select * from category where parent_id is not null;

-- Test table
drop table if exists datatype;
create table datatype (
    id int primary key auto_increment,
    created_dt timestamp default current_timestamp,
    modified_dt datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    name varchar(100),
    comment text,
    birth_date date,
    start_time time,
    count int,
    point double,
    amount decimal(12, 2)
);
-- test it
insert into datatype(name, comment, modified_dt, birth_date, start_time, count, point, amount)
values('sample', 'test', '2021-01-01 23:00:01', '1959-01-31', '08:00:00', 99, 3.14, 130000.00);
insert into datatype(name) values('test');
select * from datatype;

-- MySQL DATETIME Learning
show variables like '%time_zone%';
select now();
select * from datatype;
insert into datatype(name, modified_dt) values('NOW()', NOW());
insert into datatype(name, modified_dt) values('CURRENT_TIMESTAMP()', CURRENT_TIMESTAMP());
insert into datatype(name, modified_dt) values('ds string', '2021-12-31 08:00:01');

-- default value
-- What happen if user manually update "modified_dt" ?
create table defvalue (
    id int primary key auto_increment,
    created_dt timestamp default current_timestamp,
    modified_dt datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    name varchar(100) default 'test-name',
    comment text default 'test-comment',
    birth_date date,
    start_time time,
    count int,
    point double,
    amount decimal(12, 2)
);