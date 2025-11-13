<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p>Connection failed, please try again later.</p>");
}
$errors = [];
$table_check_query = "SHOW TABLES LIKE 'eoi'";
$table_result = mysqli_query($conn, $table_check_query);
if (mysqli_num_rows($table_result) == 0) {
    $create_table_sql = "
        CREATE TABLE eoi (
          EOInumber INT AUTO_INCREMENT PRIMARY KEY,
          JobReferenceNumber VARCHAR(10) NOT NULL,
          FirstName VARCHAR(20) NOT NULL,
          LastName VARCHAR(20) NOT NULL,
          DateOfBirth DATE NOT NULL,
          Gender VARCHAR(10) NOT NULL,
          StreetAddress VARCHAR(40) NOT NULL,
          SuburbTown VARCHAR(40) NOT NULL,
          State CHAR(3) NOT NULL,
          Postcode CHAR(4) NOT NULL,
          EmailAddress VARCHAR(255) NOT NULL,
          PhoneNumber VARCHAR(12) NOT NULL,
          skill1 BOOLEAN,
          skill2 BOOLEAN,
          skill3 BOOLEAN,
          OtherSkills TEXT,
          Status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New'
        )
    ";
    if (!mysqli_query($conn, $create_table_sql)) {
        die("<p>Error creating table: " . mysqli_error($conn) . "</p>");
    }
}
function sanitize_input($conn, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$job_ref    = sanitize_input($conn, $_POST['job_ref']);
$first_name = sanitize_input($conn, $_POST['firstname']);
$last_name  = sanitize_input($conn, $_POST['lastname']);
$dob = sanitize_input($conn, $_POST['dob']);
$gender = sanitize_input($conn, $_POST['gender']);
$street     = sanitize_input($conn, $_POST['street_address']);
$suburb     = sanitize_input($conn, $_POST['suburb']);
$state      = sanitize_input($conn, $_POST['state']);
$postcode   = sanitize_input($conn, $_POST['postcode']);
$email      = sanitize_input($conn, $_POST['email']);
$phone      = sanitize_input($conn, $_POST['phone']);
$skill1   = isset($_POST['skill_html']) ? 1 : 0;
$skill2   = isset($_POST['skill_css']) ? 1 : 0;
$skill3 = isset($_POST['skill_js']) ? 1 : 0;
$other_skills_text     = sanitize_input($conn, $_POST['otherskills']);
//Required field validation
if (empty($first_name)) {
    $errors[] = "First name is required.";
}
if (empty($last_name)) {
    $errors[] = "Last name is required.";
}
if (empty($dob)) {
    $errors[] = "Date of birth is required.";
}
if (empty($gender)) {
    $errors[] = "Gender is required.";
}
if (empty($street)) {
    $errors[] = "Street address is required.";
}
if (empty($suburb)) {
    $errors[] = "Suburb/town is required.";
}
if (empty($email)) {
    $errors[] = "Email is required.";
}
if (empty($phone)) {
    $errors[] = "Phone number is required.";
}
if (empty($state)) {
    $errors[] = "State is required.";
}
if (empty($postcode)) {
    $errors[] = "Postcode is required.";
}
//Format validation
if (!empty($first_name) && !preg_match("/^[a-zA-Z ]{1,20}$/", $first_name)) {
        $errors[] = "First name must be max 20 alpha characters.";
    }
if (!empty($last_name) && !preg_match("/^[a-zA-Z ]{1,20}$/", $last_name)) {
        $errors[] = "Last name must be max 20 alpha characters.";
    }
if (!preg_match("/^\d{4}$/", $postcode)) {
        $errors[] = "Postcode must be exactly 4 digits.";
    }
$valid_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
    if (!in_array($state, $valid_states)) {
        $errors[] = "State is not valid. Must be one of: " . implode(', ', $valid_states);
    }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email address format is not valid.";
    }
if (!preg_match("/^[\d\s]{8,12}$/", $phone)) {
        $errors[] = "Phone number must be 8 to 12 digits (or spaces).";
    }
if ((isset($_POST['skill_html']) || isset($_POST['skill_css']) || isset($_POST['skill_js'])) && empty($other_skills_text)) {
        $errors[] = "Other skills text cannot be empty if the checkbox is selected.";
    }
//Processing validation results
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: apply.php");
    exit();
    } else {
        $sql = "INSERT INTO eoi (JobReferenceNumber, FirstName, LastName, DateOfBirth, Gender, StreetAddress, SuburbTown, State, Postcode, EmailAddress, PhoneNumber, skill1, skill2, skill3, OtherSkills) 
            -- VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssssiiis", 
        $job_ref, 
        $first_name, 
        $last_name,
        $dob,
        $gender,
        $street,
        $suburb,
        $state, 
        $postcode, 
        $email, 
        $phone,
        $skill1,
        $skill2,
        $skill3,
        $other_skills_text
    );    
    if (mysqli_stmt_execute($stmt)) {
        $eoi_number = mysqli_insert_id($conn);        
        echo "<h1>Thanks for applying!</h1>";
        echo "<p>Your application has been received.</p>";
        echo "<p>Your EOI number is: <strong>$eoi_number</strong></p>";
        echo "<p><a href='index.php'>Return to home page</a></p>";
        
    } else {
        echo "<h1>System error</h1>";
        echo "<p>Your application could not be saved. Please try again later.</p>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
?>  
        