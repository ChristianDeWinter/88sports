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

$query = "select * from gebruikers";
$result = mysqli_query($con , $query);
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="adminLedenPage CSS.css">
<title>Admin Leden Page</title>
</head>
<body>
    <h1>gebruikers voor vandaag</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
            <th>username</th> 
        <th>usertype</th>
        <th>start_datum</th>
        <th>vernieuw_datum</th>
            </tr>
        </thead>
        <?php
        if (!$result) {
            die("invalid query:" . $con ->error);
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["username"] . "</td>
            <td>" . $row["usertype"] . "</td>
            <td>" . $row["start_datum"] . "</td>
            <td>" . $row["vernieuw_datum"] . "</td>
            </tr>";
        }
        
        ?>
        </table>
        <button><a href="admin Changes.php"> Homepage</button>
        <button><a href="AdminLedenEdit.php">Leden editen</button>
</body>
</html>