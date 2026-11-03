<?php
// Haut de page commun.
// Variables attendues avant l'include :
//   $titre      : titre de l'onglet
//   $pageActive : 'accueil', 'matchs' ou 'communaute' (lien souligné dans la navbar)
$titre      = $titre ?? 'Fulltimed';
$pageActive = $pageActive ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titre) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <nav class="navbar-inner">
        <a href="index.php" class="logo">Fulltimed</a>
        <ul class="nav-links">
            <li><a href="index.php" class="<?= $pageActive === 'accueil' ? 'active' : '' ?>">Accueil</a></li>
            <li><a href="matchs.php" class="<?= $pageActive === 'matchs' ? 'active' : '' ?>">Matchs</a></li>
            <?php if ($user): ?>
                <li><a href="communaute.php" class="<?= $pageActive === 'communaute' ? 'active' : '' ?>">Communauté</a></li>
            <?php endif; ?>
        </ul>

        <div class="nav-right">
            <div class="langues">
                <a href="?lang=fr" class="active">FR</a> | <a href="?lang=en">EN</a>
            </div>
            <?php if ($user): ?>
                <?php if ($user['role'] === 'administrateur'): ?>
                    <a href="admin/moderation.php">Modération</a>
                <?php endif; ?>
                <a href="profil.php"><?= e($user['username']) ?></a>
                <a href="deconnexion.php">Déconnexion</a>
            <?php else: ?>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php" class="btn btn-primary">Créer un compte</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
