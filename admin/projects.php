<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM projects
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Project has been deleted' );
  
  header( 'Location: projects.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT projects.id, title, content, type, date, members.first_name, members.last_name
  FROM projects
  LEFT OUTER JOIN members ON projects.member_id = members.id
  ORDER BY date DESC';
$result = mysqli_query( $connect, $query );

?>

<main>

  <div class="title-container">
    <h2>Manage Projects</h2>
    <p><a class="add-link" href="projects_add.php"><i class="fa-solid fa-plus"></i> Add Project</a></p>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th></th>
        <th align="center">ID</th>
        <th align="left">Title</th>
        <th align="center">Type</th>
        <th align="center">Date</th>
        <th align="center">Member</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
        <tr>
          <td align="center">
            <img src="image.php?type=project&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
          </td>
          <td align="center"><?php echo $record['id']; ?></td>
          <td align="left">
            <?php echo htmlentities( $record['title'] ); ?>
            <small><?php echo $record['content']; ?></small>
          </td>
          <td align="center"><?php echo $record['type']; ?></td>
          <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['date'] ); ?></td>
          <td align="center"><?php echo $record['first_name'] ? ($record['first_name'].' '.$record['last_name']) : 'None'; ?></td>
          <td align="center"><a href="projects_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
          <td align="center"><a href="projects_edit.php?id=<?php echo $record['id']; ?>"><i class="fa-solid fa-pen"></i></a></td>
          <td align="center">
            <a href="projects.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this project?');"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

  
</main>

<?php

include( 'includes/footer.php' );

?>