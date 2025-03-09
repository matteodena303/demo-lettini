<?php


// codice prenotazione
$codicePrenotazione = $_POST['codicePrenotazione'];

// echo "<p><strong>Codice Prenotazione:</strong> $codicePrenotazione</p>";
// echo "<br>";




// dati cliente
$nomeCognome = $_POST['nomeCognome'];
// $email = $_POST['email'];
// $telefono = $_POST['telefono'];
$email = isset($_POST['email']) ? $_POST['email'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$language = isset($_POST['lang']) ? $_POST['lang'] : null;





// echo "<p><strong>Nome e Cognome:</strong> $nomeCognome</p>";
// echo "<p><strong>Indirizzo Email:</strong> $email</p>";
// echo "<p><strong>N. di Telefono:</strong> $telefono</p>";
// echo "<p><strong>Lingua:</strong> $language</p>";
// echo "<br>";




//dati selezionati dal menu a tendina
$month = $_POST['month'];
$year = $_POST['year'];

// echo "<p><strong>Mese prima settimana:</strong> $month</p>";
// echo "<p><strong>Anno prima settimana:</strong> $year</p>";
// echo "<br>";




//n. settimane prenotate
$numWeeks = $_POST['numWeeks'];

// echo "<p><strong>Settimane Prenotate:</strong> $numWeeks</p>";
// echo "<br>";




//SETTIMANA 1
$id_settimana1 = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : null;
// $date_settimana1 = isset($_POST['date_settimana1']) ? $_POST['date_settimana1'] : null;
$nlettini_settimana1 = isset($_POST['nlettini_settimana1']) ? $_POST['nlettini_settimana1'] : null;
$posto1week1 = isset($_POST['posto1week1']) ? $_POST['posto1week1'] : null;
$posto2week1 = isset($_POST['posto2week1']) ? $_POST['posto2week1'] : null;
$posto3week1 = isset($_POST['posto3week1']) ? $_POST['posto3week1'] : null;

// echo "<p>SETTIMANA 1</p>";
// echo "<p><strong>ID settimana:</strong> $id_settimana1</p>";     // verificare variabile
// echo "<p><strong>Settimana prenotata:</strong> $date_settimana1</p>";     // verificare variabile
// echo "<p><strong>Numero lettini:</strong> $nlettini_settimana1</p>";     // verificare variabile
// echo "<p><strong>Ombrellone 1:</strong> $posto1week1</p>";      // verificare variabile
// echo "<p><strong>Ombrellone 2:</strong> $posto2week1</p>";      // verificare variabile
// echo "<p><strong>Ombrellone 3:</strong> $posto3week1</p>";      // verificare variabile
// echo "<br>";




//SETTIMANA 2
$id_settimana2 = isset($_POST['id_settimana2']) ? $_POST['id_settimana2'] : null;
// $date_settimana2 = isset($_POST['date_settimana2']) ? $_POST['date_settimana2'] : null;
$nlettini_settimana2 = isset($_POST['nlettini_settimana2']) ? $_POST['nlettini_settimana2'] : null;
$posto1week2 = isset($_POST['posto1week2']) ? $_POST['posto1week2'] : null;
$posto2week2 = isset($_POST['posto2week2']) ? $_POST['posto2week2'] : null;
$posto3week2 = isset($_POST['posto3week2']) ? $_POST['posto3week2'] : null;

// echo "<p>SETTIMANA 2</p>";
// echo "<p><strong>ID settimana:</strong> $id_settimana2</p>";     // verificare variabile
// echo "<p><strong>Settimana prenotata:</strong> $date_settimana2</p>";     // verificare variabile
// echo "<p><strong>Numero lettini:</strong> $nlettini_settimana2</p>";     // verificare variabile
// echo "<p><strong>Lettino 1:</strong> $posto1week2</p>";      // verificare variabile
// echo "<p><strong>Lettino 2:</strong> $posto2week2</p>";      // verificare variabile
// echo "<p><strong>Lettino 3:</strong> $posto3week2</p>";      // verificare variabile
// echo "<br>";



//SETTIMANA 3
$id_settimana3 = isset($_POST['id_settimana3']) ? $_POST['id_settimana3'] : null;
// $date_settimana3 = isset($_POST['date_settimana3']) ? $_POST['date_settimana3'] : null;
$nlettini_settimana3 = isset($_POST['nlettini_settimana3']) ? $_POST['nlettini_settimana3'] : null;
$posto1week3 = isset($_POST['posto1week3']) ? $_POST['posto1week3'] : null;
$posto2week3 = isset($_POST['posto2week3']) ? $_POST['posto2week3'] : null;
$posto3week3 = isset($_POST['posto3week3']) ? $_POST['posto3week3'] : null;


// echo "<p>SETTIMANA 3</p>";
// echo "<p><strong>ID settimana:</strong> $id_settimana3</p>";     // verificare variabile
// echo "<p><strong>Settimana prenotata:</strong> $date_settimana3</p>";     // verificare variabile
// echo "<p><strong>Numero lettini:</strong> $nlettini_settimana3</p>";     // verificare variabile
// echo "<p><strong>Lettino 1:</strong> $posto1week3</p>";      // verificare variabile
// echo "<p><strong>Lettino 2:</strong> $posto2week3</p>";      // verificare variabile
// echo "<p><strong>Lettino 3:</strong> $posto3week3</p>";      // verificare variabile
// echo "<br>";
