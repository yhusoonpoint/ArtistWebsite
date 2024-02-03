<?php
    // Set the variable for the page name
    $page_name = "AddUser";
    //include header
    include('inc/header.php');
    //calling global variable
    global $conn;
    //include function
    include('inc/functions.php');
    connect();
    //check if button is pressed by checking post data
    if(isset($_POST['action']) && $_POST['action'] === "addUser")
    {
        register($conn, $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['username'], $_POST['password'], "Admin");
    }
?>

    <!-- simple form layout for admin to add event -->
<div>
    <form action="#" method="post">
        <!--button to redirect to admin page-->
        <button type="button" onclick="window.location.href='admin.php'"  >ADMIN PAGE</button>
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
        <button type="submit" name="action" value="addUser">ADD USER</button>
    </form>
</div>

<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>