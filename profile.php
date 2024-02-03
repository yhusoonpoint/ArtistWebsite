<?php
    // Set the variable for the page name
    $page_name = "Profile";
    include('inc/header.php');
    global $conn;

    //checks if user isn't logged in and redirects to login page
    if(!isset($_SESSION['UserID']) || $_SESSION['UserID'] === "")
    {
        header("Location: login.php");
    }
    //check if user wants to remove account
    if(isset($_POST['action']) && $_POST['action'] === "removeAccount")
    {
        include('inc/functions.php');
        //connect to database
        connect();
        //call function and delete user
        deleteUser($conn,$_SESSION['UserID']);
        //redirect to logout and then back to login page
        header("Location: logout.php");
    }
    // End the PHP so you can add HTML
?>

<!-- Add the page content below -->
<div class="alignByColumn">
    <!-- list of what users can do -->
    <form method="post" action="">
        <button type="button" onclick="window.location.href='updateUserSettings.php'">EDIT DETAILS</button>
        <button type="button" onclick="window.location.href='logout.php'">LOGOUT</button>
        <button type="submit" name="action" value="removeAccount">DELETE ACCOUNT</button>
    </form>
</div>
<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>