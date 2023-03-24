<!doctype html>
<html>

<head>

  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

  <title>Website Admin</title>

  <link href="styles.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/672fb65ec9.js" crossorigin="anonymous"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

</head>

<body>

  <header>

    <h1>CMS</h1>

    <?php if (isset($_SESSION['id'])) : ?>

      <p style="padding: 0 1%; text-align: center;">
        <a href="dashboard.php">Dashboard</a> |
        <a href="logout.php">Logout</a>
      </p>

    <?php endif; ?>
  </header>

  <?php echo get_message(); ?>
