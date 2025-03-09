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


// ======================
// 3) INCLUDE DEI TUOI FILE DI PROGETTO
// ======================
include 'class/POST.php';
include 'class/MYSQL.php';
include 'assets/layout/header2.php';


// ======================
// 4) RECUPERO VARIABILI DA $_POST
// ======================
function nullable($value)
{
    return ($value === NULL || $value === "") ? NULL : $value;
}

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

// Numero settimane: puoi dedurlo da quante id_settimana e date sono passate o da un apposito $_POST['numWeeks']
$numWeeks = 1;
if (!empty($id_settimana2)) $numWeeks = 2;
if (!empty($id_settimana3)) $numWeeks = 3;

// ======================
// 5) ELABORAZIONE LOGICA DI AGGIORNAMENTO PRENOTAZIONE
// ======================
?>

<body>
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <main style="padding-bottom:100px;">
            <div class="row g-5">
                <div class="col-md-12">
                    <h2 class="text-body-emphasis">Conferma Riprogrammazione Prenotazione</h2>
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
                        echo "<p style='color: #ff6666; font-size: xx-large;font-weight: 700;'>ATTENZIONE: Questo codice prenotazione risulta già caricato!</p>";
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
                            echo "<p style='color: #72c772;font-size: xxx-large;font-weight: bold;'>La prenotazione e' stata inserita con successo!</p>";

                        // ======================
                        // 6) SE L'UPDATE È RIUSCITO, INVIA MAIL A CLIENTE E AMMINISTRAZIONE
                        // ======================

                        // -- A) Prepariamo mail per l'AMMINISTRAZIONE
                        $oggettoAdmin = "Nuova Prenotazione [cod. $codicePrenotazione]";
                        // Esempio di testo mail, puoi modificarlo a tuo piacere
                        $messaggioAdmin  = "Buongiorno,\n";
                        $messaggioAdmin .= "Ti confermiamo l'inserimento della prenotazione con codice $codicePrenotazione.\n\n";
                        $messaggioAdmin .= "Cliente: $nomeCognome\n";
                        $messaggioAdmin .= "Email: $emailCliente\n";
                        $messaggioAdmin .= "Telefono: $telefono\n\n";
                        $messaggioAdmin .= "Dati prenotazione:\n";
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
                            case 'ITA':
                                $subjectCliente  = "Prenotazione inserita a sistema [Cod. $codicePrenotazione]";
                                $messageCliente .= "Gentile $nomeCognome,\n\n";
                                $messageCliente .= "La informiamo che la sua prenotazione con Bibione Residence Apartments e' stata correttamente inserita a sistema.\n\n";
                                $messageCliente .= "Codice Prenotazione: $codicePrenotazione\n";
                                $messageCliente .= "Nome e cognome: $nomeCognome\n";
                                $messageCliente .= "\nRiepilogo Prenotazione:\n";
                                $messageCliente .= "- SETTIMANA 1 ($date_settimana1) -> Cod. Ombrelloni Prenotati: $lettini_week1\n\n";
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- SETTIMANA 2 ($date_settimana2) -> Cod. Ombrelloni Prenotati: $lettini_week2\n\n";
                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- SETTIMANA 3 ($date_settimana3) -> Cod. Ombrelloni Prenotati: $lettini_week3\n\n";
                                }
                                $messageCliente .= "Grazie.";
                                $messageCliente .= "\nUn saluto dallo staff.\n\nPer maggiori informazioni o richieste, contattaci via email a info@bibioneresidence.it.";
                                break;

                            case 'ENG':
                                $subjectCliente  = "Booking successfully registered [Code: $codicePrenotazione]";
                                $messageCliente .= "Dear $nomeCognome,\n\n";
                                $messageCliente .= "We inform you that your reservation with Bibione Residence Apartments has been successfully registered in our system.\n\n";
                                $messageCliente .= "Booking Code: $codicePrenotazione\n";
                                $messageCliente .= "Full Name: $nomeCognome\n";
                                $messageCliente .= "\nBooking Summary:\n";
                                $messageCliente .= "- WEEK 1 ($date_settimana1) -> Reserved Beach Umbrella Codes: $lettini_week1\n\n";
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- WEEK 2 ($date_settimana2) -> Reserved Beach Umbrella Codes: $lettini_week2\n\n";
                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- WEEK 3 ($date_settimana3) -> Reserved Beach Umbrella Codes: $lettini_week3\n\n";
                                }
                                $messageCliente .= "Thank you.";
                                $messageCliente .= "\nBest regards,\n\nFor more information or requests, contact us via email at info@bibioneresidence.it.";
                                break;


                            case 'DEU':
                                $subjectCliente  = "Reservierung im System erfasst [Code: $codicePrenotazione]";
                                $messageCliente .= "Sehr geehrte/r $nomeCognome,<br><br>";
                                $messageCliente .= "Wir informieren Sie, dass Ihre Reservierung bei Bibione Residence Apartments erfolgreich im System erfasst wurde.<br><br>";
                                $messageCliente .= "Reservierungsnummer: $codicePrenotazione<br>";
                                $messageCliente .= "Name und Nachname: $nomeCognome<br><br>";
                                $messageCliente .= "<b>Reservierungs&uuml;bersicht:</b><br>";
                                $messageCliente .= "- WOCHE 1 ($date_settimana1) -> Reservierte Strandsonnenschirm-Codes: $lettini_week1<br><br>";
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- WOCHE 2 ($date_settimana2) -> Reservierte Strandsonnenschirm-Codes: $lettini_week2<br><br>";
                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- WOCHE 3 ($date_settimana3) -> Reservierte Strandsonnenschirm-Codes: $lettini_week3<br><br>";
                                }
                                $messageCliente .= "Vielen Dank.<br>";
                                $messageCliente .= "<br>Mit freundlichen Gr&uuml;&szlig;en,<br><br>F&uuml;r weitere Informationen oder Anfragen kontaktieren Sie uns per E-Mail unter <a href='mailto:info@bibioneresidence.it'>info@bibioneresidence.it</a>.";
                                
                                break;

                            default:
                                // Default ITA
                                $subjectCliente  = "Prenotazione inserita a sistema [Cod. $codicePrenotazione]";
                                $messageCliente .= "Gentile $nomeCognome,\n\n";
                                $messageCliente .= "La informiamo che la sua prenotazione con Bibione Residence Apartments e' stata correttamente inserita a sistema.\n\n";
                                $messageCliente .= "Codice Prenotazione: $codicePrenotazione\n";
                                $messageCliente .= "Nome e cognome: $nomeCognome\n";
                                $messageCliente .= "\nRiepilogo Prenotazione:\n";
                                $messageCliente .= "- SETTIMANA 1 ($date_settimana1) -> Cod. Ombrelloni Prenotati: $lettini_week1\n\n";
                                if ($numWeeks >= 2) {
                                    $messageCliente .= "- SETTIMANA 2 ($date_settimana2) -> Cod. Ombrelloni Prenotati: $lettini_week2\n\n";
                                }
                                if ($numWeeks >= 3) {
                                    $messageCliente .= "- SETTIMANA 3 ($date_settimana3) -> Cod. Ombrelloni Prenotati: $lettini_week3\n\n";
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
                }   

                ?>

                <!-- Tasto di ritorno all'admin -->
                <a href="https://<?php echo $backend?>">
                        <button type="button" style="margin-top:30px;width:164px; padding: 5px; background-color:rgb(195, 195, 195); border: none; border-radius: 0px !important;font-size: 16px; font-weight: 600; color: white;">TORNA AL PANNELLO ADMIN</button>
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