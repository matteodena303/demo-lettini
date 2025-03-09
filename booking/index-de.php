<?php include 'class/MYSQL.php'; ?>
<?php include 'assets/layout/header.php'; ?>

<body>
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <main>
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="form-container">
                        <!-- Titolo in tedesco -->
                        <h2 class="text-body-emphasis">Geben Sie Ihre Buchungsdaten ein!</h2>
                        <p class="form-bold">SCHRITT 1<br><br></p>

                        <!-- Inizio del modulo -->
                        <form method="POST" id="mainForm">


                            <!-- Campo per il codice prenotazione -->
                            <label for="codicePrenotazione">Buchungscode</label>
                            <input type="text" id="codicePrenotazione" name="codicePrenotazione" oninput="formatCodicePrenotazione()" value="<?php echo isset($_POST['codicePrenotazione']) ? $_POST['codicePrenotazione'] : ''; ?>"
                                required>

                            <div class="spacer"></div>

                            <!-- Selezione del mese e dell'anno (commento in italiano mantenuto) -->
                            <label for="month">Monat/Jahr</label>
                            <select id="month" name="month" class="selector-date" onchange="resetNumWeeks(); updateForm()">
                                <?php
                                setlocale(LC_TIME, 'de_DE.UTF-8', 'German');

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

                            <!-- Selezione dell'anno (commento in italiano mantenuto) -->
                            <select id="year" name="year" class="selector-date" onchange="resetNumWeeks(); updateForm()">
                                <?php
                                echo '<option value="' . $currentYear . '"' . ($currentYear == $selectedYear ? ' selected' : '') . '>' . $currentYear . '</option>';
                                echo '<option value="' . ($currentYear + 1) . '"' . (($currentYear + 1) == $selectedYear ? ' selected' : '') . '>' . ($currentYear + 1) . '</option>';
                                ?>
                            </select>

                            <!-- Selezione della settimana prenotata (commento in italiano mantenuto) -->
                            <label for="weeks">Gebuchte Woche <small>[von Samstag bis Freitag]</small></label>
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
                                        $inizio = date("d/m/y", strtotime($row['inizio_settimana']));
                                        $fine = date("d/m/y", strtotime($row['fine_settimana']));
                                        $settimana = "$inizio - $fine";

                                        $selectedWeek = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : $row['id_settimana'];

                                        echo '<option value="' . $row['id_settimana'] . '"' . ($row['id_settimana'] == $selectedWeek ? ' selected' : '') . '>' . $settimana . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Keine Woche verfügbar</option>';
                                }
                                ?>
                            </select>

                            <!-- Selezione delle settimane aggiuntive (commento in italiano mantenuto) -->
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

                                            echo '<label>Woche ' . $weekNumber . ':</label>';
                                            echo '<select name="id_settimana' . $weekNumber . '" class="selector-date no-arrow">';
                                            echo '<option value="' . $row['id_settimana'] . '">' . $settimana . '</option>';
                                            echo '</select><br>';

                                            $weekNumber++;
                                        }
                                    }
                                }
                                ?>
                            </div>

                            <!-- Selezione del numero di settimane prenotate (commento in italiano mantenuto) -->
                            <label for="numWeeks">Anzahl gebuchter Wochen</label>
                            <select id="numWeeks" name="numWeeks" class="selector-date" onchange="updateForm()">
                                <option value="1" <?php echo (isset($_POST['numWeeks']) && $_POST['numWeeks'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo (isset($_POST['numWeeks']) && $_POST['numWeeks'] == 2) ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo (isset($_POST['numWeeks']) && $_POST['numWeeks'] == 3) ? 'selected' : ''; ?>>3</option>
                            </select>

                            <div class="spacer"></div>

                            <!-- Altri dati del cliente (commento in italiano mantenuto) -->
                            <label for="nomeCognome">Vor- und Nachname</label>
                            <input type="text" id="nomeCognome" name="nomeCognome" oninput="formatNomeCognomeLive()" value="<?php echo isset($_POST['nomeCognome']) ? $_POST['nomeCognome'] : ''; ?>" required>

                            <label for="email">E-Mail-Adresse</label>
                            <input type="email" id="email" name="email"
                                value="<?php echo htmlspecialchars($email); ?>"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                required>

                            <label for="telefono">Telefonnummer</label>
                            <input type="tel" id="telefono" name="telefono"
                                value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>" required>

                            <div class="spacer"></div>

                            <!-------------------------------------->
                            <!-------- INVIO INFO IN POST --------->
                            <!-------------------------------------->
                            <?php $language = "DEU"; ?>
                            <input type="hidden" name="lang" value="<?php echo $language; ?>">

                            <!-- Pulsante per procedere alla selezione del posto -->
                            <button type="button" onclick="submitForm()">FORTFAHREN →</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php include 'playa-planta.php'; ?> <!-- Include contenuto aggiuntivo (commento in italiano) -->
                </div>
            </div>
        </main>

    </div>
</body>


<?php include 'assets/layout/footer-de.php'; ?>


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

    function submitForm() {
        // Recupera i valori dei campi e rimuove gli spazi inutili
        const codicePrenotazione = document.getElementById('codicePrenotazione').value.trim();
        const nomeCognomeField = document.getElementById('nomeCognome');
        const nomeCognome = nomeCognomeField.value.trim();
        const emailField = document.getElementById('email');
        const email = emailField.value.trim();
        const telefonoField = document.getElementById('telefono');
        const telefono = telefonoField.value.trim();

        // Espressione regolare per validare l'email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Espressione regolare per validare Nome e Cognome (almeno due parole)
        const nomeCognomePattern = /^[A-Za-zÀ-ÿ]+(?: [A-Za-zÀ-ÿ]+)+$/;

        // Espressione regolare per validare il numero di telefono (min 8 cifre, può contenere +, spazi, -, .)
        const telefonoPattern = /^[+\d]?[0-9\s\-\.\+]{8,15}$/;

        // Controllo campi obbligatori
        if (!codicePrenotazione || !nomeCognome || !email || !telefono) {
            alert("Bitte füllen Sie alle Pflichtfelder aus.");
            return;
        }

        // Controllo validità Nome e Cognome
        if (!nomeCognomePattern.test(nomeCognome)) {
            alert("Bitte geben Sie mindestens Ihren Vor- und Nachnamen ein, getrennt durch ein Leerzeichen.");
            nomeCognomeField.focus();
            return;
        }

        // Controllo validità Email
        if (!emailPattern.test(email)) {
            alert("Bitte geben Sie eine gültige E-Mail-Adresse ein.");
            emailField.focus();
            return;
        }

        // Controllo validità Numero di telefono
        if (!telefonoPattern.test(telefono)) {
            alert("Bitte geben Sie eine gültige Telefonnummer ein (mindestens 8 Ziffern, kann +, Leerzeichen, -, . enthalten).");
            telefonoField.focus();
            return;
        }

        // Se tutti i controlli sono superati, invia il modulo
        document.getElementById('mainForm').action = "week1-de.php";
        document.getElementById('mainForm').submit();
    }

    // Funzione per trasformare il codice prenotazione in maiuscolo in tempo reale
    function formatCodicePrenotazione() {
        let codiceField = document.getElementById('codicePrenotazione');
        codiceField.value = codiceField.value.toUpperCase();
    }

    // Funzione per aggiornare il Nome e Cognome mentre l'utente scrive
    function formatNomeCognomeLive() {
        let nomeCognomeField = document.getElementById('nomeCognome');
        nomeCognomeField.value = nomeCognomeField.value
            .toLowerCase() // Tutto minuscolo inizialmente
            .replace(/\b\w/g, lettera => lettera.toUpperCase()); // Prima lettera di ogni parola maiuscola
    }

    // Funzione per cambiare lingua
    function changeLanguage(lang) {
        // Aggiorna il valore del campo nascosto
        document.getElementById('lang').value = lang;

        // Opzionale: aggiorna l'URL visibile all'utente
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('lang', lang);
        window.history.replaceState({}, '', currentUrl);

        // Aggiorna il form
        document.getElementById('mainForm').submit();
    }
</script>

</html>