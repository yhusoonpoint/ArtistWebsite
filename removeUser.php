<?php
    $page_name = "RemoveItem";
    //include page header
    include('inc/header.php');
    global $conn;

    include('inc/functions.php');
    connect();
    //check if button is pressed by checking post data
    if(isset($_POST['action']) && $_POST['action'] === "removeUser")
    {
        //connect and call function to delete item
        deleteUser($conn,$_POST['UserID']);
    }
 ?>

<?php
    $sql = "SELECT * FROM Users";
    $result = mysqli_query($conn, $sql);
    //if no result found print
    if (mysqli_num_rows($result) === 0) {
        echo "NO RESULTS FOUND";
    }
    else
    {
        echo '
                <form method="post" action="">          
                    <button type="button" onclick="window.location.href=\'admin.php\'"  >ADMIN PAGE</button>          
                    <select name="UserID">
                        <option disabled selected value> SELECT USER TO DELETE </option>';
                        //loop through items and display in a option type
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option  value="'.$row['UserID'].'">' . $row["UserUsername"] . '</option>';
                        }
                        echo '
                    </select>
                    <button type="submit" name = "action" value = "removeUser" >DELETE USER</button>
                </form>';
}?>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>
