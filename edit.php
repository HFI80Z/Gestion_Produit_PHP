<?php
include 'fonctions.php'; // ça doit inclure la connexion $pdo

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if ($type === 'categorie') {
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    } elseif ($type === 'produit') {
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'categorie') {
        $titre = $_POST['titre'];
        $stmt = $pdo->prepare("UPDATE categories SET titre = :titre WHERE id = :id");
        $stmt->execute(['titre' => $titre, 'id' => $id]);
        header("Location: categories.php");
    } elseif ($type === 'produit') {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $categorie = $_POST['categorie'];
        $stmt = $pdo->prepare("UPDATE produits SET titre = :titre, description = :description, prix = :prix, categorie = :categorie WHERE id = :id");
        $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'prix' => $prix,
            'categorie' => $categorie,
            'id' => $id
        ]);
        header("Location: produits.php");
    }
    exit;
}
?>

<?php include 'header.php'; ?>

<h1>Modifier <?= $type === 'categorie' ? 'Catégorie' : 'Produit' ?></h1>

<form method="POST">
    <?php if ($type === 'categorie'): ?>
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($item['titre']) ?>" required>
    <?php elseif ($type === 'produit'): ?>
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($item['titre']) ?>" required>
        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($item['description']) ?></textarea>
        <label>Prix :</label>
        <input type="number" name="prix" value="<?= htmlspecialchars($item['prix']) ?>" required>
        <label>Catégorie :</label>
        <select name="categorie" required>
            <?php
            $categories = getCategories($pdo);
            foreach ($categories as $categorie) {
                $selected = $categorie['id'] === $item['categorie'] ? 'selected' : '';
                echo "<option value='{$categorie['id']}' $selected>{$categorie['titre']}</option>";
            }
            ?>
        </select>
    <?php endif; ?>
    <button type="submit">Enregistrer les modifications</button>
</form>

<?php include 'footer.php'; ?>
