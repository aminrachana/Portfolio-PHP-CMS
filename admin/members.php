<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM members
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Member has been deleted' );
  
  header( 'Location: members.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM members';
$result = mysqli_query( $connect, $query );

?>

<main>
  <div class="title-container">
    <h2>Manage members</h2>
    <a class="add-link" href="members_add.php"><i class="fa-solid fa-plus"></i> Add Member</a>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th align="center">ID</th>
        <th align="center">First Name</th>
        <th align="center">Last Name</th>
        <th align="center">Email</th>
        <th align="center">Linkedin</th>
        <th align="center">Github</th>
        <th align="center">Phone</th>
        <th align="center">Gender</th>
        <th align="center">Description</th>
        <th></th>
        <th></th>
      </tr>
      <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
        <tr>
          <td align="center"><?php echo $record['id']; ?></td>
          <td align="center"><?php echo $record['first_name']; ?></td>
          <td align="center"><?php echo $record['last_name']; ?></td>
          <td align="center"><?php echo $record['email']; ?></td>
          <td align="center"><?php echo $record['linkedin']; ?></td>
          <td align="center"><?php echo $record['github']; ?></td>
          <td align="center"><?php echo $record['phone']; ?></td>
          <td align="center"><?php echo $record['gender']; ?></td>
          <td align="center"><?php echo $record['description']; ?></td>
          <td align="center"><a href="members_edit.php?id=<?php echo $record['id']; ?>"><i class="fa-solid fa-pen"></i></a></td>
          <td align="center">
            <a href="members.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this Member?');"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

  

</main>

<?php

include( 'includes/footer.php' );

?>