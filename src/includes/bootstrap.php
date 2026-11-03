<?php
// Code commun chargé au début de chaque page.

session_start();

// Charge automatiquement une classe la première fois qu'on l'utilise :
// "new MatchManager()" va chercher src/classes/MatchManager.php
spl_autoload_register(function ($classe) {
    require __DIR__ . '/../classes/' . $classe . '.php';
});

// Raccourci pour sécuriser l'affichage
function e($texte) {
    return htmlspecialchars($texte ?? '', ENT_QUOTES, 'UTF-8');
}

// Utilisateur connecté ? (null = visiteur)
$user = $_SESSION['user'] ?? null;
