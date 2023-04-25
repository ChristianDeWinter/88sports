<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='admin changes CSS.css'>
</head>
<body>
    <h1>Admin Menu</h1>
<h2> Leden changes </h2>
    <button><a href="adminLedenPage.php">Leden Page</a></button>
    <button><a href="AdminLedenEdit.php"> Edit Leden Page</a></button>
    <h2>Trainer Changes</h2>
    <button><a href="trainershiftpage.php">Trainer Shift</a></button>
    <button><a href="admintraineredit.php"> Edit Trainer Page</a></button>
</body>
<button><a class="dwad" href="logout.php">Log Out</a></button>
</html>