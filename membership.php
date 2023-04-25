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
  <title>Membership | 88 Sports</title>
  <link rel="stylesheet" href="membership CSS.css">
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
    <h1>Membership</h1>
<p>Choose a membership that suits your needs and budget. We offer a range of flexible options, including monthly and yearly plans. Our membership also includes access to all of our classes and equipment.</p>
<section>
  <h2>Membership Options</h2>
  <table>
    <thead>
      <tr>
        <th>Plan</th>
        <th>Price</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Monthly</td>
        <td>$50/month</td>
        <td>Pay month-to-month for access to our gym and classes.</td><br>
        <button onclick="window.location.href='payment.php';">
      Click Here
    </button>
      </tr>
      <tr>
        <td>Yearly</td>
        <td>$500/year</td>
        <td>Save $100 by paying for a year in advance.</td>
      </tr>
    </tbody>
  </table>
</section>

<p>For more information or to sign up for a membership, please contact us.</p>
  </main>
  <footer>
    <p>&copy; 2023 88 Sports. All rights reserved.</p>
  </footer>
</body>
</html>