<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<?php 
$con = mysqli_connect("localhost", "bit_academy", "bit_academy", "fitnessdb"); 
if (!$con) {
    die(" Connection Error ");
}

$query = "select * from workouts";
$result = mysqli_query($con , $query);
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="trainershiftpage CSS.css" />
<title>Trainers schema</title>
</head>
<body>
    <h1>Trainers schema</h1>
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
        <button onclick="window.location.href='logout.php';">
      Logout
    </button>
        <button><a href="admintraineredit.php">Trainer editen</button>
</body>
</html>