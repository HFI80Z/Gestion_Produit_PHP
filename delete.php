<?php
include 'fonctions.php'; // ça doit inclure la connexion $pdo

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if ($type === 'categorie') {
        $stmt = $pdo->prepare("DELETE FROM produits WHERE categorie = :id");
        $stmt->execute(['id' => $id]);
        
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: categories.php");
    } elseif ($type === 'produit') {
        
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: produits.php");
    }
    exit;
} else {
    echo "Type ou ID non spécifié.";
}
?>
