<?php
session_unset();
session_destroy();

header("Location: {$baseUrl}/login");
die();
