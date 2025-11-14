<?php
session_start();
$errors = [];
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
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
  <title>G04 Cybersecurity Specialist</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/stylesapply.css">
</head>
<body>

  <?php include("header.inc"); ?>

  <main>
    <?php
    if (!empty($errors)) { 
?>
    <div class="error-messages">
        <p>Please correct the following errors:</p>
        <ul>
            <?php 
            foreach ($errors as $error) {
            ?>
                <li><?php echo $error; ?></li>
            <?php 
            } 
            ?>
        </ul>
    </div>
<?php 
} 
?>
    <div class="container">        
    <h2>Aplication Form</h2>
    <form id="applicationForm" action="process_eoi.php" method="post" novalidate="novalidate">
      <fieldset class="personal-details">
        <h3>Personal Details</h3>    
      <div class="form-row">
        <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" maxlength="20" pattern="[A-Za-z\s]+" required>
        </div>
        <div class="form-group">
        <label for="lastname">Last Name: </label>
        <input type="text" id="lastname" name="lastname" maxlength="20" pattern="[A-Za-z\s]+" required>
        </div>
        <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        </div>
      </div>

      <div class="form-row">
      <div class="form-group">
        <fieldset>
          <legend>Gender:</legend>
          <input type="radio" id="gender_male" name="gender" value="male" required>
          <label for="gender_male">Male</label>
          <input type="radio" id="gender_female" name="gender" value="female">
          <label for="gender_female">Female</label>
          <input type="radio" id="gender_other" name="gender" value="other">
          <label for="gender_other">Other</label>
        </fieldset>
      </div> 
      </div>     

      <div class="form-row">
        <div class="form-group">
        <label for="street_address">Street Address:</label>
        <input type="text" id="street_address" name="street_address" maxlength="40" required>
        </div>
        <div class="form-group">
        <label for="suburb">Suburb/Town:</label>
        <input type="text" id="suburb" name="suburb" maxlength="40" required>
        </div>
      </div>


      <div class="form-row">
        <div class="form-group">
        <label for="state">State</label>
        <select id="state" name="state" required>
            <option value="" disabled selected>-- Please select a state --</option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="WA">WA</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
        </select>
        </div>
        <div class="form-group">       
        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" pattern="\d{4}" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" id="email" name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" placeholder="name@domain.com" required>
        </div>
        <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[\d\s]{8,12}" required>
        </div>
      </div>
      </fieldset>

      <fieldset>
        <h3>Employment Information</h3>
      <div class="form-row2">
        <div class="form-group2">
        <label for="job_ref">Job reference number:</label>
        <select id="job_ref" name="job_ref" required>
            <option value="" disabled selected>-- Select job reference code --</option>
            <option value="DEV001">CS360-Cybersecurity Specialist</option>
            <option value="QA002">DA180-Data analyst</option>
        </select>
        </div>
        
        <div class="form-group2">
        <fieldset>
          <legend>Required technical list:</legend>
          <div class="checkbox-group">
                <input type="checkbox" id="skill_html" name="skill_html" value="HTML">
                <label for="skill_html">HTML</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="skill_css" name="skill_css" value="CSS">
                <label for="skill_css">CSS</label>
            </div>
             <div class="checkbox-group">
                <input type="checkbox" id="skill_js" name="skill_js" value="JavaScript">
                <label for="skill_js">JavaScript</label>
            </div>
        </fieldset>
        </div>
        
        <div class="form-group2">
        <label for="otherskills">Other skills:</label>
        <textarea id="otherskills" name="otherskills" rows="5" placeholder="Please list any other relevant skills here..." maxlength="500"></textarea>
        </div>
      </div>
      </fieldset>
       <button type="submit">Submit</button>
    </form>
    </div>    
  </main>   

  <?php include("footer.inc"); ?>
</body>
</html>