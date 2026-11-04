<?php


class CompetitionManager {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * @return array 
     */
    public function getAll(): array {
        return $this->pdo->query("SELECT id, nom FROM competition ORDER BY nom")->fetchAll();
    }
}
