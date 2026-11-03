<?php
require __DIR__ . '/../includes/bootstrap.php';

// Onglet actif, uniquement parmi les tris autorisés
$tri = $_GET['tri'] ?? 'populaires';
if (!isset(MatchManager::TRIS[$tri])) {
    $tri = 'populaires';
}

// Récupération des données
$matchManager = new MatchManager();
$competitionManager = new CompetitionManager();

$competitions = $competitionManager->getAll();
$matchDuJour  = $matchManager->getMatchDuJour();
$matchs       = $matchManager->getMatchsAffiche($tri);

$titre = 'Fulltimed – Le carnet de matchs des fans';
$pageActive = 'accueil';
require __DIR__ . '/../includes/header.php';
?>

<div class="page">
    <!-- Barre latérale -->
    <aside class="sidebar">
        <form action="matchs.php" method="get">
            <input type="search" name="q" placeholder="Rechercher une équipe…" class="search">
        </form>

        <h2 class="label">Compétitions</h2>
        <ul class="comp-list">
            <li><a href="matchs.php" class="active">Toutes les compétitions</a></li>
            <?php foreach ($competitions as $comp): ?>
                <li><a href="matchs.php?competition=<?= $comp['id'] ?>"><?= e($comp['nom']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <main class="main">
        <!-- Hero -->
        <section class="hero">
            <div class="hero-texte">
                <p class="badge">Le carnet de matchs des fans</p>
                <h1>Note chaque match. Garde ceux qui t'ont fait vibrer.</h1>
                <p class="muted">Suis les matchs que tu regardes, note-les, commente-les et découvre ce que la communauté en a pensé.</p>

                <div class="boutons">
                    <?php if (!$user): ?>
                        <a href="inscription.php" class="btn btn-primary">Créer un compte</a>
                    <?php endif; ?>
                    <a href="matchs.php" class="btn btn-secondary">Explorer les matchs</a>
                </div>
            </div>

            <?php if ($matchDuJour): ?>
                <article class="match-du-jour">
                    <p class="badge badge-star">Match du jour</p>
                    <a href="match.php?id=<?= $matchDuJour->getId() ?>" class="affiche">
                        <span><?= e($matchDuJour->getEquipeDomicile()) ?></span>
                        <strong class="score score-grand"><?= $matchDuJour->getScore() ?></strong>
                        <span><?= e($matchDuJour->getEquipeExterieur()) ?></span>
                    </a>
                    <p class="muted"><?= e($matchDuJour->getCompetition()) ?> · <?= $matchDuJour->getDateCourte() ?></p>
                    <?php if ($matchDuJour->aDesAvis()): ?>
                        <p class="note">★ <?= $matchDuJour->getMoyenne() ?> · <?= $matchDuJour->getNbAvis() ?> avis</p>
                    <?php endif; ?>
                </article>
            <?php endif; ?>
        </section>

        <!-- Matchs à l'affiche -->
        <section>
            <div class="section-titre">
                <h2>Matchs à l'affiche</h2>
                <ul class="onglets">
                    <li><a href="?tri=populaires" class="<?= $tri === 'populaires' ? 'active' : '' ?>">Populaires</a></li>
                    <li><a href="?tri=recents" class="<?= $tri === 'recents' ? 'active' : '' ?>">Récents</a></li>
                    <li><a href="?tri=mieux-notes" class="<?= $tri === 'mieux-notes' ? 'active' : '' ?>">Mieux notés</a></li>
                </ul>
            </div>

            <?php if (empty($matchs)): ?>
                <p class="muted">Aucun match pour l'instant.</p>
            <?php else: ?>
                <div class="grille">
                    <?php foreach ($matchs as $match): ?>
                        <article class="carte">
                            <a href="match.php?id=<?= $match->getId() ?>">
                                <p class="carte-meta"><?= e($match->getCompetition()) ?> · <?= $match->getDateCourte() ?></p>
                                <p class="affiche">
                                    <span><?= e($match->getEquipeDomicile()) ?></span>
                                    <strong class="score"><?= $match->getScore() ?></strong>
                                    <span><?= e($match->getEquipeExterieur()) ?></span>
                                </p>
                                <?php if ($match->aDesAvis()): ?>
                                    <p class="note">★ <?= $match->getMoyenne() ?> · <?= $match->getNbAvis() ?> avis</p>
                                <?php else: ?>
                                    <p class="muted">Pas encore noté</p>
                                <?php endif; ?>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="centre">
                <a href="matchs.php" class="btn btn-secondary">Voir plus de matchs →</a>
            </div>
        </section>
    </main>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
