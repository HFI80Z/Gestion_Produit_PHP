<?php include 'header.php'; ?>
<?php include 'fonctions.php'; ?>

<h1>Gestion des Catégories</h1>
<form method="POST" action="categories.php">
    <label>Titre de la catégorie :</label>
    <input type="text" name="titre" required>
    <button type="submit" name="ajouter">Ajouter</button>
</form>

<?php
if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $stmt = $pdo->prepare("INSERT INTO categories (titre) VALUES (:titre)");
    $stmt->execute(['titre' => $titre]);
    header("Location: categories.php");
}
?>

<h2>Liste des Catégories</h2>
<ul>
    <?php
    $categories = getCategories($pdo);
    foreach ($categories as $categorie) {
        echo "<li>{$categorie['titre']} 
        <a href='edit.php?type=categorie&id={$categorie['id']}'>Modifier</a> 
        <a href='delete.php?type=categorie&id={$categorie['id']}'>Supprimer</a></li>";
    }
    ?>
</ul>

<?php include 'footer.php'; ?>
