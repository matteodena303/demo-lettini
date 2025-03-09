<?php $nascondi_lingua = "nascondi"; ?>
<?php include 'class/MYSQL.php'; ?>
<?php include 'assets/layout/header2.php'; ?>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Elimina stringhe vuote / spazi / "-" dai lettini e li unisce con virgole
function formattaLettini($l1, $l2, $l3)
{
    // Per evitare l'errore su null, convertiamo ogni valore in stringa:
    $tutti = array_map(function ($val) {
        return trim((string) $val);
    }, [$l1, $l2, $l3]);

    // Ora filtra valori vuoti e trattini
    $tuttiFiltrati = array_filter($tutti, function ($val) {
        return ($val !== '' && $val !== '-');
    });

    // Se dopo il filtro non c'è nulla, restituisci stringa vuota (o "-")
    return $tuttiFiltrati ? implode(", ", $tuttiFiltrati) : "";
}
// $codice_pren = "PREN005";
if (!empty($_POST['codice_prenotazione'])) {
    $codice_pren = $_POST['codice_prenotazione'];
    $dettagliPrenotazione = getReservationAndClientData($codice_pren);
}

// Dati iniziali presi da $dettagliPrenotazione
$codicePrenotazione = isset($dettagliPrenotazione['codice_prenotazione']) ? $dettagliPrenotazione['codice_prenotazione'] : '';
$nomeCognome = isset($dettagliPrenotazione['nome_cliente']) ? $dettagliPrenotazione['nome_cliente'] : '';
$email = isset($dettagliPrenotazione['email']) ? $dettagliPrenotazione['email'] : '';
$telefono = isset($dettagliPrenotazione['telefono']) ? $dettagliPrenotazione['telefono'] : '';
$language = isset($dettagliPrenotazione['lingua']) ? $dettagliPrenotazione['lingua'] : '';


$id_settimana1_old = $dettagliPrenotazione['id_settimana1'] ?? '';
$posto1week1_old = $dettagliPrenotazione['lettino1_sett1'] ?? '';
$posto2week1_old = $dettagliPrenotazione['lettino2_sett1'] ?? '';
$posto3week1_old = $dettagliPrenotazione['lettino3_sett1'] ?? '';
$postiWeek1_old = formattaLettini($posto1week1_old, $posto2week1_old, $posto3week1_old);

$id_settimana2_old = $dettagliPrenotazione['id_settimana2'] ?? '';
$posto1week2_old = $dettagliPrenotazione['lettino1_sett2'] ?? '';
$posto2week2_old = $dettagliPrenotazione['lettino2_sett2'] ?? '';
$posto3week2_old = $dettagliPrenotazione['lettino3_sett2'] ?? '';
$postiWeek2_old = formattaLettini($posto1week2_old, $posto2week2_old, $posto3week2_old);


$id_settimana3_old = $dettagliPrenotazione['id_settimana3'] ?? '';
$posto1week3_old = $dettagliPrenotazione['lettino1_sett3'] ?? '';
$posto2week3_old = $dettagliPrenotazione['lettino2_sett3'] ?? '';
$posto3week3_old = $dettagliPrenotazione['lettino3_sett3'] ?? '';
$postiWeek3_old = formattaLettini($posto1week3_old, $posto2week3_old, $posto3week3_old);

$numWeeks_old = 1;
$date_settimana1_old = getWeekById($id_settimana1_old);

if (!empty($date_settimana1_old)) {
    $inizio_settimana1_old = date("d-m-Y", strtotime($date_settimana1_old['inizio_settimana']));
    $fine_settimana1_old = date("d-m-Y", strtotime($date_settimana1_old['fine_settimana']));
    $date_settimana1_old = "$inizio_settimana1_old - $fine_settimana1_old";
}

// Impostazione numero di settimane e date
$numWeeks_old = 1;
$date_settimana1_old = getWeekById($id_settimana1_old);
if ($date_settimana1_old) {
    $date_settimana1_old = date("d-m-Y", strtotime($date_settimana1_old['inizio_settimana'])) . " - " . date("d-m-Y", strtotime($date_settimana1_old['fine_settimana']));
}

