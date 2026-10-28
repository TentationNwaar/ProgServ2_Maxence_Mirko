-- ============================================================
-- Fulltimed : Modèle Physique de Données (MySQL / MariaDB)
-- ============================================================
-- CREATE DATABASE IF NOT EXISTS fulltimed
--   CHARACTER SET utf8mb4
--   COLLATE utf8mb4_unicode_ci;
-- USE fulltimed;

CREATE TABLE pays (
  id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom       VARCHAR(100) NOT NULL,
  code_iso  CHAR(2)      NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (nom),
  UNIQUE (code_iso)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE role (
  id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom  VARCHAR(50)  NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (nom)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE type_equipe (
  id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom  VARCHAR(50)  NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (nom)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
 
 
CREATE TABLE utilisateur (
  id                 INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username           VARCHAR(50)  NOT NULL,
  email              VARCHAR(255) NOT NULL,
  mot_de_passe_hash  VARCHAR(255) NOT NULL,
  bio                TEXT         NULL,
  id_role            INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (username),
  UNIQUE (email),
  FOREIGN KEY (id_role) REFERENCES role (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE equipe (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom              VARCHAR(100) NOT NULL,
  logo             VARCHAR(255) NULL,
  id_pays          INT UNSIGNED NOT NULL,
  id_type_equipe   INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_pays)        REFERENCES pays (id),
  FOREIGN KEY (id_type_equipe) REFERENCES type_equipe (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE competition (
  id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom      VARCHAR(150) NOT NULL,
  id_pays  INT UNSIGNED NULL,
  PRIMARY KEY (id),
  UNIQUE (nom),
  FOREIGN KEY (id_pays) REFERENCES pays (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE matchs (
  id                    INT UNSIGNED NOT NULL AUTO_INCREMENT,
  date_heure            DATETIME     NOT NULL,
  description           TEXT         NULL,
  score_domicile        TINYINT UNSIGNED NULL,
  score_exterieur       TINYINT UNSIGNED NULL,
  id_equipe_domicile    INT UNSIGNED NOT NULL,
  id_equipe_exterieur   INT UNSIGNED NOT NULL,
  id_competition        INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_equipe_domicile)  REFERENCES equipe (id),
  FOREIGN KEY (id_equipe_exterieur) REFERENCES equipe (id),
  FOREIGN KEY (id_competition)      REFERENCES competition (id),
  CHECK (id_equipe_domicile <> id_equipe_exterieur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE avis (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  note            TINYINT UNSIGNED NOT NULL,
  commentaire     TEXT         NULL,
  `date`          DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_utilisateur  INT UNSIGNED NOT NULL,
  id_match        INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE,
  FOREIGN KEY (id_match)       REFERENCES matchs (id)      ON DELETE CASCADE,
  CHECK (note BETWEEN 0 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
 
CREATE TABLE like_avis (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_utilisateur  INT UNSIGNED NOT NULL,
  id_avis         INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (id_utilisateur, id_avis),
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE,
  FOREIGN KEY (id_avis)        REFERENCES avis (id)        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE a_regarder (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_utilisateur  INT UNSIGNED NOT NULL,
  id_match        INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (id_utilisateur, id_match),
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE,
  FOREIGN KEY (id_match)       REFERENCES matchs (id)      ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE favori (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_utilisateur  INT UNSIGNED NOT NULL,
  id_match        INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (id_utilisateur, id_match),
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE,
  FOREIGN KEY (id_match)       REFERENCES matchs (id)      ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE equipe_preferee (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_utilisateur  INT UNSIGNED NOT NULL,
  id_equipe       INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (id_utilisateur, id_equipe),
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE,
  FOREIGN KEY (id_equipe)      REFERENCES equipe (id)      ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
 
CREATE TABLE suit (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_suiveur  INT UNSIGNED NOT NULL,
  id_suivi    INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (id_suiveur, id_suivi),
  FOREIGN KEY (id_suiveur) REFERENCES utilisateur (id) ON DELETE CASCADE,
  FOREIGN KEY (id_suivi)   REFERENCES utilisateur (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
 
INSERT INTO role (nom) VALUES ('utilisateur'), ('administrateur');
INSERT INTO type_equipe (nom) VALUES ('club'), ('sélection nationale');
