<?php
    // Set the variable for the page name
    $page_name = "Login";
    session_start();
    include('inc/header.php');
    // End the PHP so you can add HTML
    global $conn;
    //check if a user is already logged in, if they are, redirect to the profile page
    if(isset($_SESSION['UserID']) )
    {
        header("Location: http://cseemyweb.essex.ac.uk/~aa20997/website/profile.php");

    }
    //if user isn't logged in check if the username is set
    elseif(isset($_POST['username']))
    {
        include('inc/functions.php');
        //connect to database and call login function to check user details
        connect();
        login($conn,$_POST['username'],$_POST['password'],"http://cseemyweb.essex.ac.uk/~aa20997/website/profile.php");
    }

?>

<!-- Add the page content below -->
<div id="login-area">
    <div class="login-container ">
        <!-- login form -->
        <form action="#" method="post">
            <h1>Already Have An Account</h1>
            <b>
                <label>Username: </label>
                <input name = "username" type="text" placeholder="Enter Username" value="">
            </b>
            <b>
                <label>Password: </label>
                <input name = "password" type="password" placeholder="Enter Password"value="">
            </b>
            <button type="submit" value="login">Login</button>
        </form>
    </div>
    <div class="register-container ">
        <h1>New Customer</h1>
        <p>Do you want to create an account register for newsletter?</p>
        <p>With creating an account, you get to save your details, view your basket on any device. Also view and manage your details. </p>
        <button type="submit" value="register" onClick="location.href='register.php'">REGISTER NOW </button>
    </div>
</div>
<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>
