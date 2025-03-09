<?php
include 'db_connection.php';


// funzione per gestire il login
function checkLogin($username, $password) {
    // Ottieni la connessione al database
    $conn = getdbConnection();
    if (!$conn) {
        die("Errore nella connessione al database: " . mysqli_connect_error());
    }
    
    // Prepara la query: cerchiamo l'utente per username
    $sql = "SELECT id, username, user_password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    // Se troviamo un record
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();

        // Debug
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";


        // Verifica la password con l’hash salvato
        if (password_verify($password, $row['user_password'])) {
            // Chiusura connessione
            closedbConnection($conn);
            // Torna l'intero record o semplicemente true
            return $row; // o return true
        }
    } else {
        echo "Nessun record per username = '$username'";
    }

    // Se non corrisponde, chiudiamo la connessione e torniamo false
    closedbConnection($conn);
    return false;
}



// restituisce un array con id_lettini prenotati
function getLettiniPrenotati($id_settimana)
{
    $conn = getdbConnection();
    if (!$conn) {
        die("Errore: impossibile connettersi al database.");
    } else {
        // echo "Connessione riuscita!<br>";
    }
    if (!$conn) {
        die("Errore: impossibile connettersi al database.");
    }
    $sql = "
        SELECT lettino FROM (
            SELECT lettino1_sett1 AS lettino FROM prenotazioni WHERE id_settimana1 = ?
            UNION ALL
            SELECT lettino2_sett1 FROM prenotazioni WHERE id_settimana1 = ?
            UNION ALL
            SELECT lettino3_sett1 FROM prenotazioni WHERE id_settimana1 = ?
            UNION ALL
            SELECT lettino1_sett2 FROM prenotazioni WHERE id_settimana2 = ?
            UNION ALL
            SELECT lettino2_sett2 FROM prenotazioni WHERE id_settimana2 = ?
            UNION ALL
            SELECT lettino3_sett2 FROM prenotazioni WHERE id_settimana2 = ?
            UNION ALL
            SELECT lettino1_sett3 FROM prenotazioni WHERE id_settimana3 = ?
            UNION ALL
            SELECT lettino2_sett3 FROM prenotazioni WHERE id_settimana3 = ?
            UNION ALL
            SELECT lettino3_sett3 FROM prenotazioni WHERE id_settimana3 = ?
        ) AS lettini
        WHERE lettino IS NOT NULL
        ORDER BY lettino ASC
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $conn->error);
    }
    $stmt->bind_param(
        "iiiiiiiii",
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana
    );
    $stmt->execute();
    $result = $stmt->get_result();
    $lettini = [];
    while ($row = $result->fetch_assoc()) {
        $lettini[] = $row['lettino'];
    }
    $stmt->close();
    closedbConnection($conn);
    return $lettini;
}
// funzione per tirare fuori le prenotazioni del backend
function getPrenotazioniMappa($id_settimana)
{
    $conn = getdbConnection();
    if (!$conn) {
        die("Errore: impossibile connettersi al database.");
    }
    $sql = "
        SELECT
            p.codice_prenotazione,
            c.nome_cliente,
            c.email,
            c.telefono,
            c.lingua,
            lettini.lettino AS id_lettino
        FROM (
            SELECT codice_prenotazione, id_cliente, lettino1_sett1 AS lettino FROM prenotazioni WHERE id_settimana1 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino2_sett1 FROM prenotazioni WHERE id_settimana1 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino3_sett1 FROM prenotazioni WHERE id_settimana1 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino1_sett2 FROM prenotazioni WHERE id_settimana2 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino2_sett2 FROM prenotazioni WHERE id_settimana2 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino3_sett2 FROM prenotazioni WHERE id_settimana2 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino1_sett3 FROM prenotazioni WHERE id_settimana3 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino2_sett3 FROM prenotazioni WHERE id_settimana3 = ?
            UNION ALL
            SELECT codice_prenotazione, id_cliente, lettino3_sett3 FROM prenotazioni WHERE id_settimana3 = ?
        ) AS lettini
        INNER JOIN clienti c ON lettini.id_cliente = c.id_cliente
        INNER JOIN prenotazioni p ON lettini.codice_prenotazione = p.codice_prenotazione
        WHERE lettini.lettino IS NOT NULL
        ORDER BY lettini.lettino ASC;
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $conn->error);
    }
    $stmt->bind_param(
        "iiiiiiiii",
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana,
        $id_settimana
    );
    $stmt->execute();
    $result = $stmt->get_result();
    $lettiniPrenotati = [];
    while ($row = $result->fetch_assoc()) {
        $id_lettino = $row['id_lettino'];  // Chiave principale dell'array
        $lettiniPrenotati[$id_lettino] = [
            'codice_prenotazione' => $row['codice_prenotazione'],
            'nome_cliente' => $row['nome_cliente'],
            'email' => $row['email'],
            'telefono' => $row['telefono'],
            'lingua' => $row['lingua']
        ];
    }
    $stmt->close();
    closedbConnection($conn);
    return $lettiniPrenotati;
}
// Funzione per ottenere la lista di tutti i lettini
function getAllLettini()
{
    // echo "Funzione avviata!<br>"; // Debug
    $conn = getdbConnection();
    if (!$conn) {
        // error_log("Errore: impossibile connettersi al database.");
        // echo "Errore di connessione!<br>"; // Debug
        return [];
    }
    // echo "Connessione avvenuta con successo!<br>"; // Debug
    $sql = "SELECT codice_lettino, fila, sovrapprezzo FROM lettini ORDER BY codice_lettino ASC";
    $result = $conn->query($sql);
    if (!$result) {
        error_log("Errore nella query: " . $conn->error);
        echo "Errore nella query!<br>"; // Debug
        return [];
    }
    // echo "Query eseguita con successo!<br>"; // Debug
    // echo "Numero di righe restituite: " . $result->num_rows . "<br>";
    // if ($result->num_rows == 0) {
    //     echo "⚠️ Nessun lettino trovato!<br>";
    // }
    // Array per contenere i lettini
    $lettini = [];
    while ($row = $result->fetch_assoc()) {
        $lettini[] = [
            'codice_lettino' => $row['codice_lettino'],
            'fila' => $row['fila'],
            'sovraprezzo' => $row['sovrapprezzo']
        ];
    }
    // echo "Dati lettini caricati!<br>"; // Debug
    $result->free();
    closedbConnection($conn);
    return $lettini;
}
// Funzione per ottenere le settimane disponibili (solo le future)
function getAvailableWeeks($selectedYear, $selectedMonth)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // Scrivi la query
    $sql = "SELECT id_settimana, inizio_settimana, fine_settimana
            FROM settimane
            WHERE anno = $selectedYear
            AND mese = LPAD($selectedMonth, 2, '0')
            AND fine_settimana >= CURDATE()";
    // Esegui la query
    $result = $conn->query($sql);
    // Chiudi la connessione
    closedbConnection($conn);
    // Ritorna il risultato
    return $result;
}
// Funzione per ottenere le settimane richieste (non solo le future)
function getWeeks($selectedYear, $selectedMonth)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // Scrivi la query per estrarre tutte le settimane senza filtro su data corrente
    $sql = "SELECT id_settimana, inizio_settimana, fine_settimana
            FROM settimane
            WHERE anno = $selectedYear
              AND mese = LPAD($selectedMonth, 2, '0')";
    // Esegui la query
    $result = $conn->query($sql);
    // Chiudi la connessione
    closedbConnection($conn);
    // Ritorna il risultato
    return $result;
}
// Funzione per ottenere settimane successive
function getAdditionalWeeks($selectedWeekId, $numWeeks)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // Scrivi la query
    $sql = "SELECT id_settimana, inizio_settimana, fine_settimana
            FROM settimane
            WHERE id_settimana > $selectedWeekId
            ORDER BY id_settimana ASC
            LIMIT " . ($numWeeks - 1);
    // Esegui la query
    $result = $conn->query($sql);
    // Chiudi la connessione
    closedbConnection($conn);
    // Ritorna il risultato
    return $result;
}
// Funzione per ottenere le date di inizio e fine settimana dall'id
function getWeekById($id_week)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // Usa una query parametrizzata per evitare SQL Injection
    $sql = "SELECT inizio_settimana, fine_settimana FROM settimane WHERE id_settimana = ?";
    // Prepara la query
    $stmt = $conn->prepare($sql);
    // Associa il parametro (intero)
    $stmt->bind_param("i", $id_week);
    // Esegui la query
    $stmt->execute();
    // Ottieni il risultato
    $result = $stmt->get_result();
    // Estrai i dati in un array associativo
    $row = $result->fetch_assoc();
    // Chiudi la query e la connessione
    $stmt->close();
    closedbConnection($conn);
    // Ritorna il risultato (se la riga esiste)
    return $row ?: null;
}
// restituisce le date dall'id in formato "13/05/2025 - 20/05/2025"
function getFormattedWeekRange($id_week)
{
    // Otteniamo l'array di date tramite la funzione esistente
    $week = getWeekById($id_week);

    // Se i dati sono validi, formattiamo le date
    if ($week && !empty($week['inizio_settimana']) && !empty($week['fine_settimana'])) {
        // Convertiamo le date in oggetti DateTime
        $start = DateTime::createFromFormat('Y-m-d', $week['inizio_settimana']);
        $end   = DateTime::createFromFormat('Y-m-d', $week['fine_settimana']);

        // Restituiamo la stringa formattata
        return $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y');
    }

    // In caso di dati mancanti o non validi, restituiamo una stringa vuota o un messaggio di errore
    return '';
}


