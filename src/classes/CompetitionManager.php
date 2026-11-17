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
        $stmt = $this->pdo->prepare("SELECT id, nom FROM competition ORDER BY nom");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
