CREATE TABLE usuario (
    usuCodigo SERIAL NOT NULL PRIMARY KEY,
    usuMail VARCHAR (200) NOT NULL,
    usuSenha VARCHAR (100) NOT NULL,
    usuNome VARCHAR (200) NOT NULL,
    usuDateCad TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuStatus CHAR(1),
    usuTipo CHAR(1)
);