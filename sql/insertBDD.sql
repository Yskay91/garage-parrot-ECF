-- Ajout de données dans la base de données garage_parrot
USE garage_parrot;

-- *************************************************************************
-- Insertion dans la table horaire
INSERT INTO hours (dayWeek, morningOpenHours, morningCloseHours, afternoonOpenHours, afternoonCloseHours) 
VALUES
  ('Lundi', '08:45', '12:00', '14:00', '18:00'),
  ('Mardi', '08:45', '12:00', '14:00', '18:00'),
  ('Mercredi', '08:45', '12:00', '14:00', '18:00'),
  ('Jeudi', '08:45', '12:00', '14:00', '18:00'),
  ('Vendredi', '08:45', '12:00', '14:00', '18:00'),
  ('Samedi', '08:45', '12:00', 'Fermé', 'Fermé'),
  ('dimanche', 'Fermé', 'Fermé', 'Fermé', 'Fermé');


-- *************************************************************************
-- Insertion dans la table utilisateur
INSERT INTO user (name, first_name, email, role, password) 
VALUES
  ('Parrot', 'Vincent', 'v.parrot@garage-parrot.fr', ["ROLE_ADMIN"], 'password'),
  ('Eisele', 'jessica', 'j.eisele@garage-parrot.fr', ["ROLE_EMPLOYE"], 'password');


-- *************************************************************************
-- Insertion dans la table voiture
INSERT INTO cars (brand, model, features, price, kilometre, year, created_at) 
VALUES
  ('Seat', 'Leon', '5 portes, grand coffre de 350L, climatisation', 23999, 28000, 2017, NOW()),
  ('Seat', 'Ibiza', '5 portes, grand coffre de 350L, climatisation', 10499, 87000, 2016, NOW()),
  ('Mazda', '3', '5 portes, climatisation, Puissance fiscale 5CV, Essence', 21199, 87000, 2016, NOW()),
  ('Ford', 'Mustang', 'Sièges cuir, Connectivité Bluetooth', 25000.00, 30000, 2019, NOW()),
  ('Dacia', 'Sandero', '5 portes, climatisation, Diesel', 4500, 125000, 2014, NOW());



-- Insertion de données dans la table images

INSERT INTO images (car_id, image_name, updated_at, created_at)
VALUES (1, 'Seatleon.png', NOW(), NOW()),
       (2, 'SeatIbiza.jpg', NOW(), NOW()),
       (3, 'Mazda3.jpg', NOW(), NOW()),
       (4, 'FordMustang.jpg', NOW(), NOW()),
       (5, 'Dacia.jpg', NOW(), NOW());

-- Insertion de données dans la table garage

INSERT INTO garage (name, adresse, zip_code, city, phone, mail)
VALUES ('Parrot Garage', 'Avenue d\'Aix-les-Bains', '74600', 'Annecy', '04.50.00.00', 'v.parrot@parrot-garage.fr');

-- Insertion de données dans la table message

INSERT INTO message (name_customer, first_name_customer, email, telephone, subject, message, car_id, createdAt)
VALUES ('Doe', 'John', 'johndoe@example.com', '06.55.56.00.00', 'Demande de devis', 'Bonjour, Je voudrais installé un crochet d attelage, Pouvez-vous me dire le prix pour l installation sur une seat leon 3. Cordialement, John Doe', 1, NOW());

-- Insertion de données dans la table reviews

INSERT INTO reviews (user_id, name, comment, notes, is_approved, garage_id, createdAt)
VALUES (1, 'John Doe', 'Très bon service', 5, 1, 1, NOW()),
       (2, 'Jane Smith', 'Employés très sympa, mais délai un peu long', 4, 1, 1, NOW());

-- Insertion de données dans la table services

INSERT INTO services (name, description, is_actif, price, category)
VALUES ('Entretien de la carrosserie', 'Un impact ? Une rayure ? N\'attendez plus et venez le faire réparer chez nous. ça préviendra la rouille et autre problème.', 1, 50.00, 'Carrosserie'),
       ('Entretien des freins', 'Vérifier le système de freinage et remplacer les plaquettes de frein usées', 1, 80.00, 'Mécanique');

-- Insertion de données dans la table hours




