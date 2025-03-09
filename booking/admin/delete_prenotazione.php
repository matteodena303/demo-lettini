<?php
// header("Cache-Control: no-cache, no-store, must-revalidate");
// header("Pragma: no-cache");
// header("Expires: 0");
// header('Content-Type: application/json');
require '../class/MYSQL.php';

$response = ['success' => false, 'error' => 'Errore sconosciuto'];

if (isset($_GET['delete_id'])) {
    $codicePrenotazione = $_GET['delete_id'];

    if (deletePrenotazioneECliente($codicePrenotazione)) {
        $response['success'] = true;
        unset($response['error']); // Rimuove il messaggio di errore se tutto va bene
    } else {
        $response['error'] = 'Impossibile eliminare la prenotazione.';
    }
}

// Forza la cache di SiteGround a ricaricare la pagina
header("SG-Cache-Control: no-cache");

echo json_encode($response);
exit();
