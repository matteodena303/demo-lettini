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


$domain = "bibioneresidence.it"; // DOMINIO DEL SITO
$subdomain = "bibioneresidence.it/booking";
$backend = "" . $subdomain . "/admin/";


// dati mail
$host = 'mail.303lab.it';
$mail = 'testbibione@303lab.it';
$passs = 'mpkfa123stella';

// Indirizzo email dell'azienda
$mail_azienda  = 'matteodena@303lab.it'; // (personalizza se serve)
