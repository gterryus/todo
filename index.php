<?php
if (isset($_COOKIE['login_user'])) {
    header('Location: todo-app.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- META DEFINITION -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#1F1D2B" />
        <meta name="msapplication-navbutton-color" content="#1F1D2B" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#1F1D2B" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Training intermediate programmer" />
        <meta name="keywords" content="Neuron, training, programmer" />
        <!-- END META DEFINITION -->

        <title>To do app</title>

        <!-- BOOTSTRAP STYLE -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- END BOOTSTRAP STYLE -->

        <!-- Custom style -->
        <link href="assets/style.css" rel="stylesheet" type="text/css" />
        <!-- End Custom style -->
    </head>
    <body>
        
        <div class="main-login">
            <h3 class="mb-3">Todo app login</h3>

            <div class="card card-login">
                <div class="card-body">
                    <?php
                        $err = isset($_GET['err']) ? $_GET['err'] : null;
                        echo '<p class="text-danger">' . $err . '</p>';
                    ?>
                    <form method="post" action="AuthenticationProcess.php">
                        <div class="form-group mb-3">
                            <label class="mb-2">Username*</label>
                            <input type="text" name="username" class="form-control" placeholder="johndoe" required/>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="mb-2">Password*</label>
                            <input type="password" name="password" class="form-control" placeholder="Type your password" required/>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- BOOTSTRAP JS + POPPER -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <!-- END BOOTSTRAP JS + POPPER -->

    </body>
</html>