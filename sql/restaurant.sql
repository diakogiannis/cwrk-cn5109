drop table if exists reservations;
drop table if exists reservations_tables;
drop table if exists tables;
drop table if exists user_contact_details;
drop table if exists user_roles;
drop table if exists roles;
drop table if exists users_audit;
drop table if exists users;

create table config
(
    config_key    varchar(255) not null
        primary key,
    config_values varchar(255) not null,
    description   varchar(255) not null
);

create table holidays
(
    h_start  date not null comment 'μαζι με τη κολώνα h_end αποτελούν το κλειδί της καθε μοναδικης αργίας του έτους',
    h_finish date not null comment 'μαζι με τη κολώνα h_start αποτελούν το κλειδί της καθε μοναδικης αργίας του έτους',
    hid      int auto_increment
        primary key
);

create table reservations_tables
(
    reservations_id int not null,
    table_number    int not null,
    primary key (reservations_id, table_number)
);

create index reservations_tables_ibfk_1
    on reservations_tables (table_number);

create table roles
(
    role_id          varchar(255) not null
        primary key,
    role_description varchar(255) not null
);

create table tables
(
    table_number int auto_increment
        primary key,
    seats        int not null
);

create table users
(
    email    varchar(255) not null comment 'users email used for primary key as well'
        primary key,
    fname    varchar(255) not null comment 'first name',
    lname    varchar(255) not null comment 'last name',
    address  varchar(255) not null comment 'user address',
    city     varchar(255) not null,
    password varchar(255) not null
);

create table reservations
(
    id               int auto_increment
        primary key,
    email            varchar(255) not null,
    reservation_date datetime     not null,
    persons          int          null,
    fname            varchar(255) null,
    lname            varchar(255) null,
    phone            varchar(10)  null,
    constraint reservations_ibfk_1
        foreign key (email) references users (email)
);

create index email
    on reservations (email);

create table user_contact_details
(
    email varchar(255)               not null,
    type  varchar(255)               not null,
    value varchar(255)               not null,
    id    varchar(36) default uuid() not null
        primary key,
    constraint user_contact_details_ibfk_1
        foreign key (email) references users (email)
);

create index email
    on user_contact_details (email);

create table user_roles
(
    email   varchar(255) not null,
    role_id varchar(255) not null,
    primary key (email, role_id),
    constraint fk_uroles_rid
        foreign key (role_id) references roles (role_id)
            on update cascade on delete cascade,
    constraint user_roles_ibfk_1
        foreign key (email) references users (email)
);

create table users_audit
(
    id             bigint auto_increment
        primary key,
    email          varchar(255)                           not null,
    logged_in_date date       default current_timestamp() not null,
    is_logged_in   tinyint(1) default 0                   not null,
    constraint users_audit_ibfk_1
        foreign key (email) references users (email)
);

create index email
    on users_audit (email);

create index logged_in_date
    on users_audit (logged_in_date);

-- Dummy Data Creation

insert into roles (role_id,role_description) VALUES ('CLIENT','CLIENT ROLES');
insert into roles (role_id,role_description) VALUES ('ADMIN','ADMIN ROLES');

insert into users (email, fname, lname, address, city, password) VALUES ('admin@admin.local','Admin Fname','Admin lname','My Adress','My City','1234');
insert into user_roles (email, role_id) VALUES ('admin@admin.local','ADMIN');

insert into users (email, fname, lname, address, city, password) VALUES ('client@default.local','Fill','Fill','Fill','Fill','1234');
insert into user_roles (email, role_id) VALUES ('client@default.local','CLIENT');

insert into user_contact_details (email, type, value) VALUES ('client@default.local','PHONE','2100000000');

insert into user_contact_details (email, type, value) VALUES ('admin@admin.local','PHONE','2100000000');
insert into config (config_key, config_values, description) VALUES ('starttime','12:00', 'restaurant start time');
insert into config (config_key, config_values, description) VALUES ('endtime','23:30', 'restaurant end time');
insert into holidays (h_start, h_finish) VALUES ('2019-05-16','2019-07-16');

insert into tables (seats) VALUES (4,1);
insert into tables (seats) VALUES (4,1);
insert into tables (seats) VALUES (4,0);

insert into config (config_key, config_values, description) VALUES ('reshrs','2', 'table reservation period in hours');

insert into reservations (email, reservation_date,persons) values ('client@default.local','2019-06-02',4);
insert into reservations_tables (reservations_id, table_number) VALUES (1,1);

