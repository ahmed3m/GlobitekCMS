<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.
  $first_name = "";
  $last_name = "";
  $email = "";
  $username = "";
  $errors = array();

  // if this is a POST request, process the form
  // Hint: private/functions.php can help
  if(is_post_request()) {
    // Confirm that POST values are present before accessing them.
    $first_name = $_POST['first_name'] ?? "";
    $last_name = $_POST['last_name'] ?? "";
    $email = $_POST['email'] ?? "";
    $username = $_POST['username'] ?? "";
    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }
    }
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
  ?>

  <form action="" method="POST">
    First Name:<br>
    <input type="text" name="first_name" value="<?php echo $first_name; ?>"><br>
    Last Name:<br>
    <input type="text" name="last_name" value="<?php echo $last_name; ?>"><br>
    Email:<br>
    <input type="text" name="email" value="<?php echo $email; ?>"><br>
    Username:<br>
    <input type="text" name="username" value="<?php echo $username; ?>"><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
