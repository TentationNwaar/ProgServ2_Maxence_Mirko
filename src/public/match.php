<?php
require __DIR__ . '/../includes/bootstrap.php';

$matchManager = new MatchManager();
$avisManager  = new AvisManager();

// --- 1. Récupérer le match demandé ---
// filter_input renvoie l'id en entier, ou false/null si ce n'en est pas un
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$match = $id ? $matchManager->getById($id) : null;

if (!$match) {
    http_response_code(404);
    $titre = 'Match introuvable – Fulltimed';
    require __DIR__ . '/../includes/header.php';
    echo '<main class="page"><p>Ce match n\'existe pas. <a href="index.php">Retour à l\'accueil</a></p></main>';
    require __DIR__ . '/../includes/footer.php';
    exit;
}

// --- 2. Traiter le formulaire d'avis (seulement si connecté) ---
$erreur = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user && $match->estJoue()) {
    $note = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 0, 'max_range' => 5],
    ]);
    $commentaire = trim($_POST['commentaire'] ?? '');

    if ($note === false || $note === null) {
        $erreur = 'Choisis une note entre 0 et 5.';
    } elseif (mb_strlen($commentaire) > 2000) {
        $erreur = 'Ton commentaire est trop long (2000 caractères max).';
    } else {
        $avisManager->create($user['id'], $match->getId(), $note, $commentaire !== '' ? $commentaire : null);

        // On redirige vers la même page : si l'utilisateur rafraîchit,
        // le navigateur ne renvoie pas le formulaire une deuxième fois.
        header('Location: match.php?id=' . $match->getId());
        exit;
    }
}

// --- 3. Récupérer les avis ---
$avis = $avisManager->getByMatch($match->getId());

$titre = $match->getEquipeDomicile() . ' – ' . $match->getEquipeExterieur() . ' – Fulltimed';
$pageActive = 'matchs';
require __DIR__ . '/../includes/header.php';
?>

<main class="page page-colonne">
    <a href="matchs.php" class="muted">← Retour aux matchs</a>

    <!-- En-tête du match -->
    <section class="hero hero-match">
        <p class="badge"><?= e($match->getCompetition()) ?></p>

        <div class="affiche">
            <span class="equipe"><?= e($match->getEquipeDomicile()) ?></span>
            <strong class="score score-grand"><?= $match->getScore() ?></strong>
            <span class="equipe"><?= e($match->getEquipeExterieur()) ?></span>
        </div>

        <p class="muted">
            <?= $match->getDateLongue() ?> · <?= $match->estJoue() ? 'Terminé' : 'À venir' ?>
        </p>

        <?php if ($match->aDesAvis()): ?>
            <p class="note note-grande">★ <?= $match->getMoyenne() ?> / 5 · <?= $match->getNbAvis() ?> avis</p>
        <?php endif; ?>

        <?php if ($match->getDescription()): ?>
            <p><?= e($match->getDescription()) ?></p>
        <?php endif; ?>
    </section>

    <!-- Formulaire d'avis -->
    <section class="bloc">
        <h2>Ton avis</h2>

        <?php if (!$match->estJoue()): ?>
            <p class="muted">Ce match n'a pas encore été joué. Tu pourras le noter après le coup de sifflet final.</p>

        <?php elseif (!$user): ?>
            <p class="muted">
                <a href="connexion.php" class="lien">Connecte-toi</a> pour noter et commenter ce match.
            </p>

        <?php else: ?>
            <?php if ($erreur): ?>
                <p class="erreur"><?= e($erreur) ?></p>
            <?php endif; ?>

            <form method="post" class="form-avis">
                <label for="note">Note</label>
                <select name="note" id="note" required>
                    <option value="">Choisir…</option>
                    <?php for ($i = 5; $i >= 0; $i--): ?>
                        <option value="<?= $i ?>"><?= $i ?> / 5</option>
                    <?php endfor; ?>
                </select>

                <label for="commentaire">Commentaire (facultatif)</label>
                <textarea name="commentaire" id="commentaire" rows="4" maxlength="2000"
                    placeholder="Qu'as-tu pensé du match ?"></textarea>

                <button type="submit" class="btn btn-primary">Publier mon avis</button>
            </form>
        <?php endif; ?>
    </section>

    <!-- Avis de la communauté -->
    <section class="bloc">
        <h2>Avis de la communauté (<?= count($avis) ?>)</h2>

        <?php if (empty($avis)): ?>
            <p class="muted">Aucun avis pour l'instant.</p>
        <?php else: ?>
            <ul class="liste-avis">
                <?php foreach ($avis as $a): ?>
                    <li class="avis">
                        <div class="avis-entete">
                            <a href="profil.php?id=<?= $a['id_utilisateur'] ?>" class="avis-auteur">
                                <?= e($a['username']) ?>
                            </a>
                            <span class="note">★ <?= $a['note'] ?> / 5</span>
                            <span class="muted"><?= date('d.m.Y', strtotime($a['date'])) ?></span>
                        </div>

                        <?php if ($a['commentaire']): ?>
                            <p><?= nl2br(e($a['commentaire'])) ?></p>
                        <?php endif; ?>

                        <p class="muted avis-likes">♥ <?= $a['nb_likes'] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
