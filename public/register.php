<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.
  $first_name = "";
  $last_name = "";
  $email = "";
  $username = "";
  $errors = [];

  // if this is a POST request, process the form
  if(is_post_request()) {

    // Confirm that POST values are present before accessing them.
    $first_name = $_POST['first_name'] ?? "";
    $last_name = $_POST['last_name'] ?? "";
    $email = $_POST['email'] ?? "";
    $username = $_POST['username'] ?? "";

    // Perform Validations
    // validating the first name
    if (is_blank($first_name)) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($first_name, ['min' => 2, 'max' => 255])) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }
    // validating the last name
    if (is_blank($last_name)) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($last_name, ['min' => 2, 'max' => 255])) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }
    // validating the email
    if (is_blank($email) || !has_valid_email_format($email)) {
      $errors[] = "Please use a valid email.";
    } elseif (!has_length($email, ['min' => 3, 'max' => 255])) {
      $errors[] = "Email must be between 3 and 255 characters.";
    }
    // validating the username
    $sql = "SELECT username FROM users WHERE username='{$username}';";
    $result = db_query($db, $sql);
    if(db_num_rows($result)) {
      $errors[] = "Username already exists.";
    } elseif (is_blank($username)) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($username, ['min' => 8, 'max' => 255])) {
      $errors[] = "Username must be between 8 and 255 characters.";
    }

    // if there were no errors, submit data to database
    if(empty($errors)) {
      // Write SQL INSERT statement
      $date = date("Y-m-d H:i:s");
      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at) ";
      $sql .= "VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$username}', '{$date}');";

      // For INSERT statments, $result is just true/false
      $result = db_query($db, $sql);
      if($result) {
        db_close($db);
        redirect_to("registration_success.php");
      } else {
        // The SQL INSERT statement failed.
        // Just show the error, not the form
        echo db_error($db);
        db_close($db);
        exit;
      }
    }
  }
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    echo display_errors($errors);
  ?>

  <form action="" method="POST">
    First Name:<br>
    <input type="text" name="first_name" value="<?php echo h($first_name); ?>"><br>
    Last Name:<br>
    <input type="text" name="last_name" value="<?php echo h($last_name); ?>"><br>
    Email:<br>
    <input type="text" name="email" value="<?php echo h($email); ?>"><br>
    Username:<br>
    <input type="text" name="username" value="<?php echo h($username); ?>"><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
