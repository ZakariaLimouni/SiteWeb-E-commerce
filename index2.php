<?php
include('connextion.php');
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Récupérer le nom et le prénom du propriétaire à partir de la base de données
// Assurez-vous d'avoir inclus le script de connexion à la base de données ici

$requete = $db->prepare("SELECT nom, prenom FROM Users WHERE username = :username");
$requete->bindParam(':username', $_SESSION['login']);
$requete->execute();
$proprietaire = $requete->fetch(PDO::FETCH_ASSOC);

// Déterminer le message de salutation en fonction de l'heure actuelle
$heureActuelle = date('H');
if ($heureActuelle >= 6 && $heureActuelle < 18) {
    $salutation = "Bonjour";
} else {
    $salutation = "Bonsoir";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLACK SHOP</title>
    <link rel="website icon" type="png" href="Image/logo.png">
    <link rel="stylesheet" href="STYLE.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <h1><?php echo $salutation . ", " . $proprietaire['nom'] . " " . $proprietaire['prenom']; ?></h1>
        <a href="#" class="logo"><img src="image/logo.png" width="95px" height="80px"></a>
        <ul>
            <li><a href="index2.php">Home</a></li>
            <li><a href="admin.php">Products</a></li>
            <li><a href="ajouter.php">Ajouter</a></li>
            <li><a href="logout.php">Log Out</a></li>

            <!-- <li><a href="#">Offers</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li> -->
            <i class="fas fa-shopping-cart" id="cart-icon"></i>
            <div class="cart">
                <h2 class="cart-title">votre panier</h2>
                <div class="cart-content">

                </div>
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">0 MAD</div>
                </div>
                <button type="button" class="btn-buy">Acheter maintenant</button>
                <i class='bx bxs-x-circle' id="close-cart"></i>

            </div>
        </ul>
    </nav>

    <section>
        <div class="hero">

            <video loop autoplay muted plays-inline height="780px" class="back-video">
                <source src="Image/homme2.mp4" type="video/mp4">
            </video>

            <div class="content-video">
                <h1 class="homme1">NOUVEAUTÉS</h1>
                <a href><button class="normal">ACHETER</button></a>
            </div>

        </div>
    </section>

    <section id="banner" class="section-m1">

        <h2>Jusqu'à <span>70 %</span> Tous les t-Shirts et Accessoires </h2>
        <div id="timer-content">
            <div id="countdown">
                <h2 id="countdown-header">Les soldes d'hiver se termineront</h2>
                <div id="timer">
                    <p id="timer-display">
                        <span class="time" id="days"></span>:<span class="time" id="hours"></span>:<span class="time"
                            id="minutes"></span>:<span class="time" id="seconds"></span>
                    </p>
                </div>
                <a href="INDEX.html"><button class="normal">Explore plus</button></a>

    </section>
    <section class="content">
        <div>
            <div class="c1">
                <h1 class="homme1">COLLECTION RAMADAN</h1>
                <h2 class="homme1">En magasin et en <br> ligne </h2>
                <a href="INDEX.html"><button class="normal">ACHETER</button></a>
            </div>
        </div>
    </section>
    <footer>
        <div id="containerFooter">

            <div id="webFooter">
                <h3> online store </h3>
                <p> men clothing </p>
                <p> women clothing </p>
                <p> men accessories </p>
                <p> women accessories </p>
            </div>
            <div id="webFooter">
                <h3> AIDE </h3>
                <p> Acheter en ligne </p>
                <p> Paiement </p>
                <p> Livraison </p>
                <p> Comment effectuer un retour </p>
            </div>
            <div id="webFooter">
                <h3> ENTREPRISE </h3>
                <p> Qui sommes-nous ? </p>
                <p> À propos de BLACK SHOP </p>
                <p> Magasins </p>
            </div>
            <div id="webFooter">
                <h3> CUSTOMER SERVICE </h3>
                <p> Contact </p>
            </div>
        </div>
        <div id="credit"><a href="#">
                <ion-icon name="logo-facebook"></ion-icon>
            </a><a href="#">
                <ion-icon name="logo-twitter"></ion-icon>
            </a><a href="#">
                <ion-icon name="logo-snapchat"></ion-icon>
            </a><a href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <div class="btn">
        <i class='bx bx-up-arrow-alt icone'></i>
    </div>

    <script src="SCRIPT.js"></script>

</body>

</html>