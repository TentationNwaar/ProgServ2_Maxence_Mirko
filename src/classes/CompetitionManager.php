<?php

/**
 * Toutes les requêtes SQL qui concernent les compétitions.
 */
class CompetitionManager {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * @return array Liste de ['id' => ..., 'nom' => ...]
     */
    public function getAll(): array {
        return $this->pdo->query("SELECT id, nom FROM competition ORDER BY nom")->fetchAll();
    }
}
