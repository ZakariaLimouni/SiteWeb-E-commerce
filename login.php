<?php 
include('connextion.php');
session_start(); // Start the session

if (isset($_POST['username']) && isset($_POST['motPasse'])) {
    $username = $_POST['username'];
    $motPasse = $_POST['motPasse'];

    if (empty($username) || empty($motPasse)) {
        $error = "Veuillez saisir un username et un mot de passe.";
    }elseif($username=="admin" && $motPasse=="admin123"){
        $_SESSION['login'] = $username;
        header("Location: admin.php");
    }
    else {
        // Prepare the SQL query to retrieve the user record
        $query = "SELECT * FROM Users WHERE username = :username AND motPasse = :motPasse";
        $statement = $db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':motPasse', $motPasse);
        $statement->execute();
        
        // Check if the query returned a matching user record
        if ($statement->rowCount() === 1) {
            // Authentication successful
            $_SESSION['login'] = $username;
            header("Location: index1.php");
            exit();
        } else {
            // Invalid login or password
            $error = "Erreur de username/mot de passe.";
        }
    }
} else {
    $error = "";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="login.php">
        <label>Username :</label>
        <input type="text" name="username" ><br><br>
        <label>Mot De pass</label>
        <input type="password" name="motPasse" ><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>