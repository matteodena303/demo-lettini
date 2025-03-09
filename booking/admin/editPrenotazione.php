<?php
require_once '../class/MYSQL.php';
$conn = getdbConnection();




// 1. Leggo i dati
$oldCodice   = $_POST['oldCodice'] ?? '';
$newCodice   = $_POST['codicePrenotazione'] ?? '';
$nomeCognome = $_POST['nomeCognome'] ?? '';
$email       = $_POST['email'] ?? '';
$telefono    = $_POST['telefono'] ?? '';
$lingua      = $_POST['lingua'] ?? 'ITA';

// 2. Trovo id_cliente
$sql = "SELECT id_cliente FROM prenotazioni WHERE codice_prenotazione = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $oldCodice);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    // Niente prenotazione trovata, reindirizzo con un messaggio d'errore
    header("Location: index.php?update=notfound");
    exit;
}
$row = $res->fetch_assoc();
$id_cliente = $row['id_cliente'];
$stmt->close();

// 3. Aggiorno clienti
$sql = "UPDATE clienti
           SET nome_cliente = ?,
               email        = ?,
               telefono     = ?,
               lingua       = ?
         WHERE id_cliente   = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nomeCognome, $email, $telefono, $lingua, $id_cliente);
if (!$stmt->execute()) {
    // Errore nell'update
    header("Location: index.php?update=error");
    exit;
}
$stmt->close();

// 4. Aggiorno (opzionale) codice
$sql = "UPDATE prenotazioni
           SET codice_prenotazione = ?
         WHERE codice_prenotazione = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $newCodice, $oldCodice);
if (!$stmt->execute()) {
    // Errore aggiornamento codice prenotazione
    header("Location: index.php?update=error");
    exit;
}
$stmt->close();

closedbConnection($conn);

// 5. Se va tutto bene, reindirizza alla stessa pagina con un flag
// Se tutto va bene, reindirizza con un flag per il messaggio
header("Location: index.php?update=success&nocache=" . time());
exit;
