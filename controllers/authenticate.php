<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];

    try {
        if ($user === "sa" && $password === "sa") {
            $_SESSION["loggedIn"] = true;
            header("Location: /");
            die();
        } else {
            header("Location: /login");
            die();
        }
    } catch (exception) {
        die("Query failed");
    }
} else {
    header("Location: $baseUrl/login");
    die();
}
