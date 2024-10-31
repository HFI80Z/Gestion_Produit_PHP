<?php
include 'fonctions.php'; // Assurez-vous que ce fichier inclut la connexion $pdo

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if ($type === 'categorie') {
        // Supprimer les produits associés avant de supprimer la catégorie
        $stmt = $pdo->prepare("DELETE FROM produits WHERE categorie = :id");
        $stmt->execute(['id' => $id]);

        // Suppression de la catégorie
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: categories.php");
    } elseif ($type === 'produit') {
        // Suppression du produit
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: produits.php");
    }
    exit;
} else {
    echo "Type ou ID non spécifié.";
}
?>
