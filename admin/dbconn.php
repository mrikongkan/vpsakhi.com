<?php
session_start();
$servername = "localhost";
$username = "u241746118_emsdata";
$pasword = "3Wiae%h.5B.5wVW";
$dbname = "u241746118_ems";

//PDO Connection for Database
try {
    $conn = new PDO("mysql:host = " . $servername . ";dbname =" . $dbname, $username, $pasword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
