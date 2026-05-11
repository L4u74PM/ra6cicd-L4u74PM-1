CREATE TABLE IF NOT EXISTS tasques (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  feta TINYINT(1) DEFAULT 0
);

INSERT INTO tasques (nom, feta) VALUES
  ('Fer la pràctica de DAWe', 0),
  ('Estudiar per a l\'examen', 0),
  ('Entregar el projecte', 1);
