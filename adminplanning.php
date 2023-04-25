<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$con = mysqli_connect("localhost", "bit_academy", "bit_academy", "fitnessdb");
if (!$con) {
    die("Connection Error");
}

$query = "SELECT * FROM workouts WHERE trainer = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="trainershiftpage CSS.css" />
<title>Planning Page</title>
</head>
<body>
    <h1>Planning voor vandaag</h1>
    <table>
        <thead>
            <tr>
                <th>Datum</th>
                <th>Naam</th>
                <th>Trainer</th>
                <th>Sportschool</th>
                <th>Tijds duur</th>
                <th>Spiergroep</th>
            </tr>
        </thead>
        <?php
        if (!$result) {
            die("invalid query:" . $con ->error);
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["date"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["trainer"] . "</td>
            <td>" . $row["gym"] . "</td>
            <td>" . $row["duration"] . "</td>
            <td>" . $row["muscle"] . "</td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
