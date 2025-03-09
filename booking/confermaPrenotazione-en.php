<?php
// ======================
// ATTIVA DEBUG PER VEDERE EVENTUALI ERRORI
// ======================
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ======================
// 1) REQUIRE DEI FILE DI PHPMailer (ordine: Exception, PHPMailer, SMTP)
// ======================
require __DIR__ . '/class/PHPMailer/src/Exception.php';
require __DIR__ . '/class/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/class/PHPMailer/src/SMTP.php';
require __DIR__ . '/class/CONFIG.php';


// ======================
// 2) DICHIARAZIONE DEI NAMESPACE DI PHPMailer
// ======================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// ======================
// 3) INCLUDES PROGETTO (vari file PHP tuoi)
// ======================
include 'class/POST.php';    // Se definisce alcune variabili da $_POST, OK
include 'class/MYSQL.php';   // Per la funzione getdbConnection()
include 'assets/layout/header.php';
// ======================
// 4) RECUPERO VARIABILI DA $_POST
// ======================

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

// Definisci mese/anno se servono
$month              = $_POST['month']              ?? null;
$year               = $_POST['year']               ?? null;

// Numero settimane prenotate
$numWeeks           = isset($_POST['numWeeks']) ? (int)$_POST['numWeeks'] : 1;


// ======================
// FUNZIONI UTILI
// ======================
function formattaLettini($l1, $l2, $l3)
{
    $posti_selezionati = [];
    if (!empty($l1)) $posti_selezionati[] = $l1;
    if (!empty($l2)) $posti_selezionati[] = $l2;
    if (!empty($l3)) $posti_selezionati[] = $l3;
    return implode(", ", $posti_selezionati);
}

function nullable($value)
{
    return ($value === NULL || $value === "") ? NULL : $value;
}

// Prepara stringhe dei lettini prenotati
$lettini_week1 = formattaLettini($posto1week1, $posto2week1, $posto3week1);
$lettini_week2 = formattaLettini($posto1week2, $posto2week2, $posto3week2);
$lettini_week3 = formattaLettini($posto1week3, $posto2week3, $posto3week3);
?>