if (!empty($id_settimana2_old)) {
    $numWeeks_old = 2;
    $date_settimana2_old = getWeekById($id_settimana2_old);
    if ($date_settimana2_old) {
        $date_settimana2_old = date("d-m-Y", strtotime($date_settimana2_old['inizio_settimana'])) . " - " . date("d-m-Y", strtotime($date_settimana2_old['fine_settimana']));
    }
} else {
    $date_settimana2_old = "";
}

if (!empty($id_settimana3_old)) {
    $numWeeks_old = 3;
    $date_settimana3_old = getWeekById($id_settimana3_old);
    if ($date_settimana3_old) {
        $date_settimana3_old = date("d-m-Y", strtotime($date_settimana3_old['inizio_settimana'])) . " - " . date("d-m-Y", strtotime($date_settimana3_old['fine_settimana']));
    }
} else {
    $date_settimana3_old = "";
}


// Se il form è stato inviato, sovrascrivi con i nuovi dati
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codicePrenotazione = isset($_POST['codicePrenotazione']) ? $_POST['codicePrenotazione'] : $codicePrenotazione;
    $nomeCognome = isset($_POST['nomeCognome']) ? $_POST['nomeCognome'] : $nomeCognome;
    $email = isset($_POST['email']) ? $_POST['email'] : $email;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : $telefono;
    $language = isset($_POST['lang']) ? $_POST['lang'] : $language;

    
    $numWeeks_old = isset($_POST['numWeeks_old']) ? $_POST['numWeeks_old'] : $numWeeks_old;

    // settimana1
    $id_settimana1_old = isset($_POST['id_settimana1_old']) ? $_POST['id_settimana1_old'] : $id_settimana1_old;
    $date_settimana1_old = isset($_POST['date_settimana1_old']) ? $_POST['date_settimana1_old'] : $date_settimana1_old;
    $postiWeek1_old = isset($_POST['postiWeek1_old']) ? $_POST['postiWeek1_old'] : $postiWeek1_old;

    // settimana2
    $id_settimana2_old = isset($_POST['id_settimana2_old']) ? $_POST['id_settimana2_old'] : $id_settimana2_old;
    $date_settimana2_old = isset($_POST['date_settimana2_old']) ? $_POST['date_settimana2_old'] : $date_settimana2_old;
    $postiWeek2_old = isset($_POST['postiWeek2_old']) ? $_POST['postiWeek2_old'] : $postiWeek2_old;

    // settimana3
    $id_settimana3_old = isset($_POST['id_settimana3_old']) ? $_POST['id_settimana3_old'] : $id_settimana3_old;
    $date_settimana3_old = isset($_POST['date_settimana3_old']) ? $_POST['date_settimana3_old'] : $date_settimana3_old;
    $postiWeek3_old = isset($_POST['postiWeek3_old']) ? $_POST['postiWeek3_old'] : $postiWeek3_old;
}

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';





// if ($dettagliPrenotazione) {
//     // Qui trovi i campi della prenotazione e del cliente
//     echo "<pre>";
//     print_r($dettagliPrenotazione);
//     echo "</pre>";
// } else {
//     echo "Nessuna prenotazione trovata per il codice: $codicePren";
// }
?>

