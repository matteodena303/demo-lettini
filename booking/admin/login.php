<?php // include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>


<?php
// Avvia la sessione
session_start();


// Includi i file necessari (connessione DB, funzioni e così via)
require_once '../class/MYSQL.php';       // dove hai definito checkLogin()

$login_error = '';

// Se la richiesta arriva con metodo POST (submit del form)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Prendi i campi inviati dal form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica le credenziali
    $user = checkLogin($username, $password);

    if ($user !== false) {
        // Credenziali valide: settiamo i dati di sessione
        $_SESSION['username'] = $user['username']; // o $user['id']
        
        // Reindirizza a una pagina protetta
        header('Location: index.php');
        exit();
    } else {
        // Credenziali non valide
        // $login_error = 'Credenziali non valide. Riprova.';
                $login_error =  "Username inviato: " . htmlspecialchars($username) . "<br>Password inviata: " . htmlspecialchars($password) . "<br>";


    }

    $user = checkLogin($username, $password);



}

// Se arrivi qui, non è stato effettuato alcun redirect, quindi o
// è un GET o la verifica credenziali è fallita.
// Ora prosegui con l’HTML della form...



?>



<head>

    <title>Sign In | BRA</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay bg-dark"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card overflow-hidden">
                        <div class="p-lg-5 p-4">
                            <div>
                                <h5 class="text-primary">Bentornato !</h5>
                                <p class="text-muted">Effettua il login per accedere al pannello admin.</p>
                            </div>

                            <div class="mt-4">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Inserisci l'username" required>
                                    </div>

                                    <div class="mb-3">
                                        <!-- <div class="float-end"> -->
                                            <!-- <a href="auth-pass-reset-cover.php" class="text-muted">Password dimenticata?</a>
                                        </div> -->
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" id="password-input" name="password" placeholder="Inserisci la password" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted shadow-none password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>

                                    <!-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Ricordami</label>
                                    </div> -->

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Login</button>
                                    </div>

                                    <!-- <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                        </div>
                                    </div> -->

                                    <?php
                                    if (isset($login_error)) {
                                        echo '<div class="mt-3 text-danger text-center">' . $login_error . '</div>';
                                    }
                                    ?>
                                </form>
                            </div>

                            <!-- <div class="mt-5 text-center">
                                <p class="mb-0">Don't have an account ? <a href="auth-signup-cover.php" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy; <script>
                                document.write(new Date().getFullYear())
                            </script> BRA - Design & Develop by Anda Creativa</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- password-addon init -->
<script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>