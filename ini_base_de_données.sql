-- Création de la base de données
CREATE DATABASE zoo_arcadia;
USE zoo_arcadia;

-- Table utilisateur
CREATE TABLE utilisateur (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(60),
    nom VARCHAR(50),
    prenom VARCHAR(50)
);

-- Table role
CREATE TABLE role (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50)
);

-- Table service
CREATE TABLE service (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    description VARCHAR(50)
);

-- Table habitat
CREATE TABLE habitat (
    habitat_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    description VARCHAR(100),
    commentaire_habitat VARCHAR(50)
);

-- Table race
CREATE TABLE race (
    race_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50)
);

-- Table animal
CREATE TABLE animal (
    animal_id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50),
    etat VARCHAR(50),
    race_id INT,
    habitat_id INT,
    FOREIGN KEY (race_id) REFERENCES race(race_id),
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id)
);

-- Table rapport_veterinaire
CREATE TABLE rapport_veterinaire (
    rapport_veterinaire_id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT,
    date DATE,
    detail VARCHAR(50),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id)
);

-- Table avis
CREATE TABLE avis (
    avis_id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50),
    commentaire VARCHAR(255),
    invisible BOOL
);

-- Table image (pour associer des images aux habitats et animaux)
CREATE TABLE image (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    image_data BLOB
);

-- Insertion des rôles
INSERT INTO role (label) VALUES ('admin'), ('employe'), ('veterinaire');

-- Insertion des utilisateurs
INSERT INTO utilisateur (username, password, nom, prenom) 
VALUES 
('admin', 'hashed_password', 'Admin', 'User'),
('veterinaire1', 'hashed_password', 'Jean', 'Vet'),
('employe1', 'hashed_password', 'Pierre', 'Emp');

-- Insertion des services
INSERT INTO service (nom, description) 
VALUES 
('Visite guidée', 'Visite des habitats avec un guide'),
('Restauration', 'Restaurant du zoo'),
('Petit train', 'Petit train pour faire le tour du zoo');

-- Insertion des habitats
INSERT INTO habitat (nom, description, commentaire_habitat) 
VALUES 
('Savane', 'Grandes plaines africaines', 'Bien entretenu'),
('Jungle', 'Forêts tropicales', 'En bon état');

-- Insertion des races
INSERT INTO race (libelle) 
VALUES ('Lion'), ('Éléphant'), ('Tigre');

-- Insertion des animaux
INSERT INTO animal (prenom, etat, race_id, habitat_id) 
VALUES 
('Simba', 'En bonne santé', 1, 1), 
('Dumbo', 'Besoin de soins', 2, 1),
('Rajah', 'En bonne santé', 3, 2);

-- Insertion des rapports vétérinaires
INSERT INTO rapport_veterinaire (animal_id, date, detail) 
VALUES 
(1, '2024-09-18', 'Bon état général'),
(2, '2024-09-17', 'A besoin de plus de nourriture');

-- Insertion des avis
INSERT INTO avis (pseudo, commentaire, invisible) 
VALUES 
('Visiteur1', 'Superbe visite, les animaux sont magnifiques', 0),
('Visiteur2', 'Le zoo est très propre, mais manque un peu d’animation', 0);

-- 1. Relation entre utilisateur et role
ALTER TABLE utilisateur
ADD COLUMN role_id INT,  
ADD CONSTRAINT fk_utilisateur_role
FOREIGN KEY (role_id) REFERENCES role(role_id)
ON DELETE SET NULL ON UPDATE CASCADE; 

-- 2. Relation entre utilisateur et rapport_veterinaire
ALTER TABLE rapport_veterinaire
ADD COLUMN username VARCHAR(50),  
ADD CONSTRAINT fk_rapport_utilisateur
FOREIGN KEY (username) REFERENCES utilisateur(username)
ON DELETE SET NULL ON UPDATE CASCADE; 

-- 3. Relation entre rapport_veterinaire et animal
ALTER TABLE rapport_veterinaire
ADD COLUMN animal_id INT,  
ADD CONSTRAINT fk_rapport_animal
FOREIGN KEY (animal_id) REFERENCES animal(animal_id)
ON DELETE CASCADE ON UPDATE CASCADE; 

-- 4. Relation entre animal et race
ALTER TABLE animal
ADD COLUMN race_id INT,  
ADD CONSTRAINT fk_animal_race
FOREIGN KEY (race_id) REFERENCES race(race_id)
ON DELETE SET NULL ON UPDATE CASCADE;  

-- 5. Relation entre animal et habitat
ALTER TABLE animal
ADD COLUMN habitat_id INT,  
ADD CONSTRAINT fk_animal_habitat
FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id)
ON DELETE SET NULL ON UPDATE CASCADE; 

-- 6. Relation entre habitat et image
ALTER TABLE image
ADD COLUMN habitat_id INT,  
ADD CONSTRAINT fk_image_habitat
FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id)
ON DELETE CASCADE ON UPDATE CASCADE; 




