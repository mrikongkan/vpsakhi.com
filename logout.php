<?php
session_start();
unset($_SESSION['addusr_id']);
unset( $_SESSION['usr_id']);
unset($_SESSION['usr_name']);
unset($_SESSION['logout']);
unset($_SESSION['dashboard']);
unset($_SESSION['total_credit']);
header("Location:index.php");
?>