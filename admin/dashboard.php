<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

include('includes/header.php');

?>
<main>
  <ul id="dashboard">
    <li>
      <i class="fa-solid fa-school"></i>
      <a href="education.php">
        Manage Education
      </a>
    </li>
    <li>
      <i class="fa-solid fa-people-group"></i>
      <a href="members.php">
        Manage Members
      </a>
    </li>
    <li>
    <i class="fa-solid fa-diagram-project"></i>
      <a href="projects.php">
        Manage Projects
      </a>
    </li>
    <li>
      <i class="fa-solid fa-people-group"></i>
      <a href="users.php">
        Manage Users
      </a>
    </li>
    <li>
      <i class="fa-solid fa-right-from-bracket"></i>
      <a href="logout.php">
        Logout
      </a>
    </li>
  </ul>
</main>

<?php

include('includes/footer.php');

?>