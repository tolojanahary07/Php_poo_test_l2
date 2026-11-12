<?php
class Produit {
    public string $nom;
    public float $prix;
    public int $quantite;

    public function __construct(string $nom, float $prix, int $quantite) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }
    public function valeurStock(): float {
        return $this->prix * $this->quantite;
    }
    public function vendre(int $qte): void {
        if ($qte > 0 && $this->quantite >= $qte) {
            $this->quantite -= $qte;
        } else {
            echo "Vente impossible : stock insuffisant pour {$this->nom}<br>";
        }
    }

    public function afficher(): string {
        return $this->nom . " | " . $this->prix . " Ar | " . $this->quantite . " | " . $this->valeurStock() . " Ar";
    }

}

$riz = new Produit("Riz", 3500, 40);
$huile = new Produit("Huile", 9000, 12);
$sucre = new Produit("Sucre", 3800, 25);

$riz->vendre(15);
$huile->vendre(20);
$sucre->prix = 4200;

$produits = [$riz, $huile, $sucre];
$valeurTotale = 0;

echo "Nom | Prix | Quantite | Valeur stock<br>";
foreach ($produits as $produit) {
    echo $produit->afficher() . "<br>";
    $valeurTotale += $produit->valeurStock();
}

echo "Valeur totale du stock : " . $valeurTotale . " Ar<br>";

?>