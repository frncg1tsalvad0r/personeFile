drop database if exists persone;
create database persone;
use persone;

create table utenti (
    id int auto_increment,
    nome varchar(50) not null,
    foto varchar(255),
    primary key(id)
);

insert utenti (id, nome, foto) value (1, 'Mario', "img/1_foto.jpg");