function getInfoLettino($codice_lettino)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // Query parametrizzata per evitare SQL Injection
    $sql = "SELECT fila, sovrapprezzo FROM lettini WHERE codice_lettino = ?";
    // Prepara la query
    $stmt = $conn->prepare($sql);
    // Associa il parametro (intero)
    $stmt->bind_param("i", $codice_lettino);
    // Esegui la query
    $stmt->execute();
    // Ottieni il risultato
    $result = $stmt->get_result();
    // Estrai i valori
    $row = $result->fetch_assoc();
    // Chiudi la query e la connessione
    $stmt->close();
    closedbConnection($conn);
    // Ritorna i dati come array associativo o null se non trovato
    return $row ?: null;
}
/**
 * Aggiorna codice_prenotazione, nome_cliente, email, telefono, lingua.
 *
 * $conn: oggetto mysqli aperto
 * $oldCode: il codice prenotazione attuale (per trovarlo)
 * $newCode: il codice prenotazione nuovo (o lo stesso se non vuoi cambiarlo)
 * $nomeCliente, $email, $telefono, $lingua: dati del cliente
 *
 * Ritorna TRUE se l'aggiornamento va a buon fine, FALSE altrimenti.
 */
function updatePrenotazione($conn, $oldCode, $newCode, $nomeCliente, $email, $telefono, $lingua)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // 1. Trova l'id_cliente nella tabella prenotazioni partendo dal codice prenotazione "oldCode"
    $stmt = $conn->prepare("SELECT id_cliente FROM prenotazioni WHERE codice_prenotazione = ?");
    if (!$stmt) {
        // Se c’è errore nella preparazione
        return false;
    }
    $stmt->bind_param("s", $oldCode);
    $stmt->execute();
    $result = $stmt->get_result();
    // Se non troviamo nessuna prenotazione con quel codice, usciamo
    if ($result->num_rows === 0) {
        $stmt->close();
        return false;
    }
    // Estraggo id_cliente
    $row = $result->fetch_assoc();
    $id_cliente = $row['id_cliente'];
    $stmt->close();
    // 2. Aggiorna la tabella clienti
    $stmt = $conn->prepare("
        UPDATE clienti
           SET nome_cliente = ?,
               email = ?,
               telefono = ?,
               lingua = ?
         WHERE id_cliente = ?
    ");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ssssi", $nomeCliente, $email, $telefono, $lingua, $id_cliente);
    $ok = $stmt->execute();
    $stmt->close();
    if (!$ok) {
        return false;
    }
    // 3. Aggiorna la tabella prenotazioni
    //    Se vuoi cambiare il codice, metti anche 'codice_prenotazione = ?' nel SET
    //    e userai oldCode nella WHERE
    $stmt = $conn->prepare("
        UPDATE prenotazioni
           SET codice_prenotazione = ?
         WHERE codice_prenotazione = ?
    ");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ss", $newCode, $oldCode);
    $ok = $stmt->execute();
    $stmt->close();
    closedbConnection($conn);
    return $ok; // true o false
}
/**
 * Restituisce i dati completi di una prenotazione (e del rispettivo cliente)
 * in base al codice prenotazione passato come parametro.
 *
 * @param string $codicePrenotazione Il codice prenotazione da cercare.
 * @return array|null Ritorna un array associativo con i dati di prenotazione e cliente,
 *                    oppure null se non viene trovata alcuna corrispondenza.
 */
