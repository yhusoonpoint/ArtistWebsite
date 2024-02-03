<?php
    $page_name = "RemoveEvent";
    include('inc/header.php');
    global $conn;
    include('inc/functions.php');
    connect();
    //check if button is pressed by checking post data
    if(isset($_POST['action']) && $_POST['action'] === "removeEvent")
    {
        //connect to db and call function in functions to delete event
        deleteEvent($conn,$_POST['eventID']);
    }
 ?>

<?php
    $sql = "SELECT * FROM Event";
    $result = mysqli_query($conn, $sql);
    //check if there's row
    if (mysqli_num_rows($result) === 0) {
        echo "NO RESULTS FOUND";
    }
    else
    {
        echo '
                <form method="post" action="">               
                    <button type="button" onclick="window.location.href=\'admin.php\'"  >ADMIN PAGE</button>     
                    <select name="eventID">
                        <option disabled selected value> SELECT AN EVENT TO DELETE </option>';
                        //loop through row to get event details
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option  value="'.$row['EventID'].'">' . $row["EventTitle"] . '</option>';
                        }
                        echo '
                    </select>
                    <button type="submit" name = "action" value = "removeEvent" >DELETE EVENT</button>
                </form>';
}?>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>
