<?php


// QUESTO CODICE CAUSA UN LOOP INFINITO

// // Check if the user is logged in, if not then redirect him to login page
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: auth-signin-cover.php");
//     exit;
// }

// CODICE CORRETTO

// Check if the user is logged in, if not then redirect him to login page
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Simula credenziali valide per esempio
//     $valid_username = "admin";
//     $valid_password = "password123";

//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     if ($username === $valid_username && $password === $valid_password) {
//         // Se le credenziali sono corrette, imposta la sessione
//         $_SESSION["loggedin"] = true;
//         $_SESSION["username"] = $username;

//         // Reindirizza alla dashboard o ad un'altra pagina protetta
//         header("Location: index.php");
//         exit;
//     } else {
//         // Se le credenziali sono errate, mostra un errore
//         $login_error = "Invalid username or password.";
//     }
// }



session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Non loggato: reindirizza
    header('Location: login.php');
    exit();
}

