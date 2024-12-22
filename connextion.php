<?php
try {
   $db = new PDO('mysql:host=localhost;port=3308;dbname=gestion_produit;', 'root', 'root123');
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connexion Successfully";
} catch (PDOexception $e) {
   echo "Connextion failed" . $e->getMessage();
}