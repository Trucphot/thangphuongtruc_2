<?php
session_start();

$correct_username = "thangphuongtruc";
$correct_password = "thangphuongtruc";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username; 
        header("Location: manage.php");
        exit();
    } else {
        $error = "Incorrect username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="G04 Cybersecurity Specialist - Protecting businesses with advanced security solutions">
  <meta name="keywords" content="Cybersecurity, G04, Specialist, IT Security, Company">
  <meta name="author" content="G04 Cybersecurity Specialist">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager Login</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/stylelogin.css">
</head>
<body>

  <?php include("header.inc"); ?>

  <main>
    <div class="login-container">
      <form class="login-box" method="post">
        <h2>Manager Login</h2>
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <br>
        <input type="submit" value="Login">
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
      </form>
    </div>
  </main>

  <?php include("footer.inc"); ?>

</body>
</html>
