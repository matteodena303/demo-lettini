<?php include 'class/POST.php'; ?>
<?php include 'class/MYSQL.php'; ?>
<?php include 'assets/layout/header.php'; ?>

<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Lettini Prenotati
$lettini_prenotati = getLettiniPrenotati($id_settimana2);
// print_r($lettini_prenotati);
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

                        <!-- Titolo e Step in tedesco -->
                        <h2 class="text-body-emphasis">Wählen Sie Ihren Sonnenschirm</h2>
                        <p class="form-bold">SCHRITT 2<br><br></p>

                        <?php
                        // Mostra i dati del modulo per conferma
                        $date_settimana1 = getFormattedWeekRange($id_settimana1);
                        echo "<p style=\"margin:4px\"><strong>Buchungscode:</strong> $codicePrenotazione</p>";
                        if ($numWeeks == 1) {
                            echo "<p style=\"margin:4px; color: #f29240;\"><strong>Buchungsdatum:</strong> $date_settimana1</p>";
                        }
                        if ($date_settimana2 != "") {
                            $date_settimana2 = getFormattedWeekRange($id_settimana2);
                            echo "<p style=\"margin:4px 4px 0px 4px;\"><strong>WOCHE 1:</strong> $date_settimana1</p>";
                            $posti_selezionati = [];
                            if (!empty($_POST['posto1week1'])) {
                                $posti_selezionati[] = $_POST['posto1week1'];
                            }
                            if (!empty($_POST['posto2week1'])) {
                                $posti_selezionati[] = $_POST['posto2week1'];
                            }
                            if (!empty($_POST['posto3week1'])) {
                                $posti_selezionati[] = $_POST['posto3week1'];
                            }
                            echo "<p style=\"margin:0px 4px 4px 4px;\">Ausgewählte Plätze: " . implode(", ", $posti_selezionati) . "</p>";
                            echo "<p style=\"margin:4px; color: #f29240;\"><strong>WOCHE 2:</strong> $date_settimana2</p>";
                        }
                        if ($date_settimana3 != "") {
                            $date_settimana3 = getFormattedWeekRange($id_settimana3);
                            echo "<p style=\"margin:4px\"><strong>WOCHE 3:</strong> $date_settimana3</p>";
                        }
                        ?>

                        <div class="spacer"></div>

                        <form method="POST" action="confermaPrenotazione.php" id="mainForm">
                            <!-- Label e opzioni in tedesco -->
                            <label for="nlettini_settimana2">Wählen Sie die Anzahl der Sonnenschirme</label>
                            <select id="nlettini_settimana2" name="nlettini_settimana2" class="selector-date" onchange="updateForm()">
                                <option value="1" <?php echo (isset($_POST['nlettini_settimana2']) && $_POST['nlettini_settimana2'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo (isset($_POST['nlettini_settimana2']) && $_POST['nlettini_settimana2'] == 2) ? 'selected' : ''; ?>>2 (+70€)</option>
                                <option value="3" <?php echo (isset($_POST['nlettini_settimana2']) && $_POST['nlettini_settimana2'] == 3) ? 'selected' : ''; ?>>3 (+140€)</option>
                            </select>

                            <div class="spacer"></div>

                            <div class="">
                                <label for="">Wählen Sie den Sonnenschirm für die zweite Woche:</label>
                                <select id="posto1week2" name="posto1week2" onchange="updateOptions(this)">
                                    <?php
                                    // Prendere i primi 3 lettini come pre-selezione
                                    $selectedLettini = array_slice($lettini_disponibili, 0, 3);

                                    foreach ($lettini_disponibili as $lettino) {
                                        $codice = $lettino['codice_lettino'];
                                        $fila = $lettino['fila'];
                                        $sovraprezzo = intval($lettino['sovraprezzo']); // Convertire il sovrapprezzo in intero

                                        // Formattazione della voce nel menu a tendina
                                        $prezzoExtra = ($sovraprezzo > 0) ? " (+{$sovraprezzo}€)" : "";
                                        $label = "REIHE $fila - Sonnenschirm $codice$prezzoExtra";

                                        // Controlla se il lettino deve essere pre-selezionato
                                        $selected = ($codice == $selectedLettini[0]['codice_lettino']) ? 'selected' : '';

                                        echo "<option value='$codice' $selected>$label</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="additionalOmbrelloni">
                                <?php
                                if (isset($_POST['nlettini_settimana2'])) {
                                    $n_ombrelloni = $_POST['nlettini_settimana2'];

                                    if ($n_ombrelloni >= 2) {
                                        echo "<label for=\"posto2week2\">Wählen Sie einen zusätzlichen Sonnenschirm:</label>";
                                        echo "<select id=\"posto2week2\" name=\"posto2week2\" onchange=\"updateOptions(this)\">";

                                        foreach ($lettini_disponibili as $lettino) {
                                            $codice = $lettino['codice_lettino'];
                                            $fila = $lettino['fila'];
                                            $sovraprezzo = intval($lettino['sovraprezzo']); // Convertire il sovrapprezzo in intero

                                            $prezzoExtra = ($sovraprezzo > 0) ? " (+{$sovraprezzo}€)" : "";
                                            $label = "REIHE $fila - Sonnenschirm $codice$prezzoExtra";

                                            $selected = (isset($selectedLettini[1]) && $codice == $selectedLettini[1]['codice_lettino']) ? 'selected' : '';
                                            echo "<option value='$codice' $selected>$label</option>";
                                        }

                                        echo "</select>";
                                    }

                                    if ($n_ombrelloni == 3) {
                                        echo "<label for=\"posto3week2\">Wählen Sie einen zweiten zusätzlichen Sonnenschirm:</label>";
                                        echo "<select id=\"posto3week2\" name=\"posto3week2\" onchange=\"updateOptions(this)\">";

                                        foreach ($lettini_disponibili as $lettino) {
                                            $codice = $lettino['codice_lettino'];
                                            $fila = $lettino['fila'];
                                            $sovraprezzo = intval($lettino['sovraprezzo']);

                                            $prezzoExtra = ($sovraprezzo > 0) ? " (+{$sovraprezzo}€)" : "";
                                            $label = "REIHE $fila - Sonnenschirm $codice$prezzoExtra";

                                            $selected = (isset($selectedLettini[2]) && $codice == $selectedLettini[2]['codice_lettino']) ? 'selected' : '';
                                            echo "<option value='$codice' $selected>$label</option>";
                                        }

                                        echo "</select>";
                                    }
                                }
                                ?>
                            </div>


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
                            <input type="hidden" name="nlettini_settimana1" value="<?php echo $nlettini_settimana1; ?>">
                            <input type="hidden" name="posto1week1" value="<?php echo $posto1week1; ?>">
                            <input type="hidden" name="posto2week1" value="<?php echo $posto2week1; ?>">
                            <input type="hidden" name="posto3week1" value="<?php echo $posto3week1; ?>">

                            <!-------- SETTIMANA 2 ---------->
                            <input type="hidden" name="id_settimana2" value="<?php echo $id_settimana2; ?>">

                            <!-------- SETTIMANA 3 ---------->
                            <input type="hidden" name="id_settimana3" value="<?php echo $id_settimana3; ?>">

                            <div class="spacer"></div>
                            <?php include 'legenda-de.php'; ?>
                            <div class="spacer"></div>

                            <!-- Bottoni in tedesco -->
                            <?php if ($numWeeks >= 3) { ?>
                                <button type="button" onclick="submitForm()">FORTFAHREN →</button>
                            <?php } else { ?>
                                <button type="button" onclick="submitForm()">ABSCHLIESSEN →</button>
                            <?php } ?>

                            <button type="button" class="button-back" onclick="submitFormBack()">← Zurück</button>

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


<?php include 'assets/layout/footer-de.php'; ?>


<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Funzione per aggiornare e inviare il modulo
    function updateForm() {
        // Imposta l'attributo 'action' del modulo su una stringa vuota
        document.getElementById('mainForm').action = "";
        document.getElementById('mainForm').submit(); // Invia il modulo
    }

    function updateOptions(changedSelect) {
        // Recuperiamo il valore selezionato
        const selectedValue = changedSelect.value;

        // Recuperiamo i select presenti nel DOM
        const posto1 = document.getElementById("posto1week2");
        const posto2 = document.getElementById("posto2week2");
        const posto3 = document.getElementById("posto3week2");

        // Creiamo un array con i valori selezionati (filtrando quelli non definiti)
        const selectedValues = [
            posto1 ? posto1.value : null,
            posto2 ? posto2.value : null,
            posto3 ? posto3.value : null
        ].filter(value => value !== null);

        // Ripristiniamo tutte le opzioni disponibili nei select presenti
        if (posto1) resetOptions(posto1);
        if (posto2) resetOptions(posto2);
        if (posto3) resetOptions(posto3);

        // Nascondiamo le opzioni già selezionate negli altri select
        if (posto1) hideSelectedOptions(posto1, selectedValues);
        if (posto2) hideSelectedOptions(posto2, selectedValues);
        if (posto3) hideSelectedOptions(posto3, selectedValues);

        // Aggiorniamo la mappa
        updateMapHighlight();
    }

    // Funzione per nascondere le opzioni già selezionate
    function hideSelectedOptions(selectElement, selectedValues) {
        if (selectElement) {
            for (let option of selectElement.options) {
                if (selectedValues.includes(option.value) && option.value !== selectElement.value) {
                    option.style.display = "none";
                }
            }
        }
    }

    // Funzione per ripristinare tutte le opzioni in un select
    function resetOptions(selectElement) {
        if (selectElement) {
            for (let option of selectElement.options) {
                option.style.display = "block";
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
                circle.classList.add('red');
            }
        });
    }

    // Funzione per aggiornare la mappa degli ombrelloni
    function updateMapHighlight() {
        // Rimuove la classe di selezione da tutti gli elementi sulla mappa
        document.querySelectorAll('.circle').forEach(circle => {
            circle.classList.remove('selected-ombrellone');
        });

        // Recupera i valori selezionati dai selettori
        const selectedposto1week2s = [
            document.getElementById('posto1week2').value,
            document.getElementById('posto2week2') ? document.getElementById('posto2week2').value : null,
            document.getElementById('posto3week2') ? document.getElementById('posto3week2').value : null
        ];

        // Evidenzia gli ombrelloni selezionati sulla mappa
        selectedposto1week2s.forEach(posto1week2 => {
            if (posto1week2) {
                const circle = document.querySelector(`.circle[data-seat="${posto1week2}"]`);
                if (circle) {
                    circle.classList.add('selected-ombrellone');
                }
            }
        });
    }

    // Al caricamento della pagina, aggiorniamo le opzioni per ogni selettore
    document.addEventListener("DOMContentLoaded", function() {
        const posto1week2Selects = ['posto1week2', 'posto2week2', 'posto3week2'];
        posto1week2Selects.forEach((id) => {
            const select = document.getElementById(id);
            if (select) {
                updateOptions(select, 'posto1week2', 'posto2week2', 'posto3week2');
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

        // Converte numWeeks in intero
        let numWeeks = parseInt(numWeeksInput.value, 10);

        if (isNaN(numWeeks)) {
            console.error("Errore: numWeeks non è un numero valido! Valore originale:", numWeeksInput.value);
            return;
        }

        console.log("numWeeks (convertito):", numWeeks);

        // Se la prenotazione è di 2 settimane, va a conferma. Se >= 3 settimane, va a week3.
        if (numWeeks === 2) {
            form.action = "confermaPrenotazione-de.php";
        } else if (numWeeks >= 3) {
            form.action = "week3-de.php";
        } else {
            console.error("Errore: numWeeks ha un valore non valido!");
            return;
        }

        console.log("Invio form con action:", form.action);
        form.submit();
    }

    function submitFormBack() {
        const form = document.getElementById("mainForm");
        if (!form) {
            console.error("Errore: Form non trovato!");
            return;
        }

        // Torna indietro alla pagina di week1
        form.action = "week1-de.php";
        console.log("Torno indietro inviando il form a:", form.action);
        form.submit();
    }
</script>




</html>