<?php
    // Set the variable for the page name
    $page_name = "UpdateUser";
    include('inc/header.php');
    global $conn;
    include('inc/functions.php');
    connect();
    //check if action has a value when button is pressed or page is loaded
    if (isset($_POST['action']) && $_POST['action'] === "updateUser")
    {
        //connect to db and call update function to update info.
        updateUser($conn, $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['username'], $_POST['password']);
    }

?>

    <div>
        <form method="post" action="">
            <button type="button" onclick="window.location.href='admin.php'"  >ADMIN PAGE</button>
            <b>
                <select name="UserID">
                    <option disabled selected value> SELECT USER TO UPDATE </option>
                    <?php
                    $sql = "SELECT * FROM Users";
                    $result = mysqli_query($conn, $sql);
                    //loop through items and display in a option type
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option  value="'.$row['UserID'].'">' . $row["UserUsername"] . '</option>';
                    }
                    ?>
                </select>
            </b>
            <button type="submit" name="action" value="search">SEARCH</button>
        </form>
    </div>
<?php
    //check if value is given
    if(isset($_POST['UserID']))
    {
        $_SESSION['UserID'] = $_POST['UserID'];
    }
    //show info if id is given
    if(isset($_POST['UserID']) || $_POST['action'] === "updateUser")
    {
        $result = mysqli_query($conn, 'SELECT * FROM Users WHERE UserID = '.$_SESSION['UserID']);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) === 0)
        {
            echo "USERS NOT FOUND";
        }
        else
        {
?>
    <div class=" ">
        <form action="#" method="post">
            <!-- add value from db to form -->
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
            <button type="submit" name="action" value="updateUser">UPDATE USER</button>
        </form>
    </div>
 <?php
       }
    }
 ?>





<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>