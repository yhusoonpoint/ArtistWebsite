<?php
    // Set the variable for the page name
    $page_name = "UpdateUserSettings";
    include('inc/header.php');
    global $conn;

    if(!isset($_SESSION['UserID']))
    {
        header("Location: login.php");
    }
    elseif(isset($_POST['save-changes']))
    {
        include('inc/functions.php');
        connect();
        updateUser($conn, $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['username'], $_POST['password']);
    }

?>


<?php
include('inc/functions.php');
connect();
$result = mysqli_query($conn, 'SELECT * FROM Users WHERE UserID = '.$_SESSION['UserID']);
$row = mysqli_fetch_assoc($result);
?>
<div>
    <div>
        <form action="" method="post">
            <label><b>First name</b></label>
            <input name = "first-name" type="text" placeholder="Enter First Name" value="<?php echo $row['UserFirstName'];?>">
            <label><b>Last Name</b></label>
            <input name = "last-name" type="text" placeholder="Enter Last Name" value="<?php echo $row['UserLastName'];?>">
            <label><b>Email</b></label>
            <input name = "email" type="text" placeholder="Enter Email" value="<?php echo $row['UserEmail'];?>">
            <label><b>Username</b></label>
            <input name = "username" type="text" placeholder="Enter Username" value="<?php echo $row['UserUsername'] ?>">
            <label><b>Password</b></label>
            <input name = "password" type="password" value="">
            <button name="save-changes" value ="this is it" type="submit">SAVE CHANGES</button>
        </form>
    </div>
</div>


<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>