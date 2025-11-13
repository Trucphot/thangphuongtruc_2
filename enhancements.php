<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enhancements - G04 Cybersecurity Specialist</title>
  <meta name="description" content="G04 Cybersecurity Specialist - Enhancements implemented">
  <meta name="keywords" content="Cybersecurity, G04, Specialist, Enhancements">
  <meta name="author" content="G04 Cybersecurity Specialist">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/styleenhancements.css">
</head>
<body>

  <?php include("header.inc"); ?>

  <main>
    <h3>Enhancements Implemented</h3>

    <section>
      <h2>1️⃣ Sorting EOIs by Selected Field</h2>
      <p>
        The HR manager can now choose how to sort EOI records in <code>manage.php</code>.  
        A dropdown menu allows sorting by fields like <b>first name</b>, <b>last name</b>, <b>job reference</b>, or <b>status</b>.
      </p>
      <ul>
        <li>Added a <code>&lt;select&gt;</code> form element in <code>manage.php</code>.</li>
        <li>The PHP script uses <code>ORDER BY</code> in SQL based on the selected field.</li>
      </ul>
      <p><b>Code Example:</b></p>
      <pre><code>$sort_field = $_POST['sort_field'] ?? 'eoi_id';
$query = "SELECT * FROM eoi ORDER BY $sort_field ASC";
$result = mysqli_query($conn, $query);</code></pre>
    </section>

    <section>
      <h2>2️⃣ Manager Registration Page (manager_register.php)</h2>
      <p>
        A secure manager registration page was created with <b>server-side validation</b>:
      </p>
      <ul>
        <li><b>Unique username</b> — checked against existing database records.</li>
        <li><b>Password rule</b> — at least 8 characters, one number, and one uppercase letter.</li>
      </ul>
      <p>The manager’s data (username & hashed password) is stored in a <code>managers</code> table.</p>
      <p><b>Code Example:</b></p>
      <pre><code>$hash = password_hash($password, PASSWORD_DEFAULT);
mysqli_query($conn, "INSERT INTO managers (username, password) VALUES ('$user', '$hash')");</code></pre>
    </section>

    <section>
      <h2>3️⃣ Secure Login for Manager (login.php)</h2>
      <p>
        The <code>manage.php</code> page is now protected. Managers must log in using their credentials before accessing it.
      </p>
      <ul>
        <li>Username is stored in <code>$_SESSION['username']</code> after login.</li>
        <li>Each protected page checks if the session exists before showing content.</li>
      </ul>
      <p><b>Code Example:</b></p>
      <pre><code>session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}</code></pre>
    </section>

    <section>
      <h2>4️⃣ Lockout After 3 Invalid Login Attempts</h2>
      <p>
        To increase security, the login system tracks failed login attempts. After <b>3 failed attempts</b>, the user is <b>locked out</b> for 5 minutes.
      </p>
      <ul>
        <li>Each failed login increments an <code>attempts</code> counter.</li>
        <li>If counter reaches 3, current time is recorded.</li>
        <li>The system checks if 5 minutes have passed before allowing login again.</li>
      </ul>
      <p><b>Code Example:</b></p>
      <pre><code>if ($attempts >= 3 && time() - $last_attempt < 300) {
    echo "Access disabled. Please try again later.";
} else {
    // allow login
}</code></pre>
    </section>

    <section>
      <h2>Summary of Enhancements</h2>
      <ul>
        <li>✅ Added EOI sorting feature for better data management.</li>
        <li>✅ Added manager registration with unique username & password validation.</li>
        <li>✅ Added login system & session-based access control.</li>
        <li>✅ Added security lockout after 3 failed login attempts.</li>
      </ul>
      <p>These enhancements improve the system’s usability, organization, and security.</p>
    </section>

  </main>

  <?php include("footer.inc"); ?>

</body>
</html>
