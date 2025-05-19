CREATE DATABASE IF NOT EXISTS angela_store;
USE angela_store;

CREATE TABLE IF NOT EXISTS address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(80) NOT NULL,
    number INT NOT NULL,
    complement VARCHAR(60),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    zip_code VARCHAR(20) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS seller (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(120) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address_id INT,
    FOREIGN KEY (address_id)
		REFERENCES address(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(120) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address_id INT,
    FOREIGN KEY (address_id)
		REFERENCES address(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    name VARCHAR(60) NOT NULL,
    description TEXT NOT NULL,
    price DOUBLE NOT NULL,
    image INT,
    quantity INT NOT NULL,
    status VARCHAR(20),
    FOREIGN KEY (seller_id)
		REFERENCES seller(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS shopBasket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NULL,
    total DOUBLE,
    FOREIGN KEY (client_id)
		REFERENCES client(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS shopBasket_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    basket_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DOUBLE NOT NULL,
    FOREIGN KEY (basket_id)
		REFERENCES shopBasket(id)
        ON DELETE CASCADE,
	FOREIGN KEY (product_id)
		REFERENCES product(id)
) ENGINE=InnoDB;
delete "angela_store";