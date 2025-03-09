<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php
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

    .delete-button {
        -webkit-box-shadow: none !important;
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
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Connessione al database
$servername = "localhost";
$username = "urxyl2og5uvmh";
$password = "mpkfa123stella";
$dbname = "dbw5ffqcbgv2wq";
// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);
// Controllo della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
// Imposta la lingua italiana per i nomi dei mesi
$conn->query("SET lc_time_names = 'it_IT'");
// Se c'è un messaggio di ritorno dall'update
if (isset($_GET['update'])) {
    if ($_GET['update'] === 'success') {
        echo "<script>alert('Prenotazione aggiornata con successo!');</script>";
    } elseif ($_GET['update'] === 'notfound') {
        echo "<script>alert('Codice prenotazione non trovato!');</script>";
    } else {
        echo "<script>alert('Errore nell\'aggiornamento della prenotazione!');</script>";
    }
}
// Verifica se è stato inviato un ID per la rimozione
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    // Prepara ed esegui la query per eliminare la prenotazione
    $stmt = $conn->prepare("DELETE FROM prenotazioni WHERE codice_prenotazione = ?");
    $stmt->bind_param("s", $delete_id);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Prenotazione #$delete_id eliminata con successo.</div>";
    } else {
        echo "<div class='alert alert-danger'>Errore durante l'eliminazione della prenotazione.</div>";
    }
    $stmt->close();
}
// Verifica se è stato inviato un ID per la rimozione
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
//     $delete_id = $_POST['delete_id']; // codice_prenotazione
//     // 1) Recupero id_cliente da prenotazioni
//     $stmt = $conn->prepare("SELECT id_cliente FROM prenotazioni WHERE codice_prenotazione = ?");
//     $stmt->bind_param("s", $delete_id);
//     $stmt->execute();
//     $res = $stmt->get_result();
//     if ($res->num_rows > 0) {
//         // Trovato
//         $row = $res->fetch_assoc();
//         $id_cliente = $row['id_cliente'];
//         $stmt->close();
//         // 2) Elimino la prenotazione
//         $stmt = $conn->prepare("DELETE FROM prenotazioni WHERE codice_prenotazione = ?");
//         $stmt->bind_param("s", $delete_id);
//         $okPrenotazione = $stmt->execute();
//         $stmt->close();
//         if ($okPrenotazione) {
//             // 3) Elimino il cliente
//             $stmt = $conn->prepare("DELETE FROM clienti WHERE id_cliente = ?");
//             $stmt->bind_param("i", $id_cliente);
//             $okCliente = $stmt->execute();
//             $stmt->close();
//             if ($okCliente) {
//                 echo "<div class='alert alert-success'>Prenotazione #$delete_id e il relativo cliente eliminati con successo.</div>";
//             } else {
//                 echo "<div class='alert alert-danger'>Prenotazione eliminata, ma errore durante l'eliminazione del cliente.</div>";
//             }
//         } else {
//             echo "<div class='alert alert-danger'>Errore durante l'eliminazione della prenotazione #$delete_id.</div>";
//         }
//     } else {
//         // Non trovato
//         echo "<div class='alert alert-danger'>Nessuna prenotazione con codice #$delete_id trovata.</div>";
//     }
// }
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
                                            <button type="button" class="btn btn-success add-btn" id="create-btn" onclick="window.location.href='https://demoprenotazioni.303lab.it/';">
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
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-6">
                                            <!-- <div>
                                                <input type="text" class="form-control" data-provider="flatpickr"
                                                    data-date-format="d M, Y" data-range-date="true"
                                                    id="demo-datepicker" placeholder="Select date">
                                            </div> -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <!-- <div>
                                                <select class="form-control" data-choices data-choices-search-false
                                                    name="choices-single-default" id="idStatus">
                                                    <option value="">Status</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Inprogress">Inprogress</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Pickups">Pickups</option>
                                                    <option value="Returns">Returns</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <!-- <div>
                                                <select class="form-control" data-choices data-choices-search-false
                                                    name="choices-single-default" id="idPayment">
                                                    <option value="">Select Payment</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="Mastercard">Mastercard</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="Visa">Visa</option>
                                                    <option value="COD">COD</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-1 col-sm-4">
                                            <!-- <div>
                                                <button type="button" class="btn btn-primary w-100"
                                                    onclick="SearchData();"> <i
                                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                                    Filters
                                                </button>
                                            </div> -->
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <!-- <th scope="col" style="width: 25px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="checkAll" value="option">
                                                        </div>
                                                    </th> -->
                                                    <th class="sort" data-sort="id">COD.</th>
                                                    <th class="sort" data-sort="customer_name">CLIENTE</th>
                                                    <th class="" data-sort="product_name">SETTIMANA 1</th>
                                                    <th class="" data-sort="status">SETTIMANA 2</th>
                                                    <th class="" data-sort="amount">SETTIMANA 3</th>
                                                    <th class="" data-sort="date">DATA</th>
                                                    <th class="" data-sort="city">AZIONI</th>
                                                </tr>
                                            </thead>
                                            <!------------------------------------------------------------------->
                                            <!--------------------------- TEST ---------------------------------->
                                            <!------------------------------------------------------------------->
                                            <tbody class="list form-check-all">
                                                <?php
                                                // // Connessione al database
                                                // $servername = "localhost";
                                                // $username = "urxyl2og5uvmh";
                                                // $password = "mpkfa123stella";
                                                // $dbname = "dbw5ffqcbgv2wq";
                                                // // Creazione della connessione
                                                // $conn = new mysqli($servername, $username, $password, $dbname);
                                                // // Controllo della connessione
                                                // if ($conn->connect_error) {
                                                //     die("Connessione fallita: " . $conn->connect_error);
                                                // }
                                                // // Imposta la lingua italiana per i nomi dei mesi
                                                // // Imposta la lingua italiana per i nomi dei mesi
                                                // $conn->query("SET lc_time_names = 'it_IT'");
                                                // Query per ottenere i dati aggregati
                                                $sql = "
                                                        SELECT
                                                            p.codice_prenotazione AS codice,
                                                            CONCAT('<b>', c.nome_cliente, '</b>', '<br><small>', c.email, '<br>', c.telefono, '<br>', c.lingua, '</small>') AS contatti,
                                                            CONCAT('<b><small>DAL:</small></b> ', DATE_FORMAT(s1.inizio_settimana, '%e %b %Y'),
                                                                '<br><b><small>AL: </small></b> ', DATE_FORMAT(s1.fine_settimana, '%e %b %Y'),
                                                                '<br><b><small>LETTINI:</small></b> ',
                                                                CONCAT_WS(', ',
                                                                            NULLIF(p.lettino1_sett1, '-'),
                                                                            NULLIF(p.lettino2_sett1, '-'),
                                                                            NULLIF(p.lettino3_sett1, '-'))) AS settimana1,
                                                            CONCAT('<b><small>DAL:</small></b> ', DATE_FORMAT(s2.inizio_settimana, '%e %b %Y'),
                                                                '<br><b><small>AL:</small></b> ', DATE_FORMAT(s2.fine_settimana, '%e %b %Y'),
                                                                '<br><b><small>LETTINI:</small></b> ',
                                                                CONCAT_WS(', ',
                                                                            NULLIF(p.lettino1_sett2, '-'),
                                                                            NULLIF(p.lettino2_sett2, '-'),
                                                                            NULLIF(p.lettino3_sett2, '-'))) AS settimana2,
                                                            CONCAT('<b><small>DAL:</small></b> ', DATE_FORMAT(s3.inizio_settimana, '%e %b %Y'),
                                                                '<br><b><small>AL:</small></b> ', DATE_FORMAT(s3.fine_settimana, '%e %b %Y'),
                                                                '<br><b><small>LETTINI:</small></b> ',
                                                                CONCAT_WS(', ',
                                                                            NULLIF(p.lettino1_sett3, '-'),
                                                                            NULLIF(p.lettino2_sett3, '-'),
                                                                            NULLIF(p.lettino3_sett3, '-'))) AS settimana3,
                                                            DATE_FORMAT(p.data_inserimento, '%Y-%m-%d') AS sortable_date,
                                                            DATE_FORMAT(p.data_inserimento, '%d-%m-%Y') AS date
                                                        FROM prenotazioni p
                                                        LEFT JOIN clienti c ON p.id_cliente = c.id_cliente
                                                        LEFT JOIN settimane s1 ON p.id_settimana1 = s1.id_settimana
                                                        LEFT JOIN settimane s2 ON p.id_settimana2 = s2.id_settimana
                                                        LEFT JOIN settimane s3 ON p.id_settimana3 = s3.id_settimana;
                                                    ";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    // Stampa i dati di ogni riga
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<tr>
                                                        <td class="id">
                                                            <a href="#" class="fw-medium link-primary">#' . $row['codice'] . '</a>
                                                        </td>
                                                        <td class="customer_name" style="line-height: 14px;">' . $row['contatti'] . '</td>
                                                        <td class="date">' . $row['settimana1'] . '</td>
                                                        <td class="date">' . $row['settimana2'] . '</td>
                                                        <td class="date">' . $row['settimana3'] . '</td>
                                                        <td class="date" data-sort="' . $row['sortable_date'] . '">
                                                            <small>inserito in data <br>' . $row['date'] . '</small>
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <!-- Visualizza Dettagli -->
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Visualizza Dettagli">
                                                                    <form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                                                        <input type="hidden" name="codice_prenotazione" value="' . $row['codice'] . '">
                                                                        <button type="submit" class="btn btn-link text-primary p-0">
                                                                            <i class="ri-eye-fill fs-16"></i>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <!-- Modifica Dati Cliente -->
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Modifica dati Cliente">
                                                                    <a href="#"
                                                                       class="text-primary d-inline-block"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#editModal"
                                                                       onclick="editPrenotazione(\'' . $row['codice'] . '\')">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <!-- Riprogramma Settimane -->
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Riprogramma Settimane">
                                                                    <form action="../riprogramma.php" method="POST" style="display:inline;">
                                                                        <input type="hidden" name="codice_prenotazione" value="' . $row['codice'] . '">
                                                                        <button type="submit" class="btn btn-link text-primary p-0">
                                                                            <i class="ri-calendar-todo-line fs-16"></i>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <!-- Elimina Prenotazione -->
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Elimina">
                                                                    <form method="POST"
                                                                          onsubmit="return confirm(\'Sei sicuro di voler eliminare questa prenotazione?\');"
                                                                          style="display:inline;">
                                                                        <input type="hidden" name="delete_id" value="' . $row['codice'] . '">
                                                                        <button type="submit" class="delete-button btn btn-link text-danger p-0">
                                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>';
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='8' class='text-center'>Nessuna prenotazione trovata</td></tr>";
                                                }
                                                // Chiudere la connessione
                                                $conn->close();
                                                ?>
                                            </tbody>
                                            <!------------------------------------------------------------------->
                                            <!------------------------FINE TEST --------------------------------->
                                            <!------------------------------------------------------------------->
                                        </table>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#405189,secondary:#0ab39c"
                                                    style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted">We've searched more than 150+ Orders We did
                                                    not find any
                                                    orders for you search.</p>
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
                                <!-------------POPUP----------------->
                                <!-- Popup per Modifica Prenotazione -->
                                <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifica Prenotazione</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- L'action punta allo script PHP che eseguirà l'UPDATE -->
                                            <form action="editPrenotazione.php" method="POST" id="editForm">
                                                <div class="modal-body">
                                                    <!-- Campo hidden per il "vecchio" codice prenotazione -->
                                                    <input type="hidden" name="oldCodice" id="oldCodice">
                                                    <!-- Campo per il "nuovo" codice (o lo stesso, se non vuoi cambiarlo) -->
                                                    <div class="mb-3">
                                                        <label for="editCodice" class="form-label">Codice Prenotazione</label>
                                                        <input type="text" class="form-control" id="editCodice" name="codicePrenotazione" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editNomeCognome" class="form-label">Nome Cliente</label>
                                                        <input type="text" class="form-control" id="editNomeCognome" name="nomeCognome" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editEmail" class="form-label">E-mail</label>
                                                        <input type="email" class="form-control" id="editEmail" name="email" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editTelefono" class="form-label">Telefono</label>
                                                        <input type="text" class="form-control" id="editTelefono" name="telefono" required>
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-5 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#405189,secondary:#f06548"
                                                    style="width:90px;height:90px"></lord-icon>
                                                <div class="mt-4 text-center">
                                                    <h4>Sei sicuro di voler eliminare questa prenotazione ?</h4>
                                                    <p class="text-muted fs-15 mb-4">Confermando eliminerai
                                                        tutti i dati di questa prenotazione dal database.</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button
                                                            class="btn btn-link link-success fw-medium text-decoration-none"
                                                            id="deleteRecord-close" data-bs-dismiss="modal"><i
                                                                class="ri-close-line me-1 align-middle"></i>
                                                            Chiudi</button>
                                                        <button class="btn btn-danger" id="delete-record">Si,
                                                            Elimina</button>
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
<!-- list.js min js -->
<script src="assets/libs/list.js/list.min.js"></script>
<!--list pagination js-->
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- ecommerce-order init js -->
<script src="assets/js/pages/ecommerce-order.init.js"></script>
<!-- App js -->
<script src="assets/js/app.js"></script>
<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     const searchInput = document.querySelector(".search");
    //     const tableRows = document.querySelectorAll("#orderTable tbody tr");
    //     const noResultDiv = document.querySelector(".noresult");
    //     // Rimuove gli eventi preesistenti sulla barra di ricerca
    //     let newSearchInput = searchInput.cloneNode(true);
    //     searchInput.parentNode.replaceChild(newSearchInput, searchInput);
    //     // Aggiunge il nuovo event listener sulla barra di ricerca
    //     newSearchInput.addEventListener("input", function() {
    //         const searchText = newSearchInput.value.trim().toLowerCase();
    //         let matchFound = false;
    //         tableRows.forEach(row => {
    //             const cod = row.querySelector("td.id a")?.textContent.toLowerCase() || "";
    //             const cliente = row.querySelector("td.customer_name")?.textContent.toLowerCase() || "";
    //             if (cod.includes(searchText) || cliente.includes(searchText)) {
    //                 row.style.display = "";
    //                 matchFound = true;
    //             } else {
    //                 row.style.display = "none";
    //             }
    //         });
    //         // Mostra/nasconde il messaggio "Nessuna prenotazione trovata"
    //         noResultDiv.style.display = matchFound ? "none" : "block";
    //     });
    // });
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector(".search");
        const tableBody = document.querySelector("#orderTable tbody");
        const tableRows = Array.from(tableBody.querySelectorAll("tr"));
        const noResultDiv = document.querySelector(".noresult");
        const paginationContainer = document.querySelector(".pagination");
        const prevButton = document.querySelector(".pagination-prev");
        const nextButton = document.querySelector(".pagination-next");
        const rowsPerPage = 25; // Numero di righe per pagina
        let currentPage = 1;
        let filteredRows = [...tableRows]; // Copia iniziale di tutte le righe
        // Funzione per aggiornare la paginazione
        function updatePagination() {
            paginationContainer.innerHTML = ""; // Svuota la paginazione
            let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            if (totalPages === 0) totalPages = 1; // Evita che la paginazione sparisca se non ci sono risultati
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
        // Funzione per evidenziare la pagina attuale
        function highlightActivePage() {
            paginationContainer.querySelectorAll(".page-item").forEach((item, index) => {
                item.classList.toggle("active", index + 1 === currentPage);
            });
        }
        // Funzione per mostrare solo le righe della pagina attuale
        function showPage() {
            tableRows.forEach(row => row.style.display = "none"); // Nasconde tutte le righe
            let start = (currentPage - 1) * rowsPerPage;
            let end = start + rowsPerPage;
            filteredRows.slice(start, end).forEach(row => row.style.display = ""); // Mostra solo le righe della pagina
            let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            updateNavigationButtons(totalPages);
            highlightActivePage(); // Aggiorna la pagina attuale evidenziata
        }
        // Funzione per aggiornare lo stato dei pulsanti "Precedente" e "Prossimo"
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
        // Rimuove gli eventi preesistenti sulla barra di ricerca
        let newSearchInput = searchInput.cloneNode(true);
        searchInput.parentNode.replaceChild(newSearchInput, searchInput);
        // Aggiunge il nuovo event listener sulla barra di ricerca
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
            // Mostra/Nasconde il messaggio "Nessuna prenotazione trovata"
            noResultDiv.style.display = matchFound ? "none" : "block";
            // Reset paginazione alla prima pagina e aggiorna
            currentPage = 1;
            updatePagination();
            showPage();
        });
        // Inizializza la paginazione con tutte le righe visibili
        updatePagination();
        showPage();
    });
    /// funzione per popup modifica
    function editPrenotazione(codicePrenotazione) {
        // Effettua una chiamata AJAX/Fetch a getPrenotazione.php?cod=...
        // e poi compila i campi del form nel popup.
        fetch('getPrenotazione.php?cod=' + encodeURIComponent(codicePrenotazione))
            .then(response => response.json())
            .then(data => {
                // Riempi i campi
                document.getElementById('oldCodice').value = data.oldCodice; // oppure data.codicePrenotazione
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
</script>
</body>

</html>