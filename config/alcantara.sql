


DROP TABLE IF EXISTS nivelUsuarios;
CREATE TABLE nivelUsuarios (
  idNivelUsuario int NOT NULL AUTO_INCREMENT,
  nivel varchar(20) DEFAULT NULL COMMENT '{''Cliente '', ''Administrador''}',
  PRIMARY KEY (idNivelUsuario)
);
INSERT INTO nivelUsuarios VALUES (1,'Cliente'),(2,'Administrador');
select*from nivelUsuarios;

DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT,
    nome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255),
    idNivelUsuario int DEFAULT '1',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cpf VARCHAR(11),
    telefone VARCHAR(11),
    cep VARCHAR(8),
    logradouro VARCHAR(255),
    complemento VARCHAR(50),
    numero VARCHAR(10),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
	PRIMARY KEY (idUsuario),
  UNIQUE KEY email (email),
  KEY idNivelUsuario (idNivelUsuario),
  FOREIGN KEY (idNivelUsuario) REFERENCES nivelUsuarios (idNivelUsuario)
);
INSERT INTO usuario (nome, email, senha, idNivelUsuario)
VALUES ('Fernando', 'alcantara@gmail.com', '$2y$10$kuTQRlHGgNLGzVzDRhmz7uZMSFCsBUaGT8wYdK5cBHRuBipJCm3uy', '2');
-- Atualizar o papel do usuário para 'admin'
UPDATE usuario SET idNivelUsuario = '2' WHERE email = 'alcantara@gmail.com';
-- Selecionar todos os usuários e seus papéis
select*from usuario;
DESCRIBE usuario;

DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos (
	`idProduto` int not null auto_increment,
	nome varchar(45)not null,
	descricao varchar(90) not null,
	imagem varchar (80) not null,
	precoProduto decimal (10,2) not null,
PRIMARY KEY (idProduto)
  );
select*from produtos;

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
    `idPedido` int NOT NULL AUTO_INCREMENT,
    `idUsuario` int DEFAULT NULL,
    `idProduto` int DEFAULT NULL,
    cep varchar(10),
    rua varchar(255),
    numero varchar(10),
    bairro varchar(100),
    cidade varchar(100),
    produto varchar(100) not null,
    quantidade int(100) not null,
    preco decimal(10, 2) not null,
    total decimal(10, 2) GENERATED ALWAYS AS (quantidade * preco) STORED,
    formaPagamento ENUM('Dinheiro', 'Cartão de Crédito', 'Cartão de Débito', 'PIX') not null,
    total_produtos varchar(10000),
    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`idPedido`),
	 KEY `idUsuario` (`idUsuario`),
     FOREIGN KEY (`idUsuario`) REFERENCES usuario (`idUsuario`),
     FOREIGN KEY (`idProduto`) REFERENCES produtos (`idProduto`)
);

select*from pedidos;

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `idEstoque` int NOT NULL AUTO_INCREMENT,
  `idProduto` int DEFAULT NULL,
  produto varchar(100) not null,
  `quantidade` int DEFAULT '0',
  `qtdVendida` int DEFAULT NULL,
  PRIMARY KEY (`idEstoque`),
  KEY `idProduto` (`idProduto`),
  FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`)
);
select*from estoque;

