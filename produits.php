<?php include 'header.php'; ?>
<?php include 'fonctions.php'; ?>

<h1>Gestion des Produits</h1>
<form method="POST" action="produits.php">
    <label>Titre :</label>
    <input type="text" name="titre" required>
    <label>Description :</label>
    <textarea name="description" required></textarea>
    <label>Prix :</label>
    <input type="number" name="prix" required>
    <label>Catégorie :</label>
    <select name="categorie" required>
        <?php
        $categories = getCategories($pdo);
        foreach ($categories as $categorie) {
            echo "<option value='{$categorie['id']}'>{$categorie['titre']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="ajouter">Ajouter</button>
</form>

<?php
if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stmt = $pdo->prepare("INSERT INTO produits (titre, description, prix, categorie) VALUES (:titre, :description, :prix, :categorie)");
    $stmt->execute(['titre' => $titre, 'description' => $description, 'prix' => $prix, 'categorie' => $categorie]);
    header("Location: produits.php");
}
?>

<h2>Liste des Produits</h2>
<ul>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM produits");
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($produits as $produit) {
        echo "<li>{$produit['titre']} - {$produit['prix']} € 
        <a href='edit.php?type=produit&id={$produit['id']}'>Modifier</a> 
        <a href='delete.php?type=produit&id={$produit['id']}'>Supprimer</a></li>";
    }
    ?>
</ul>

<?php include 'footer.php'; ?>
