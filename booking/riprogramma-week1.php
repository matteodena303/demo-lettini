<?php include 'class/POST.php'; ?>
<?php include 'class/MYSQL.php'; ?>
<?php include 'assets/layout/header2.php'; ?>

<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


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

// echo '<pre>';
// print_r($postiWeek1_old);
// echo '</pre>';

// Lettini Prenotati
$lettini_prenotati = getLettiniPrenotati($id_settimana1);
// echo '<pre>';
// print_r($lettini_prenotati);
// echo '</pre>';


// Converto la stringa dei lettini della vecchia prenotazione in un array
$codici_da_rimuovere = array_map('trim', explode(',', $postiWeek1_old));

// Rimuovo i codici della vecchia prenotazione dalla lista dei prenotati
$lettini_prenotati = array_values(array_diff($lettini_prenotati, $codici_da_rimuovere));

// Output del nuovo array
// echo '<pre>';
// print_r($lettini_prenotati);
// echo '</pre>';

// echo "<br>";

// Lista Lettini
$lettini = getAllLettini();
// print_r($lettini);

// Filtriamo i lettini rimuovendo quelli prenotati
$lettini_disponibili = array_filter($lettini, function ($lettino) use ($lettini_prenotati) {
    return !in_array($lettino['codice_lettino'], $lettini_prenotati);
});

// Reindicizziamo l'array lettini disponibili
$lettini_disponibili = array_values($lettini_disponibili);
// print_r($lettini_disponibili);
?>


