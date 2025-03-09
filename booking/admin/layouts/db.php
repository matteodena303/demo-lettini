<?php
// Connessione al database
$servername = "localhost";
$username = "kf303lab_admin"; // Cambia se hai un altro username
$password = "mpkfa123stella"; // Cambia se hai una password
$dbname = "kf303lab_velzon-php"; // Sostituisci con il nome del tuo database

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
} else {
    echo "Connessione al database OK";
}
