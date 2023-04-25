<?php
include 'dbaseconnect.php';
$id = "";
$username = "";
$password = "";
$usertype = "";
$vernieuw_datum = "";

if (isset($_POST['insert'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $usertype = filter_var($_POST['usertype'], FILTER_SANITIZE_STRING);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username) || empty($password)) {
        echo '<script> alert("Please fill in Username and Password") </script>';
    } else {
        $stmt = $dbconn->prepare("INSERT INTO gebruikers(username, password, usertype) VALUES (:username, :password, :usertype)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        
        $usertype = "leden";
        $stmt->bindParam(':usertype', $usertype);

        try {
            $stmt->execute();

            echo '<script> alert("Data inserted successfully") </script>';
            header("Location: registration_success.php");
            exit; 
        } catch (PDOException $e) {
            echo 'Something went wrong: ' . $e->getMessage();
        }
    }
}

?>
<form class="form" action="" method="post">
    <h1 class="login-title">Registration</h1>
    <input type="text" class="login-input" name="username" placeholder="Username" required />
    <input type="text" class="login-input" name="password" placeholder="Password" required>
    <input type="submit" name="insert" value="Register" class="login-button">
    <p class="link"><a href="login.php">Click to Login</a></p>
</form>
