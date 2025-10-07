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
    photo VARCHAR(512) NULL,
    isConfirmed TINYINT(1) DEFAULT 0,
    confirmation_token VARCHAR(512) NULL,
    FOREIGN KEY (idUserCategory)
        REFERENCES users_categories(id)
) ENGINE=InnoDB;

CREATE TABLE store (
  id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idUser INT(11) NOT NULL,
  name VARCHAR(255) NOT NULL,
  cpf CHAR(14) NOT NULL,
  logo VARCHAR(512) NULL,
  instagram VARCHAR(512) NULL,
  FOREIGN KEY (idUser) 
        REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    zipCode VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    number VARCHAR(255) NOT NULL,
    complement VARCHAR(255),
    neighborhood VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    FOREIGN KEY (idUser)
        REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS products_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idGender INT,
    description VARCHAR(255) NOT NULL,
    FOREIGN KEY (idGender)
        REFERENCES genders(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCategory INT,
    idBrand INT,
    idStatus INT,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    salePrice FLOAT NOT NULL,
    description TEXT NOT NULL,
    photo VARCHAR(512) NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (idCategory)
		REFERENCES products_categories(id),
    FOREIGN KEY (idBrand)
        REFERENCES brands(id),
    FOREIGN KEY (idStatus)
        REFERENCES products_status(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS photos_products (
	id INT AUTO_INCREMENT PRIMARY KEY,
    idProduct INT NOT NULL,
    photo VARCHAR(512) NOT NULL,
    FOREIGN KEY (idProduct)
        REFERENCES products(id)
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
    total FLOAT NOT NULL,
    FOREIGN KEY (idUser)
        REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS purchasesProducts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idPurchase INT,
    idProduct INT,
    quantity INT NOT NULL,
    value FLOAT NOT NULL,
    FOREIGN KEY (idPurchase)
        REFERENCES purchases(id),
    FOREIGN KEY (idProduct)
        REFERENCES products(id)
) ENGINE=InnoDB;