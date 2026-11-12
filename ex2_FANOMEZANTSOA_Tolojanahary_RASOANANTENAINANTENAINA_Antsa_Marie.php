<?php
class CompteBancaire {
    public string $numero;
    public string $titulaire;
    public float $solde;

    public function __construct(string $numero, string $titulaire, float $solde) {
        $this->numero = $numero;
        $this->titulaire = $titulaire;
        $this->solde = $solde;
    }

    public function afficher(): string {
        return "{$this->numero} | {$this->titulaire} | {$this->solde} Ar";
    }

    public function deposer(float $montant): void {
        if ($montant > 0) {
            $this->solde += $montant;
        } else {
            echo "Le montant à déposer doit être positif.<br>";
        }
    }

    public function retirer(float $montant): bool {
        if ($montant > 0 && $this->solde >= $montant) {
            $this->solde -= $montant;
            return true;
        } else {
            echo "Retrait refuse sur $this->numero : solde insuffisant .<br>";
            return false;
        }
    }
    public function virer(float $montant, CompteBancaire $dest): void {
        if ($this->retirer($montant)) {
            $dest->deposer($montant);
        }
    }

}
$c1 = new CompteBancaire("CPT-001", "Rakoto", 500000);
$c2 = new CompteBancaire("CPT-002", "Rasoa", 0); 
$c3 = new CompteBancaire("CPT-003", "Randria", 120000); 

$c2->deposer(200000);
$c1->retirer(150000);
$c3->retirer(300000);
$c2->virer(50000, $c3);

$comptes = [$c1, $c2, $c3];
$NbrCompte = 0;
foreach ($comptes as $compte) {
    echo $compte->afficher() . "<br>";
    $NbrCompte++;
}

echo "Nombre de comptes : $NbrCompte<br>";
echo "Total des soldes : " . ($c1->solde + $c2->solde + $c3->solde) . " Ar<br>";

?>