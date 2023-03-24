<?php

include('admin/includes/database.php');
include('admin/includes/config.php');
include('admin/includes/functions.php');
$ID = 3;
?>
<!doctype html>
<html>

<head>

  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

  <title>Rachana's Portfolio</title>

  <link href="styles.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">

  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  <script src="https://kit.fontawesome.com/672fb65ec9.js" crossorigin="anonymous"></script>

</head>

<body>

  <nav>
    <h1><span>&lt;/</span> RA.<span>&gt;</span></h1>
    <div>
      <a href="#">Home</a>
      <a href="#about">About Me</a>
      <a href="#projects">Project</a>
      <a href="#education">Education</a>
    </div>
  </nav>


  <div class="hero-banner">
    <h1>Hi, I am Rachana Amin...</h1>
    <p>A Front-end Web developer!</p>
    <p>Welcome to my Web Space. I like creating Interactive Applications and experiences on the web.</p>
  </div>

  <main>
    <section id="about">
      <h2 class="title">About Me</h2>
      <div class="description-container">
        <?php
        $query = 'SELECT *
                  FROM members
                  WHERE id = '.$ID;
        $result = mysqli_query($connect, $query);
        while ($record = mysqli_fetch_assoc($result)) :
        ?>
          <img src="./img/hero-banner.png" alt="profile" class="photo" />
          <div>
            <h2><?php echo $record['first_name'] . ' ' . $record['last_name'] ?></h2>
            <p><?php echo $record['description'] ?></p>
            <p><?php echo $record['email'] ?></p>
            <p><?php echo $record['phone'] ?></p>
            <div class="link-container">
              <a href="<?php echo $record['github']; ?>" class="git-link"><i class="fa-brands fa-github"></i>Github</a>
              <a href="<?php echo $record['linkedin']; ?>" class="linkedin-link"><i class="fa-brands fa-linkedin"></i>Linkedin</a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </section>

    <section id="projects">
      <h2 class="title">Projects</h2>
      <div class="card-container">
        <?php
        $query = 'SELECT projects.id, title, content, photo, url, members.first_name, members.last_name
                  FROM projects
                  LEFT JOIN members ON projects.member_id = members.id
                  ORDER BY date DESC';
        $result = mysqli_query($connect, $query);
        while ($record = mysqli_fetch_assoc($result)) :
        ?>

          <div class="card-wrapper">
            <div class="card">
              <div>
                <?php if ($record['photo']) : ?>
                  <img src="<?php echo $record['photo']; ?>" class="project-photo">
                <?php else : ?>
                  <div class="project-photo">

                  </div>
                <?php endif; ?>

                <h2><?php echo $record['title']; ?></h2>
                <?php echo $record['content']; ?>
              </div>
              <div>
                <a href="<?php echo $record['url']; ?>" class="git-link">Github</a>
              </div>
            </div>
          </div>

        <?php endwhile; ?>
      </div>

    </section>

    <section id="education">
      <h2 class="title">Education</h2>
      <div class="card-container">
        <?php
        $query = 'SELECT *
                  FROM education 
                  where member_id = '.$ID.'
                  ORDER BY end_year DESC';
        $result = mysqli_query($connect, $query);
        while ($record = mysqli_fetch_assoc($result)) :
        ?>
          <div class="card-wrapper">
            <div class="card">
              <span class="year"><?php echo $record['start_year'].' - '.$record['end_year']; ?></span>
              <h3><?php echo $record['name']; ?></h3>
              <p><?php echo $record['degree']; ?></p>
              <span><em><?php echo $record['location']; ?></em></span>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    </section>

  </main>

  <footer>
    <p>&copy; Copyright 2023, PHP-CMS | Rachana Amin</p>
  </footer>

</body>

</html>