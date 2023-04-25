<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

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
        if (empty($username) || empty($password) || empty($usertype)) {

            echo '<script> alert("Please fill in Username, Password, Usertype, Vernieuw datum") </script>';
        } else {

        $stmt = $dbconn->prepare("INSERT INTO gebruikers(username, password, usertype) VALUES (:username, :password, :usertype)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':usertype', $usertype);

        try {
            $stmt->execute();

            echo '<script> alert("Data inserted successfully") </script>';
        } catch (PDOException $e) {

            echo 'Something went wrong: ' . $e->getMessage();
        }
    }
}


if (isset($_POST['search'])) {
    $id = $_POST['id'];
    $pdoqueryS = "SELECT * FROM gebruikers WHERE id = :id";
    $pdoquery_runS = $dbconn->prepare($pdoqueryS);
    $pdoquery_execS = $pdoquery_runS->execute(array(":id" => $id));

    if ($pdoquery_execS) {
        if ($pdoquery_runS->rowCount() > 0) {
            while ($row = $pdoquery_runS->fetch(PDO::FETCH_OBJ)) {
                $id = $row->id;
                $username = $row->username;
                $usertype = $row->usertype;
                $vernieuw_datum = $row->vernieuw_datum;
            }
        }
    }
}
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    $vernieuw_datum = date("Y-m-d", strtotime($_POST['vernieuw_datum'])); 
    $pdoqueryU = "UPDATE gebruikers SET username=:username, password=:password, usertype=:usertype, vernieuw_datum=:vernieuw_datum WHERE id=:id";
    $pdoquery_runU = $dbconn->prepare($pdoqueryU);
    $pdoquery_execU = $pdoquery_runU->execute(array(":username" => $username, ":password" => $hashed_password, ":usertype" => $usertype, ":vernieuw_datum" => $vernieuw_datum, ":id" => $id));

    if ($pdoquery_execU) {
        echo '<script> alert("Data updated") </script>';
    } else {
        echo 'No data updated';
    }
}

if (isset($_POST['display'])) {
    $pdoqueryD = "SELECT * FROM gebruikers";
    $pdoquery_runD = $dbconn->query($pdoqueryD);

    if ($pdoquery_runD) {
        echo '<table width="50%" border="1" cellpadding="5" cellspacing="5">
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>usertype</th>
                <th>vernieuw datum</th>
                <th>start datum</th>
            </tr>';

        while ($row = $pdoquery_runD->fetch(PDO::FETCH_OBJ)) {
            echo '<tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->username.'</td>
                    <td>'.$row->password.'</td>
                    <td>'.$row->usertype.'</td>
                    <td>'.$row->vernieuw_datum.'</td>
                    <td>'.$row->start_datum.'</td>
                </tr>';
        }
        echo '</table>';
    }
}
?>

<head>
    <title>ASHE 22 feat. Freeze Corleone 667 & Norsacce - SCELLE PART. 99</title>
        <link rel='stylesheet' type='text/css' media='screen' href='AdminLedenEdit CSS.css'>
</head>
<body>
    <center>
    <h1>Edit username shift</h1>
    <form action="" method="POST">
        <table width="50%" cellpadding="5" cellspacing="5" border="1">
            <tr>
                <td><br><br>
                <center>
                id <input type= "text" name="id" value="<?php echo $id ?>" placeholder="Enter username id"/> <br>
                    username <input type= "text" name="username" value="<?php echo $username ?>" placeholder="Enter username name"/> <br>
                    password <input type= "text" name="password" value="<?php echo $password ?>" placeholder="Enter password"/> <br>
                    usertype <input type= "text" name="usertype" value="<?php echo $usertype ?>" placeholder="Enter usertype"/> <br>
                    Vernieuw datum <input type= "text" name="vernieuw_datum" value="<?php echo $vernieuw_datum ?>" placeholder="Enter vernieuw datum"/> <br>

                <button type="submit" name="display"> DISPLAY DATA </button>
                <button type="submit" name="insert"> INSERT DATA </button>
                <button type="submit" name="search"> SEARCH DATA </button>
                <button type="submit" name="delete"> DELETE DATA </button>
                <button type="submit" name="update"> UPDATE DATA </button>
            </td>
            <td><a href="admin changes.php">Admin menu</a></td>
            <td><a href="adminLedenPage.php">gebruikers page</a></td>
            </tr>
    </table>
    </form>
    </center>
</body>
</center>
<?php
if (isset($_POST['delete'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $usertype = filter_var($_POST['usertype'], FILTER_SANITIZE_STRING);


    if (empty($id) || empty($username) || empty($usertype)) {

        echo '<script> alert("Please fill all required fields") </script>';
    } else {

        $stmt = $dbconn->prepare("SELECT * FROM gebruikers WHERE id = :id AND username = :username AND usertype = :usertype");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':usertype', $usertype);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt = $dbconn->prepare("DELETE FROM gebruikers WHERE id = :id AND username = :username AND usertype = :usertype");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':usertype', $usertype);
            $stmt->execute();

            echo '<script> alert("Data deleted successfully") </script>';
        } else {

            echo '<script> alert("No matching data found") </script>';
        }
    }
}
?>