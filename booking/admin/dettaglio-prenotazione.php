<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include '../class/MYSQL.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_TIME, 'it_IT.UTF-8', 'Italian');
$codice_pren = $_POST['codice_prenotazione'];
$dettagliPrenotazione = getReservationAndClientData($codice_pren);
// if ($dettagliPrenotazione) {
//     // Qui trovi i campi della prenotazione e del cliente
//     echo "<pre>";
//     print_r($dettagliPrenotazione);
//     echo "</pre>";
// } else {
//     echo "Nessuna prenotazione trovata per il codice: $codice";
// }
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

    .fw-semibold {
        width: 15%;
        /* BACKGROUND: AQUA; */
        font-size: 15px;
    }

    .td-right {
        font-size: 15px;
    }

    .date {
        font-size: 15px !important;
        font-weight: 100 !important;
        text-transform: uppercase;
    }

    .extra1 {
        font-weight: bold;
        color: #ee5aeb;
    }

    .extra2 {
        font-weight: bold;
        color: rgb(49, 226, 73);
    }

    @media print {
        .btn-primary {
            display: none !important;
        }

        #dett-pren {
            display: none !important;
        }

    }

    .padding-print {
        margin-bottom: 10px;
    }
</style>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// $id_settimana = "";
?>

<head>
    <title>Dettaglio Prenotazione | BRA</title>
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
                            <?php
                            echo "<h4 class=\"mb-sm-0\">DETTAGLIO</h4>";
                            ?>
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
                                        <h5 class="card-title mb-0" id="dett-pren">Dettaglio Prenotazione</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <!-- <button type="button" class="btn btn-success add-btn" id="create-btn" onclick="window.location.href='https://demoprenotazioni.303lab.it/';">
                                                <i class="ri-add-line align-bottom me-1"></i> Inserisci Prenotazione
                                            </button> -->
                                            <button onclick="window.history.back()" style="background: #a2a4b1; border:none" class="btn btn btn-primary padding-print">Torna indietro</button>

                                            <button onclick="window.print()" class="btn btn-primary padding-print">Stampa PDF</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div style="font-size: 20px;">

                                    <?php
                                    $extra_lettino = 70;
                                    $nomeCliente = $dettagliPrenotazione['nome_cliente'];
                                    $email = $dettagliPrenotazione['email'];
                                    $telefono = $dettagliPrenotazione['telefono'];
                                    $lingua = $dettagliPrenotazione['lingua'];
                                    $data_inserimento = date("d-m-Y", strtotime($dettagliPrenotazione['data_inserimento']));

                                    // $codice_pren = $dettagliPrenotazione['codice_pren'];

                                    $total_extra = 0;

                                    function getLettinoData($lettino_id)
                                    {
                                        $dati = getInfoLettino($lettino_id);
                                        return [
                                            'fila' => $dati['fila'] ?? "",
                                            'sovrapprezzo' => $dati['sovrapprezzo'] ?? 0
                                        ];
                                    }

                                    function formattaData($data)
                                    {
                                        if (class_exists('IntlDateFormatter')) {
                                            $formatter = new IntlDateFormatter('it_IT', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                            return $formatter->format(DateTime::createFromFormat('Y-m-d', $data));
                                        }
                                        return strftime('%d %B %Y', strtotime($data));
                                    }

                                    $settimane = [];
                                    for ($i = 1; $i <= 3; $i++) {
                                        $id_settimana = $dettagliPrenotazione["id_settimana$i"];
                                        if ($id_settimana) {
                                            $date_settimana = getWeekById($id_settimana);
                                            $settimane[$i] = [
                                                'date' => formattaData($date_settimana['inizio_settimana']) . " - " . formattaData($date_settimana['fine_settimana']),
                                                'lettini' => []
                                            ];
                                            for ($j = 1; $j <= 3; $j++) {
                                                $lettino = $dettagliPrenotazione["lettino{$j}_sett{$i}"];
                                                if ($lettino) {
                                                    $dati_lettino = getLettinoData($lettino);
                                                    $extra_fila = in_array($dati_lettino['fila'], [1, 2, 3, 4]) ? (int)$dati_lettino['sovrapprezzo'] : 0;
                                                    $extra_lett = ($j >= 2) ? $extra_lettino : 0;
                                                    $total_extra += $extra_fila + $extra_lettino;
                                                    error_log("SETTIMANA $i - LETTINO $j: ID=$lettino, FILA={$dati_lettino['fila']}, EXTRA FILA=$extra_fila, EXTRA LETTINO=$extra_lettino");
                                                    $settimane[$i]['lettini'][] = [
                                                        'id' => $lettino,
                                                        'fila' => $dati_lettino['fila'],
                                                        'extra_fila' => $extra_fila,
                                                        'extra_lettino' => $extra_lett
                                                    ];
                                                }
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap table-borderless mb-0">
                                            <tbody>
                                                <tr class="table-light">
                                                    <td colspan="2" class="fw-bold">PRENOTAZIONE <?php echo $codice_pren; ?> - <?php echo $nomeCliente; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">CODICE:</td>
                                                    <td class="td-right"><?php echo $codice_pren; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">CLIENTE:</td>
                                                    <td class="td-right"><?php echo $nomeCliente; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">EMAIL:</td>
                                                    <td class="td-right"><?php echo $email; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">TELEFONO:</td>
                                                    <td class="td-right"><?php echo $telefono; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">LINGUA:</td>
                                                    <td class="td-right"><?php echo $lingua; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">DATA INSERIMENTO:</td>
                                                    <td class="td-right"><?php echo $data_inserimento; ?></td>
                                                </tr>

                                                <?php foreach ($settimane as $num => $sett): ?>
                                                    <tr class="table-light">
                                                        <td class="fw-bold">SETTIMANA <?php echo $num; ?>: </td>
                                                        <td><span class="date"><?php echo $sett['date']; ?></span></td>
                                                    </tr>
                                                    <?php foreach ($sett['lettini'] as $index => $lettino): ?>
                                                        <tr>
                                                            <td class="fw-semibold">LETTINO <?php echo $index + 1; ?>:</td>
                                                            <td class="td-right">
                                                                <?php echo $lettino['id'] . " - FILA " . $lettino['fila']; ?>
                                                                <?php if ($lettino['extra_fila']) echo " <span class='extra1'>// EXTRA FILA {$lettino['fila']} +{$lettino['extra_fila']} €</span>"; ?>
                                                                <?php if ($lettino['extra_lettino']) echo " <span class='extra2'>// EXTRA LETTINO {$lettino['extra_lettino']} €</span>"; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>

                                                <tr class="table-light">
                                                    <td class="fw-semibold">TOTALE EXTRA:</td>
                                                    <td class="td-right"><?php echo $total_extra; ?> €</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!------------fine tabella------------->

                                </div>

                            </div>
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <!-- <h5 class="card-title mb-0">Dettaglio Prenotazione</h5> -->
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <!-- <button type="button" class="btn btn-success add-btn" id="create-btn" onclick="window.location.href='https://demoprenotazioni.303lab.it/';">
                                                <i class="ri-add-line align-bottom me-1"></i> Inserisci Prenotazione
                                            </button> -->

                                        </div>
                                    </div>
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

        // Seleziona il titolo e il suo elemento padre
        const titleElement = document.getElementById("dett-pren");
        const parentElement = titleElement.parentNode;

        // Rimuove temporaneamente il titolo
        parentElement.removeChild(titleElement);

        // Attendi un attimo per garantire la rimozione prima della generazione
        setTimeout(() => {
            // Genera il PDF con la tabella
            doc.autoTable({
                html: ".table"
            });

            // Salva il PDF
            doc.save("mappa_settore.pdf");

            // Reinserisce il titolo nella sua posizione originale
            parentElement.insertBefore(titleElement, parentElement.firstChild);
        }, 100);
    });
</script>
</body>

</html>