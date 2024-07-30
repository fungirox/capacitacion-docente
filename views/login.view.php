<? require $_SERVER['DOCUMENT_ROOT'] . "/views/components/header.php"; ?>
<header class="text-center">
    <h1>Capacitación Docente</h1>
</header>
<main>
    <div class="d-flex justify-content-center">
        <form action="/authenticate" method="post">
            <label for="user">User</label><br>
            <input type="text" name="user" id="user"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password"><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</main>
<? require $_SERVER['DOCUMENT_ROOT'] . "/views/components/footer.php"; ?>