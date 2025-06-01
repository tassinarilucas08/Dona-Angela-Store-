CREATE DATABASE IF NOT EXISTS angela_store;
USE angela_store;

CREATE TABLE IF NOT EXISTS users_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUserCategory INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR (255),
    token VARCHAR (1024),
    FOREIGN KEY (idUserCategory)
        REFERENCES users_categories(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    zipCode VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    number VARCHAR(255) NOT NULL,
    complement VARCHAR(255),
    state VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    FOREIGN KEY (idUser)
        REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    idGender INT,
    FOREIGN KEY (idGender)
        REFERENCES genders(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCategory INT,
    name VARCHAR(255) NOT NULL,
    price DOUBLE NOT NULL,
    description TEXT NOT NULL,
    photo INT,
    quantity INT NOT NULL,
    status VARCHAR(255),
    idGender INT,
    FOREIGN KEY (idCategory)
		REFERENCES products_categories(id),
    FOREIGN KEY (idGender)
		REFERENCES genders(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    idProduct INT,
    stars INT NOT NULL,
    comment LONGTEXT,
    FOREIGN KEY (idUser)
        REFERENCES users(id),
    FOREIGN KEY (idProduct)
        REFERENCES products(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS questions_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCategoryQuestion INT,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL,
    FOREIGN KEY (idCategoryQuestion)
        REFERENCES questions_categories(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    date DATE,
    total DOUBLE NOT NULL,
    FOREIGN KEY (idUser)
        REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS purchasesProducts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idPurchase INT,
    idProduct INT,
    quantity INT NOT NULL,
    value DOUBLE NOT NULL,
    FOREIGN KEY (idPurchase)
        REFERENCES purchases(id),
    FOREIGN KEY (idProduct)
        REFERENCES products(id)
) ENGINE=InnoDB;