create database if not exists fitagenda
character set utf8mb4
collate utf8mb4_general_ci;

use fitagenda;

create table if not exists agendamentos(
    id int auto_increment primary key,
    nome_aluno varchar(100) not null,
    atividade varchar(100) not null,
    data_aula date not null,
    horario time not null,
    status enum('agendado', 'concluido', 'cancelado')
     not null default 'agendado'
);