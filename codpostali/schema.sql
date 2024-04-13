
CREATE TABLE comuni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    provincia VARCHAR(255) NOT NULL,
    cap VARCHAR(10) NOT NULL
);


INSERT INTO comuni (provincia, cap) VALUES
('Roma', '00100'),
('Milano', '20121'),
('Napoli', '80100'),
('Torino', '10100'),
('Palermo', '90100'),
('Bologna', '40121'),
('Firenze', '50121'),
('Genova', '16121'),
('Bari', '70121'),
('Catania', '95121'),
('Venezia', '30121'),
('Verona', '37121'),
('Trieste', '34121'),
('Cagliari', '09121'),
('Matera', '75100'),
('Lecce', '73100'),
('Perugia', '06121'),
('Potenza', '85100'),
('Ancona', '60121'),
('Campobasso', '86100'),
('Aosta', '11100'),
('Trento', '38121'),
('Bolzano', '39100'),
('Pescara', '65121'),
('Ravenna', '48121'),
('Sassari', '07100'),
('Foggia', '71121'),
('Reggio Calabria', '89121');
