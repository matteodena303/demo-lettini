<?php
include 'layouts/session.php';
include 'layouts/head-main.php';
include '../class/MYSQL.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


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

    .edit-button {
        box-shadow: none !important;
    }

    .button.btn.btn-link.text-primary.p-0 {
        box-shadow: none !important;

    }

    button#back-to-top {
        display: none !important;
    }

    form {
        padding-bottom: 10px;
    }
</style>

<?php
// ------------------------------------------------
// FUNZIONI DI SUPPORTO
// ------------------------------------------------



// Converte la data SQL in un formato leggibile (se vuota, ritorna "-")
function formattaData($dataSql)
{
    if (empty($dataSql)) return "-";
    try {
        $mesiItaliani = [
            'January' => 'Gennaio',
            'February' => 'Febbraio',
            'March' => 'Marzo',
            'April' => 'Aprile',
            'May' => 'Maggio',
            'June' => 'Giugno',
            'July' => 'Luglio',
            'August' => 'Agosto',
            'September' => 'Settembre',
            'October' => 'Ottobre',
            'November' => 'Novembre',
            'December' => 'Dicembre'
        ];

        $dt = new DateTime($dataSql);
        $dataFormato = $dt->format('d F Y'); // es. "10 February 2025"

        // Sostituzione manuale dei mesi in inglese con quelli italiani
        return strtr($dataFormato, $mesiItaliani);
    } catch (Exception $e) {
        return $dataSql;
    }
}


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


/**
 * buildSettimana():
 *   - Mostra "DAL: xx", "AL: xx" e "LETTINI: xx" solo se valorizzati
 *   - Se tutto è vuoto o "-", ritorna stringa vuota
 */
function buildSettimana($inizio, $fine, $l1, $l2, $l3)
{
    $inizioFmt = formattaData($inizio); // "10 Feb 2025" oppure "-"
    $fineFmt   = formattaData($fine);   // idem
    $lettini   = formattaLettini($l1, $l2, $l3); // es. "4, 5" oppure ""

    // Verifichiamo se TUTTO è vuoto o "-"
    $nothingForDal  = ($inizioFmt === "-" || $inizioFmt === "");
    $nothingForAl   = ($fineFmt   === "-" || $fineFmt   === "");
    $nothingForLett = ($lettini   === "");

    if ($nothingForDal && $nothingForAl && $nothingForLett) {
        // Nessuna settimana prenotata
        return "";
    }

    // Altrimenti mostriamo solo i campi effettivamente non vuoti
    $outputLines = [];
    if (!$nothingForDal) {
        $outputLines[] = "DAL: $inizioFmt";
    }
    if (!$nothingForAl) {
        $outputLines[] = "AL: $fineFmt";
    }
    if (!$nothingForLett) {
        $outputLines[] = "OMBRELLONI: $lettini";
    }

    return $outputLines ? implode("<br>", $outputLines) : "";
}
?>

<head>
    <title>Prenotazioni | BRA</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>

