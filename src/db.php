<?php
$conn = new mysqli("db", "user", "password", "pth_db");
if ($conn->connect_error) {
    die("Database connection failed");
}