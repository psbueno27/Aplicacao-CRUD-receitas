CREATE DATABASE IF NOT EXISTS `Receitas`;

USE `Receitas`;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS proteina (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pratos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    preparo VARCHAR(255) NOT NULL,
    tempo VARCHAR(255) NOT NULL,
    proteina_id INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (proteina_id) REFERENCES proteina(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir dados de exemplo na tabela proteinas
INSERT INTO `proteina` (`nome`) VALUES
('Glúten'),
('Carboidratos');

-- Inserir dados de exemplo na tabela pratos
INSERT INTO `pratos` (`nome`, `preparo`, `tempo`, `proteina_id`) VALUES
('Espaguete', 'Adicione água e deixe ferver por 5-10 minutos, depois adicione a massa e ferva ela até ficar mole. Por último, escorra ela e adicione o molho a gosto', '20-30 minutos', 1),
('Cachorro-Quente', 'Corte dois tomates, metade de uma cebola, cozinhe numa panela com azeite de oliva até formar um molho, corte as salsichas em tiras e cozinhe junto.','15-30 minutos' , 2),
('Miojo', 'Ferva a água em uma panela, coloque o miojo e deixe ferver até ficar mole. Após isso, adicione qualquer ingrediente que queira para acompanhar. Por último, escorra ele e adicione o tempero a gosto.','5 minutos' , 1)