<body>
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <main style="padding-bottom:100px;">
            <div class="row g-5">
                <div class="col-md-12">
                    <h2 class="text-body-emphasis">Confirm Booking</h2>
                    <p class="form-bold">STEP 3<br><br></p>

                    <?php
                    // ======================
                    // CONNESSIONE DB
                    // ======================
                    $conn = getdbConnection();

                    // 1) Controllo se la prenotazione esiste già
                    $stmt = $conn->prepare("SELECT codice_prenotazione FROM prenotazioni WHERE codice_prenotazione = ?");
                    $stmt->bind_param("s", $codicePrenotazione);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        // Esiste già prenotazione
                        echo "<p style='color: #ff6666; font-size: xx-large;font-weight: 700;'>WARNING: This reservation code is already in use!</p>";
                        $stmt->close();
                        closedbConnection($conn);
                    } else {
                        // Non esiste prenotazione => proseguiamo
                        $stmt->close();

                        // 2) Inserimento cliente
                        $stmt = $conn->prepare("INSERT INTO clienti (nome_cliente, email, telefono, lingua, data_inserimento) 
                                                VALUES (?, ?, ?, ?, NOW())");
                        if (!$stmt) {
                            die("<p style='color: red;'>Errore nella preparazione della query clienti: " . $conn->error . "</p>");
                        }
                        $stmt->bind_param("ssss", $nomeCognome, $email, $telefono, $language);
                        if (!$stmt->execute()) {
                            die("<p style='color: red;'>Errore nell'inserimento del cliente: " . $stmt->error . "</p>");
                        }
                        $id_cliente = $stmt->insert_id;
                        $stmt->close();

                        // 3) Prepariamo i dati per la INSERT prenotazioni
                        $id_settimana1_val = nullable($id_settimana1);
                        $posto1week1_val   = nullable($posto1week1);
                        $posto2week1_val   = nullable($posto2week1);
                        $posto3week1_val   = nullable($posto3week1);

                        $id_settimana2_val = nullable($id_settimana2);
                        $posto1week2_val   = nullable($posto1week2);
                        $posto2week2_val   = nullable($posto2week2);
                        $posto3week2_val   = nullable($posto3week2);

                        $id_settimana3_val = nullable($id_settimana3);
                        $posto1week3_val   = nullable($posto1week3);
                        $posto2week3_val   = nullable($posto2week3);
                        $posto3week3_val   = nullable($posto3week3);

                        // 4) Query insert prenotazione
                        $stmt = $conn->prepare(
                            "INSERT INTO prenotazioni (
                                codice_prenotazione,
                                id_cliente,
                                id_settimana1, lettino1_sett1, lettino2_sett1, lettino3_sett1,
                                id_settimana2, lettino1_sett2, lettino2_sett2, lettino3_sett2,
                                id_settimana3, lettino1_sett3, lettino2_sett3, lettino3_sett3,
                                data_inserimento
                            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())"
                        );

                        if (!$stmt) {
                            die("<p style='color: red;'>Errore nella preparazione della query prenotazioni: " . $conn->error . "</p>");
                        }

                        $stmt->bind_param(
                            "siiiiiiiiiiiii",
                            $codicePrenotazione,
                            $id_cliente,
                            $id_settimana1_val,
                            $posto1week1_val,
                            $posto2week1_val,
                            $posto3week1_val,
                            $id_settimana2_val,
                            $posto1week2_val,
                            $posto2week2_val,
                            $posto3week2_val,
                            $id_settimana3_val,
                            $posto1week3_val,
                            $posto2week3_val,
                            $posto3week3_val
                        );

                        // 5) Esecuzione insert prenotazione
                        if ($stmt->execute()) {
                            echo "<p style='color: #72c772;font-size: xxx-large;font-weight: bold;'>Your reservation has been successfully recorded!</p>";
                            echo "<p>You will receive a summary email shortly.</p>";

                            // ===================
                            // SEZIONE INVIO EMAIL
                            // ===================
                            // Prepara i testi email
                            // -- A) Prepariamo mail per l'AMMINISTRAZIONE
                            $oggettoAdmin = "Nuova Prenotazione [cod. $codicePrenotazione]";
                            // Esempio di testo mail, puoi modificarlo a tuo piacere
                            $messaggioAdmin  = "Buongiorno,\n";
                            $messaggioAdmin .= "E' stata caricata una nuova prenotazione con codice $codicePrenotazione.\n\n";
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

                            // (A) Invia mail A AZIENDA
                            try {
                                $mailAz = new PHPMailer(true);

                                global $host, $smtp_auth, $username, $password, $smtp_secure, $port;

                                // Configurazione SMTP
                                $mailAz->isSMTP();
                                $mailAz->Host       = $host;
                                $mailAz->SMTPAuth   = true;
                                $mailAz->Username   = $mail;
                                $mailAz->Password   = $passs;
                                $mailAz->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mailAz->Port       = 465;

                                // Impostazioni base
                                $mailAz->setFrom($mail, 'Bibione Residence Apartments');
                                $mailAz->addAddress($mail_azienda);

                                $mailAz->isHTML(true);
                                $mailAz->Subject = $oggetto_azienda;
                                $mailAz->Body    = nl2br($messaggio_azienda);
                                $mailAz->AltBody = $messaggio_azienda;

                                $mailAz->send();
                            } catch (Exception $e) {
                                // Se vuoi, decommenta per debug:
                                // echo "Errore mail azienda: " . $mailAz->ErrorInfo;
                            }

                            // (B) Invia mail AL CLIENTE
                            $subjectCliente = "";
                            $messageCliente = "";

                            // Switch su $language
                            switch ($language) {
                                case 'ITA':
                                    $subjectCliente  = "Richiesta di prenotazione ricevuta [$codicePrenotazione]";
                                    $messageCliente .= "Gentile $nomeCognome,\n\n";
                                    $messageCliente .= "La tua richiesta di prenotazione e' stata inviata correttamente.\n";
                                    $messageCliente .= "<b>La prenotazione deve essere confermata dall'ufficio prenotazioni.</b>\n";
                                    $messageCliente .= "Riceverai una conferma via e-mail entro qualche giorno lavorativo.\n\n";
                                    $messageCliente .= "Codice Prenotazione: $codicePrenotazione\n";
                                    $messageCliente .= "Nome e cognome: $nomeCognome\n";
                                    $messageCliente .= "\nRiepilogo Prenotazione:\n";
                                    $messageCliente .= "- Settimana1 ($date_settimana1) -> Cod. Ombrelloni Prenotati: $lettini_week1\n\n";
                                    if ($numWeeks >= 2) {
                                        $messageCliente .= "- Settimana2 ($date_settimana2) -> Cod. Ombrelloni Prenotati: $lettini_week2\n\n";
                                    }
                                    if ($numWeeks >= 3) {
                                        $messageCliente .= "- Settimana3 ($date_settimana3) -> Cod. Ombrelloni Prenotati: $lettini_week3\n\n";
                                    }
                                    $messageCliente .= "Grazie.";
                                    $messageCliente .= "\nUn saluto dallo staff.\n\nPer maggiori informazioni o richieste, contattaci via email a info@bibioneresidence.it.";
                                    break;

                                case 'ENG':
                                    $subjectCliente  = "Reservation Request Received [$codicePrenotazione]";
                                    $messageCliente .= "Dear $nomeCognome,\n\n";
                                    $messageCliente .= "Your reservation request has been sent successfully.\n";
                                    $messageCliente .= "<b>The booking must be confirmed by the reservations office.</b>\n";
                                    $messageCliente .= "You will receive a confirmation email within a few working days.\n\n";
                                    $messageCliente .= "Reservation Code: $codicePrenotazione\n";
                                    $messageCliente .= "Name and Surname: $nomeCognome\n";
                                    $messageCliente .= "\nBooking Summary:\n";
                                    $messageCliente .= "- Week1 ($date_settimana1) -> Booked Parasol Codes: $lettini_week1\n\n";
                                    if ($numWeeks >= 2) {
                                        $messageCliente .= "- Week2 ($date_settimana2) -> Booked Parasol Codes: $lettini_week2\n\n";
                                    }
                                    if ($numWeeks >= 3) {
                                        $messageCliente .= "- Week3 ($date_settimana3) -> Booked Parasol Codes: $lettini_week3\n\n";
                                    }
                                    $messageCliente .= "Thank you.";
                                    $messageCliente .= "\n\nBest regards from our staff.\n\nFor more information or requests, please contact us via email at info@bibioneresidence.it.";

                                    break;

                                case 'DEU':
                                    $subjectCliente  = "Buchungsanfrage erhalten [$codicePrenotazione]";
                                    $messageCliente .= "Hallo $nomeCognome,\n\n";
                                    $messageCliente .= "Ihre Buchungsanfrage wurde erfolgreich gesendet.\n";
                                    $messageCliente .= "<b>Die Buchung muss noch vom Reservierungsbüro bestätigt werden.</b>\n";
                                    $messageCliente .= "Sie erhalten innerhalb weniger Werktage eine Bestätigung per E-Mail.\n\n";
                                    $messageCliente .= "Buchungscode: $codicePrenotazione\n";
                                    $messageCliente .= "Name und Nachname: $nomeCognome\n";
                                    $messageCliente .= "\nBuchungsübersicht:\n";
                                    $messageCliente .= "- Woche1 ($date_settimana1) -> Gebuchte Sonnenschirm-Codes: $lettini_week1\n\n";
                                    if ($numWeeks >= 2) {
                                        $messageCliente .= "- Woche2 ($date_settimana2) -> Gebuchte Sonnenschirm-Codes: $lettini_week2\n\n";
                                    }
                                    if ($numWeeks >= 3) {
                                        $messageCliente .= "- Woche3 ($date_settimana3) -> Gebuchte Sonnenschirm-Codes: $lettini_week3\n\n";
                                    }
                                    $messageCliente .= "Vielen Dank.";
                                    $messageCliente .= "\n\nMit freundlichen Grüßen vom Team.\n\nFür weitere Informationen oder Anfragen kontaktieren Sie uns bitte per E-Mail unter info@bibioneresidence.it.";

                                    break;

                                default:
                                    // Default ITA
                                    $subjectCliente  = "Richiesta di prenotazione ricevuta [$codicePrenotazione]";
                                    $messageCliente .= "Gentile $nomeCognome,\n\n";
                                    $messageCliente .= "La tua richiesta di prenotazione è stata inviata correttamente.\n";
                                    $messageCliente .= "<b>La prenotazione deve essere confermata dall'ufficio prenotazioni.</b>\n";
                                    $messageCliente .= "Riceverai una conferma via e-mail entro qualche giorno lavorativo.\n\n";
                                    $messageCliente .= "Codice Prenotazione: $codicePrenotazione\n";
                                    $messageCliente .= "Nome e cognome: $nomeCognome\n";
                                    $messageCliente .= "\nRiepilogo Prenotazione:\n";
                                    $messageCliente .= "- Settimana1 ($date_settimana1) -> Cod. Ombrelloni Prenotati: $lettini_week1\n\n";
                                    if ($numWeeks >= 2) {
                                        $messageCliente .= "- Settimana2 ($date_settimana2) -> Cod. Ombrelloni Prenotati: $lettini_week2\n\n";
                                    }
                                    if ($numWeeks >= 3) {
                                        $messageCliente .= "- Settimana3 ($date_settimana3) -> Cod. Ombrelloni Prenotati: $lettini_week3\n\n";
                                    }
                                    $messageCliente .= "Grazie.";
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
                                $mailClient->addAddress($email, $nomeCognome);

                                $mailClient->isHTML(true);
                                $mailClient->Subject = $subjectCliente;
                                $mailClient->Body    = nl2br($messageCliente);
                                $mailClient->AltBody = $messageCliente;

                                $mailClient->send();
                            } catch (Exception $e) {
                                // echo "Errore mail cliente: " . $mailClient->ErrorInfo;
                            }
                        } else {
                            // Errore inserimento prenotazione
                            die("<p style='color: red;font-size: xx-large;'>WARNING: An error occurred while saving the booking: "
                                . $stmt->error . "</p><br>"
                                . "<p style='color: red;'>Please contact us via email at info@bibioneresidence.it to report and resolve the issue.</p>");
                        }

                        $stmt->close();
                        closedbConnection($conn);
                    }
                    ?>

                    <!-- Tasto per tornare alla home -->
                    <a href="https://<?php echo $domain; ?>">
                        <button type="button"
                            style="margin-top:30px;width:164px; padding: 5px; background-color:rgb(195, 195, 195); 
                                       border: none; border-radius: 0px !important; font-size: 16px; 
                                       font-weight: 600; color: white;">
                            BACK TO HOME
                        </button>
                    </a>

                    <?php
                    // // ======================
                    // // SEZIONE DI DEBUG
                    // // ======================
                    // echo "<hr>";
                    // echo "<p><strong>Codice Prenotazione:</strong> $codicePrenotazione</p>";
                    // echo "<p><strong>Nome e Cognome:</strong> $nomeCognome</p>";
                    // echo "<p><strong>Indirizzo Email:</strong> $email</p>";
                    // echo "<p><strong>N. di Telefono:</strong> $telefono</p>";
                    // echo "<p><strong>Lingua:</strong> $language</p>";
                    // echo "<br>";

                    // echo "<p><strong>Mese prima settimana:</strong> $month</p>";
                    // echo "<p><strong>Anno prima settimana:</strong> $year</p>";
                    // echo "<br>";

                    // echo "<p><strong>Settimane Prenotate:</strong> $numWeeks</p>";
                    // echo "<br>";

                    // // SETTIMANA 1
                    // echo "<p>SETTIMANA 1</p>";
                    // echo "<p><strong>ID settimana:</strong> $id_settimana1</p>";
                    // echo "<p><strong>Settimana prenotata:</strong> $date_settimana1</p>";
                    // echo "<p><strong>Posti (lettini):</strong> $lettini_week1</p>";
                    // echo "<br>";

                    // // SETTIMANA 2
                    // echo "<p>SETTIMANA 2</p>";
                    // echo "<p><strong>ID settimana:</strong> $id_settimana2</p>";
                    // echo "<p><strong>Settimana prenotata:</strong> $date_settimana2</p>";
                    // echo "<p><strong>Posti (lettini):</strong> $lettini_week2</p>";
                    // echo "<br>";

                    // // SETTIMANA 3
                    // echo "<p>SETTIMANA 3</p>";
                    // echo "<p><strong>ID settimana:</strong> $id_settimana3</p>";
                    // echo "<p><strong>Settimana prenotata:</strong> $date_settimana3</p>";
                    // echo "<p><strong>Posti (lettini):</strong> $lettini_week3</p>";
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