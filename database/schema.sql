CREATE TABLE enderecos
(
   cep varchar(12) PRIMARY KEY auto_increment,
   bairro varchar(100),
   cidade varchar(50) not null,
   estado varchar(50) not null
) ENGINE=InnoDB;

CREATE TABLE anunciante
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(200) not null,
   cpf varchar(20) not null,
   email varchar(150) not null,
   telefone varchar(50) not null,
   password_hash varchar(255) not null
) ENGINE=InnoDB;

CREATE TABLE categoria
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(150) not null,
   descricao varchar(500) not null
) ENGINE=InnoDB;

CREATE TABLE anuncio
(
   codigo int PRIMARY KEY auto_increment,
   titulo varchar(150) not null,
   descricao varchar(500) not null,
   preco decimal(15,2) not null,
   data_hora DATE not null,
   cep varchar(20) not null,
   bairro varchar(100) not null,
   cidade varchar(50) not null,
   estado varchar(50) not null,
   cod_categoria int not null,
   cod_anunciante int not null,
   FOREIGN KEY (cod_categoria) REFERENCES categoria(codigo) ON DELETE CASCADE,
   FOREIGN KEY (cod_anunciante) REFERENCES anunciante(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE foto
(
   codigo_anuncio int not null,
   nome_arq_foto varchar(255) not null,
   FOREIGN KEY (codigo_anuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE interesse
(
   codigo int PRIMARY KEY auto_increment,
   codigo_anuncio int not null,
   mensagem varchar(300) not null,
   data_hora DATE not null,
   contato varchar(50) not null,
   FOREIGN KEY (codigo_anuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;


-- INSERTS CATEGORIA
INSERT INTO `categoria` (nome,descricao)
VALUES ("Veículo","Veículo de transporte de pessoas ou carga.");

INSERT INTO `categoria` (nome,descricao)
VALUES ("Eletroeletrônico","Pode ser uma Geladeira, um Frezer, Fogão, Cafeteira, Celular, etc.");

INSERT INTO `categoria` (nome,descricao)
VALUES ("Imóvel","Pode ser um terreno, casa, chácara, etc.");

INSERT INTO `categoria` (nome,descricao)
VALUES ("Móvel","Pode ser uma cadeira, mesa, cama, etc.");

INSERT INTO `categoria` (nome,descricao)
VALUES ("Vestuário","É qualquer objeto usado para cobrir partes do corpo.");

INSERT INTO `categoria` (nome,descricao)
VALUES ("Outro","Qualquer objeto que não se encaixa nas outras categorias.");

-- INSERTS CATEGORIA
INSERT INTO `enderecos` (cep, bairro, cidade, estado)
VALUES ("38410-607", "Granada", "Uberlândia", "MG");

INSERT INTO `enderecos` (cep, bairro, cidade, estado)
VALUES ("38440-218", "Centro", "Araguari", "MG");
