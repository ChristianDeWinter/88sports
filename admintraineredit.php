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
$date = "";
$name = "";
$trainer = "";
$gym = "";
$duration = "";
$muscle= "";

if (isset($_POST['insert'])) {
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $trainer = filter_var($_POST['trainer'], FILTER_SANITIZE_STRING);
    $gym = filter_var($_POST['gym'], FILTER_SANITIZE_STRING);
    $duration = filter_var($_POST['duration'], FILTER_SANITIZE_STRING);
    $muscle = filter_var($_POST['muscle'], FILTER_SANITIZE_STRING);


        $stmt = $dbconn->prepare("INSERT INTO workouts(date, name, trainer, gym, duration, muscle) VALUES (:date, :name, trainer, :gym, duration, :muscle)");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':trainer', $trainer);
        $stmt->bindParam(':gym', $gym);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':muscle', $muscle);

        try {
            $stmt->execute();

            echo '<script> alert("Data inserted successfully") </script>';
        } catch (PDOException $e) {

            echo 'Something went wrong: ' . $e->getMessage();
        }
    }

    if (isset($_POST['delete'])) {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $trainer = filter_var($_POST['trainer'], FILTER_SANITIZE_STRING);
    
    
        if (empty($id) || empty($trainer)) {
    
            echo '<script> alert("Please fill all required fields") </script>';
        } else {
    
            $stmt = $dbconn->prepare("SELECT * FROM workouts WHERE id = :id AND date = :date, name = :name, trainer = :trainer, gym = :gym, duration = :duration, muscle = :muscle");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':trainer', $trainer);
            $stmt->bindParam(':gym', $gym);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':muscle', $muscle);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $stmt = $dbconn->prepare("DELETE FROM workouts WHERE id = :id AND trainer = :trainer");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':trainer', $trainer);
                $stmt->execute();
    
                echo '<script> alert("Data deleted successfully") </script>';
            } else {
    
                echo '<script> alert("No matching data found") </script>';
            }
        }
    }

if (isset($_POST['search'])) {
    $id = $_POST['id'];
    $pdoqueryS = "SELECT * FROM workouts WHERE id = :id";
    $pdoquery_runS = $dbconn->prepare($pdoqueryS);
    $pdoquery_execS = $pdoquery_runS->execute(array(":id" => $id));

    if ($pdoquery_execS) {
        if ($pdoquery_runS->rowCount() > 0) {
            while ($row = $pdoquery_runS->fetch(PDO::FETCH_OBJ)) {
                $id = $row->id;
                $date = $row->date;
                $name = $row->name;
                $trainer = $row->trainer;
                $gym = $row->gym;
                $duration = $row->duration;
                $muscle = $row->muscle;
            }
        }
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $trainer = $_POST['trainer'];
    $gym = $_POST['gym'];
    $duration = $_POST['duration'];
    $muscle = $_POST['muscle'];
    $pdoqueryU = "UPDATE workouts SET date = :date, name = :name, trainer = :trainer, gym = :gym, duration = :duration, muscle = :muscle WHERE id=:id";
    $pdoquery_runU = $dbconn->prepare($pdoqueryU);
    $pdoquery_execU = $pdoquery_runU->execute(array(":date" => $date, ":name" => $name, ":trainer" => $trainer, ":gym" => $gym, ":duration" => $duration, ":muscle" => $muscle, ":id" => $id));

    if ($pdoquery_execU) {
        echo '<script> alert("Data updated") </script>';
    } else {
        echo 'No data updated';
    }
}

if (isset($_POST['display'])) {
    $pdoqueryD = "SELECT * FROM workouts";
    $pdoquery_runD = $dbconn->query($pdoqueryD);

    if ($pdoquery_runD) {
        echo '<table width="50%" border="1" cellpadding="5" cellspacing="5">
            <tr>
                <th>id</th>
                <th>date</th>
                <th>name</th>
                <th>trainer</th>
                <th>gym</th>
                <th>duration</th>
                <th>muscle</th>
            </tr>';

        while ($row = $pdoquery_runD->fetch(PDO::FETCH_OBJ)) {
            echo '<tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->date.'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->trainer.'</td>
                    <td>'.$row->gym.'</td>
                    <td>'.$row->duration.'</td>
                    <td>'.$row->muscle.'</td>
                </tr>';
        }
        echo '</table>';
    }
}
?>

<head>
    <title>ASHE 22 feat. Freeze Corleone 667 & Norsacce - SCELLE PART. 99</title>
    <link rel='stylesheet' type='text/css' media='screen' href='admintraineredit CSS.css'>
    <style>
        input {
            width: 50%;
            height: 30px;
        }
        button{
            width: 20%;
            height:30px;
        }
    </style>
</head>
<body>
    <center>
    <h1>Edit trainer shift</h1>
    <form action="" method="POST">
        <table width="50%" cellpadding="5" cellspacing="5" border="1">
            <tr>
                <td><br><br>
                <center>
                    id <input type= "text" name="id" value="<?php echo $id ?>" placeholder="Enter trainer id"/> <br>
                    Datum <input type= "text" name="date" value="<?php echo $date ?>" placeholder="Enter date"/> <br>
                    Naam <input type= "text" name="name" value="<?php echo $name ?>" placeholder="Enter name"/> <br>
                    Trainer <input type= "text" name="trainer" value="<?php echo $trainer ?>" placeholder="Enter trainer"/> <br>
                    Sportschool <input type= "text" name="gym" value="<?php echo $gym ?>" placeholder="Enter gym"/> <br>
                    Tijds duur <input type= "text" name="duration" value="<?php echo $duration ?>" placeholder="Enter duration"/> <br>
                    Spiergroep <input type= "text" name="muscle" value="<?php echo $muscle ?>" placeholder="Enter muscle"/> <br>

                <button type="submit" name="display"> DISPLAY DATA </button>
                <button type="submit" name="search"> SEARCH DATA </button>
                <button type="submit" name="update"> UPDATE DATA </button>
                <button type="submit" name="insert"> INSERT DATA </button>
                <button type="submit" name="delete"> DELETE DATA </button>
            </td>
            <td><a href="admin changes.php">Admin menu</a></td>
            <td><a href="trainershiftpage.php">trainer shift</a></td>
            </tr>
    </table>
    </form>
    </center>
</body>
</center>
