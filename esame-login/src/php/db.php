<?php
$configs = include('config.php');
// Connessione al database
$servername = $configs["host"];
$username = $configs["username"];
$password = $configs["password"];
$dbname = $configs["dbname"];
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo se la connessione è stata stabilita correttamente
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
