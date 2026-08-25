CREATE DATABASE concessionaria;
USE concessionaria;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE proprietarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    ano INT NOT NULL,
    placa VARCHAR(10) NOT NULL,
    proprietario_id INT NOT NULL,
    
    CONSTRAINT fk_proprietario
    FOREIGN KEY (proprietario_id)
    REFERENCES proprietarios(id)
);

INSERT INTO proprietarios
(nome, telefone, email)
VALUES
('Carlos Silva','41999999999','carlos@gmail.com'),
('Ana Souza','41988888888','ana@gmail.com');

INSERT INTO veiculos
(modelo, marca, ano, placa, proprietario_id)
VALUES
('Civic','Honda',2022,'ABC1D23',1),
('Corolla','Toyota',2023,'XYZ4E56',1),
('Gol','Volkswagen',2020,'QWE7R89',2);

SELECT * FROM proprietarios;
SELECT * FROM veiculos;

SELECT
    v.id,
    v.modelo,
    v.marca,
    v.ano,
    v.placa,
    p.nome AS proprietario
FROM veiculos v
INNER JOIN proprietarios p
ON p.id = v.proprietario_id;
SELECT * FROM usuarios;