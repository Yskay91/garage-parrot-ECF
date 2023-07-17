-- Ajout de données dans la base de données garage_parrot
USE garage_parrot;

-- *************************************************************************
-- Insertion dans la table modele
INSERT INTO brand (name)
 VALUES
 ('Audi'),
 ('Alpha Romeo'),
 ('Aston Martin'),
 ('BMW'),
 ('Bugatti'),
 ('Chevrolet'),
 ('Chrysler'),
 ('Citroën'),
 ('Cupra'),
 ('Dacia'),
 ('Daihatsu'),
 ('Dodge'),
 ('DS'),
 ('Ferrari'),
 ('Fiat'),
 ('Ford'),
 ('GMC'),
 ('Honda'),
 ('Hummer'),
 ('Hyundai'),
 ('Infiniti'),
 ('Isuzu'),
 ('Jaguar'),
 ('Jeep'),
 ('Kia'),
 ('Koenigsegg'),
 ('Lamborghini'),
 ('Lancia'),
 ('Land Rover'),
 ('Lexus'),
 ('Lotus'),
 ('Maserati'),
 ('Mazda'),
 ('Mclaren'),
 ('Mercedes'),
 ('MG Motor'),
 ('Mini'),
 ('Mitsubishi'),
 ('Nissan'),
 ('Opel'),
 ('Peugeot'),
 ('Porsche'),
 ('Renault'),
 ('Rolls Royce'),
 ('Saab'),
 ('Seat'),
 ('Shelby'),
 ('Skoda'),
 ('Smart'),
 ('Ssangyong'),
 ('Subaru'),
 ('Suzuki'),
 ('Tesla'),
 ('Toyota'),
 ('Volkswagen'),
 ('Volvo');


-- *************************************************************************
-- Insertion dans la table horaire
INSERT INTO hours (dayWeek, morningOpenHours, morningCloseHours, afternoonOpenHours, afternoonCloseHours, is_open) 
VALUES
  ('lundi', '08:45', '12:00', '14:00', '18:00', true),
  ('mardi', '08:45', '12:00', '14:00', '18:00', true),
  ('mercredi', '08:45', '12:00', '14:00', '18:00', true),
  ('jeudi', '08:45', '12:00', '14:00', '18:00', true),
  ('vendredi', '08:45', '12:00', '14:00', '18:00', true),
  ('samedi', '08:45', '12:00', NULL, NULL, true),
  ('dimanche', NULL, NULL, NULL, NULL, false);


-- *************************************************************************
-- Insertion dans la table caractéristique
INSERT INTO features (name) 
VALUES
  ('Puissance fiscale'),
  ('Cylindrée'),
  ('Transmission'),
  ('Carburant'),
  ('Nombre de cylindre'),
  ('Catégorie'),
  ('Nombre de portes'),
  ('Capacité du coffre'),
  ('Climatisation'),
  ('Ecran de bord');


-- *************************************************************************
-- Insertion dans la table utilisateur
INSERT INTO user (name, firstName, email, role, password) 
VALUES
  ('Parrot', 'Vincent', 'vincent@garage-parrot.fr', ["ROLE_ADMIN"], 'test23'),
  ('Eisele', 'jessica', 'jessica@garage-parrot.fr', ["ROLE_EMPLOYE"], 'password23');


-- *************************************************************************
-- Insertion dans la table voiture
INSERT INTO car (model, price, kilometre, year, image, id_brand, id_user) 
VALUES
  ('Leon', 23999, 28000, 2017, NULL, 46, 1),
  ('Ibiza', 10499, 87000, 2016, NULL, 46, 1),
  ('CX-5', 21199, 87000, 2016, NULL, 33, 1),
  ('Sandero', 4500, 125000, 2014, NULL, 10, 2);


-- *************************************************************************
-- Insertion dans la table utilisateur
INSERT INTO car_features (id_car, id_features, value) 
VALUES 
(2, 4, "Diesel"),
(1, 7, "5 portes"),
(4, 7, "5 portes"),
(1, 2, "2.0l"),
(1, 3, "automatique"),
(2, 3, "manuel"),
(3, 3, "manuel"),
(1, 5, "4"),
(1, 6, "compact"),
(2, 7, "3 portes"),
(2, 8, "280l"),
(2, 9, "oui"),
(3, 9, "oui"),
(2, 10, "oui"),
(1, 1, "14"), /*CV*/
(1, 4, "Essence");


-- *************************************************************************
-- Modifier champ reference
  UPDATE car SET reference = CONCAT('REF-0', id) WHERE id = id ;