<body>
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <main>
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="form-container">

                        <h2 class="text-body-emphasis">Scegli gli ombrelloni della prima settimana</h2>
                        <p class="form-bold">STEP 2<br><br></p>

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

                        <?php

                        // Mostra i dati del modulo per conferma
                        $date_settimana1 = getFormattedWeekRange($id_settimana1);
                        echo "<p style=\"margin:4px; padding-TOP:6px\"><strong>NUOVA PRENOTAZIONE:</strong></p>";
                        if ($numWeeks == 1) {
                            echo "<p style=\"margin:4px; color: #f29240;\"><strong>Date Prenotazione:</strong> $date_settimana1</p>";
                        }
                        if ($date_settimana2 != "") {
                            $date_settimana2 = getFormattedWeekRange($id_settimana2);
                            echo "<p style=\"margin:4px; color: #f29240;\"><strong>SETTIMANA 1:</strong> $date_settimana1</p>";
                            echo "<p style=\"margin:4px\"><strong>SETTIMANA 2:</strong> $date_settimana2</p>";
                        }
                        if ($date_settimana3 != "") {
                            $date_settimana3 = getFormattedWeekRange($id_settimana3);
                            echo "<p style=\"margin:4px\"><strong>SETTIMANA 3:</strong> $date_settimana3</p>";
                        }
                        ?>

                        <div class="spacer"></div>

                        <form method="POST" action="confermaPrenotazione.php" id="mainForm">


                            <label for="nlettini_settimana1">Seleziona la q.tà di Ombrelloni</label>
                            <select id="nlettini_settimana1" name="nlettini_settimana1" class="selector-date" onchange="updateForm()">
                                <option value="1" <?php echo (isset($_POST['nlettini_settimana1']) && $_POST['nlettini_settimana1'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo (isset($_POST['nlettini_settimana1']) && $_POST['nlettini_settimana1'] == 2) ? 'selected' : ''; ?>>2 (+70€)</option>
                                <option value="3" <?php echo (isset($_POST['nlettini_settimana1']) && $_POST['nlettini_settimana1'] == 3) ? 'selected' : ''; ?>>3 (+140€)</option>
                            </select>

                            <div class="spacer"></div>

                            <div class="posto1week1-selection">
                                <?php
                                if ($numWeeks == 1) {
                                    echo "<label for=\"posto1week1\">Seleziona l'ombrellone:</label>";
                                } else {
                                    echo "<label for=\"posto1week1\">Seleziona l'ombrellone per la prima settimana:</label>";
                                }
                                ?>

                                <select id="posto1week1" name="posto1week1" onchange="updateOptions(this)">
                                    <?php
                                    // Prendere i primi 3 lettini come pre-selezione
                                    $selectedLettini = array_slice($lettini_disponibili, 0, 3);

                                    foreach ($lettini_disponibili as $lettino) {
                                        $codice = $lettino['codice_lettino'];
                                        $fila = $lettino['fila'];
                                        $sovraprezzo = intval($lettino['sovraprezzo']); // Convertire il sovrapprezzo in intero

                                        // Formattazione della voce nel menu a tendina
                                        $prezzoExtra = ($sovraprezzo > 0) ? " (+{$sovraprezzo}€)" : "";
                                        $label = "FILA $fila - Ombrellone $codice$prezzoExtra";

                                        // Controlla se il lettino deve essere pre-selezionato
                                        $selected = ($codice == $selectedLettini[0]['codice_lettino']) ? 'selected' : '';

                                        echo "<option value='$codice' $selected>$label</option>";
                                    }
                                    ?>
                                </select>


                            </div>

                            <div id="additionalOmbrelloni">
                                <?php
                                if (isset($_POST['nlettini_settimana1'])) {
                                    $n_ombrelloni = $_POST['nlettini_settimana1'];

                                    if ($n_ombrelloni >= 2) {
                                        echo "<label for=\"posto2week1\">Seleziona l'ombrellone aggiuntivo:</label>";
                                        echo "<select id=\"posto2week1\" name=\"posto2week1\" onchange=\"updateOptions(this)\">";

                                        foreach ($lettini_disponibili as $lettino) {
                                            $codice = $lettino['codice_lettino'];
                                            $fila = $lettino['fila'];
                                            $sovraprezzo = intval($lettino['sovraprezzo']); // Convertire il sovrapprezzo in intero

                                            // Formattazione della voce nel menu a tendina
                                            $prezzoExtra = ($sovraprezzo > 0) ? " (+{$sovraprezzo}€)" : "";
                                            $label = "FILA $fila - Ombrellone $codice$prezzoExtra";

                                            // Pre-seleziona il secondo ombrellone disponibile
                                            $selected = (isset($selectedLettini[1]) && $codice == $selectedLettini[1]['codice_lettino']) ? 'selected' : '';

                                            echo "<option value='$codice' $selected>$label</option>";
                                        }

                                        echo "</select>";
                                    }

                                    if ($n_ombrelloni == 3) {
                                        echo "<label for=\"posto3week1\">Seleziona l'ombrellone aggiuntivo 2:</label>";
                                        echo "<select id=\"posto3week1\" name=\"posto3week1\" onchange=\"updateOptions(this)\">";

                                        foreach ($lettini_disponibili as $lettino) {
                                            $codice = $lettino['codice_lettino'];
                                            $fila = $lettino['fila'];
                                            $sovraprezzo = intval($lettino['sovraprezzo']); // Convertire il sovrapprezzo in intero

                                            // Formattazione della voce nel menu a tendina
                                            $prezzoExtra = ($sovraprezzo > 0) ? " (+{$sovraprezzo}€)" : "";
                                            $label = "FILA $fila - Ombrellone $codice$prezzoExtra";

                                            // Pre-seleziona il terzo ombrellone disponibile
                                            $selected = (isset($selectedLettini[2]) && $codice == $selectedLettini[2]['codice_lettino']) ? 'selected' : '';

                                            echo "<option value='$codice' $selected>$label</option>";
                                        }

                                        echo "</select>";
                                    }
                                }
                                ?>
                            </div>

                            <!-------------------------------------->
                            <!-------- INVIO INFO IN POST ---------->
                            <!-------------------------------------->

                            <!-------- INFO CLIENTE ---------->
                            <input type="hidden" name="codicePrenotazione" value="<?php echo $codicePrenotazione; ?>">
                            <input type="hidden" name="nomeCognome" value="<?php echo $nomeCognome; ?>">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="telefono" value="<?php echo $telefono; ?>">
                            <input type="hidden" name="lang" value="<?php echo $language; ?>">

                            <!-------- INFO PRENOTAZIONE ---------->
                            <input type="hidden" name="month" value="<?php echo $month; ?>">
                            <input type="hidden" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" name="numWeeks" id="numWeeks" value="<?php echo isset($numWeeks) && is_numeric($numWeeks) ? (int)$numWeeks : 1; ?>">

                            <!-------- SETTIMANA 1 ---------->
                            <input type="hidden" name="id_settimana1" value="<?php echo $id_settimana1; ?>">

                            <!-------- SETTIMANA 2 ---------->
                            <input type="hidden" name="id_settimana2" value="<?php echo $id_settimana2; ?>">

                            <!-------- SETTIMANA 3 ---------->
                            <input type="hidden" name="id_settimana3" value="<?php echo $id_settimana3; ?>">

                            <input type="hidden" id="numWeeks_old" name="numWeeks_old" value="<?php echo $numWeeks_old; ?>">

                            <!-------- SETTIMANA 1 OLD ---------->
                            <input type="hidden" name="id_settimana1_old" value="<?php echo $id_settimana1_old; ?>">
                            <input type="hidden" name="date_settimana1_old" value="<?php echo $date_settimana1_old; ?>">
                            <input type="hidden" name="postiWeek1_old" value="<?php echo $postiWeek1_old; ?>">

                            <!-------- SETTIMANA 2 OLD---------->
                            <input type="hidden" name="id_settimana2_old" value="<?php echo $id_settimana2_old; ?>">
                            <input type="hidden" name="date_settimana2_old" value="<?php echo $date_settimana2_old; ?>">
                            <input type="hidden" name="postiWeek2_old" value="<?php echo $postiWeek2_old; ?>">

                            <!-------- SETTIMANA 3 OLD---------->
                            <input type="hidden" name="id_settimana3_old" value="<?php echo $id_settimana3_old; ?>">
                            <input type="hidden" name="date_settimana3_old" value="<?php echo $date_settimana3_old; ?>">
                            <input type="hidden" name="postiWeek3_old" value="<?php echo $postiWeek3_old; ?>">


                            <div class="spacer"></div>
                            <?php include 'legenda.php'; ?>
                            <div class="spacer"></div>

                            <?php if ($numWeeks >= 2) { ?>
                                <button type="button" onclick="submitForm()">PROSEGUI →</button>
                            <?php } else { ?>
                                <label>
                                <input type="checkbox" name="invia_mail" id="inviaMail" value="1">
                                    Seleziona per inviare la mail di conferma al cliente
                                </label>
                                <button type="button" onclick="submitForm()">CONCLUDI →</button>
                            <?php } ?>

                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php include 'playa1.php'; ?>
                </div>

            </div>
        </main>
        <!-- <footer class="pt-5 my-5 text-body-secondary border-top">
            Creato dal team Anda Creativa &middot; &copy; 2024
        </footer> -->
    </div>
</body>

<?php include 'assets/layout/footer.php'; ?>



<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Funzione per aggiornare e inviare il modulo
    function updateForm() {
        document.getElementById('mainForm').action = ""; // Imposta l'attributo 'action' del modulo su una stringa vuota
        document.getElementById('mainForm').submit(); // Invia il modulo
    }

    function updateOptions(changedSelect) {
        const selectedValue = changedSelect.value;

        // Recuperiamo i select presenti nel DOM
        const posto1 = document.getElementById("posto1week1");
        const posto2 = document.getElementById("posto2week1");
        const posto3 = document.getElementById("posto3week1");

        // Creiamo un array con i valori selezionati (filtrando quelli non definiti)
        const selectedValues = [
            posto1 ? posto1.value : null,
            posto2 ? posto2.value : null,
            posto3 ? posto3.value : null
        ].filter(value => value !== null); // Rimuove i valori nulli

        // Ripristiniamo tutte le opzioni disponibili nei select presenti
        if (posto1) resetOptions(posto1);
        if (posto2) resetOptions(posto2);
        if (posto3) resetOptions(posto3);

        // Nascondiamo le opzioni già selezionate negli altri select
        if (posto1) hideSelectedOptions(posto1, selectedValues);
        if (posto2) hideSelectedOptions(posto2, selectedValues);
        if (posto3) hideSelectedOptions(posto3, selectedValues);

        // ✅ Ora updateMapHighlight viene sempre chiamato, indipendentemente dal numero di lettini
        updateMapHighlight();
    }


    // Funzione per nascondere le opzioni già selezionate
    function hideSelectedOptions(selectElement, selectedValues) {
        if (selectElement) {
            for (let option of selectElement.options) {
                if (selectedValues.includes(option.value) && option.value !== selectElement.value) {
                    option.style.display = "none"; // Nasconde l'opzione se è già selezionata in un altro menu a tendina
                }
            }
        }
    }

    // Funzione per ripristinare tutte le opzioni in un select
    function resetOptions(selectElement) {
        if (selectElement) {
            for (let option of selectElement.options) {
                option.style.display = "block"; // Mostra tutte le opzioni
            }
        }
    }



    document.addEventListener("DOMContentLoaded", function() {
        updateUnavailableSeats();
    });

    // Funzione per evidenziare gli ombrelloni non disponibili
    function updateUnavailableSeats() {
        // Array di lettini prenotati passato da PHP a JavaScript
        const lettiniPrenotati = <?php echo json_encode($lettini_prenotati); ?>;

        // Aggiunge la classe 'red' ai posti non disponibili sulla mappa
        lettiniPrenotati.forEach(codice => {
            const circle = document.querySelector(`.circle[data-seat="${codice}"]`);
            if (circle) {
                circle.classList.add('red'); // Aggiunge la classe CSS per evidenziare
            }
        });
    }


    // Funzione per aggiornare la mappa degli ombrelloni
    function updateMapHighlight() {
        // Rimuove la classe di selezione da tutti gli elementi sulla mappa
        document.querySelectorAll('.circle').forEach(circle => {
            circle.classList.remove('selected-ombrellone'); // Rimuove la classe CSS di evidenziazione
        });

        // Recupera i valori selezionati dai tre selettori
        const selectedposto1week1s = [
            document.getElementById('posto1week1').value, // Valore del primo selettore
            document.getElementById('posto2week1') ? document.getElementById('posto2week1').value : null, // Valore del secondo selettore, se esiste
            document.getElementById('posto3week1') ? document.getElementById('posto3week1').value : null // Valore del terzo selettore, se esiste
        ];

        // Evidenzia gli ombrelloni selezionati sulla mappa
        selectedposto1week1s.forEach(posto1week1 => {
            if (posto1week1) { // Se esiste un valore selezionato
                const circle = document.querySelector(`.circle[data-seat="${posto1week1}"]`); // Trova l'elemento della mappa corrispondente
                if (circle) { // Se l'elemento esiste
                    circle.classList.add('selected-ombrellone'); // Aggiunge la classe di evidenziazione
                }
            }
        });
    }

    // Esegue il codice al caricamento completo della pagina
    document.addEventListener("DOMContentLoaded", function() {
        const posto1week1Selects = ['posto1week1', 'posto2week1', 'posto3week1']; // Array degli ID dei selettori
        posto1week1Selects.forEach((id) => { // Per ogni ID nell'array
            const select = document.getElementById(id); // Trova il selettore
            if (select) { // Se il selettore esiste
                updateOptions(select, 'posto1week1', 'posto2week1', 'posto3week1'); // Aggiorna le opzioni dei selettori
            }
        });
    });

    function submitForm() {
        const form = document.getElementById("mainForm");
        if (!form) {
            console.error("Errore: Form non trovato!");
            return;
        }

        const numWeeksInput = document.getElementById("numWeeks");

        if (!numWeeksInput || !numWeeksInput.value.trim()) {
            console.error("Errore: input hidden numWeeks non trovato o valore vuoto!");
            return;
        }

        // 🔴 Problema: numWeeks è una stringa → 🟢 Soluzione: parseInt()
        let numWeeks = parseInt(numWeeksInput.value, 10); // Conversione esplicita a numero intero

        if (isNaN(numWeeks)) {
            console.error("Errore: numWeeks non è un numero valido! Valore originale:", numWeeksInput.value);
            return;
        }

        console.log("numWeeks (convertito):", numWeeks);

        if (numWeeks === 1) {
            form.action = "confermaRiprogrammazione.php";
        } else if (numWeeks >= 2) {
            form.action = "riprogramma-week2.php";
        } else {
            console.error("Errore: numWeeks ha un valore non valido!");
            return;
        }

        console.log("Invio form con action:", form.action);
        form.submit();
    }
</script>




</html>