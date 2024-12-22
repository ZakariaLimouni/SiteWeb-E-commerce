<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <?php
    include('connextion.php');
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve user input from the form
        $username = $_POST["username"];
        $name = $_POST["name"];
        $prenom = $_POST["prenom"];
        $motdpass = $_POST["motdpass"];

        // Prepare and execute the SQL statement
        $stmt = $db->prepare("INSERT INTO Users (username, nom, prenom, motPasse) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $name, $prenom, $motdpass]);

        // Check if the insertion was successful
        if ($stmt->rowCount() > 0) {
            echo "User registered successfully.";

            // Redirect to login.php
            header("Location: login.php");
            exit();
        } else {
            echo "Error registering user.";
        }
    }
    ?>

    <h2>User Registration Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="name">Nom:</label>
        <input type="text" name="name" required><br>

        <label for="prenom">Prenom:</label>
        <input type="text" name="prenom" required><br>

        <label for="motdpass">Password:</label>
        <input type="password" name="motdpass" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
