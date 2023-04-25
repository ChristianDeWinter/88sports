<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>88 Sports Fitness Club</title>
    <link rel="stylesheet" href="memberhomepage CS.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
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
      <section id="hero">
        <img src="BSB.png" alt="Fitness Club">
        <div class="hero-text">
          <h1>Get Fit at 88 Sports Fitness Club</h1>
          <p>Join our community and experience the benefits of a healthy lifestyle. With our range of equipment and classes, you'll never get bored and always find new ways to challenge yourself.</p>
          <a href="membership.php" class="btn">Join Now</a>
        </div>
      </section>
      <section id="membership">
        <h2>Membership</h2>
        <p>Choose a membership that suits your needs and budget. We offer a range of flexible options, including monthly and yearly plans. Our membership also includes access to all of our classes and equipment.</p>
        <a href="membership.php" class="btn">Learn More</a>
      </section>
      <section id="classes">
        <h2>Classes</h2>
        <p>Our classes are led by experienced trainers and designed to challenge you and help you reach your goals. We offer a variety of classes, including yoga, Pilates, Zumba, and more.</p>
        <a href="#" class="btn">View Schedule</a>
      </section>
      <section id="trainers">
        <h2>Trainers</h2>
        <p>Our trainers are dedicated to helping you achieve your fitness goals. They'll create a personalized workout plan for you and provide guidance and motivation along the way.</p>
        <a href="Trainers.php" class="btn">Meet Our Trainers</a>
      </section>
      <section id="about">
        <h2>About Us</h2>
        <p>88 Sports Fitness Club is a state-of-the-art fitness center located in the heart of the city. We're committed to providing our members with the best possible experience and helping them achieve their health and fitness goals.</p>
        <a href="#" class="btn">Learn More</a>
      </section>
    </main>
    <footer>
      <p>&copy; 2023 88 Sports Fitness Club. All rights reserved.</p>
      <nav>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="Terms & Services.php">Terms and Conditions</a></li>
        </ul>
      </nav>
    </footer>
  </body>
</html>
