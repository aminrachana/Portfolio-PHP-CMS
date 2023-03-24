<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM users
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'User has been deleted' );
  
  header( 'Location: users.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM users 
  '.( ( $_SESSION['id'] != 1 and $_SESSION['id'] != 4 ) ? 'WHERE id = '.$_SESSION['id'].' ' : '' ).'
  ORDER BY last,first';
$result = mysqli_query( $connect, $query );

?>

<main>

  <div class="title-container">
    <h2>Manage Users</h2>
    <p><a class="add-link" href="users_add.php"><i class="fa-solid fa-plus"></i> Add User</a></p>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th align="center">ID</th>
        <th align="left">Name</th>
        <th align="left">Email</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
        <tr>
          <td align="center"><?php echo $record['id']; ?></td>
          <td align="left"><?php echo htmlentities( $record['first'] ); ?> <?php echo htmlentities( $record['last'] ); ?></td>
          <td align="left"><a href="mailto:<?php echo htmlentities( $record['email'] ); ?>"><?php echo htmlentities( $record['email'] ); ?></a></td>
          <td align="center"><a href="users_edit.php?id=<?php echo $record['id']; ?>"><i class="fa-solid fa-pen"></i></a></td>
          <td align="center">
            <?php if( $_SESSION['id'] != $record['id'] ): ?>
              <a href="users.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this user?');"><i class="fa-solid fa-trash"></i></a>
            <?php endif; ?>
          </td>
          <td align="center">
            <?php echo $record['active']; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
  

</main>

<?php

include( 'includes/footer.php' );

?>