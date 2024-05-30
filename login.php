<?php
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Capacitación Docente ITESCA</title>
    <link rel="icon" href="assets/images/icono-itesca.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="text-center">
        <h1>Capacitación Docente</h1>
    </header>
    <main>
        <div class="d-flex justify-content-center">
            <form action="modules/authenticate.php" method="post">
                <label for="user">User</label><br>
                <input type="text" name="user" id="user"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password"><br>
                <input type="submit" value="Iniciar Sesión">
            </form>
        </div>
    </main>
</body>

</html>