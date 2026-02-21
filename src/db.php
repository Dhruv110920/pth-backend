<?php
$host = "YOUR_RENDER_DB_HOST";
$user = "YOUR_DB_USER";
$pass = "YOUR_DB_PASSWORD";
$db   = "YOUR_DB_NAME";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>