function getReservationAndClientData($codicePrenotazione)
{
    // Ottieni la connessione al database
    $conn = getdbConnection();
    // Prepara la query JOIN su prenotazioni e clienti
    $sql = "SELECT p.*, c.*
            FROM prenotazioni p
            JOIN clienti c ON p.id_cliente = c.id_cliente
            WHERE p.codice_prenotazione = ?";
    // Prepara lo statement
    $stmt = $conn->prepare($sql);
    // Associa il parametro alla query
    $stmt->bind_param("s", $codicePrenotazione);
    // Esegui la query
    $stmt->execute();
    // Ottieni il risultato
    $result = $stmt->get_result();
    // Estrai la singola riga come array associativo (se presente)
    $data = $result->fetch_assoc();
    // Libera la memoria e chiudi statement
    $stmt->free_result();
    $stmt->close();
    // Chiudi la connessione
    closedbConnection($conn);
    // Ritorna i dati trovati (oppure null se non trovati)
    return $data !== null ? $data : null;
}


function getAllPrenotazioni()
{
    $conn = getdbConnection();
    if (!$conn) {
        error_log("Errore: impossibile connettersi al database.");
        return [];
    }

    $sql = "
    SELECT
        p.codice_prenotazione AS codice,
        c.nome_cliente,
        c.email,
        c.telefono,
        c.lingua,

        s1.inizio_settimana AS inizio1,
        s1.fine_settimana   AS fine1,
        p.lettino1_sett1,
        p.lettino2_sett1,
        p.lettino3_sett1,

        s2.inizio_settimana AS inizio2,
        s2.fine_settimana   AS fine2,
        p.lettino1_sett2,
        p.lettino2_sett2,
        p.lettino3_sett2,

        s3.inizio_settimana AS inizio3,
        s3.fine_settimana   AS fine3,
        p.lettino1_sett3,
        p.lettino2_sett3,
        p.lettino3_sett3,

        DATE_FORMAT(p.data_inserimento, '%Y-%m-%d') AS sortable_date,
        DATE_FORMAT(p.data_inserimento, '%d-%m-%Y') AS date
    FROM prenotazioni p
    LEFT JOIN clienti c ON p.id_cliente = c.id_cliente
    LEFT JOIN settimane s1 ON p.id_settimana1 = s1.id_settimana
    LEFT JOIN settimane s2 ON p.id_settimana2 = s2.id_settimana
    LEFT JOIN settimane s3 ON p.id_settimana3 = s3.id_settimana
    ORDER BY p.data_inserimento DESC
";

    $result = $conn->query($sql);

    if (!$result) {
        error_log("Errore nella query: " . $conn->error);
        return [];
    }

    $prenotazioni = [];
    while ($row = $result->fetch_assoc()) {
        $prenotazioni[] = [
            'codice' => $row['codice'],
            'nome_cliente' => $row['nome_cliente'],
            'email' => $row['email'],
            'telefono' => $row['telefono'],
            'lingua' => $row['lingua'],

            'inizio1' => $row['inizio1'],
            'fine1' => $row['fine1'],
            'lettino1_sett1' => $row['lettino1_sett1'],
            'lettino2_sett1' => $row['lettino2_sett1'],
            'lettino3_sett1' => $row['lettino3_sett1'],

            'inizio2' => $row['inizio2'],
            'fine2' => $row['fine2'],
            'lettino1_sett2' => $row['lettino1_sett2'],
            'lettino2_sett2' => $row['lettino2_sett2'],
            'lettino3_sett2' => $row['lettino3_sett2'],

            'inizio3' => $row['inizio3'],
            'fine3' => $row['fine3'],
            'lettino1_sett3' => $row['lettino1_sett3'],
            'lettino2_sett3' => $row['lettino2_sett3'],
            'lettino3_sett3' => $row['lettino3_sett3'],

            'sortable_date' => $row['sortable_date'],
            'date' => $row['date']
        ];
    }

    $result->free();
    closedbConnection($conn);
    return $prenotazioni;
}


