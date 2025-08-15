
CREATE DATABASE padaria;
USE padaria;


CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL, 
    email VARCHAR(100) UNIQUE NOT NULL,
    senha_hash VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    data_contratacao DATE NOT NULL
);


CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);


CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL, 
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT NOT NULL,
    id_categoria INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);


CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20)
);


CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
);


CREATE TABLE pedido_itens (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos (id_pedido),
    FOREIGN KEY (id_produto) REFERENCES produtos (id_produto)
);


INSERT INTO usuarios (nome, email, senha_hash, telefone, data_contratacao) VALUES
('Admin', 'admin@padaria.com', 'hash_senha_aqui', '11999999999', '2025-01-01');

INSERT INTO categorias (nome) VALUES
('Pães'),
('Doces');

INSERT INTO produtos (nome, descricao, preco, quantidade_estoque, id_categoria, id_usuario) VALUES
('Pão Francês', 'Pão crocante e fresquinho', 0.50, 100, 1, 1),
('Sonho Recheado', 'Doce macio com recheio de creme', 3.00, 50, 2, 1);

INSERT INTO clientes (nome, email, telefone) VALUES
('João Silva', 'joao@email.com', '11988887777'),
('Maria Oliveira', 'maria@email.com', '11877776666');
