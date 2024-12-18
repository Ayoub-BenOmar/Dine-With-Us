
CREATE DATABASE IF NOT EXISTS reservation_restau;
USE reservation_restau;

CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone INT(14) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS menus (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    nom_menu VARCHAR(100) NOT NULL,
    description TEXT
);
CREATE TABLE IF NOT EXISTS plats (
    id_plat INT AUTO_INCREMENT PRIMARY KEY,
    nom_plat VARCHAR(100) NOT NULL,
    pic MEDIUMBLOB NOT NULL,
    ingredients TEXT,
    id_menu INT,
    FOREIGN KEY (id_menu) REFERENCES menus(id_menu) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_menu INT  NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_hour TIME NOT NULL,
    nb_personnes INT NOT NULL,
    statut ENUM('en attente', 'approuve', 'refuse') DEFAULT 'en attente',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_menu) REFERENCES menus(id_menu) ON DELETE CASCADE
);
