<?php
// File: db_connection.php

function getdbConnection()
{
    $servername = "31.11.39.205";
    $username = "Sql1848995";
    $password = "Kc9*5A%aXovF3Y1l";
    $dbname = "Sql1848995_2";

    // Creazione della connessione al database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controllo della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    return $conn; // Ritorna la connessione
}

// Funzione per chiudere la connessione (opzionale)
function closedbConnection($conn)
{
    if (isset($conn)) {
        $conn->close();
    }
}
