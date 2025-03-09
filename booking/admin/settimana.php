<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include '../class/MYSQL.php'; ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_TIME, 'it_IT.UTF-8', 'Italian');
$id_settimana = "";
?>

<style>
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-width: 1px !important;
    }

    .delete-button {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }

    button#back-to-top {
        display: none !important;
    }

    .id-lettino {
        font-size: medium;
        font-weight: bolder;
        /* BACKGROUND: AQUA; */
        /* color: blue; */
    }

    td {
        width: 20%;
    }
</style>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// $id_settimana = "";

?>


<head>
    <title>Mappa Settore | BRA</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">MAPPA SETTORE</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-header border-0">
                                <div class="row align-items- gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title mb-0">Mappa Settimanale</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <button type="button" class="btn btn-success add-btn" id="create-btn" onclick="window.location.href='https://demoprenotazioni.303lab.it/';">
                                                <i class="ri-add-line align-bottom me-1"></i> Inserisci Prenotazione
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border border-dashed border-end-0 border-start-0" style="margin-bottom: 15px;">
                                <form method="POST" id="mainForm">

                                    <!------------------------------------------------------->
                                    <!-----------INSERIRE QUI MENU A TENDINA SETTIMANE------->
                                    <!------------------------------------------------------->

                                    <div class="row g-3">
                                        <div class="col-xxl-1 col-sm-6">
                                            <div>
                                                <label>Anno:</label>

                                                <select id="year" name="year" class="form-control" onchange="updateWeeks()">
                                                    <?php

                                                    // Imposta il primo anno da mostrare
                                                    $startYear = 2025;

                                                    // Anno corrente
                                                    $currentYear = date('Y');

                                                    // Anno selezionato, se presente in POST, altrimenti l'anno corrente
                                                    $selectedYear = isset($_POST['year']) ? $_POST['year'] : $currentYear;

                                                    // Costruiamo il limite massimo da mostrare
                                                    // (se ad esempio siamo nel 2025, mostriamo 2025 e 2026)
                                                    $endYear = $currentYear + 1;

                                                    // Cicliamo dal 2025 fino a ($currentYear + 1)
                                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                                        // Se il year in loop coincide col $selectedYear, mettiamo selected
                                                        $selected = ($year == $selectedYear) ? 'selected' : '';
                                                        echo "<option value=\"$year\" $selected>$year</option>";
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-xxl-2 col-sm-6">
                                            <div>
                                                <label>Mese:</label>
                                                <select id="month" name="month" class="form-control" onchange="updateWeeks()">
                                                    <?php
                                                    $currentMonth  = date('n');
                                                    $selectedMonth = isset($_POST['month']) ? $_POST['month'] : $currentMonth;

                                                    // Generazione dinamica dei mesi disponibili
                                                    for ($i = 1; $i <= 12; $i++) {
                                                        echo '<option value="' . $i . '"' . ($i == $selectedMonth ? ' selected' : '') . '>'
                                                            . strtoupper(strftime('%B', mktime(0, 0, 0, $i, 1))) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-6">
                                            <div>
                                                <!-- <select class="form-control" data-choices data-choices-search-false
                                                    name="choices-single-default">
                                                </select> -->
                                                <label>Settimana:</label>
                                                <select id="weeks" name="id_settimana1" class="form-control">
                                                    <?php
                                                    // Carichiamo *di base* le settimane del mese/anno selezionato all'apertura pagina
                                                    $result = getWeeks($selectedYear, $selectedMonth);

                                                    if ($result && $result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $inizio = date("d/m/y", strtotime($row['inizio_settimana']));
                                                            $fine   = date("d/m/y", strtotime($row['fine_settimana']));
                                                            $label  = "$inizio - $fine";

                                                            // Imposta la settimana selezionata
                                                            $selectedWeek = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : $row['id_settimana'];

                                                            echo '<option value="' . $row['id_settimana'] . '"' .
                                                                ($row['id_settimana'] == $selectedWeek ? ' selected' : '') .
                                                                '>' . $label . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">Nessuna settimana disponibile</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->


                                        <div class="col-xxl-2 col-sm-6">
                                            <div>
                                                <label></label>
                                                <button type="submit" class="btn btn-primary w-100">
                                                    Aggiorna Mappa
                                                </button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <label></label>

                                                <button type="button" class="btn btn-primary w-100"
                                                    id="exportPDF" class="btn btn-danger"> <i
                                                        class=" ri-equalizer-fill me-1 align-bottom"></i>
                                                    Scarica PDF
                                                </button>
                                                <!-- <a href="generate_pdf.php" class="btn btn-primary">Scarica PDF</a> -->

                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->

                                </form>
                            </div>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Verifica che esista il valore 'id_settimana1' in $_POST
                                $id_settimana = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : null;

                                // A questo punto $id_settimana conterrà il valore selezionato.
                                // Puoi usarlo come preferisci.
                            }
                            ?>

                            <?php
                            // $id_settimana1 = isset($_POST['id_settimana1']) ? $_POST['id_settimana1'] : null;

                            // echo "id_settimana1: $id_settimana1<br>";

                            // echo "id_settimana: $id_settimana<br>";
                            // Se è stata selezionata una settimana, chiama la funzione
                            if ($id_settimana) {
                                $lettiniPrenotati = getPrenotazioniMappa($id_settimana);
                                $date_settimana = getWeekById($id_settimana);
                                $inizio_settimana = date('d-m-Y', strtotime($date_settimana['inizio_settimana'])); // Output: 22/02/2025
                                $fine_settimana = date('d-m-Y', strtotime($date_settimana['fine_settimana'])); // Output: 22/02/2025
                            } else {
                                $lettiniPrenotati = [];
                            }
                            // echo "<pre>";
                            // print_r($lettiniPrenotati);
                            // echo "</pre>";
                            // echo "<pre>";
                            // print_r($date_settimana);
                            // echo "</pre>";


                            ?>




                            <div class="card-body pt-0">
                                <div>
                                    <?php
                                    if ($id_settimana == "") {
                                        echo "<div class='alert alert-warning'>Seleziona una settimana.</div>";
                                    } elseif (empty($lettiniPrenotati)) {
                                        echo "<div class='alert alert-warning'>Nessuna Prenotazione per la settimana selezionata.</div>";
                                    } else {
                                        echo "<h4 style=\"color:black;\" id=\"settimana-prenotata\">Settimana dal $inizio_settimana al $fine_settimana</h4><br>";
                                        include 'tabella-settimane.php';
                                    }

                                    ?>

                                </div>


                            </div>
                        </div>

                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<?php include 'layouts/customizer.php'; ?>

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- list.js min js -->
<script src="assets/libs/list.js/list.min.js"></script>




<!--list pagination js-->
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- ecommerce-order init js -->
<script src="assets/js/pages/ecommerce-order.init.js"></script>
<!-- App js -->
<script src="assets/js/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

<script>
    function updateWeeks() {
        // 1. Leggiamo anno e mese correnti
        const yearSelect = document.getElementById('year');
        const monthSelect = document.getElementById('month');
        const weeksSelect = document.getElementById('weeks');

        const year = yearSelect.value;
        const month = monthSelect.value;

        // 2. Chiamiamo via AJAX il nostro getWeeks.php (passando i parametri in GET)
        fetch('getWeeks.php?year=' + year + '&month=' + month)
            .then(response => response.json())
            .then(data => {
                // `data` è un array di oggetti, ciascuno { id_settimana, label }

                // 3. Svuotiamo il contenuto della tendina "weeks"
                weeksSelect.innerHTML = '';

                // 4. Se l’array è vuoto, inseriamo un option di avviso
                if (data.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Nessuna settimana disponibile';
                    weeksSelect.appendChild(option);
                } else {
                    // 5. Popoliamo la tendina con le nuove opzioni
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_settimana;
                        option.textContent = item.label;
                        weeksSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Errore nella fetch delle settimane:', error);
            });
    }


    document.getElementById("exportPDF").addEventListener("click", function() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Recupera il testo della settimana dalla pagina
        const settimanaPrenotata = document.getElementById("settimana-prenotata").innerText;

        // Aggiungi il testo in alto nel PDF
        doc.setFontSize(12); // Imposta la dimensione del testo
        doc.text(settimanaPrenotata, 10, 10); // Posizione X = 10, Y = 10

        // Aggiungi la tabella con i bordi e il testo ridotto
        doc.autoTable({
            html: ".table",
            startY: 20, // Posiziona la tabella sotto il testo
            styles: {
                fontSize: 10, // Riduce la dimensione del testo
                lineWidth: 0.5 // Imposta il bordo della tabella
            },
            tableLineColor: [0, 0, 0], // Bordo nero
            tableLineWidth: 0.5
        });

        // Salva il PDF
        doc.save("mappa_settore.pdf");
    });
</script>

</body>

</html>