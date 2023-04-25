<?php
include 'dbaseconnect.php';

session_start();

if (isset($_POST['login'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $pdoquery = "SELECT * FROM gebruikers WHERE username = :username";
    $pdoquery_run = $dbconn->prepare($pdoquery);
    $pdoquery_exec = $pdoquery_run->execute(array(":username" => $username));

    if ($pdoquery_exec) {
        if ($pdoquery_run->rowCount() > 0) {
            $row = $pdoquery_run->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = $row['usertype'];

                $cookie_params = session_get_cookie_params();
                session_set_cookie_params(
                    $cookie_params["lifetime"],
                    $cookie_params["path"],
                    $cookie_params["domain"],
                    true,
                    true
                );
                session_regenerate_id();

                if ($_SESSION['usertype'] == 'leden') {
                    header("Location: memberhomepage.php");
                } elseif ($_SESSION['usertype'] == 'trainer') {
                    header("Location: planning.php");
                } elseif ($_SESSION['usertype'] == 'admin') {
                    header("Location: admin changes.php");
                }
                exit;
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
        }
    } else {
        echo 'Something went wrong: ' . $e->getMessage();
    }
}
if (isset($_POST['register'])) {
    header("Location: register.php");
}
?>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login CS.css">
</head>
<body>
    <h1>Login</h1>
    <form action="" method="POST">
        <label for="username">Voornaam:</label>
        <input type="text" name="username" id="username" > <br>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" id="password" > <br>
        <input type="submit" name="login" value="Log in">
    </form>
    <form action="" method="POST">
    <p class="noacount">No acount yet! No problem</p>
        <a  href="register.php">
        <input type="submit" name="register" value="Register" id="register-button">
    </a>
    </form>
</body>
