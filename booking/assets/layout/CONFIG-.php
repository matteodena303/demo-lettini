<?php
//reimposto il livello di errore visualizzato
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', 1);

//setto la timezone (necessaria per php 5.3)
date_default_timezone_set('Europe/Rome');
setlocale(LC_TIME, 'it_IT');



// Imposta la durata della sessione a 30 giorni (2592000 secondi)
ini_set('session.gc_maxlifetime', 2592000);

// Imposta il cookie di sessione con la stessa durata
session_set_cookie_params(2592000);

//avvio la sessione
session_start();
//echo "sessione avviata";

// //nome ditta
// $_SESSION['tco']['ditta'] = "Arca Distribution";

$domain = "www.bibioneresidence.it"; // DOMINIO DEL SITO
$subdomain = "www.bibioneresidence.it/booking";
$backend = "" . $subdomain . "/admin/";

$mail_azienda = "matteodena@303lab.it";
$mail_cliente = "matteodaneluzzi@gmail.com";
