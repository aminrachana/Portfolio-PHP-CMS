<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM education
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Education has been deleted' );
  
  header( 'Location: education.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT education.id, name, degree, field, start_year, end_year, location, members.first_name, members.last_name
  FROM education
  LEFT OUTER JOIN members ON education.member_id = members.id';
$result = mysqli_query( $connect, $query );

?>

<main>

  <div class="title-container">
    <h2>Manage education</h2>
    <p><a class="add-link" href="education_add.php"><i class="fa-solid fa-plus"></i> Add Education</a></p>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th align="center">ID</th>
        <th align="center">Name</th>
        <th align="center">Degree</th>
        <th align="center">Field</th>
        <th align="center">Start Year</th>
        <th align="center">End Year</th>
        <th align="center">Location</th>
        <th align="center">Member</th>
        <th></th>
        <th></th>
      </tr>
      <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
        <tr>
          <td align="center"><?php echo $record['id']; ?></td>
          <td align="center"><?php echo $record['name']; ?></td>
          <td align="center"><?php echo $record['degree']; ?></td>
          <td align="center"><?php echo $record['field']; ?></td>
          <td align="center"><?php echo $record['start_year']; ?></td>
          <td align="center"><?php echo $record['end_year']; ?></td>
          <td align="center"><?php echo $record['location']; ?></td>
          <td align="center"><?php echo $record['first_name'] ? ($record['first_name'].' '.$record['last_name']) : 'None'; ?></td>
          <td align="center"><a href="education_edit.php?id=<?php echo $record['id']; ?>"><i class="fa-solid fa-pen"></i></a></td>
          <td align="center">
            <a href="education.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this Education?');"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

  

</main>

<?php

include( 'includes/footer.php' );

?>