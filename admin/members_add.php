<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['first_name'])) {
    $error_msg = '';
    if (empty($_POST['first_name']))
        $error_msg .= '<li>Please enter first name</li>';
    if (empty($_POST['last_name']))
        $error_msg .= '<li>Please enter last name</li>';
    if (empty($_POST['email']))
        $error_msg .= '<li>Please enter email</li>';
    else if (!preg_match('/^\\S+@\\S+\\.\\S+$/', $_POST['email']))
        $error_msg .= '<li>Email is not valid</li>';
    if (empty($_POST['phone']))
        $error_msg .= '<li>Please enter phone</li>';
    else if (!preg_match('/^\\+?[1-9][0-9]{7,14}$/', $_POST['phone']))
        $error_msg .= '<li>Phone is not valid</li>';
    if (empty($_POST['gender']))
        $error_msg .= '<li>Please enter gender</li>';

    if (empty($error_msg)) {
        $query = 'INSERT INTO members (
        first_name,
        last_name,
        email,
        linkedin,
        github,
        description,
        phone,
        gender
      ) VALUES (
        "' . mysqli_real_escape_string($connect, $_POST['first_name']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['last_name']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['email']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['linkedin']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['github']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['description']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['phone']) . '",
        "' . mysqli_real_escape_string($connect, $_POST['gender']) . '"
      )';
        mysqli_query($connect, $query);

        set_message('Member has been added');
        header('Location: members.php');
        die();
    } else {
        $error_msg = '<div class="validation-errors">Please fix these errors:<ul>' . $error_msg . '</ul></div>';
    }
}

include('includes/header.php');

?>

<main>
    <h2>Add Member</h2>

    <?php echo $error_msg ?>
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name">

        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name">

        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone">

        <br>

        <label for="gender">Gender:</label>
        <?php

        $values = array('male', 'female', 'other');

        echo '<select name="gender" id="gender">';
        foreach ($values as $key => $value) {
            echo '<option value="' . $value . '"';
            echo '>' . $value . '</option>';
        }
        echo '</select>';

        ?>

        <br>

        <label for="linkedin">Linkedin:</label>
        <input type="text" name="linkedin" id="linkedin">

        <br>

        <label for="github">Github:</label>
        <input type="text" name="github" id="github">

        <br>

        <label for="description">Description:</label>
        <textarea type="text" name="description" id="description" rows="10"></textarea>

        <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>


        <br>

        <input type="submit" value="Add Member">

    </form>

    <p><a href="members.php"><i class="fas fa-arrow-circle-left"></i> Return to Member List</a></p>

</main>

<?php

include('includes/footer.php');

?>