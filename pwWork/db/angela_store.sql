CREATE DATABASE IF NOT EXISTS angela_store;
USE angela_store;

CREATE TABLE IF NOT EXISTS users_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idType INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address_id INT,
    FOREIGN KEY (idType)
        REFERENCES users_categories(id)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    street VARCHAR(255) NOT NULL,
    number VARCHAR(255) NOT NULL,
    complement VARCHAR(255),
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip_code VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS seller (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address_id INT,
    FOREIGN KEY (address_id)
		REFERENCES address(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gender VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS product_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender_id INT,
    FOREIGN KEY (gender_id)
        REFERENCES genders(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DOUBLE NOT NULL,
    image INT,
    quantity INT NOT NULL,
    status VARCHAR(255),
    gender_id INT,
    category_id INT,
    FOREIGN KEY (seller_id)
		REFERENCES seller(id),
    FOREIGN KEY (gender_id)
		REFERENCES product_gender(id),
    FOREIGN KEY (category_id)
		REFERENCES product_categories(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS question_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCategory INT,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL,
    FOREIGN KEY (idCategory)
        REFERENCES question_categories(id)
) ENGINE=InnoDB;