<!-- Begin page -->
<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">PRENOTAZIONI</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title mb-0">Lista Prenotazioni</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <button type="button" class="btn btn-success add-btn" id="create-btn"
                                                onclick="window.location.href='https://www.bibioneresidence.it/booking/index-admin.php';">
                                                <i class="ri-add-line align-bottom me-1"></i> Inserisci Prenotazione
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-xxl-5 col-sm-6">
                                            <div class="search-box">
                                                <input type="text" class="form-control search"
                                                    placeholder="Cerca per Cod., Nome Cliente, email, n.tel...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body pt-0">
                                <div>
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th>COD.</th>
                                                    <th>CLIENTE</th>
                                                    <th>SETTIMANA 1</th>
                                                    <th>SETTIMANA 2</th>
                                                    <th>SETTIMANA 3</th>
                                                    <th>DATA</th>
                                                    <th>AZIONI</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php
                                                $prenotazioni = getAllPrenotazioni();
                                                if (count($prenotazioni) > 0) {
                                                    foreach ($prenotazioni as $row) {
                                                        // Contatti (Nome, Email, Telefono, Lingua)
                                                        $contatti  = "<b>" . htmlspecialchars($row['nome_cliente']) . "</b>";
                                                        $contatti .= "<br><small>";
                                                        $contatti .= htmlspecialchars($row['email'])    . "<br>";
                                                        $contatti .= htmlspecialchars($row['telefono']) . "<br>";
                                                        $contatti .= htmlspecialchars($row['lingua']);
                                                        $contatti .= "</small>";

                                                        // Settimana 1
                                                        $settimana1 = buildSettimana(
                                                            $row['inizio1'],
                                                            $row['fine1'],
                                                            $row['lettino1_sett1'],
                                                            $row['lettino2_sett1'],
                                                            $row['lettino3_sett1']
                                                        );
                                                        if (!$settimana1) {
                                                            $settimana1 = "-";
                                                        }

                                                        // Settimana 2
                                                        $settimana2 = buildSettimana(
                                                            $row['inizio2'],
                                                            $row['fine2'],
                                                            $row['lettino1_sett2'],
                                                            $row['lettino2_sett2'],
                                                            $row['lettino3_sett2']
                                                        );
                                                        if (!$settimana2) {
                                                            $settimana2 = "-";
                                                        }

                                                        // Settimana 3
                                                        $settimana3 = buildSettimana(
                                                            $row['inizio3'],
                                                            $row['fine3'],
                                                            $row['lettino1_sett3'],
                                                            $row['lettino2_sett3'],
                                                            $row['lettino3_sett3']
                                                        );
                                                        if (!$settimana3) {
                                                            $settimana3 = "-";
                                                        }
                                                ?>

                                                        <tr>
                                                            <td class="id">
                                                                <form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                                                    <input type="hidden" name="codice_prenotazione" value="<?php echo htmlspecialchars($row['codice']); ?>">
                                                                    <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                                                        #<?php echo htmlspecialchars($row['codice']); ?>
                                                                    </button>
                                                                </form>
                                                            </td>

                                                            <td class="customer_name" style="line-height: 14px;">
                                                                <?php echo $contatti; ?>
                                                            </td>
                                                            <td class="date">
                                                                <?php echo $settimana1; ?>
                                                            </td>
                                                            <td class="date">
                                                                <?php echo $settimana2; ?>
                                                            </td>
                                                            <td class="date">
                                                                <?php echo $settimana3; ?>
                                                            </td>
                                                            <td class="date" data-sort="<?php echo str_replace('-', '', $row['sortable_date']); ?>">
                                                                <small>
                                                                    inserito in data <br>
                                                                    <?php echo htmlspecialchars($row['date']); ?>
                                                                </small>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline hstack gap-2 mb-0">

                                                                    <!-- Visualizza Dettagli -->
                                                                    <li class="list-inline-item"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-trigger="hover"
                                                                        data-bs-placement="top"
                                                                        title="Visualizza Dettagli">
                                                                        <form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                                                            <input type="hidden"
                                                                                name="codice_prenotazione"
                                                                                value="<?php echo htmlspecialchars($row['codice']); ?>">
                                                                            <button type="submit" class="edit-button btn btn-link text-primary p-0">
                                                                                <i class="ri-eye-fill fs-16"></i>
                                                                            </button>
                                                                        </form>
                                                                    </li>

                                                                    <!-- Modifica Dati Cliente -->
                                                                    <li class="list-inline-item edit"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-trigger="hover"
                                                                        data-bs-placement="top"
                                                                        title="Modifica dati Cliente">
                                                                        <a href="#"
                                                                            class="text-primary d-inline-block"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editModal"
                                                                            onclick="editPrenotazione('<?php echo addslashes($row['codice']); ?>')">
                                                                            <i class="ri-pencil-fill fs-16"></i>
                                                                        </a>
                                                                    </li>

                                                                    <!-- Riprogramma Settimane -->
                                                                    <li class="list-inline-item"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-trigger="hover"
                                                                        data-bs-placement="top"
                                                                        title="Riprogramma Settimane">
                                                                        <form action="../riprogramma.php" method="POST" style="display:inline;">
                                                                            <input type="hidden"
                                                                                name="codice_prenotazione"
                                                                                value="<?php echo htmlspecialchars($row['codice']); ?>">
                                                                            <button type="submit" class="edit-button btn btn-link text-primary p-0">
                                                                                <i class="ri-calendar-todo-line fs-16"></i>
                                                                            </button>
                                                                        </form>
                                                                    </li>

                                                                    <!-- Elimina Prenotazione -->
                                                                    <li class="list-inline-item"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-trigger="hover"
                                                                        data-bs-placement="top"
                                                                        title="Elimina">
                                                                        <button onclick="deletePrenotazione('<?php echo htmlspecialchars($row['codice']); ?>')"
                                                                            class="edit-button btn btn-link text-danger p-0">
                                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            Nessuna prenotazione trovata
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>

                                        </table>

                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#405189,secondary:#0ab39c"
                                                    style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2">Nessuna prenotazione trovata</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2">
                                            <a class="page-item pagination-prev disabled" href="#">
                                                Precedente
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-item pagination-next" href="#">
                                                Prossimo
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modale: Modifica Prenotazione -->
                                <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifica Prenotazione</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="editPrenotazione.php" method="POST" id="editForm">
                                                <div class="modal-body">
                                                    <input type="hidden" name="oldCodice" id="oldCodice">
                                                    <div class="mb-3">
                                                        <label for="editCodice" class="form-label">Codice Prenotazione</label>
                                                        <input type="text" class="form-control"
                                                            id="editCodice" name="codicePrenotazione" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editNomeCognome" class="form-label">Nome Cliente</label>
                                                        <input type="text" class="form-control"
                                                            id="editNomeCognome" name="nomeCognome" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editEmail" class="form-label">E-mail</label>
                                                        <input type="email" class="form-control"
                                                            id="editEmail" name="email" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editTelefono" class="form-label">Telefono</label>
                                                        <input type="text" class="form-control"
                                                            id="editTelefono" name="telefono" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editLingua" class="form-label">Lingua</label>
                                                        <select class="form-select" id="editLingua" name="lingua" required>
                                                            <option value="ITA">ITA</option>
                                                            <option value="ENG">ENG</option>
                                                            <option value="DEU">DEU</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Annulla
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        Salva Modifiche
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fine Modale -->

                                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-5 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#405189,secondary:#f06548"
                                                    style="width:90px;height:90px">
                                                </lord-icon>
                                                <div class="mt-4 text-center">
                                                    <h4>Sei sicuro di voler eliminare questa prenotazione ?</h4>
                                                    <p class="text-muted fs-15 mb-4">
                                                        Confermando eliminerai tutti i dati di questa prenotazione.
                                                    </p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                            id="deleteRecord-close" data-bs-dismiss="modal">
                                                            <i class="ri-close-line me-1 align-middle"></i> Chiudi
                                                        </button>
                                                        <button class="btn btn-danger" id="delete-record">
                                                            Sì, Elimina
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal -->
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

<!-- list.js -->
<script src="assets/libs/list.js/list.min.js"></script>
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/pages/ecommerce-order.init.js"></script>
<script src="assets/js/app.js"></script>

<?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Modifica completata!",
                text: "La prenotazione è stata aggiornata con successo.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                // Rimuove ?update=success dall'URL senza ricaricare la pagina
                const newUrl = window.location.pathname + window.location.search.replace(/&?update=success/, "");
                window.history.replaceState({}, document.title, newUrl);
            });
        });
    </script>
