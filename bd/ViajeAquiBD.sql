create database if not exists viajeaqui;
use viajeaqui;

drop table if exists relatorioFuncionario;
drop table if exists relatorioAdm;
drop table if exists relatorio;
drop table if exists passagem;
drop table if exists acesso;
drop table if exists cliente;
drop table if exists funcionario;
drop table if exists agenda;
drop table if exists viajem;
drop table if exists linha;
drop table if exists adm;
drop table if exists usuario;

create table usuario (
	id int not null auto_increment,
    primary key (id),
	email varchar(30) not null,
	nome varchar(40) not null,
	senha varchar(60) not null,
	celular varchar(12) not null,
	cpf varchar(11) not null,
    tipoUsuario int not null
);

create table funcionario (
	id int not null auto_increment,
    primary key (id),
    id_usuario int not null,
    key fk_funcionario_id_usuario(id_usuario),
    constraint fk_funcionario_id_usuario foreign key (id_usuario) references usuario (id)
);

create table adm (
	id int not null auto_increment,
    primary key (id),
    id_usuario int not null,
    key fk_adm_id_usuario(id_usuario),
    constraint fk_adm_id_usuario foreign key (id_usuario) references usuario (id),
    admMaster boolean not null
);

create table cliente (
	id int not null auto_increment,
    primary key (id),
    id_usuario int not null,
    key fk_cliente_id_usuario(id_usuario),
    constraint fk_cliente_id_usuario foreign key (id_usuario) references usuario (id)
);

create table acesso (
	id int not null auto_increment,
    primary key (id),
    id_cliente int not null,
    key fk_acesso_id_cliente(id_cliente),
    constraint fk_acesso_id_cliente foreign key (id_cliente) references cliente (id),
	dataAcesso datetime default current_timestamp
);

create table linha (
	id int not null auto_increment,
    primary key (id),
    preco float not null,
    tipoLinha varchar(6) not null,
    quantidadePassagem int not null default 29,
    origem varchar(30) not null,
    destino varchar(30) not null,
    num_linha int null,
    id_adm int not null,
    key fk_linha_id_adm(id_adm),
    constraint fk_linha_id_adm foreign key (id_adm) references adm (id)
);

create table viajem (
	id int not null auto_increment,
    primary key (id),
    quantidadePassagem int,
    dataViajem varchar(10) not null,
    horaViajem varchar(10),
    id_linha int not null,
    key fk_id_linhaVendendo(id_linha),
    constraint fk_id_linhaVendendo foreign key (id_linha) references linha (id)
);

create table agenda (
	id int not null auto_increment,
    primary key (id),
    dia_semana varchar (20),
    hora varchar (10),
    id_linha int not null,
    key fk_id_linha(id_linha),
    constraint fk_id_linha foreign key (id_linha) references linha (id)
);

create table passagem (
	id int not null auto_increment,
    primary key (id),
    id_funcionario int,
    key fk_passagem_id_funcionario(id_funcionario),
    constraint fk_passagem_id_funcionario foreign key (id_funcionario) references funcionario (id),
    id_viajem int not null,
    key fk_passagem_id_viajem(id_viajem),
    constraint fk_passagem_id_viajem foreign key (id_viajem) references viajem (id),
    id_cliente int,
    key fk_passagem_id_cliente(id_cliente),
    constraint fk_passagem_id_cliente foreign key (id_cliente) references cliente (id),
    origem varchar(30),
    destino varchar(30),
    preco float,
    tipoLinha varchar(6),
    diaVenda date not null
);

create table relatorio (
	id int not null auto_increment,
    primary key (id),
	descricao varchar(60) not null
);

create table relatorioFuncionario (
	id_relatorio int not null,
    key fk_relatorioFuncionario_id_relatorio(id_relatorio),
    constraint fk_relatorioFuncionario_id_relatorio foreign key (id_relatorio) references relatorio (id),
    id_funcionario int not null,
    key fk_relatorioFuncionario_id_funcionario(id_funcionario),
    constraint fk_relatorioFuncionario_id_funcionario foreign key (id_funcionario) references funcionario (id)
);

create table relatorioAdm (
	id_relatorio int not null,
    key fk_relatorioAdm_id_relatorio(id_relatorio),
    constraint fk_relatorioAdm_id_relatorio foreign key (id_relatorio) references relatorio (id),
    id_adm int not null,
    key fk_relatorioAdm_id_adm(id_adm),
    constraint fk_relatorioAdm_id_adm foreign key (id_adm) references adm (id)
);

insert into usuario
(nome,celular,senha,email,cpf,tipoUsuario)
values
('Mateus','991951780','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','joaosvbg@gmail.com','40274881560','0'),
('Milaide','99344780','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','maria@gmail.com','40648611590','0'),
('Tartarek','99346660','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','jose@gmail.com','36558438526','1'),
('Tamera','99756660','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','marcos@gmail.com','80759477540','2'),
('Tito','93426660','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','isa@gmail.com','69938577580','2');

insert into adm
(id_usuario,admMaster)
values
('4','1'),
('5','0');

insert into cliente
(id_usuario)
values
('1'),
('2'),
('3'),
('4'),
('5');

insert into funcionario
(id_usuario)
values
('3');

insert into acesso
(dataAcesso,id_cliente)
values
('2021-10-15 13:50:00', '1'),
('2021-10-15 14:50:00', '2');

insert into linha
(origem,destino,preco,tipoLinha,num_linha,quantidadePassagem,id_adm)
values
('Feira de Santana','Salvador','40.0','Direta',null,'28','1'),
('Feira de Santana','Ilheus','44.0','Direta',null,'28','1'),
('Salvador','Feira de Santana','36.0','Comum','1','28','2'),
('Feira de Santana','Riachão do Jacuipe','36.0','Comum','2','28','2'),
('Riachão do Jacuipe','Capim Grosso','40.0','Comum','2','28','2'),
('Capim Grosso','Jacobina','35.0','Comum','2','28','2'),
('Feira de Santana','Salvador','50.0','Direta',null,'28','1'),
('Salvador','Camaçari','65.0','Direta',null,'28','1');

insert into viajem
(dataViajem, horaViajem, id_linha, quantidadePassagem)
values
('2021-12-04','19:00','8','28'),
('2021-12-06','15:00','1','28'),
('2021-12-08','10:00','2','28'),
('2021-12-09','07:00','7','28');

insert into agenda
(dia_semana, hora, id_linha)
values
('segunda-feira', '15:00', '1'),
('quarta-feira', '10:00', '1'),
('quinta-feira', '07:00', '7'),
('sábado', '13:00', '1'),
('domingo', '19:00', '8'),
('quinta-feira', '05:00', '4');

insert into passagem
(id_funcionario,id_cliente,id_viajem,diaVenda,origem,destino,preco,tipoLinha)
values
('1','1','1','2021-12-04','Salvador','Camaçari','65.0','Direta'),
('1','1','2','2021-12-04','Feira de Santana','Salvador','40.0','Direta'),
('1','2','1','2021-12-04','Salvador','Camaçari','65.0','Direta'),
('1','2','2','2021-12-04','Feira de Santana','Salvador','40.0','Direta');
