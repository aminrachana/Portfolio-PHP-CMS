<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['title'])) {
  $error_msg = '';
  if (empty($_POST['content']))
    $error_msg .= '<li>Please enter content</li>';
  if (empty($_POST['date']))
    $error_msg .= '<li>Please enter date</li>';
  if (empty($_POST['url']))
    $error_msg .= '<li>Please enter url</li>';

  if (empty($error_msg)) {

    $query = 'INSERT INTO projects (
        title,
        content,
        date,
        type,
        url
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['content']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['date']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['type']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['url']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Project has been added');

    header('Location: projects.php');
    die();
  } else {
    $error_msg = '<div class="validation-errors">Please fix these errors:<ul>' . $error_msg . '</ul></div>';
  }
}

include('includes/header.php');

?>

<main>

  <h2>Add Project</h2>

  <?php echo $error_msg ?>
  <form method="post">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title">

    <br>

    <label for="content">Content:</label>
    <textarea type="text" name="content" id="content" rows="10"></textarea>

    <script>
      ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
          console.log(editor);
        })
        .catch(error => {
          console.error(error);
        });
    </script>

    <br>

    <label for="url">URL:</label>
    <input type="text" name="url" id="url">

    <br>

    <label for="date">Date:</label>
    <input type="date" name="date" id="date">

    <br>

    <label for="type">Type:</label>
    <?php

    $values = array('Website', 'Graphic Design');

    echo '<select name="type" id="type">';
    foreach ($values as $key => $value) {
      echo '<option value="' . $value . '"';
      echo '>' . $value . '</option>';
    }
    echo '</select>';

    ?>

    <br>

    <input type="submit" value="Add Project">

  </form>

  <p><a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a></p>

</main>

<?php

include('includes/footer.php');

?>