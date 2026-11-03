<?php

/**
 * Toutes les requêtes SQL qui concernent les avis.
 */
class AvisManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Les avis d'un match, du plus récent au plus ancien,
     * avec l'auteur et le nombre de likes.
     */
    public function getByMatch(int $idMatch): array
    {
        $stmt = $this->pdo->prepare("
            SELECT a.id, a.note, a.commentaire, a.`date`,
                   u.id AS id_utilisateur, u.username,
                   COUNT(l.id) AS nb_likes
            FROM avis a
            JOIN utilisateur u    ON a.id_utilisateur = u.id
            LEFT JOIN like_avis l ON l.id_avis        = a.id
            WHERE a.id_match = :id_match
            GROUP BY a.id
            ORDER BY a.`date` DESC
        ");
        $stmt->execute(['id_match' => $idMatch]);

        return $stmt->fetchAll();
    }

    /**
     * Ajoute un avis. La date est mise automatiquement par la base.
     */
    public function create(int $idUtilisateur, int $idMatch, int $note, ?string $commentaire): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO avis (note, commentaire, id_utilisateur, id_match)
            VALUES (:note, :commentaire, :id_utilisateur, :id_match)
        ");
        $stmt->execute([
            'note'           => $note,
            'commentaire'    => $commentaire,
            'id_utilisateur' => $idUtilisateur,
            'id_match'       => $idMatch,
        ]);
    }
}
