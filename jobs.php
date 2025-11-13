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
  <!-- Header -->
  <?php include("header.inc"); ?>

  <main>
    
    <?php
      // Gọi file kết nối CSDL có sẵn
      require_once("settings.php");

      // Truy vấn dữ liệu
      $query = "SELECT * FROM jobs";
      $result = mysqli_query($conn, $query);

      // Kiểm tra có dữ liệu không
      if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<section class='job'>";
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
          echo "<p>No job listings found.</p>";
      }

      // Đóng kết nối
      mysqli_close($conn);
    ?>
  </main>

  <!-- Footer -->
  <?php include("footer.inc"); ?>
</body>
</html>
