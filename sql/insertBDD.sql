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
INSERT INTO user (name, firstName, email, role, password) 
VALUES
  ('Parrot', 'Vincent', 'v.parrot@garage-parrot.fr', ["ROLE_ADMIN"], 'password'),
  ('Eisele', 'jessica', 'j.eisele@garage-parrot.fr', ["ROLE_EMPLOYE"], 'password');


-- *************************************************************************
-- Insertion dans la table voiture
INSERT INTO car (brand, model, features, price, kilometre, year) 
VALUES
  ('Seat', 'Leon', '5 portes, grand coffre de 350L, climatisation', 23999, 28000, 2017),
  ('Seat', '5 portes, grand coffre de 350L, climatisation', 'Ibiza', 10499, 87000, 2016),
  ('Mazda', '5 portes, climatisation, Puissance fiscale 5CV, Essence', 'CX-5', 21199, 87000, 2016),
  ('Dacia', '5 portes, climatisation, Diesel', 'Sandero', 4500, 125000, 2014);




