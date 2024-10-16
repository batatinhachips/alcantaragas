create database banco_alcantara_gas;
use banco_alcantara_gas;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255),
    papel ENUM('admin', 'usuario') DEFAULT 'usuario',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cpf varchar (11),
    telefone varchar (11),
    cep varchar(10),
    logradouro varchar(255),
    complemento varchar(50),
    numero varchar(10),
    bairro varchar(100),
    cidade varchar(100)
);

select*from usuario;
DESCRIBE usuario;

create table produtos (
	id int not null auto_increment,
	nome varchar(45)not null,
	descricao varchar(90) not null,
	imagem varchar (80) not null,
	preco decimal (10,2) not null,
primary key (id));

INSERT INTO usuario (nome, email, senha, papel)
VALUES ('Fernando', 'alcantara@gmail.com', '$2y$10$kuTQRlHGgNLGzVzDRhmz7uZMSFCsBUaGT8wYdK5cBHRuBipJCm3uy', 'admin');
-- Atualizar o papel do usuário para 'admin'
UPDATE usuario SET papel = 'admin' WHERE email = 'alcantara@gmail.com';
-- Selecionar todos os usuários e seus papéis

create table vendas (
    id int auto_increment primary key,
    data_venda datetime not null,
    cliente_id int not null,
    produto varchar(100) not null,
    quantidade decimal(10, 2) not null,
    preco_unitario decimal(10, 2) not null,
    total decimal(10, 2) GENERATED ALWAYS AS (quantidade * preco_unitario) STORED,
    forma_pagamento ENUM('Dinheiro', 'Cartão de Crédito', 'Cartão de Débito', 'PIX') not null,
    observacoes TEXT,
    foreign key (cliente_id) REFERENCES usuario(id_usuario)
);


