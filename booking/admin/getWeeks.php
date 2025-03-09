<?php
// Supponiamo che tu abbia una funzione getAvailableWeeks($anno, $mese)
// simile a quella già nel tuo codice, ma che restituisce un mysqli_result o un array

require_once '../class/MYSQL.php';

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');

$result = getWeeks($year, $month);

// Prepara array di risposta
$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inizio = date("d/m/y", strtotime($row['inizio_settimana']));
        $fine   = date("d/m/y", strtotime($row['fine_settimana']));
        $label  = "$inizio - $fine";

        // Mettiamo nel JSON l'ID e la descrizione
        $response[] = [
            'id_settimana' => $row['id_settimana'],
            'label'        => $label
        ];
    }
}

// Risposta JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
