create database if not exists  organizador_symfony;

use organizador_symfony;

create table if not exists usuers (
    id          int(255) auto_increment not null,
    role        varchar(50),
    name        varchar(100),
    surname     varchar(100),
    email       varchar(100),
    password    varchar(255),
    created_at  datetime,
    CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDb;

create table if not exists tasks (
    id          int(255) auto_increment not null,
    user_id     int(255) not null,
    title       varchar(100),
    content     text,    
    priority    varchar(50),
    hours       int(100),
    created_at  datetime,
    CONSTRAINT pk_tasks PRIMARY KEY (id),
    CONSTRAINT fk_tasks_users FOREIGN KEY (user_id) REFERENCES usuers(id)
)ENGINE=InnoDb;