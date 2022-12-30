drop table if exists services;
drop table if exists appointment;
drop table if exists work;
drop table if exists employee;
drop table if exists schedule;

create table services(
id integer primary key autoincrement, 
name text not null, 
gender text not null check (gender in ('male', 'female')), 
duration text not null check (duration is strftime('%H:%M:%S', duration)), 
price integer not null check (price >= 0)
);

create table appointment(
id integer primary key autoincrement, 
employee_id text not null,
service_id integer not null, 
date text not null check (date is strftime('%Y-%m-%d', date)), 
time text not null check (time is strftime('%H:%M:%S', time)), 
done text not null check (done in ('yes', 'no')) default ('no'), 
foreign key (employee_id) references employee(id) on delete restrict on update cascade
foreign key (service_id) references services(id) on delete restrict on update cascade
);

create table employee(
id integer primary key autoincrement, 
name text not null, surname text not null, 
specialization text not null check (specialization in ('male', 'female')), 
percent real not null check ((percent >= 0) and (percent <= 100)), 
status text not null check (status in ('works', 'dismissed')) default ('works')
);

create table schedule(
employee_id integer not null, 
date text not null check (date is strftime('%Y-%m-%d', date)), 
begin_time text not null check (begin_time is strftime('%H:%M:%S', begin_time)), 
end_time text not null check ((end_time is strftime('%H:%M:%S', end_time)) and (begin_time < end_time)), 
primary key (employee_id, date) 
foreign key (employee_id) references employee(id) on delete restrict on update cascade
);

PRAGMA foreign_keys=on;

insert into employee ('name', 'surname', 'specialization', 'percent' ) values  
('Olga', 'Ivanova', 'male', '30'), 
('Kamala', 'Harris', 'female', '40');

insert into services ('name', 'gender', 'duration', 'price') values 
('bald haircut', 'male', time('00:30:00'), '100'),
('half-box haircut', 'male', time('00:30:00'), '200'),
('men haircut', 'male', time('00:40:00'), '300'),
('hair coloring', 'female', time('00:50:00'), '1000'),
('women haircut', 'female', time('01:00:00'), '500');

insert into schedule ('employee_id', 'date', 'begin_time', 'end_time') values  
('1', date('2022-11-26'), time('12:00:00'), time('17:00:00')),
('2', date('2022-11-28'), time('09:30:00'), time('15:00:00')),
('1', date('2022-11-30'), time('10:00:00'), time('19:00:00'));

insert into appointment ('employee_id', 'service_id', 'date', 'time') values 
('1', '5', '2021-11-13', time('14:30:00')),
('2', '1', '2021-11-13', time('12:00:00')),
('1', '2', '2021-11-13', time('11:00:00')),
('2', '3', '2021-11-13', time('13:50:00'));