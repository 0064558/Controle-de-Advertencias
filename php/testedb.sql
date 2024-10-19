CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45),
    email VARCHAR(255) UNIQUE,
    senha VARCHAR(255),
    admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS membros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255),
    cargo VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS notificacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT,
    categoria ENUM('baixa', 'media', 'alta'),
    descricao TEXT,
    FOREIGN KEY (membro_id) REFERENCES membros(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS advertencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT,
    quantidade INT DEFAULT 0,
    FOREIGN KEY (membro_id) REFERENCES membros(id) ON DELETE CASCADE
);

