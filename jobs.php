<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="G04 Cybersecurity Specialist - Job Listings">
  <meta name="keywords" content="Cybersecurity, Data Analyst, IT Jobs, Security Specialist">
  <meta name="author" content="G04 Cybersecurity Specialist">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>G04 Job Listings</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/stylesjobs.css">
</head>

<body>

  <?php include("header.inc"); ?>

  <main>
  <?php
    require_once("settings.php");

    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<section class='intro'>";
            echo "<h2>" . htmlspecialchars($row['job_code']) . " - " . htmlspecialchars($row['job_title']) . "</h2>";

            echo "<h3>Description</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['job_description'])) . "</p>";

            echo "<h3>Responsibilities</h3>";
            echo $row['responsibilities'];

            echo "<h3>Requirements</h3>";
            echo $row['requirements'];

            echo "<h3>Offers</h3>";
            echo $row['offers'];

            echo "</section><hr>";
        }

    } else {
        echo "<h4>No job listings found.</h4>";
    }

    mysqli_close($conn);
  ?>

  <aside>
      <h6>Why Join Us?</h6>
      <p>At Shield Cyber Security, we value innovation, teamwork, and growth. Our team is dedicated to creating a safer digital world while empowering each member to reach their potential.</p>
      <ul>
        <li>🌐 Work with cutting-edge cybersecurity technologies</li>
        <li>💼 Collaborate with global clients</li>
        <li>🚀 Opportunities for rapid career advancement</li>
        <li>🎓 Continuous learning and certification support</li>
      </ul>
      <blockquote>“Your career in cybersecurity starts with us.”</blockquote>
  </aside>

  </main>

  <?php include("footer.inc"); ?>

</body>
</html>