<body>
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <main>
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="form-container">
                        <h2 class="text-body-emphasis">Riprogramma la prenotazione</h2>
                        <p class="form-bold">STEP 1<br><br></p>

                        <!-- Inizio del modulo -->
                        <form method="POST" id="mainForm">

                            <div style="font-size:14px;line-height: 16px;">

                                <!-- Campo per il codice prenotazione -->
                                <?php
                                echo "<p style='margin:4px'><strong>Codice Prenotazione:</strong> $codicePrenotazione </p>";
                                echo "<p style='margin:4px'><strong>Cliente:</strong> $nomeCognome </p>";
                                echo "<p style='margin:4px; color:#ff5a5a;'><strong>Qt.à Settimane Prenotate:</strong> $numWeeks_old </p>";


                                echo "<p style='margin:4px; color:#ff5a5a;'><strong>Settimana1:</strong> $date_settimana1_old </p>";
                                echo "<p style='margin:4px; color:#ff5a5a;'><strong>Lettini Prenotati:</strong> $postiWeek1_old </p>";

                                if ($numWeeks_old >= 2) {
                                    echo "<p style='margin:4px; color:#ff5a5a;'><strong>Settimana2:</strong>  $date_settimana2_old</p>";
                                    echo "<p style='margin:4px; color:#ff5a5a;'><strong>Lettini Prenotati:</strong> $postiWeek2_old </p>";
                                }

                                if ($numWeeks_old == 3) {
                                    echo "<p style='margin:4px; color:#ff5a5a;'><strong>Settimana3:</strong>  $date_settimana3_old</p>";
                                    echo "<p style='margin:4px; color:#ff5a5a;'><strong>Lettini Prenotati:</strong> $postiWeek3_old </p>";
                                }


                                ?>
                            </div>


                            <div class="spacer"></div>

                            <!-- Selezione del mese e dell'anno -->
                            <label for="month">Mese/Anno</label>
                            <select id="month" name="month" class="selector-date" onchange="resetNumWeeks(); updateForm()">
                                <?php
                                setlocale(LC_TIME, 'it_IT.UTF-8', 'Italian');

                                $currentYear = date('Y'); // Anno corrente
                                $currentMonth = (date('n') >= 5 && date('n') <= 9) ? date('n') : 5;
                                $selectedYear = isset($_POST['year']) ? $_POST['year'] : $currentYear; // Anno selezionato
                                $selectedMonth = isset($_POST['month']) ? $_POST['month'] : $currentMonth; // Mese selezionato

                                // Generazione dinamica dei mesi disponibili
                                for ($i = 5; $i <= 9; $i++) {
                                    if ($selectedYear == $currentYear && $i < $currentMonth) {
                                        continue; // Salta i mesi precedenti a quello corrente
                                    }
                                    echo '<option value="' . $i . '"' . ($i == $selectedMonth ? ' selected' : '') . '>' .
                                        strtoupper(strftime('%B', mktime(0, 0, 0, $i, 1))) . '</option>';
                                }
                                ?>
                            </select>

                            <!-- Selezione dell'anno -->
                            <select id="year" name="year" class="selector-date" onchange="resetNumWeeks(); updateForm()">
                                <?php
                                echo '<option value="' . $currentYear . '"' . ($currentYear == $selectedYear ? ' selected' : '') . '>' . $currentYear . '</option>';
                                echo '<option value="' . ($currentYear + 1) . '"' . (($currentYear + 1) == $selectedYear ? ' selected' : '') . '>' . ($currentYear + 1) . '</option>';
                                ?>
                            </select>

                            <!-- Selezione della settimana prenotata -->
                            <label for="weeks">Settimana Prenotata <small>[da Sabato a Venerdì]</small></label>
                            <select id="weeks" name="id_settimana1" class="selector-date" onchange="updateForm()">
                                <?php
                                // Recupera il mese e l'anno selezionati
                                $selectedYear = isset($_POST['year']) ? $_POST['year'] : date('Y');
                                $currentMonth = (date('n') >= 5 && date('n') <= 9) ? date('n') : 5;


                                // Funzione per ottenere le settimane disponibili
                                $result = getAvailableWeeks($selectedYear, $selectedMonth);


                                // Controlla se ci sono risultati
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Formatto le date inizio e fine nel formato richiesto
                                        $inizio = date("d/m/y", strtotime($row['inizio_settimana']));
                                        $fine = date("d/m/y", strtotime($row['fine_settimana']));
                                        $settimana = "$inizio - $fine";

                                        // Imposta la settimana selezionata
                                        $selectedWeek = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : $row['id_settimana'];

                                        echo '<option value="' . $row['id_settimana'] . '"' . ($row['id_settimana'] == $selectedWeek ? ' selected' : '') . '>' . $settimana . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Nessuna settimana disponibile</option>';
                                }
                                ?>
                            </select>

                            <!-- Selezione delle settimane aggiuntive -->
                            <div id="additionalWeeks">
                                <?php
                                if (isset($_POST['numWeeks']) && isset($_POST['id_settimana1'])) {
                                    $numWeeks = intval($_POST['numWeeks']);
                                    $selectedWeekId = intval($_POST['id_settimana1']); // ID della prima settimana selezionata


                                    //Funzione per ottenere settimane successive
                                    $result = getAdditionalWeeks($selectedWeekId, $numWeeks);


                                    if ($result->num_rows > 0) {
                                        $weekNumber = 2;
                                        while ($row = $result->fetch_assoc()) {
                                            $inizio = date("d/m/y", strtotime($row['inizio_settimana']));
                                            $fine = date("d/m/y", strtotime($row['fine_settimana']));
                                            $settimana = "$inizio - $fine";

                                            echo '<label>Settimana ' . $weekNumber . ':</label>';
                                            echo '<select name="id_settimana' . $weekNumber . '" class="selector-date no-arrow">';
                                            echo '<option value="' . $row['id_settimana'] . '">' . $settimana . '</option>';
                                            echo '</select><br>';

                                            $weekNumber++;
                                        }
                                    }
                                }
                                ?>
                            </div>

                            <!-- Selezione del numero di settimane prenotate -->
                            <label for="numWeeks">Q.tà Settimane Prenotate</label>
                            <select id="numWeeks" name="numWeeks" class="selector-date" onchange="updateForm()">
                                <option value="1" <?php echo (isset($_POST['numWeeks']) && $_POST['numWeeks'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo (isset($_POST['numWeeks']) && $_POST['numWeeks'] == 2) ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo (isset($_POST['numWeeks']) && $_POST['numWeeks'] == 3) ? 'selected' : ''; ?>>3</option>
                            </select>

                            <div class="spacer"></div>



                            <div class="spacer"></div>

                            <!-------------------------------------->
                            <!-------- INVIO INFO IN POST ---------->
                            <!-------------------------------------->
                            <!-------- INFO CLIENTE ---------->
                            <input type="hidden" id="codicePrenotazione" name="codicePrenotazione" value="<?php echo $codicePrenotazione; ?>">
                            <input type="hidden" id="nomeCognome" name="nomeCognome" value="<?php echo $nomeCognome; ?>">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="telefono" value="<?php echo $telefono; ?>">
                            <input type="hidden" name="lang" value="<?php echo $language; ?>">

                            <input type="hidden" id="numWeeks_old" name="numWeeks_old" value="<?php echo $numWeeks_old; ?>">

                            <!-------- SETTIMANA 1 ---------->
                            <input type="hidden" name="id_settimana1_old" value="<?php echo $id_settimana1_old; ?>">
                            <input type="hidden" name="date_settimana1_old" value="<?php echo $date_settimana1_old; ?>">
                            <input type="hidden" name="postiWeek1_old" value="<?php echo $postiWeek1_old; ?>">

                            <!-------- SETTIMANA 2 ---------->
                            <input type="hidden" name="id_settimana2_old" value="<?php echo $id_settimana2_old; ?>">
                            <input type="hidden" name="date_settimana2_old" value="<?php echo $date_settimana2_old; ?>">
                            <input type="hidden" name="postiWeek2_old" value="<?php echo $postiWeek2_old; ?>">

                            <!-------- SETTIMANA 3 ---------->
                            <input type="hidden" name="id_settimana3_old" value="<?php echo $id_settimana3_old; ?>">
                            <input type="hidden" name="date_settimana3_old" value="<?php echo $date_settimana3_old; ?>">
                            <input type="hidden" name="postiWeek3_old" value="<?php echo $postiWeek3_old; ?>">




                            <!-- Pulsante per procedere alla selezione del posto -->
                            <button type="button" onclick="submitForm()">PROSEGUI →</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php include 'playa-planta.php'; ?> <!-- Include contenuto aggiuntivo -->
                </div>
            </div>
        </main>

    </div>
</body>


<?php include 'assets/layout/footer.php'; ?>


<!-- Script JavaScript -->
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Funzione per resettare il numero di settimane
    function resetNumWeeks() {
        document.getElementById('numWeeks').value = 1;
    }

    // Funzione per aggiornare il form
    function updateForm() {
        document.getElementById('mainForm').action = "";
        document.getElementById('mainForm').submit();
    }

    // Funzione per inviare il form
    function submitForm() {
        // Se tutti i controlli sono superati, invia il modulo
        document.getElementById('mainForm').action = "riprogramma-week1.php";
        document.getElementById('mainForm').submit();
    }
</script>


</html>