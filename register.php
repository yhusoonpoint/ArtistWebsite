<?php
    // Set the variable for the page name
    $page_name = "Register";
    include('inc/header.php');
    global $conn;
    //check if user is logged in then redirect to profile page
    if(isset($_SESSION['UserID']))
    {
        header("Location: http://cseemyweb.essex.ac.uk/~aa20997/website/profile.php");
    }
    //checks if email is set when button pressed then connect to database
    elseif (isset($_POST['email']))
    {
            include('inc/functions.php');
            connect();
            //call register function and add to db
            register($conn, $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['username'], $_POST['password'],"profile");
}
    // End the PHP so you can add HTML
?>

<!-- Add the page content below -->
<div id="login-area">
    <div class="register-container ">
        <h1>Create An Account</h1>
        <form action="#" method="post">
            <b>
                <label>First name: </label>
                <input name = "first-name" type="text" placeholder="Enter First Name" >
            </b>
            <b>
                <label>Last Name: </label>
                <input name = "last-name" type="text" placeholder="Enter Last Name" >
            </b>
            <b>
                <label>Email: </label>
                <input name = "email" type="text" placeholder="Enter Email" >
            </b>
            <b>
                <label>Username: </label>
                <input name = "username" type="text" placeholder="Enter Username" >
            </b>
            <b>
                <label>Password: </label>
                <input name = "password" type="password" placeholder="Enter Password">
            </b>
            <button type="submit">CREATE ACCOUNT</button>
        </form>
    </div>
    <div class="login-container ">
        <h1>Existing Customer</h1>
        <p>Do you have an account and want to sign it?</p>
        <p>With signing, you can do more with your accounts. </p>
        <button type="button" onClick="location.href='login.php'">LOGIN</button>
    </div>
</div>
<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>