CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  rm VARCHAR(10) NOT NULL,
  senha VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT email_formato CHECK (email LIKE '%_@__%.__%'),
  CONSTRAINT rm_tamanho CHECK (LENGTH(rm) = 5),
  CONSTRAINT senha_formato CHECK (senha REGEXP '^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[A-Za-z0-9!@#$%^&*()_+]{8,}$')
);

CREATE TABLE estagios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    assunto VARCHAR(255) NOT NULL,
    requisitos VARCHAR(255) NOT NULL,
    carga_horaria INT(11) NOT NULL,
    principais_atividades TEXT NOT NULL,
    salario VARCHAR(50) DEFAULT NULL,
    data_validade DATE NOT NULL,
    PRIMARY KEY (id)
);