<?php endif; ?>



<script>
    //elimina la prenotazione e pulisce la cache di siteground
    function deletePrenotazione(codice) {
        if (confirm('Sei sicuro di voler eliminare questa prenotazione?')) {
            fetch('delete_prenotazione.php?delete_id=' + encodeURIComponent(codice))
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Prenotazione eliminata con successo!');
                        window.location.href = "index.php?nocache=" + new Date().getTime(); // Forza refresh senza cache
                    } else {
                        alert('Errore: ' + data.error);
                    }
                })
                .catch(error => alert('Errore durante la richiesta.'));
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector(".search");
        const tableBody = document.querySelector("#orderTable tbody");
        const tableRows = Array.from(tableBody.querySelectorAll("tr"));
        const noResultDiv = document.querySelector(".noresult");
        const paginationContainer = document.querySelector(".pagination");
        const prevButton = document.querySelector(".pagination-prev");
        const nextButton = document.querySelector(".pagination-next");
        const rowsPerPage = 25;
        let currentPage = 1;
        let filteredRows = [...tableRows];

        function updatePagination() {
            paginationContainer.innerHTML = "";
            let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            if (totalPages === 0) totalPages = 1;
            for (let i = 1; i <= totalPages; i++) {
                let pageItem = document.createElement("li");
                pageItem.classList.add("page-item");
                pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                pageItem.addEventListener("click", function(e) {
                    e.preventDefault();
                    currentPage = i;
                    showPage();
                    highlightActivePage();
                });
                paginationContainer.appendChild(pageItem);
            }
            updateNavigationButtons(totalPages);
            highlightActivePage();
        }

        function highlightActivePage() {
            paginationContainer.querySelectorAll(".page-item").forEach((item, idx) => {
                item.classList.toggle("active", idx + 1 === currentPage);
            });
        }

        function showPage() {
            tableRows.forEach(row => row.style.display = "none");
            let start = (currentPage - 1) * rowsPerPage;
            let end = start + rowsPerPage;
            filteredRows.slice(start, end).forEach(row => row.style.display = "");
            let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            updateNavigationButtons(totalPages);
            highlightActivePage();
        }

        function updateNavigationButtons(totalPages) {
            prevButton.classList.toggle("disabled", currentPage === 1);
            nextButton.classList.toggle("disabled", currentPage === totalPages);
            prevButton.onclick = function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    showPage();
                    highlightActivePage();
                }
            };
            nextButton.onclick = function(e) {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage();
                    highlightActivePage();
                }
            };
        }

        // Sostituiamo la search con una nuova per evitare conflitti
        let newSearchInput = searchInput.cloneNode(true);
        searchInput.parentNode.replaceChild(newSearchInput, searchInput);

        newSearchInput.addEventListener("input", function() {
            const searchText = newSearchInput.value.trim().toLowerCase();
            let matchFound = false;
            filteredRows = [];

            tableRows.forEach(row => {
                const cod = row.querySelector("td.id a")?.textContent.toLowerCase() || "";
                const cliente = row.querySelector("td.customer_name")?.textContent.toLowerCase() || "";
                if (cod.includes(searchText) || cliente.includes(searchText)) {
                    filteredRows.push(row);
                    matchFound = true;
                }
            });

            noResultDiv.style.display = matchFound ? "none" : "block";
            currentPage = 1;
            updatePagination();
            showPage();
        });

        updatePagination();
        showPage();
    });

    // Per caricare i dati di una prenotazione da modificare via AJAX
    function editPrenotazione(codicePrenotazione) {
        let timestamp = new Date().getTime(); // Genera un timestamp unico

        fetch('getPrenotazione.php?cod=' + encodeURIComponent(codicePrenotazione) + '&nocache=' + timestamp)
            .then(response => response.json())
            .then(data => {
                document.getElementById('oldCodice').value = data.oldCodice;
                document.getElementById('editCodice').value = data.codicePrenotazione;
                document.getElementById('editNomeCognome').value = data.nomeCognome;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editTelefono').value = data.telefono;
                document.getElementById('editLingua').value = data.lingua;
            })
            .catch(err => {
                console.error('Errore fetch getPrenotazione:', err);
            });
    }

    // Forza il reload della pagina con un parametro univoco per evitare la cache
    (function() {
        let url = new URL(window.location.href);
        if (!url.searchParams.has('nocache')) {
            url.searchParams.set('nocache', new Date().getTime());
            window.location.replace(url.href);
        }
    })();
</script>

</body>

</html>