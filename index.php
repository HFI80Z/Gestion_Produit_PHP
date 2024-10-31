<?php include 'header.php'; ?>
<?php include 'fonctions.php'; ?>

<h1>Liste des Produits</h1>
<form method="POST" action="">
    <label for="categorie">Choisir une catégorie :</label>
    <select name="categorie" id="categorie" onchange="this.form.submit()">
        <option value="">Sélectionner</option>
        <?php
        $categories = getCategories($pdo);
        foreach ($categories as $categorie) {
            echo "<option value='{$categorie['id']}'>{$categorie['titre']}</option>";
        }
        ?>
    </select>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['categorie'])) {
    $categorie_id = $_POST['categorie'];
    $produits = getProduitsByCategorie($pdo, $categorie_id);
    echo "<ul>";
    foreach ($produits as $produit) {
        echo "<li>{$produit['titre']} - {$produit['prix']} €</li>";
    }
    echo "</ul>";
}
?>

<?php include 'footer.php'; ?>
