<?php
$host = 'localhost';
$dbname = 'a_rendre';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

function getCategories($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProduitsByCategorie($pdo, $categorie_id) {
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE categorie = :categorie_id");
    $stmt->execute(['categorie_id' => $categorie_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
