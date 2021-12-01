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
drop table if exists linha;
drop table if exists adm;
drop table if exists usuario;

create table usuario (
	id int not null auto_increment,
    primary key (id),
	email varchar(30) not null,
	nome varchar(40) not null,
	senha varchar(16) not null,
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
    id_linha int not null,
    key fk_passagem_id_linha(id_linha),
    constraint fk_passagem_id_linha foreign key (id_linha) references linha (id),
    id_cliente int not null,
    key fk_passagem_id_cliente(id_cliente),
    constraint fk_passagem_id_cliente foreign key (id_cliente) references cliente (id),
    ativo boolean not null,
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
('Joao Samuel','991951780','123','joaosvbg@gmail.com','1','0'),
('Maria','99344780','123','maria@gmail.com','2','0'),
('Jose','99346660','123','jose@gmail.com','3','1'),
('Marcos','99756660','123','marcos@gmail.com','4','2'),
('Isabela','93426660','123','isa@gmail.com','5','2');

insert into adm
(id_usuario,admMaster)
values
('4','1'),
('5','0');

insert into cliente
(id_usuario)
values
('1'),
('2');

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
('Feira de Santana','Salvador','40.0','Direta',null,'29','1'),
('Feira de Santana','Ilheus','44.0','Direta',null,'28','1'),
('Salvador','Feira de Santana','36.0','Comum','1','25','2'),
('Feira de Santana','Riachão do Jacuipe','36.0','Comum','2','25','2'),
('Riachão do Jacuipe','Capim Grosso','40.0','Comum','2','25','2'),
('Capim Grosso','Jacobina','35.0','Comum','2','25','2'),
('Feira de Santana','Salvador','50.0','Direta',null,'24','1'),
('Salvador','Camaçari','65.0','Direta',null,'30','1');

insert into agenda
(dia_semana, hora, id_linha)
values
('Segunda-Feira', '15:00', '1'),
('Quarta-Feira', '10:00', '2'),
('Quinta-Feira', '07:00', '3'),
('Sábado', '13:00', '1'),
('Domingo', '19:00', '8'),
('Quinta-Feira', '05:00', '4');

insert into passagem
(id_cliente,id_linha,ativo,diaVenda)
values
('1','1','1','2021-05-10'),
('1','2','0','2021-05-10'),
('2','1','0','2021-05-10'),
('2','2','1','2021-05-10');
