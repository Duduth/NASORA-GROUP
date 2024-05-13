<?php
// Récupérer les données saisies dans le formulaire
$labo = $_POST['labo'];
$article = $_POST['article'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];
$stock = $_POST['stock'];
$date = $_POST['date'];

// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "Nasora2024";
$dbname = "suite_nasora";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Préparer la requête SQL pour insérer les données dans la table des ventes
$sql = "INSERT INTO ventes (labo, article, prix, quantite, stock, date) VALUES ('$labo', '$article', '$prix', '$quantite', '$stock', '$date')";

// Exécuter la requête SQL
if ($conn->query($sql) === TRUE) {
  echo "Enregistrement des ventes effectué avec succès.";
} else {
  echo "Erreur lors de l'enregistrement des ventes : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>
