<?php
session_start();

$correct_username = "thangphuongtruc";
$correct_password = "thangphuongtruc";
$error = "";
// Limit the number of loggins
$max_attempts = 3;
$lockout_seconds = 300;
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Check if the user is locked
if (isset($_SESSION['lockout_until']) && $_SESSION['lockout_until'] > time()) {
  $remaining = $_SESSION['lockout_until'] - time();
  $error = "Too many failed attempts. Please wait $remaining seconds.";
}
// Process logging if the user is not locked
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === $correct_username && $password === $correct_password) {
        unset($_SESSION['login_attempts']);
        unset($_SESSION['lockout_until']);  
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username; 
        header("Location: manage.php");
        exit();
    } else {
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] >= $max_attempts) {
        $_SESSION['lockout_until'] = time() + $lockout_seconds;
        $error = "You attempted the wrong $max_attempts times. Locked out for $lockout_seconds seconds.";
    } else {
        $error = "Incorrect username or password. Please try again.";
    }
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
