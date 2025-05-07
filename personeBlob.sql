drop database if exists personeBLOB;
create database personeBLOB;
use personeBLOB;

create table utenti (
    id int auto_increment,
    nome varchar(50) not null,
    foto BLOB,
    primary key(id)
);

