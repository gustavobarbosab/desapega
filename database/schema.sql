CREATE TABLE anunciante
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(150) not null,
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
   FOREIGN KEY (cod_categoria) REFERENCES categoria(codigo) ON DELETE CASCADE
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