function deletePrenotazioneECliente($codice_prenotazione)
{
    $conn = getdbConnection();
    if (!$conn) {
        error_log("Errore: impossibile connettersi al database.");
        return false;
    }

    // Trova l'ID cliente associato alla prenotazione
    $sqlCliente = "SELECT id_cliente FROM prenotazioni WHERE codice_prenotazione = ?";
    $stmtCliente = $conn->prepare($sqlCliente);
    $stmtCliente->bind_param("s", $codice_prenotazione);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();

    if ($resultCliente->num_rows === 0) {
        error_log("Errore: prenotazione non trovata.");
        $stmtCliente->close();
        closedbConnection($conn);
        return false;
    }

    $row = $resultCliente->fetch_assoc();
    $id_cliente = $row['id_cliente'];
    $stmtCliente->close();

    // Elimina la prenotazione
    $sqlDeletePrenotazione = "DELETE FROM prenotazioni WHERE codice_prenotazione = ?";
    $stmtDeletePrenotazione = $conn->prepare($sqlDeletePrenotazione);
    $stmtDeletePrenotazione->bind_param("s", $codice_prenotazione);
    $stmtDeletePrenotazione->execute();

    if ($stmtDeletePrenotazione->affected_rows === 0) {
        error_log("Errore: impossibile eliminare la prenotazione.");
        $stmtDeletePrenotazione->close();
        closedbConnection($conn);
        return false;
    }
    $stmtDeletePrenotazione->close();

    // Controlla se il cliente ha altre prenotazioni
    $sqlCheckCliente = "SELECT COUNT(*) AS prenotazioni_attive FROM prenotazioni WHERE id_cliente = ?";
    $stmtCheckCliente = $conn->prepare($sqlCheckCliente);
    $stmtCheckCliente->bind_param("i", $id_cliente);
    $stmtCheckCliente->execute();
    $resultCheckCliente = $stmtCheckCliente->get_result();
    $rowCheck = $resultCheckCliente->fetch_assoc();
    $prenotazioni_attive = $rowCheck['prenotazioni_attive'];
    $stmtCheckCliente->close();

    // Se il cliente non ha altre prenotazioni, lo eliminiamo
    if ($prenotazioni_attive == 0) {
        $sqlDeleteCliente = "DELETE FROM clienti WHERE id_cliente = ?";
        $stmtDeleteCliente = $conn->prepare($sqlDeleteCliente);
        $stmtDeleteCliente->bind_param("i", $id_cliente);
        $stmtDeleteCliente->execute();
        $stmtDeleteCliente->close();
    }

    closedbConnection($conn);
    return true;
}
