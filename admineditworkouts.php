<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<?php
include 'dbaseconnect.php';


$date = "";
$name = "";
$trainer = "";
$gym = "";
$duration = "";
$muscle = "";


if (isset($_POST['submit'])) {
  
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $trainer = filter_var($_POST['trainer'], FILTER_SANITIZE_STRING);
    $gym = filter_var($_POST['gym'], FILTER_SANITIZE_STRING);
    $duration = filter_var($_POST['duration'], FILTER_SANITIZE_STRING);
    $muscle = filter_var($_POST['muscle'], FILTER_SANITIZE_STRING);

    $stmt = $dbconn->prepare("INSERT INTO workouts(date, name, trainer, gym, duration, muscle) VALUES (:date, :name, :trainer, :gym, :duration, :muscle)");
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':trainer', $trainer);
    $stmt->bindParam(':gym', $gym);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':muscle', $muscle);

    try {
        $stmt->execute();
        echo '<script> alert("Data inserted successfully") </script>';
        header("Location: succes trainerplanned.php");
        exit();
    } catch (PDOException $e) {

        echo 'Something went wrong: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="admineditworkouts CS.css">
<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            document.getElementById("date").setAttribute("min", new Date().toISOString().split("T")[0]);
        });
    </script>
</head>
<body>
<header>
      <nav>
        <ul>
          <li><a href="memberhomepage.php">Home</a></li>
          <li><a href="nologinmembership.php">Membership</a></li>
          <li><a href="login.php">Classes</a></li>
          <li><a href="trainers.php">Trainers</a></li>
          <li><a href="login.php">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="Logout.php">Log Out</a></li>
        </ul>
      </nav>
    </header>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>
        <label for="name">Your Name:</label>
        <input type="text" name="username" id="username" value="<?php echo $_SESSION['username'] ?>" disabled required>

        <label for="trainer">Trainer:</label>
        
        <select id="trainer" name="trainer">
        <?php
        $db_host = "localhost";
        $db_user = "bit_academy";
        $db_password = "bit_academy";
        $db_name = "fitnessdb";
        
 
        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
    
        if (isset($_POST['trainer'])) {
            $select = $_POST['trainer'];
        } else {
            $select = "";
        }
        

        $query = "SELECT id, trainer FROM trainers ORDER BY id ASC";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id, $trainer);
            while (mysqli_stmt_fetch($stmt)) {
                $selected = ($id == $select) ? "selected" : "";
                echo "<option value=\"$trainer\" $selected>$trainer</option>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
      
        mysqli_close($conn);
        ?>
        </select><br>
        <label for="gym">Gym:</label>
        <select name="gym" id="gym">
        <option value="">-- Selecteer --</option>
            <option value="88 Sport Amsterdam"> 88 Sport Amsterdam</option>
            <option value="88 Sport Haarlem"> 88 Sport Haarlem</option>
            <option value="88 Sport Amstelveen"> 88 Sport Amstelveen</option>
            <option value="88 Sport Den Haag"> 88 Sport Den Haag</option>
            <option value="88 Sport Uterecht"> 88 Sport Uterecht</option>
        </select><br>
        <label for="duration">Duration (in minutes):</label>
        <input type="number" id="duration" name="duration" value="<?php echo $duration ?>" placeholder="Enter duration" required min="60" step="1">

        <label for="muscle">Spiergroep:</label>
        <select id="muscle" name="muscle" required>
        <option value="">-- Selecteer --</option>
  <option value="Chest">Borst</option>
  <option value="Back">Rug</option>
  <option value="Arms">Armen</option>
  <option value="Legs">Benen</option>
</select>
        <input type="submit" name="submit" value="Select" />
    </form>
</body>
</html>



            