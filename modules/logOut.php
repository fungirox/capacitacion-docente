<?php
require_once "../app-code/config.php";

session_unset();
session_destroy();

header("Location: ../login.php");
die();
