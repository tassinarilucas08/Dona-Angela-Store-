CREATE DATABASE IF NOT EXISTS angela_store;
USE angela_store;

CREATE TABLE IF NOT EXISTS users_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255) NOT NULL,
    number VARCHAR(255) NOT NULL,
    complement VARCHAR(255),
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip_code VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUserCategory INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address_id INT,
    FOREIGN KEY (idUserCategory)
        REFERENCES users_categories(id),
    FOREIGN KEY (address_id)
        REFERENCES address(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gender VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender_id INT,
    FOREIGN KEY (gender_id)
        REFERENCES genders(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DOUBLE NOT NULL,
    image INT,
    quantity INT NOT NULL,
    status VARCHAR(255),
    gender_id INT,
    category_id INT,
    FOREIGN KEY (gender_id)
		REFERENCES genders(id),
    FOREIGN KEY (category_id)
		REFERENCES products_categories(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    stars INT NOT NULL,
    comment LONGTEXT,
    FOREIGN KEY (user_id)
        REFERENCES users(id),
    FOREIGN KEY (product_id)
        REFERENCES products(id)
) ENGINE=InnoDB;

<<<<<<< HEAD
CREATE TABLE IF NOT EXISTS questions_categories (
=======
CREATE TABLE IF NOT EXISTS question_categories (
>>>>>>> 289c93d4a67d61f733a1caab893790d17f948d5b
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCategory INT,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL,
    FOREIGN KEY (idCategory)
        REFERENCES questions_categories(id)
) ENGINE=InnoDB;