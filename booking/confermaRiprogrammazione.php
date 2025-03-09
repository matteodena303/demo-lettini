<?php
// ======================
// ATTIVA DEBUG PER VEDERE EVENTUALI ERRORI (se utile in fase di test)
// ======================
error_reporting(E_ALL);
ini_set('display_errors', 1);


// ======================
// 1) REQUIRE DEI FILE DI PHPMailer (ordine: Exception, PHPMailer, SMTP) + CONFIG
// ======================
require __DIR__ . '/class/PHPMailer/src/Exception.php';
require __DIR__ . '/class/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/class/PHPMailer/src/SMTP.php';
require __DIR__ . '/class/CONFIG.php';
// CONFIG.php ipotizziamo contenga le variabili come $host, $mail, $passs, $mail_azienda, ecc.

// ======================
// 2) DICHIARAZIONE DEI NAMESPACE DI PHPMailer
// ======================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

?>

<?php include 'class/POST.php'; ?>
<?php include 'class/MYSQL.php'; ?>
<?php include 'assets/layout/header2.php'; ?>


<?php

// Funzione di comodo per formattare i lettini in una sola stringa
function formattaLettini($l1, $l2, $l3)
{
    $posti = [];
    if (!empty($l1)) $posti[] = $l1;
    if (!empty($l2)) $posti[] = $l2;
    if (!empty($l3)) $posti[] = $l3;
    return implode(", ", $posti);
}

// Creo le stringhe pronte da inserire nell'email
$lettini_week1 = formattaLettini($posto1week1, $posto2week1, $posto3week1);
$lettini_week2 = formattaLettini($posto1week2, $posto2week2, $posto3week2);
$lettini_week3 = formattaLettini($posto1week3, $posto2week3, $posto3week3);

// Recupero dati di base per mail al cliente:
$codicePrenotazione = $_POST['codicePrenotazione'] ?? '';
$nomeCognome        = $_POST['nomeCognome']        ?? '';
$emailCliente       = $_POST['email']              ?? '';
$telefono           = $_POST['telefono']           ?? '';
$language           = $_POST['lang']               ?? 'ITA';


// Id settimanali (eventualmente non usati nella mail, ma utili da mostrare in debug)
$id_settimana1   = $_POST['id_settimana1']   ?? null;
$date_settimana1 = getFormattedWeekRange($id_settimana1);
$id_settimana2   = $_POST['id_settimana2']   ?? null;
if ($id_settimana2 != "") {
    $date_settimana2 = getFormattedWeekRange($id_settimana2);
}
$id_settimana3   = $_POST['id_settimana3']   ?? null;
if ($id_settimana2 != "") {
    $date_settimana3 = getFormattedWeekRange($id_settimana3);
}

// Posti (lettini/ombrelloni):
$posto1week1 = $_POST['posto1week1'] ?? null;
$posto2week1 = $_POST['posto2week1'] ?? null;
$posto3week1 = $_POST['posto3week1'] ?? null;

$posto1week2 = $_POST['posto1week2'] ?? null;
$posto2week2 = $_POST['posto2week2'] ?? null;
$posto3week2 = $_POST['posto3week2'] ?? null;

$posto1week3 = $_POST['posto1week3'] ?? null;
$posto2week3 = $_POST['posto2week3'] ?? null;
$posto3week3 = $_POST['posto3week3'] ?? null;

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
?>

