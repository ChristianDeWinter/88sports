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
$trainer = "";
$title = "";
$bio = "";
$image = "";

if (isset($_POST['insert'])) {
    $trainer = filter_var($_POST['trainer'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);

        $stmt = $dbconn->prepare("INSERT INTO trainers(trainer, title, bio, image) VALUES (:trainer, :title, :bio, :image)");
        $stmt->bindParam(':trainer', $trainer);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':image', $image);
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
    
            $stmt = $dbconn->prepare("SELECT * FROM trainers WHERE id = :id AND trainer = :trainer AND title = :title AND bio = :bio AND image = :image");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':trainer', $trainer);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $stmt = $dbconn->prepare("DELETE FROM trainers WHERE id = :id AND trainer = :trainer");
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
    $pdoqueryS = "SELECT * FROM trainers WHERE id = :id";
    $pdoquery_runS = $dbconn->prepare($pdoqueryS);
    $pdoquery_execS = $pdoquery_runS->execute(array(":id" => $id));

    if ($pdoquery_execS) {
        if ($pdoquery_runS->rowCount() > 0) {
            while ($row = $pdoquery_runS->fetch(PDO::FETCH_OBJ)) {
                $id = $row->id;
                $trainer = $row->trainer;
                $title = $row->title;
                $bio = $row->bio;
                $image = $row->image;
            }
        }
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $trainer = $_POST['trainer'];
    $title = $_POST['title'];
    $bio = $_POST['bio'];
    $image = $_POST['image'];
    $pdoqueryU = "UPDATE trainers SET trainer = :trainer, title = :title, bio = :bio, image = :image WHERE id=:id";
    $pdoquery_runU = $dbconn->prepare($pdoqueryU);
    $pdoquery_execU = $pdoquery_runU->execute(array(":trainer" => $trainer, ":title" => $title, ":bio" => $bio, ":image" => $image, ":id" => $id));

    if ($pdoquery_execU) {
        echo '<script> alert("Data updated") </script>';
    } else {
        echo 'No data updated';
    }
}
?>

<head>
    <title>ediit trainer</title>
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
                id <input type="text" name="id" value="<?php echo isset($id) ? htmlspecialchars($id, ENT_QUOTES) : ''; ?>" placeholder="Enter id"/><br>
trainer <input type="text" name="trainer" value="<?php echo isset($trainer) ? htmlspecialchars($trainer, ENT_QUOTES) : ''; ?>" placeholder="Enter trainer"/> <br>
title <input type="text" name="title" value="<?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES) : ''; ?>" placeholder="Personal Trainer"/> <br>
bio <input type="text" name="bio" value="<?php echo isset($bio) ? htmlspecialchars($bio, ENT_QUOTES) : ''; ?>" placeholder="Enter bio"/> <br>
image <input type="text" name="image" value="<?php echo isset($image) ? htmlspecialchars($image, ENT_QUOTES) : ''; ?>" placeholder="Enter image"/> <br>


                <button type="submit" name="search"> SEARCH DATA </button>
                <button type="submit" name="update"> UPDATE DATA </button>
                <button type="submit" name="insert"> INSERT DATA </button>
                <button type="submit" name="delete"> DELETE DATA </button>
            </td>
            <td><a href="planning.php">Mijn planning</a></td>
            </tr>
    </table>
    </form>
    </center>
</body>
</center>
