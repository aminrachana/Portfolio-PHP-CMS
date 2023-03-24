<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {

  header('Location: education.php');
  die();
}

if (isset($_POST['name'])) {
  $error_msg = '';

  if (empty($_POST['name']))
    $error_msg .= '<li>Please enter name</li>';
  if (empty($_POST['degree']))
    $error_msg .= '<li>Please enter degree</li>';
  if (empty($_POST['start_year']))
    $error_msg .= '<li>Please enter start year</li>';
  else if (!preg_match('~\b\d{4}\b~', $_POST['start_year']))
    $error_msg .= '<li>Start year is not valid</li>';
  if (empty($_POST['end_year']))
    $error_msg .= '<li>Please enter end year</li>';
  else if (!preg_match('~\b\d{4}\b~', $_POST['start_year']))
    $error_msg .= '<li>End year is not valid</li>';
  if (empty($_POST['location']))
    $error_msg .= '<li>Please enter Location</li>';
  if (empty($_POST['member_id']))
    $error_msg .= '<li>Please enter Member</li>';

  if (empty($error_msg)) {

    $query = 'UPDATE education SET
         name = "' . mysqli_real_escape_string($connect, $_POST['name']) . '",
         degree = "' . mysqli_real_escape_string($connect, $_POST['degree']) . '",
         field = "' . mysqli_real_escape_string($connect, $_POST['field']) . '",
         start_year = "' . mysqli_real_escape_string($connect, $_POST['start_year']) . '",
         end_year = "' . mysqli_real_escape_string($connect, $_POST['end_year']) . '",
         location = "' . mysqli_real_escape_string($connect, $_POST['location']) . '",
         member_id = "' . mysqli_real_escape_string($connect, $_POST['member_id']) . '"
        WHERE id = ' . $_GET['id'] . '
        LIMIT 1';
    mysqli_query($connect, $query);

    set_message('Education has been updated');
    header('Location: education.php');
    die();
  } else {
    $error_msg = '<div class="validation-errors">Please fix these errors:<ul>' . $error_msg . '</ul></div>';
  }
}


if (isset($_GET['id'])) {

  $query = 'SELECT education.id, name, degree, field, start_year, end_year, location, members.id
    FROM education
    LEFT OUTER JOIN members ON education.id = members.id
    WHERE education.id = ' . $_GET['id'] . '
    LIMIT 1';

  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: education.php');
    die();
  }

  $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

?>

<main>
  <h2>Edit Education</h2>

  <?php echo $error_msg ?>
  <form method="post">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlentities($record['name']); ?>">

    <br>

    <label for="degree">Degree:</label>
    <input type="text" name="degree" id="degree" value="<?php echo htmlentities($record['degree']); ?>">

    <br>

    <label for="field">Field:</label>
    <input type="text" name="field" id="field" value="<?php echo htmlentities($record['field']); ?>">

    <br>

    <label for="start_year">Start Year:</label>
    <input type="text" name="start_year" id="start_year" value="<?php echo htmlentities($record['start_year']); ?>">

    <br>

    <label for="end_year">End Year:</label>
    <input type="text" name="end_year" id="end_year" value="<?php echo htmlentities($record['end_year']); ?>">

    <br>

    <label for="location">Location:</label>
    <input type="text" name="location" id="location" value="<?php echo htmlentities($record['location']); ?>">

    <br>

    <label for="member_id">Member:</label>
    <?php
    $query = 'SELECT *
      FROM members';
    $res = mysqli_query($connect, $query);

    echo '<select name="member_id" id="member_id">';
    while ($rec = mysqli_fetch_assoc($res)) {
      echo '<option value="' . $rec['id'] . '"';
      if ($rec['id'] == $record['members.id']) echo ' selected="selected"';
      echo '>' . $rec['first_name'] . ' ' . $rec['last_name'] . '</option>';
    }
    echo '</select>';

    ?>

    <br>

    <input type="submit" value="Edit Education">

  </form>

  <p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>

</main>

<?php

include('includes/footer.php');

?>