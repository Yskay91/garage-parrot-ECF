-- Création de la base de données garage_parrot

create DATABASE IF NOT EXISTS garage_parrot;

USE garage_parrot;

-- Création de la table voiture

CREATE TABLE
    IF NOT EXISTS car (
        id INT AUTO_INCREMENT,
        brand VARCHAR(100) NOT NULL,
        model VARCHAR(100) NOT NULL,
        features VARCHAR(255) NOT NULL,
        price DOUBLE NOT NULL,
        kilometre INT NOT NULL,
        year INT NOT NULL,
        created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
        id_brand INT NOT NULL,
        id_user INT NOT NULL,
        reference VARCHAR(100),
        PRIMARY KEY(id)
    );

-- Création de la table images

CREATE TABLE
    IF NOT EXISTS images (
        id INT AUTO_INCREMENT NOT NULL,
        car_id INT NOT NULL,
        image_name VARCHAR(255) DEFAULT NULL,
        updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
        created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
        FOREIGN KEY (car_id) REFERENCES car(id),
        PRIMARY KEY(id)
    );

-- Création de la table utilisateur

CREATE TABLE
    IF NOT EXISTS user (
        id INT AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        first_name varchar(100) NOT NULL,
        email varchar(180) NOT NULL,
        roles LONGTEXT NOT NULL COMMENT '(DC2Type:json)',
        password varchar(255) NOT NULL,
        PRIMARY KEY(id),
        UNIQUE (email)
    );

-- Création de la table message

CREATE TABLE
    IF NOT EXISTS garage (
        id INT AUTO_INCREMENT NOT NULL,
        name VARCHAR(100) NOT NULL,
        adresse VARCHAR(255) NOT NULL,
        zip_code VARCHAR(10) NOT NULL,
        city VARCHAR(255) NOT NULL,
        phone VARCHAR(100) NOT NULL,
        mail VARCHAR(100) NOT NULL,
        PRIMARY KEY(id)
    );

-- Création de la table message

CREATE TABLE
    IF NOT EXISTS message (
        id INT AUTO_INCREMENT,
        name_customer VARCHAR(100) NOT NULL,
        first_name_customer VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        telephone VARCHAR(20) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        car_id INT DEFAULT NULL,
        createdAt date NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(car_id) REFERENCES cars(id)
    );

-- Création de la table avis

CREATE TABLE
    IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT,
        user_id INT DEFAULT NULL,
        name VARCHAR(100) NOT NULL,
        comment LONGTEXT NOT NULL,
        notes INT NOT NULL,
        is_approved TINYINT(1) NOT NULL,
        garage_id INT DEFAULT NULL,
        createdAt DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
        PRIMARY KEY(id),
        FOREIGN KEY (user_id) REFERENCES user(id),
        FOREIGN KEY (garage_id) REFERENCES garage(id)
    );

-- Création de la table services

CREATE TABLE
    IF NOT EXISTS services (
        id INT AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description LONGTEXT NOT NULL,
        is_actif TINYINT(1) NOT NULL,
        price DOUBLE,
        category VARCHAR(100) NOT NULL,
        PRIMARY KEY(id)
    );

-- Création de la table horaire

CREATE TABLE
    IF NOT EXISTS hours (
        id INT AUTO_INCREMENT,
        dayWeek VARCHAR(20) NOT NULL,
        morningOpenHours VARCHAR(2),
        morningCloseHours VARCHAR(20),
        afternoonOpenHours VARCHAR(20),
        afternoonCloseHours VARCHAR(20),
        PRIMARY KEY(id)
    );

ENGINE=InnoDB DEFAULT CHARSET=utf8;