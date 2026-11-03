-- ============================================================
-- Fulltimed : données de base
-- ============================================================
-- Ce qui doit exister pour que le site fonctionne.
-- À importer APRÈS schema.sql (qui crée déjà les rôles et les types d'équipe) :
--   role        : 1 = utilisateur, 2 = administrateur
--   type_equipe : 1 = club, 2 = sélection nationale

SET NAMES utf8mb4;


-- ------------------------------------------------------------
-- Pays
-- ------------------------------------------------------------
INSERT INTO pays (nom, code_iso) VALUES
('Italie',     'IT'),  -- 1
('Turquie',    'TR'),  -- 2
('France',     'FR'),  -- 3
('Belgique',   'BE'),  -- 4
('Suisse',     'CH'),  -- 5
('Portugal',   'PT'),  -- 6
('Espagne',    'ES'),  -- 7
('Angleterre', 'GB'),  -- 8 (l'Angleterre n'a pas de code ISO à 2 lettres, on prend GB)
('Allemagne',  'DE');  -- 9

-- ------------------------------------------------------------
-- Compétitions (id_pays NULL = compétition internationale)
-- ------------------------------------------------------------
INSERT INTO competition (nom, id_pays) VALUES
('Ligue des champions', NULL),  -- 1
('Ligue des nations',   NULL),  -- 2
('Premier League',      8),     -- 3
('La Liga',             7),     -- 4
('Serie A',             1),     -- 5
('Bundesliga',          9),     -- 6
('Super League',        5);     -- 7

-- ------------------------------------------------------------
-- Équipes (logo NULL pour l'instant)
-- ------------------------------------------------------------
INSERT INTO equipe (nom, logo, id_pays, id_type_equipe) VALUES
-- Sélections nationales
('Italie',          NULL, 1, 2),  -- 1
('Turquie',         NULL, 2, 2),  -- 2
('France',          NULL, 3, 2),  -- 3
('Belgique',        NULL, 4, 2),  -- 4
('Suisse',          NULL, 5, 2),  -- 5
('Portugal',        NULL, 6, 2),  -- 6
-- Clubs
('Inter',           NULL, 1, 1),  -- 7
('AC Milan',        NULL, 1, 1),  -- 8
('Juventus',        NULL, 1, 1),  -- 9
('Real Madrid',     NULL, 7, 1),  -- 10
('Barcelone',       NULL, 7, 1),  -- 11
('Arsenal',         NULL, 8, 1),  -- 12
('Liverpool',       NULL, 8, 1),  -- 13
('Manchester City', NULL, 8, 1),  -- 14
('Bayern Munich',   NULL, 9, 1),  -- 15
('Dortmund',        NULL, 9, 1),  -- 16
('Paris SG',        NULL, 3, 1),  -- 17
('Young Boys',      NULL, 5, 1),  -- 18
('FC Bâle',         NULL, 5, 1),  -- 19
('Servette',        NULL, 5, 1);  -- 20

-- ------------------------------------------------------------
-- Compte administrateur (impossible à créer depuis le site)
-- Mot de passe : password123 (à changer avant la mise en ligne)
-- ------------------------------------------------------------
INSERT INTO utilisateur (username, email, mot_de_passe_hash, bio, id_role) VALUES
('admin', 'admin@fulltimed.ch', '$2y$10$R4H7ls5ccMYYjU.YdxAuBOinqLhWqYQkOQsEYDfpCQeqzOgQF9jIu', 'Compte administrateur.', 2);  -- 1

-- ------------------------------------------------------------
-- Matchs
-- Terminés : date fixe + score
-- Aujourd'hui / à venir : calculés à partir de CURDATE(), sans score,
-- pour que la page "Matchs du jour" ne soit jamais vide.
-- ------------------------------------------------------------
INSERT INTO matchs (date_heure, description, score_domicile, score_exterieur, id_equipe_domicile, id_equipe_exterieur, id_competition) VALUES
-- Terminés
('2026-10-03 17:30:00', 'Choc au sommet à l''Emirates.',                         1, 1, 12, 13, 3),  -- 1  Arsenal - Liverpool
('2026-10-03 18:30:00', 'Der Klassiker à l''Allianz Arena.',                     4, 2, 15, 16, 6),  -- 2  Bayern - Dortmund
('2026-10-04 18:00:00', 'Derby della Madonnina.',                                1, 0,  7,  8, 5),  -- 3  Inter - AC Milan
('2026-10-04 21:00:00', 'El Clásico au Bernabéu.',                               2, 3, 10, 11, 4),  -- 4  Real Madrid - Barcelone
('2026-10-05 20:45:00', 'Ligue des nations, phase de groupes.',                  3, 1,  1,  2, 2),  -- 5  Italie - Turquie
('2026-10-05 20:45:00', 'Ligue des nations, phase de groupes.',                  2, 2,  3,  4, 2),  -- 6  France - Belgique
('2026-10-08 20:45:00', 'La Nati reçoit le Portugal à Genève.',                  1, 2,  5,  6, 2),  -- 7  Suisse - Portugal
('2026-10-25 16:30:00', 'Le Klassiker suisse au Wankdorf.',                      2, 0, 18, 19, 7),  -- 8  Young Boys - FC Bâle
('2026-11-01 14:00:00', NULL,                                                     1, 1, 20, 18, 7),  -- 9  Servette - Young Boys
('2026-11-01 17:30:00', 'Duel pour la tête de la Premier League.',               3, 2, 14, 12, 3),  -- 10 Manchester City - Arsenal
('2026-11-01 20:45:00', 'Derby d''Italia.',                                      0, 0,  9,  7, 5),  -- 11 Juventus - Inter
-- Aujourd'hui
(CONCAT(CURDATE(), ' 18:45:00'), 'Phase de ligue, 4e journée.',              NULL, NULL, 11,  9, 1),  -- 12 Barcelone - Juventus
(CONCAT(CURDATE(), ' 21:00:00'), 'Phase de ligue, 4e journée.',              NULL, NULL, 17, 15, 1),  -- 13 Paris SG - Bayern
(CONCAT(CURDATE(), ' 21:00:00'), 'Remake de la finale 2022 à Anfield.',      NULL, NULL, 13, 10, 1),  -- 14 Liverpool - Real Madrid
-- À venir
(CONCAT(CURDATE() + INTERVAL 1 DAY, ' 21:00:00'), 'Phase de ligue, 4e journée.', NULL, NULL, 16, 14, 1),  -- 15 Dortmund - Manchester City
(CONCAT(CURDATE() + INTERVAL 4 DAY, ' 16:30:00'), NULL,                          NULL, NULL, 19, 20, 7);  -- 16 FC Bâle - Servette
