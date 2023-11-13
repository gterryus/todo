<?php
require_once __DIR__ . '/vendor/autoload.php';
use TodoController\TodoController;

if (!isset($_COOKIE['login_user'])) {
    $err = "Your session have been timeout!";
    header('Location: index.php?err=' . $err);
    exit();
}

session_start();

$datauser = isset($_SESSION['datauser']) ? $_SESSION['datauser'] : [];

$todopage = new TodoController();
$datatodo = $todopage->getTodo();

$full_name = $datauser['first_name'] . ' ' . $datauser['last_name'];
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
        <div class="navbar">
            <h4 class="text-bold m-0">Welcome back <?php echo $full_name; ?>!</h4>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="container">
            <div class="card card-form-todo mb-3">
                <div class="card-body">
                    <h3>Setup your to do list</h3>
                    <?php
                        $message = isset($_GET['message']) ? $_GET['message'] : null;
                        echo '<p class="text-danger">' . $message . '</p>';
                    ?>

                    <form action="./TodoController.php?action=createTodo" method="post">
                        <div class="form-group mb-3">
                            <label class="mb-2">Upload a banner</label>
                            <input type="file" class="form-control" placeholder="Write your next activities" name="todoFile" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2">To do activities</label>
                            <input type="text" class="form-control" placeholder="Write your next activities" name="todoText" />
                        </div>
                        <button type="submit" class="btn btn-primary">Save to do</button>
                    </form>
                </div>
            </div>

            <ul class="list-group">
                <?php foreach ($datatodo as $row) { ?>
                <li class="list-group-item">
                    <div class="todo-info">
                        <img src="./assets/img/<?php echo $row['image']; ?>" class="thumbnail"/>
                        <p><?php echo $row['title']; ?></p>
                    </div>
                    <div class="todo-action">
                        <a href="TodoController.php?edit=<?php echo $row['id_todo']; ?>" class="btn btn-outline-warning">Edit</a>
                        <a href="TodoController.php?delete=<?php echo $row['id_todo']; ?>" class="btn btn-outline-danger">Hapus</a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>


        <!-- BOOTSTRAP JS + POPPER -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <!-- END BOOTSTRAP JS + POPPER -->

    </body>
</html>