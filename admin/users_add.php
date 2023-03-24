<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['first'])) {

  $error_msg = '';
  if (empty($_POST['first']))
    $error_msg .= '<li>Please enter first</li>';
  if (empty($_POST['last']))
    $error_msg .= '<li>Please enter last</li>';
  if (empty($_POST['email']))
    $error_msg .= '<li>Please enter email</li>';
  else if (!preg_match('/^\\S+@\\S+\\.\\S+$/', $_POST['email']))
    $error_msg .= '<li>Email is not valid</li>';
  if (empty($_POST['password']))
    $error_msg .= '<li>Please enter password</li>';
  if (empty($_POST['active']))
    $error_msg .= '<li>Please enter active</li>';

  if (empty($error_msg)) {

    $query = 'INSERT INTO users (
        first,
        last,
        email,
        password,
        active
      ) VALUES (
        "' . mysqli_real_escape_string($connect, $_POST['first']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['last']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['email']) . '",
        "' . md5($_POST['password']) . '",
        "' . $_POST['active'] . '"
      )';
    mysqli_query($connect, $query);

    set_message('User has been added');
    header('Location: users.php');
    die();
  }
  else{
    $error_msg = '<div class="validation-errors">Please fix these errors:<ul>' . $error_msg . '</ul></div>';
  }
}

include('includes/header.php');

?>

<main>


  <h2>Add User</h2>

  <?php echo $error_msg ?>
  <form method="post">

    <label for="first">First Name:</label>
    <input type="text" name="first" id="first">

    <br>

    <label for="last">Last Name:</label>
    <input type="text" name="last" id="last">

    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email">

    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">

    <br>

    <label for="active">Active:</label>
    <?php

    $values = array('Yes', 'No');

    echo '<select name="active" id="active">';
    foreach ($values as $key => $value) {
      echo '<option value="' . $value . '"';
      echo '>' . $value . '</option>';
    }
    echo '</select>';

    ?>

    <br>

    <input type="submit" value="Add User">

  </form>

  <p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>

</main>

<?php

include('includes/footer.php');

?>