    
    CREATE DATABASE "apimentesnotaveis";

    use apimentesnotaveis;

    CREATE TABLE enderecos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Estado CHAR(2),
        Cidade VARCHAR(60),
        Rua VARCHAR(60),
        Usuario_Cpf VARCHAR(11),
        FOREIGN KEY (Usuario_Cpf) REFERENCES usuarios(Cpf)
        ON UPDATE CASCADE
        ON DELETE CASCADE
    );


    CREATE TABLE usuarios (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(20),
        Sobrenome VARCHAR(30),
        Data_Nascimento Date,
        Cpf VARCHAR(11),
        UNIQUE(Cpf)
    );