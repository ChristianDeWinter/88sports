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
	<meta charset="UTF-8">
	<title>Meet Our Trainers | Fitness Club</title>
	<link rel="stylesheet" type="text/css" href="Trainers CS.css">
</head>
<body>
	<header>
		<nav>
			<ul>
			<li><a href="memberhomepage.php">Home</a></li>
          <li><a href="membership.php">Membership</a></li>
          <li><a href="#">Classes</a></li>
          <li><a href="Trainers.php">Trainers</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<main>
		<h1>Meet Our Trainers</h1>
		
		<?php
			$servername = "localhost";
			$username = "bit_academy";
			$password = "bit_academy";
			$dbname = "fitnessdb";

			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "SELECT * FROM trainers";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<div class='trainer'>";
					echo "<img src='" . $row['image'] . "' alt='" . $row['trainer'] . "'>";
					echo "<h2>" . $row['trainer'] . "</h2>";
					echo "<p>" . $row['bio'] . "</p>";
					echo "</div>";
				}
			} else {
				echo "<p>No trainers found.</p>";
			}

			mysqli_close($conn);
		?>
		
	</main>
	<a href="admineditworkouts.php">Maak een afspraak</a>
	<footer>
		<p>&copy; 2023 Fitness Club. All rights reserved.</p>
	</footer>
	
</body>
</html>
