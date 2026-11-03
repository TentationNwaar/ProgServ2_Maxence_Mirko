-- ============================================================
-- Fulltimed : données de test
-- ============================================================
-- Faux utilisateurs et activité, pour développer et pour la démo.
-- À importer APRÈS schema.sql et data.sql.
-- Mot de passe de tous les comptes : password123
-- Les commentaires et notes sont fictifs.

SET NAMES utf8mb4;

-- ------------------------------------------------------------
-- Utilisateurs (id 1 = admin, déjà créé dans data.sql)
-- ------------------------------------------------------------
INSERT INTO utilisateur (username, email, mot_de_passe_hash, bio, id_role) VALUES
('tifosi_luca', 'luca@example.com',    '$2y$10$R4H7ls5ccMYYjU.YdxAuBOinqLhWqYQkOQsEYDfpCQeqzOgQF9jIu', 'Interista depuis toujours. Je note tout ce que je regarde.', 1), -- 2
('sarah_cdf',   'sarah@example.com',   '$2y$10$R4H7ls5ccMYYjU.YdxAuBOinqLhWqYQkOQsEYDfpCQeqzOgQF9jIu', 'Fan du Real et des soirées de Ligue des champions.', 1),       -- 3
('nico_90',     'nico@example.com',    '$2y$10$R4H7ls5ccMYYjU.YdxAuBOinqLhWqYQkOQsEYDfpCQeqzOgQF9jIu', NULL, 1),                                                        -- 4
('lena_bleus',  'lena@example.com',    '$2y$10$R4H7ls5ccMYYjU.YdxAuBOinqLhWqYQkOQsEYDfpCQeqzOgQF9jIu', 'Allez les Bleus. Avis courts, notes sévères.', 1),              -- 5
('tom_ybfan',   'tom@example.com',     '$2y$10$R4H7ls5ccMYYjU.YdxAuBOinqLhWqYQkOQsEYDfpCQeqzOgQF9jIu', 'Wankdorf tous les week-ends.', 1);                              -- 6

-- ------------------------------------------------------------
-- Avis (uniquement sur les matchs terminés, 1 à 11)
-- Plusieurs avis possibles par match, y compris du même utilisateur
-- ------------------------------------------------------------
INSERT INTO avis (note, commentaire, `date`, id_utilisateur, id_match) VALUES
(5, 'Clásico complètement fou, 5 buts et du suspense jusqu''au bout.',  '2026-10-04 23:05:00', 3,  4),  -- 1
(4, 'Énorme intensité, dommage pour la défense du Real.',               '2026-10-04 23:20:00', 2,  4),  -- 2
(5, NULL,                                                                '2026-10-05 09:12:00', 4,  4),  -- 3
(4, 'Revu en entier le lendemain, il passe encore mieux.',               '2026-10-05 19:40:00', 3,  4),  -- 4 (2e avis de sarah_cdf)
(4, 'L''Italie maîtrise, belle soirée.',                                 '2026-10-05 22:50:00', 2,  5),  -- 5
(4, NULL,                                                                '2026-10-06 08:30:00', 6,  5),  -- 6
(5, 'Match ouvert de bout en bout, les deux équipes voulaient gagner.',  '2026-10-05 22:55:00', 5,  6),  -- 7
(4, 'Un nul logique, mais quelle deuxième mi-temps.',                    '2026-10-05 23:10:00', 4,  6),  -- 8
(5, 'Derby gagné, rien d''autre à dire.',                                '2026-10-04 20:15:00', 2,  3),  -- 9
(3, 'Fermé, peu d''occasions.',                                          '2026-10-04 21:00:00', 4,  3),  -- 10
(3, 'Beaucoup de duels, peu de football.',                               '2026-10-03 19:45:00', 5,  1),  -- 11
(4, 'Égalisation méritée de Liverpool.',                                 '2026-10-03 20:10:00', 6,  1),  -- 12
(5, 'Le Bayern a régalé.',                                               '2026-10-03 21:00:00', 3,  2),  -- 13
(4, NULL,                                                                '2026-10-04 10:00:00', 4,  2),  -- 14
(3, 'La Nati a fait jeu égal pendant une heure.',                        '2026-10-08 22:50:00', 6,  7),  -- 15
(5, 'Wankdorf en feu, victoire nette contre Bâle.',                      '2026-10-25 18:40:00', 6,  8),  -- 16
(4, 'Solide de la part de YB.',                                          '2026-10-25 19:30:00', 5,  8),  -- 17
(3, 'Match correct sans plus.',                                          '2026-11-01 16:10:00', 6,  9),  -- 18
(5, 'Le meilleur match de la saison en Premier League.',                 '2026-11-01 19:45:00', 5, 10),  -- 19
(4, 'City plus réaliste, Arsenal peut avoir des regrets.',               '2026-11-01 20:05:00', 2, 10),  -- 20
(2, '0-0 soporifique, j''ai failli m''endormir.',                        '2026-11-01 22:50:00', 3, 11),  -- 21
(1, NULL,                                                                '2026-11-01 23:05:00', 4, 11);  -- 22

-- ------------------------------------------------------------
-- Likes sur les avis
-- ------------------------------------------------------------
INSERT INTO like_avis (id_utilisateur, id_avis) VALUES
(2, 1), (4, 1), (5, 1), (6, 1),
(3, 2),
(2, 7), (3, 7),
(3, 9),
(5, 16), (2, 16),
(2, 19), (3, 19), (6, 19),
(2, 21), (5, 21);

-- ------------------------------------------------------------
-- Liste « à regarder » (matchs du jour et à venir)
-- ------------------------------------------------------------
INSERT INTO a_regarder (id_utilisateur, id_match) VALUES
(2, 12), (2, 15),
(3, 14), (3, 13),
(4, 13),
(5, 13), (5, 15),
(6, 16), (6, 14);

-- ------------------------------------------------------------
-- Matchs en favoris
-- ------------------------------------------------------------
INSERT INTO favori (id_utilisateur, id_match) VALUES
(2, 3), (2, 5),
(3, 4),
(4, 4),
(5, 6), (5, 10),
(6, 8);

-- ------------------------------------------------------------
-- Équipes préférées
-- ------------------------------------------------------------
INSERT INTO equipe_preferee (id_utilisateur, id_equipe) VALUES
(2, 7), (2, 1),
(3, 10),
(4, 15), (4, 11),
(5, 3),
(6, 18), (6, 5);

-- ------------------------------------------------------------
-- Suivis (à sens unique : id_suiveur suit id_suivi)
-- ------------------------------------------------------------
INSERT INTO suit (id_suiveur, id_suivi) VALUES
(2, 3), (2, 5),
(3, 2),
(4, 3), (4, 6),
(5, 2),
(6, 2), (6, 3);
