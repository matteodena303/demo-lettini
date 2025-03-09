<?php
require_once '../class/MYSQL.php';
$conn = getdbConnection();

$cod = $_GET['cod'] ?? '';

$sql = "
    SELECT p.codice_prenotazione,
           c.nome_cliente,
           c.email,
           c.telefono,
           c.lingua
      FROM prenotazioni p
      JOIN clienti c ON p.id_cliente = c.id_cliente
     WHERE p.codice_prenotazione = ?
     LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cod);
$stmt->execute();
$res = $stmt->get_result();

$data = [
    'oldCodice'          => '',
    'codicePrenotazione' => '',
    'nomeCognome'        => '',
    'email'              => '',
    'telefono'           => '',
    'lingua'             => 'ITA'
];

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $data['oldCodice']          = $row['codice_prenotazione'];  // Se gestisci cambio codice
    $data['codicePrenotazione'] = $row['codice_prenotazione'];
    $data['nomeCognome']        = $row['nome_cliente'];
    $data['email']              = $row['email'];
    $data['telefono']           = $row['telefono'];
    $data['lingua']             = $row['lingua'] ?: 'ITA';
}

$stmt->close();
closedbConnection($conn);

// Ritorno come JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
