<?php

/**
 * Toutes les requêtes SQL qui concernent les matchs.
 */
class MatchManager {
    // Tris autorisés pour les matchs à l'affiche (liste blanche)
    public const TRIS = [
        'populaires'  => 'nb_avis DESC',
        'recents'     => 'm.date_heure DESC',
        'mieux-notes' => 'moyenne DESC',
    ];

    // Partie commune à toutes les requêtes : équipes, compétition, notes
    private const SELECT = "
        SELECT m.id, m.date_heure, m.description, m.score_domicile, m.score_exterieur,
               dom.nom AS equipe_dom,
               ext.nom AS equipe_ext,
               c.nom   AS competition,
               ROUND(AVG(a.note), 1) AS moyenne,
               COUNT(a.id)           AS nb_avis
        FROM matchs m
        JOIN equipe dom    ON m.id_equipe_domicile  = dom.id
        JOIN equipe ext    ON m.id_equipe_exterieur = ext.id
        JOIN competition c ON m.id_competition      = c.id
        LEFT JOIN avis a   ON a.id_match            = m.id
    ";

    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Le premier match d'aujourd'hui, sinon le match terminé le plus commenté.
     */
    public function getMatchDuJour(): ?FootballMatch {
        $row = $this->pdo->query(self::SELECT . "
            WHERE DATE(m.date_heure) = CURDATE()
            GROUP BY m.id
            ORDER BY m.date_heure
            LIMIT 1
        ")->fetch();

        if (!$row) {
            $row = $this->pdo->query(self::SELECT . "
                WHERE m.score_domicile IS NOT NULL
                GROUP BY m.id
                ORDER BY nb_avis DESC
                LIMIT 1
            ")->fetch();
        }

        return $row ? $this->creerMatch($row) : null;
    }

    /**
     * Les matchs terminés, triés selon $tri.
     * @return FootballMatch[]
     */
    public function getMatchsAffiche(string $tri, int $limite = 6): array {
        // Un ORDER BY ne peut pas être un paramètre de requête préparée,
        // donc on n'accepte que les valeurs de la liste blanche.
        $ordre = self::TRIS[$tri] ?? self::TRIS['populaires'];

        $stmt = $this->pdo->prepare(self::SELECT . "
            WHERE m.score_domicile IS NOT NULL
            GROUP BY m.id
            ORDER BY $ordre
            LIMIT :limite
        ");
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();

        $matchs = [];
        foreach ($stmt->fetchAll() as $row) {
            $matchs[] = $this->creerMatch($row);
        }
        return $matchs;
    }

    /**
     * Crée un match à partir d'une ligne renvoyée par la base.
     */
    public function creerMatch(array $row): FootballMatch {
        return new FootballMatch(
            (int) $row['id'],
            $row['date_heure'],
            $row['score_domicile'] !== null ? (int) $row['score_domicile'] : null,
            $row['score_exterieur'] !== null ? (int) $row['score_exterieur'] : null,
            $row['equipe_dom'],
            $row['equipe_ext'],
            $row['competition'],
            $row['moyenne'] !== null ? (float) $row['moyenne'] : null,
            (int) $row['nb_avis'],
            $row['description'] ?? null,
        );
    }

    /**
     * Un match par son id, ou null s'il n'existe pas.
     */
    public function getById(int $id): ?FootballMatch {
        $stmt = $this->pdo->prepare(self::SELECT . "
            WHERE m.id = :id
            GROUP BY m.id
        ");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ? $this->creerMatch($row) : null;
    }
}
