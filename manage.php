<?php
// manage.php
include("settings.php"); // connect to the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage EOIs - HR Manager</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 20px; }
    h1 { color: #0a3775; }
    form { margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 10px; }
    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #0a3775; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    input[type=text] { padding: 5px; }
    input[type=submit] { background-color: #0a3775; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 5px; }
    input[type=submit]:hover { background-color: #005bb5; }
  </style>
</head>
<body>

<h1>HR Manager - Manage EOIs</h1>

<!-- Form to list all EOIs -->
<form method="post">
  <input type="submit" name="list_all" value="List All EOIs">
</form>

<!-- Form to list EOIs by job reference -->
<form method="post">
  <label>Enter Job Reference Number:</label>
  <input type="text" name="job_ref" required>
  <input type="submit" name="list_by_job" value="List EOIs by Job Reference">
</form>

<!-- Form to list EOIs by applicant name -->
<form method="post">
  <label>First Name:</label>
  <input type="text" name="fname">
  <label>Last Name:</label>
  <input type="text" name="lname">
  <input type="submit" name="list_by_name" value="List EOIs by Applicant">
</form>

<!-- Form to delete EOIs by job reference -->
<form method="post" onsubmit="return confirm('Are you sure you want to delete all EOIs for this job reference?');">
  <label>Job Reference to Delete:</label>
  <input type="text" name="delete_ref" required>
  <input type="submit" name="delete" value="Delete EOIs">
</form>

<!-- Form to change EOI status -->
<form method="post">
  <label>EOI ID:</label>
  <input type="text" name="eoi_id" required>
  <label>New Status:</label>
  <input type="text" name="new_status" required>
  <input type="submit" name="update_status" value="Change Status">
</form>

<hr>

<?php
// List all EOIs
if (isset($_POST['list_all'])) {
    $query = "SELECT * FROM eoi";
    $result = mysqli_query($conn, $query);
    showResults($result);
}

// List EOIs by job reference
if (isset($_POST['list_by_job'])) {
    $job_ref = trim($_POST['job_ref']);
    $query = "SELECT * FROM eoi WHERE job_ref = '$job_ref'";
    $result = mysqli_query($conn, $query);
    showResults($result);
}

// List EOIs by applicant name
if (isset($_POST['list_by_name'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $conditions = [];

    if (!empty($fname)) $conditions[] = "first_name LIKE '%$fname%'";
    if (!empty($lname)) $conditions[] = "last_name LIKE '%$lname%'";

    if (count($conditions) > 0) {
        $query = "SELECT * FROM eoi WHERE " . implode(" AND ", $conditions);
        $result = mysqli_query($conn, $query);
        showResults($result);
    } else {
        echo "<p>Please enter at least a first or last name.</p>";
    }
}

// Delete EOIs by job reference
if (isset($_POST['delete'])) {
    $delete_ref = trim($_POST['delete_ref']);
    $query = "DELETE FROM eoi WHERE job_ref = '$delete_ref'";
    if (mysqli_query($conn, $query)) {
        echo "<p>All EOIs for Job Reference '$delete_ref' have been deleted.</p>";
    } else {
        echo "<p>Error deleting EOIs: " . mysqli_error($conn) . "</p>";
    }
}

// Update EOI status
if (isset($_POST['update_status'])) {
    $eoi_id = trim($_POST['eoi_id']);
    $new_status = trim($_POST['new_status']);
    $query = "UPDATE eoi SET status = '$new_status' WHERE eoi_id = '$eoi_id'";
    if (mysqli_query($conn, $query)) {
        echo "<p>EOI ID $eoi_id updated to status '$new_status'.</p>";
    } else {
        echo "<p>Error updating status: " . mysqli_error($conn) . "</p>";
    }
}

// Function to display results in table format
function showResults($result) {
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table><tr>";
        while ($fieldinfo = mysqli_fetch_field($result)) {
            echo "<th>{$fieldinfo->name}</th>";
        }
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
}

mysqli_close($conn);
?>

</body>
</html>
