CREATE DATABASE padaria;
use padaria;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY
    nome VARCHAR(100) NOT NULL, 
    email VARCHAR(100) UNIQUE NOT NULL,
    senha_hash VARCHAR (255) NOT NULL,
    telefone VARCHAR (20),
    data_contratacao DATE NOT NULL
)
CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY
)