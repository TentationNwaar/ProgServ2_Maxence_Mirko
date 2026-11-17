<?php

/**
 * Représente un match, avec ses équipes, sa compétition et ses notes.
 * (Nommée FootballMatch car "match" est un mot réservé en PHP 8.)
 */
class FootballMatch {
    public function __construct(
        private int $id,
        private string $dateHeure,
        private ?int $scoreDomicile,
        private ?int $scoreExterieur,
        private string $equipeDomicile,
        private string $equipeExterieur,
        private string $competition,
        private ?float $moyenne,
        private int $nbAvis,
        private ?string $description = null,
    ) {
    }


    public function getId(): int {
        return $this->id;
    }
    public function getEquipeDomicile(): string {
        return $this->equipeDomicile;
    }
    public function getEquipeExterieur(): string {
        return $this->equipeExterieur;
    }
    public function getCompetition(): string {
        return $this->competition;
    }
    public function getMoyenne(): ?float {
        return $this->moyenne;
    }
    public function getNbAvis(): int {
        return $this->nbAvis;
    }
    public function getDescription(): ?string {
        return $this->description;
    }

    public function estJoue(): bool {
        return $this->scoreDomicile !== null;
    }

    public function aDesAvis(): bool {
        return $this->nbAvis > 0;
    }

    /** "3 – 1", ou "vs" si le match n'est pas encore joué */
    public function getScore(): string {
        if (!$this->estJoue()) {
            return 'vs';
        }
        return $this->scoreDomicile . ' – ' . $this->scoreExterieur;
    }

    /** "Dimanche 4 octobre 2026 · 21:00" */
    public function getDateLongue(): string {
        $jours = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $mois  = [
            '',
            'janvier',
            'février',
            'mars',
            'avril',
            'mai',
            'juin',
            'juillet',
            'août',
            'septembre',
            'octobre',
            'novembre',
            'décembre'
        ];
        $t = strtotime($this->dateHeure);

        return ucfirst($jours[date('w', $t)]) . ' ' . date('j', $t) . ' '
            . $mois[date('n', $t)] . ' ' . date('Y', $t) . ' · ' . date('H:i', $t);
    }

    /** "04.10 · 21:00" */
    public function getDateCourte(): string {
        return date('d.m · H:i', strtotime($this->dateHeure));
    }
}
