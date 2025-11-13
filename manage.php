<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit();
}
include("settings.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage EOIs - HR Manager</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/stylemanage.css">
</head>
<body>

<h1>HR Manager - Manage EOIs</h1>
<p><a href="logout.php">Logout</a></p>

<div class="manage-container">
    <form method="post">
        <input type="submit" name="list_all" value="List All EOIs">
    </form>
    <form method="post">
        <label>Enter Job Reference Number:</label>
        <input type="text" name="job_ref" required>
        <input type="submit" name="list_by_job" value="List EOIs by Job Reference">
    </form>
    <form method="post">
        <label>First Name:</label>
        <input type="text" name="fname">
        <label>Last Name:</label>
        <input type="text" name="lname">
        <input type="submit" name="list_by_name" value="List EOIs by Applicant">
    </form>
    <form method="post" onsubmit="return confirm('Are you sure you want to delete all EOIs with this EOInumber?');">
        <label>EOI ID to Delete:</label>
        <input type="text" name="eoi_id" required>
        <input type="submit" name="delete" value="Delete EOIs">
    </form>
    <form method="post">
        <label>EOI ID:</label>
        <input type="text" name="eoi_id_status" required>
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
// List EOIs by Job Reference
    if (isset($_POST['list_by_job'])) {
        $job_ref = trim($_POST['job_ref']);
        $stmt = $conn->prepare("SELECT * FROM eoi WHERE JobReferenceNumber = ?");
        $stmt->bind_param("s", $job_ref);
        $stmt->execute();
        $result = $stmt->get_result();
        showResults($result);
        $stmt->close();
    }
 // List EOIs by Applicant Name
    if (isset($_POST['list_by_name'])) {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $conditions = [];
        $params = [];
        $types = "";

        if (!empty($fname)) {
            $conditions[] = "FirstName LIKE ?";
            $params[] = "%$fname%";
            $types .= "s";
        }
        if (!empty($lname)) {
            $conditions[] = "LastName LIKE ?";
            $params[] = "%$lname%";
            $types .= "s";
        }

        if (count($conditions) > 0) {
            $sql = "SELECT * FROM eoi WHERE " . implode(" AND ", $conditions);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            showResults($result);
            $stmt->close();
        } else {
            echo "<p>Please enter at least a first or last name.</p>";
        }
    }

// Delete EOIs by EOInumber
    if (isset($_POST['delete'])) {
        $eoi_id = trim($_POST['eoi_id']);
        $stmt = $conn->prepare("DELETE FROM eoi WHERE EOInumber = ?");
        $stmt->bind_param("s", $eoi_id);
        if ($stmt->execute()) {
            echo "<p>All EOIs with EOInumber '$eoi_id' have been deleted.</p>";
        } else {
            echo "<p>Error deleting EOIs: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

// Update Status
    if (isset($_POST['update_status'])) {
        $eoi_id = trim($_POST['eoi_id_status']);
        $new_status = trim($_POST['new_status']);
        $stmt = $conn->prepare("UPDATE eoi SET Status = ? WHERE EOInumber = ?");
        $stmt->bind_param("ss", $new_status, $eoi_id);
        if ($stmt->execute()) {
            echo "<p>EOI ID $eoi_id updated to status '$new_status'.</p>";
        } else {
            echo "<p>Error updating status: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

// Display results in table
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
</div>
</body>
</html>
