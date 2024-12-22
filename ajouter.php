<?php
include('connextion.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si tous les champs ont été remplis
    if (empty($_POST['title']) || empty($_POST['prix']) || empty($_FILES['photoProduit']['name'])) {
        // Rediriger vers la page d'ajout avec un message d'erreur
        header("Location: ajouter.php?erreur=Tous les champs doivent être remplis.");
        exit();
    }

    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $prix = $_POST['prix'];
    $photoProduit = $_FILES['photoProduit']['name'];

    // Déplacer l'image vers le dossier des images dans la racine du projet
    $dossierImages = "Image/";
    $cheminImage = $dossierImages . $photoProduit;
    move_uploaded_file($_FILES['photoProduit']['tmp_name'], $cheminImage);

    // Insérer les données dans la base de données
    $requeteInsertion = $db->prepare("INSERT INTO Produit (title, prix, photoProduit) VALUES (:title, :prix, :photoProduit)");
    $requeteInsertion->bindParam(':title', $title);
    $requeteInsertion->bindParam(':prix', $prix);
    $requeteInsertion->bindParam(':photoProduit', $photoProduit);
    $requeteInsertion->execute();

    // Rediriger vers la page d'accueil
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Produit</title>
</head>
<body>
    <h1>Ajouter Produit</h1>

    <?php if (isset($_GET['erreur'])) {
        echo "<p style='color: red;'>Erreur : " . $_GET['erreur'] . "</p>";
    } ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title de Produit :</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="prix">Prix de Produit :</label>
        <input type="text" id="prix" name="prix" required><br><br>


        <label for="photoProduit">Photo du produit :</label>
        <input type="file" id="photoProduit" name="photoProduit" required><br><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>