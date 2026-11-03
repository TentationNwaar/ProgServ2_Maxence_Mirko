<?php

/**
 * Gère la connexion à la base de données.
 * Une seule connexion PDO est créée, puis réutilisée partout.
 */
class Database {
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO {
        // Première fois : on crée la connexion. Ensuite, on renvoie la même.
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/db.php';

            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";

            try {
                self::$pdo = new PDO($dsn, $config['user'], $config['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données.');
            }
        }

        return self::$pdo;
    }
}