<body>
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <main style="padding-bottom:100px;">
            <div class="row g-5">
                <div class="col-md-12">
                    <h2 class="text-body-emphasis">Conferma Riprogrammazione Prenotazione</h2>
                    <p class="form-bold">STEP 3<br><br></p>

                    <?php
                    $conn = getdbConnection();

                    // Funzione per gestire i valori NULL
                    function nullable($value)
                    {
                        return ($value === NULL || $value === "") ? NULL : $value;
                    }

                    // Recupero dati dal form
                    $codicePrenotazione = $_POST['codicePrenotazione'] ?? NULL;
                    $fields = [
                        'id_settimana1' => nullable($_POST['id_settimana1'] ?? NULL),
                        'lettino1_sett1' => nullable($_POST['posto1week1'] ?? NULL),
                        'lettino2_sett1' => nullable($_POST['posto2week1'] ?? NULL),
                        'lettino3_sett1' => nullable($_POST['posto3week1'] ?? NULL),
                        'id_settimana2' => nullable($_POST['id_settimana2'] ?? NULL),
                        'lettino1_sett2' => nullable($_POST['posto1week2'] ?? NULL),
                        'lettino2_sett2' => nullable($_POST['posto2week2'] ?? NULL),
                        'lettino3_sett2' => nullable($_POST['posto3week2'] ?? NULL),
                        'id_settimana3' => nullable($_POST['id_settimana3'] ?? NULL),
                        'lettino1_sett3' => nullable($_POST['posto1week3'] ?? NULL),
                        'lettino2_sett3' => nullable($_POST['posto2week3'] ?? NULL),
                        'lettino3_sett3' => nullable($_POST['posto3week3'] ?? NULL),
                    ];

                    // Filtriamo i campi non nulli
                    $updateFields = [];
                    $values = [];
                    $types = "";

                    // Costruzione dinamica della query
                    foreach ($fields as $column => $value) {
                        if (is_null($value)) {
                            $updateFields[] = "$column = NULL"; // Gestione diretta di NULL
                        } else {
                            $updateFields[] = "$column = ?";
                            $values[] = $value;
                            $types .= "i"; // Tutti i campi sono numeri interi
                        }
                    }

                    if (empty($updateFields)) {
                        die("<p style='color: red;font-size: xx-large;'>ATTENZIONE: Nessun valore da aggiornare!</p>");
                    }

                    // Aggiungiamo codice_prenotazione per il WHERE
                    $values[] = $codicePrenotazione;
                    $types .= "s";

                    $query = "UPDATE prenotazioni SET " . implode(", ", $updateFields) . " WHERE codice_prenotazione = ?";

                    // Preparazione della query
                    $stmt = $conn->prepare($query);
                    if (!$stmt) {
                        die("<p style='color: red;'>Errore nella preparazione della query di aggiornamento: " . $conn->error . "</p>");
                    }

                    // Bind dei parametri (solo per i valori non NULL)
                    if (!empty($values)) {
                        $stmt->bind_param($types, ...$values);
                    }

                    // Esecuzione dell'aggiornamento
                    if ($stmt->execute()) {
                        echo "<p style='color: #72c772;font-size: xxx-large;font-weight: bold;'>La prenotazione è stata aggiornata con successo!</p>";


                        // ======================
                        // 6) SE L'UPDATE È RIUSCITO, INVIA MAIL A CLIENTE E AMMINISTRAZIONE
                        // ======================

                        // -- A) Prepariamo mail per l'AMMINISTRAZIONE
                        $oggettoAdmin = "Prenotazione Riprogrammata [cod. $codicePrenotazione]";
                        // Esempio di testo mail, puoi modificarlo a tuo piacere
                        $messaggioAdmin  = "Buongiorno,\n";
                        $messaggioAdmin .= "La prenotazione con codice $codicePrenotazione e' stata riprogrammata.\n\n";
                        $messaggioAdmin .= "Cliente: $nomeCognome\n";
                        $messaggioAdmin .= "Email: $emailCliente\n";
                        $messaggioAdmin .= "Telefono: $telefono\n\n";
                        $messaggioAdmin .= "Nuovi dati prenotazione:\n";
                        if ($numWeeks >= 1) {
                            $messaggioAdmin .= "- Settimana1 ($date_settimana1) -> Ombrelloni: $lettini_week1\n";
                        }
                        if ($numWeeks >= 2) {
                            $messaggioAdmin .= "- Settimana2 ($date_settimana2) -> Ombrelloni: $lettini_week2\n";
                        }
                        if ($numWeeks >= 3) {
                            $messaggioAdmin .= "- Settimana3 ($date_settimana3) -> Ombrelloni: $lettini_week3\n";
                        }
                        $messaggioAdmin .= "\nPuoi visualizzarla nel <a href='https://$backend'>PANNELLO ADMIN</a>.\n";

                        // Istanza PHPMailer per l'email all'amministrazione
                        try {
                            $mailAz = new PHPMailer(true);

                            // Configurazione SMTP (dati presi da CONFIG.php)
                            $mailAz->isSMTP();
                            $mailAz->Host       = $host;             // Indirizzo del server SMTP
                            $mailAz->SMTPAuth   = true;              // Abilita l'autenticazione SMTP
                            $mailAz->Username   = $mail;             // SMTP username
                            $mailAz->Password   = $passs;            // SMTP password
                            // Se si usa SSL/TLS, vedi config
                            $mailAz->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                            $mailAz->Port       = 465;               // Porta SMTP, es. 465 (SSL) / 587 (TLS)

                            // Impostazioni mail
                            $mailAz->setFrom($mail, 'Bibione Residence Apartments');
                            $mailAz->addAddress($mail_azienda); // Indirizzo dell'amministrazione

                            $mailAz->isHTML(true);
                            $mailAz->Subject = $oggettoAdmin;
                            $mailAz->Body    = nl2br($messaggioAdmin);
                            $mailAz->AltBody = $messaggioAdmin; // Testo puro (senza HTML)

                            $mailAz->send();
                        } catch (Exception $e) {
                            // Se vuoi mostrare l'errore
                            // echo "Errore mail admin: " . $mailAz->ErrorInfo;
                        }


                        if (isset($_POST['invia_mail'])) {

                        // -- B) Prepariamo mail per il CLIENTE
                        $subjectCliente = "";
                        $messageCliente = "";

                        // Eventuale messaggio in base alla lingua
                        switch ($language) {
                            case 'ENG':
                                $subjectCliente  = "Your booking has been rescheduled [cod. $codicePrenotazione]";
                                $messageCliente .= "Dear $nomeCognome,\n\n";
                                $messageCliente .= "Your booking with Bibione Residence Apartments has been modified by our office.\n";
                                $messageCliente .= "Here is the updated booking summary:\n\n";
                                if ($numWeeks >= 1) {
                                    $messageCliente .= "- WEEK 1 ($date_settimana1):\n";
                                    $messageCliente .= "- Assigned Beach Umbrella(s): $lettini_week1\n\n";
                                }
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- WEEK 2 ($date_settimana2):\n";
                                    $messageCliente .= "- Assigned Beach Umbrella(s): $lettini_week2\n\n";
                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- WEEK 3 ($date_settimana3):\n";
                                    $messageCliente .= "- Assigned Beach Umbrella(s): $lettini_week3\n\n";
                                }
                                $messageCliente .= "\nBest regards from our staff.\n\nFor more information or requests, contact us via email at info@bibioneresidence.it.";
                                break;
                                

                            case 'DEU':
                                $subjectCliente  = "Ihre Buchung wurde geändert [cod. $codicePrenotazione]";
                                $messageCliente .= "Sehr geehrte/r $nomeCognome,\n\n";
                                $messageCliente .= "Ihre Buchung bei Bibione Residence Apartments wurde von unserem Büro geändert.\n";
                                $messageCliente .= "Hier ist die aktualisierte Buchungsübersicht:\n\n";
                                if ($numWeeks >= 1) {
                                    $messageCliente .= "- WOCHE 1 ($date_settimana1):\n";
                                    $messageCliente .= "- Zugewiesener Sonnenschirm(e): $lettini_week1\n\n";
                                }
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- WOCHE 2 ($date_settimana2):\n";
                                    $messageCliente .= "- Zugewiesener Sonnenschirm(e): $lettini_week2\n\n";
                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- WOCHE 3 ($date_settimana3):\n";
                                    $messageCliente .= "- Zugewiesener Sonnenschirm(e): $lettini_week3\n\n";
                                }
                                $messageCliente .= "\nBeste Grüße von unserem Team.\n\nFür weitere Informationen oder Anfragen kontaktieren Sie uns per E-Mail unter info@bibioneresidence.it.";
                                break;
                                

                            // Default italiano
                            default:
                                $subjectCliente  = "La tua prenotazione e' stata riprogrammata [cod. $codicePrenotazione]";
                                $messageCliente .= "Gentile $nomeCognome,\n\n";
                                $messageCliente .= "La tua prenotazione con Bibione Residence Apartments e' stata modificata dal nostro ufficio.\n";
                                $messageCliente .= "Di seguito il riepilogo aggiornato della prenotazione:\n\n";
                                if ($numWeeks >= 1) {
                                    $messageCliente .= "- SETTIMANA 1 ($date_settimana1): \n";
                                    $messageCliente .= "- Ombrellone/i Assegnato/i: $lettini_week1\n\n";
                                }
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- SETTIMANA 2 ($date_settimana2):\n";
                                    $messageCliente .= "- Lettino/i Assegnati: $lettini_week2\n\n";

                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- SETTIMANA 3 ($date_settimana3):\n";
                                    $messageCliente .= "- Lettino/i Assegnati: $lettini_week3\n\n";
                                }
                                $messageCliente .= "\nUn saluto dallo staff.\n\nPer maggiori informazioni o richieste, contattaci via email a info@bibioneresidence.it.";
                                break;
                        }

                        // Invio mail al cliente
                        try {
                            $mailClient = new PHPMailer(true);

                            $mailClient->isSMTP();
                            $mailClient->Host       = $host;
                            $mailClient->SMTPAuth   = true;
                            $mailClient->Username   = $mail;
                            $mailClient->Password   = $passs;
                            $mailClient->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                            $mailClient->Port       = 465;

                            $mailClient->setFrom($mail, 'Bibione Residence Apartments');
                            $mailClient->addAddress($emailCliente, $nomeCognome);

                            $mailClient->isHTML(true);
                            $mailClient->Subject = $subjectCliente;
                            $mailClient->Body    = nl2br($messageCliente);
                            $mailClient->AltBody = $messageCliente;

                            $mailClient->send();
                        } catch (Exception $e) {
                            echo "Errore mail cliente: " . $mailClient->ErrorInfo;
                        }
                    }


                    } else {
                        die("<p style='color: red;font-size: xx-large;'>ATTENZIONE: Errore nell'aggiornamento della prenotazione: " . $stmt->error . "</p>");
                    }

                    $stmt->close();
                    closedbConnection($conn);
                    ?>


                    <a href="https://<?php echo $backend?>">
                        <button type="button" style="margin-top:30px;width:164px; padding: 5px; background-color:rgb(195, 195, 195); border: none; border-radius: 0px !important;font-size: 16px; font-weight: 600; color: white;">TORNA AL PANNELLO ADMIN</button>
                    </a>




                    <?php
                    // Recupera i dati del modulo
                    // Messaggio di conferma
                    // echo "<p>La tua prenotazione è stata confermata!</p>";
                    // echo "<br>";

                    /////////////////////////////////////////////////////////////////////////
                    /////////// debug ///////////////////////////////////////////////
                    /////////////////////////////////////////////////////////////////////////

                    // // codice prenotazione
                    // $codicePrenotazione = $_POST['codicePrenotazione'];
                    // echo "<p><strong>Codice Prenotazione:</strong> $codicePrenotazione</p>";
                    // echo "<br>";

                    // // dati cliente
                    // $nomeCognome = $_POST['nomeCognome'];
                    // $email = $_POST['email'];
                    // $telefono = $_POST['telefono'];
                    // $language = isset($_POST['lang']) ? $_POST['lang'] : null;

                    // echo "<p><strong>Nome e Cognome:</strong> $nomeCognome</p>";
                    // echo "<p><strong>Indirizzo Email:</strong> $email</p>";
                    // echo "<p><strong>N. di Telefono:</strong> $telefono</p>";
                    // echo "<p><strong>Lingua:</strong> $language</p>";
                    // echo "<br>";

                    // //dati selezionati dal menu a tendina
                    // $month = $_POST['month'];
                    // $year = $_POST['year'];

                    // echo "<p><strong>Mese prima settimana:</strong> $month</p>";
                    // echo "<p><strong>Anno prima settimana:</strong> $year</p>";
                    // echo "<br>";

                    // //n. settimane prenotate
                    // $numWeeks = $_POST['numWeeks'];

                    // echo "<p><strong>Settimane Prenotate:</strong> $numWeeks</p>";
                    // echo "<br>";

                    // //SETTIMANA 1
                    // $id_settimana1 = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : null;
                    // $date_settimana1 = isset($_POST['date_settimana1']) ? $_POST['date_settimana1'] : null;
                    // $nlettini_settimana1 = isset($_POST['nlettini_settimana1']) ? $_POST['nlettini_settimana1'] : null;
                    // $posto1week1 = isset($_POST['posto1week1']) ? $_POST['posto1week1'] : null;
                    // $posto2week1 = isset($_POST['posto2week1']) ? $_POST['posto2week1'] : null;
                    // $posto3week1 = isset($_POST['posto3week1']) ? $_POST['posto3week1'] : null;

                    // echo "<p>SETTIMANA 1</p>";
                    // echo "<p><strong>ID settimana:</strong> $id_settimana1</p>";     // verificare variabile
                    // echo "<p><strong>Settimana prenotata:</strong> $date_settimana1</p>";     // verificare variabile
                    // echo "<p><strong>Numero lettini:</strong> $nlettini_settimana1</p>";     // verificare variabile
                    // echo "<p><strong>Ombrellone 1:</strong> $posto1week1</p>";      // verificare variabile
                    // echo "<p><strong>Ombrellone 2:</strong> $posto2week1</p>";      // verificare variabile
                    // echo "<p><strong>Ombrellone 3:</strong> $posto3week1</p>";      // verificare variabile
                    // echo "<br>";

                    // //SETTIMANA 2
                    // $id_settimana2 = isset($_POST['id_settimana2']) ? $_POST['id_settimana2'] : null;
                    // $date_settimana2 = isset($_POST['date_settimana2']) ? $_POST['date_settimana2'] : null;
                    // $nlettini_settimana2 = isset($_POST['nlettini_settimana2']) ? $_POST['nlettini_settimana2'] : null;
                    // $posto1week2 = isset($_POST['posto1week2']) ? $_POST['posto1week2'] : null;
                    // $posto2week2 = isset($_POST['posto2week2']) ? $_POST['posto2week2'] : null;
                    // $posto3week2 = isset($_POST['posto3week2']) ? $_POST['posto3week2'] : null;

                    // echo "<p>SETTIMANA 2</p>";
                    // echo "<p><strong>ID settimana:</strong> $id_settimana2</p>";     // verificare variabile
                    // echo "<p><strong>Settimana prenotata:</strong> $date_settimana2</p>";     // verificare variabile
                    // echo "<p><strong>Numero lettini:</strong> $nlettini_settimana2</p>";     // verificare variabile
                    // echo "<p><strong>Lettino 1:</strong> $posto1week2</p>";      // verificare variabile
                    // echo "<p><strong>Lettino 2:</strong> $posto2week2</p>";      // verificare variabile
                    // echo "<p><strong>Lettino 3:</strong> $posto3week2</p>";      // verificare variabile
                    // echo "<br>";

                    // //SETTIMANA 3
                    // $id_settimana3 = isset($_POST['id_settimana3']) ? $_POST['id_settimana3'] : null;
                    // $date_settimana3 = isset($_POST['date_settimana3']) ? $_POST['date_settimana3'] : null;
                    // $nlettini_settimana3 = isset($_POST['nlettini_settimana3']) ? $_POST['nlettini_settimana3'] : null;
                    // $posto1week3 = isset($_POST['posto1week3']) ? $_POST['posto1week3'] : null;
                    // $posto2week3 = isset($_POST['posto2week3']) ? $_POST['posto2week3'] : null;
                    // $posto3week3 = isset($_POST['posto3week3']) ? $_POST['posto3week3'] : null;

                    // echo "<p>SETTIMANA 3</p>";
                    // echo "<p><strong>ID settimana:</strong> $id_settimana3</p>";     // verificare variabile
                    // echo "<p><strong>Settimana prenotata:</strong> $date_settimana3</p>";     // verificare variabile
                    // echo "<p><strong>Numero lettini:</strong> $nlettini_settimana3</p>";     // verificare variabile
                    // echo "<p><strong>Lettino 1:</strong> $posto1week3</p>";      // verificare variabile
                    // echo "<p><strong>Lettino 2:</strong> $posto2week3</p>";      // verificare variabile
                    // echo "<p><strong>Lettino 3:</strong> $posto3week3</p>";      // verificare variabile
                    // echo "<br>";
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>


<?php include 'assets/layout/footer.php'; ?>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>



</html>