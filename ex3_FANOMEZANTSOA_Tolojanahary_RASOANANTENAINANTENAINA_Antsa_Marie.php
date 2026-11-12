<?php
class Employe {
    public string $matricule;
    public string $nom;
    public float $salaireBase;

    public function __construct(string $matricule, string $nom, float $salaireBase) {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->salaireBase = $salaireBase;
    }

    public function calculerSalaire(): float {
        return $this->salaireBase;
    }

    public function getType(): string {
        return "Employe";
    }

    public function afficher(): string {
        return $this->matricule . " | " . $this->nom . " | " . $this->getType()
            . " | " . $this->calculerSalaire() . " Ar";
    }
}

class Manager extends Employe {
    public float $prime;

    public function __construct(string $matricule, string $nom, float $salaireBase, float $prime) {
        parent::__construct($matricule, $nom, $salaireBase);
        $this->prime = $prime;
    }

    public function calculerSalaire(): float {
        return parent::calculerSalaire() + $this->prime;
    }

    public function getType(): string {
        return "Manager";
    }
}

class Commercial extends Employe {
    public float $ventes;
    public float $taux;

    public function __construct(
        string $matricule,
        string $nom,
        float $salaireBase,
        float $ventes,
        float $taux
    ) {
        parent::__construct($matricule, $nom, $salaireBase);
        $this->ventes = $ventes;
        $this->taux = $taux;
    }

    public function calculerSalaire(): float {
        return parent::calculerSalaire() + $this->ventes * $this->taux / 100;
    }

    public function getType(): string {
        return "Commercial";
    }
}

class Stagiaire extends Employe {
    public function calculerSalaire(): float {
        return parent::calculerSalaire() * 0.30;
    }

    public function getType(): string {
        return "Stagiaire";
    }
}

$employe1 = new Employe("E01", "Rabe", 600000);
$manager = new Manager("M01", "Rakoto", 1200000, 400000);
$commercial1 = new Commercial("C01", "Rasoa", 500000, 8000000, 5);
$commercial2 = new Commercial("C02", "Hery", 500000, 3000000, 5);
$employe2 = new Employe("E02", "Fara", 650000);
$stagiaire = new Stagiaire("S01", "Tiana", 600000);

$personnel = [$employe1,$manager,$commercial1,$commercial2,$employe2,$stagiaire];

echo "Matricule | Nom | Type | Salaire<br>";
$masseSalariale = 0;
$nombreCommerciaux = 0;
$employeMieuxPaye = $personnel[0];

foreach ($personnel as $employe) {
    echo $employe->afficher() . "<br>";
    $salaire = $employe->calculerSalaire();
    $masseSalariale += $salaire;

    if ($employe instanceof Commercial) {
        $nombreCommerciaux++;
    }

    if ($salaire > $employeMieuxPaye->calculerSalaire()) {
        $employeMieuxPaye = $employe;
    }
}
echo "<br>";
echo "Masse salariale : " . $masseSalariale . " Ar<br>";
echo "Nombre de commerciaux : " . $nombreCommerciaux . "<br>";
echo "Salaire le plus eleve : " . $employeMieuxPaye->nom . "<br>";
?>