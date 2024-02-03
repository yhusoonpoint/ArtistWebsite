<?php
// Set the variable for the page name
$page_name = "Admin";
include('inc/header.php');
?>

<!-- management area for admin pages -->
<div class="alignByColumn">
    <a href="additem.php">ADD ITEM</a>
    <a href="updateitem.php">UPDATE ITEM</a>
    <a href="removeitem.php">REMOVE ITEM</a>
    <a href="addUser.php">ADD USER</a>
    <a href="updateUser.php">UPDATE USER</a>
    <a href="removeUser.php">REMOVE USER</a>
    <a href="addevent.php">ADD EVENT</a>
    <a href="updateevent.php">UPDATE EVENT</a>
    <a href="removeevent.php">REMOVE EVENT</a>
</div>

<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>