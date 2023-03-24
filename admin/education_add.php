<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

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

    $query = 'INSERT INTO education (
        name,
        degree,
        field,
        start_year,
        end_year,
        location,
        member_id
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['name']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['degree']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['field']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['start_year']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['end_year']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['location']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['member_id']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Education has been added');
    header('Location: education.php');
    die();
  } else {
    $error_msg = '<div class="validation-errors">Please fix these errors:<ul>'.$error_msg.'</ul></div>';
  }
}

include('includes/header.php');

?>

<main>
  <h2>Add Education</h2>

  <?php echo $error_msg ?>
  <form method="post">

    <label for="name">Name*</label>
    <input type="text" name="name" id="name">

    <br>

    <label for="degree">Degree*</label>
    <input type="text" name="degree" id="degree">

    <br>

    <label for="field">Field</label>
    <input type="text" name="field" id="field">

    <br>

    <label for="start_year">Start Year*</label>
    <input type="text" name="start_year" id="start_year">

    <br>

    <label for="end_year">End Year*</label>
    <input type="text" name="end_year" id="end_year">

    <br>

    <label for="location">Location*</label>
    <input type="text" name="location" id="location">

    <br>

    <label for="member_id">Member*</label>
    <?php
    $query = 'SELECT *
      FROM members';
    $result = mysqli_query($connect, $query);

    echo '<select name="member_id" id="member_id">';
    while ($record = mysqli_fetch_assoc($result)) {
      echo '<option value="' . $record['id'] . '"';
      echo '>' . $record['first_name'] . ' ' . $record['last_name'] . '</option>';
    }
    echo '</select>';

    ?>

    <br>

    <input type="submit" value="Add Education">

  </form>
  <p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>

</main>

<?php

include('includes/footer.php');

?>