<?php
    // Set the variable for the page name
    $page_name = "UpdateEvent";
    //include page header
    include('inc/header.php');
    global $conn;
    include('inc/functions.php');
    connect();
        //check if button is pressed by checking post data
    if (isset($_POST['action']) && $_POST['action'] === "updateEvent")
    {
        //CONNECT TO DB AND CALL FUNCTION TO UPDATE EVENT
        updateEvent($conn,$_SESSION['eventID'], $_POST['eventTitle'],$_POST['eventTicket'],$_POST['eventLocation'],$_POST['eventDate']);
    }

?>

    <div>
        <form method="post" action="">
            <button type="button" onclick="window.location.href='admin.php'"  >ADMIN PAGE</button>
            <b>
                <select name="eventID">
                    <option disabled selected value> SELECT AN EVENT TO UPDATE </option>
                    <?php
                    $sql = "SELECT * FROM Event";
                    $result = mysqli_query($conn, $sql);
                    //loop through row to get event details
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option  value="'.$row['EventID'].'">' . $row["EventTitle"] . '</option>';
                    }
                    ?>
                </select>
            </b>
            <button type="submit" name="action" value="search">SEARCH</button>
        </form>
    </div>
    <?php
        //check if a value is given in the event id session the display this if true
        if(isset($_POST['eventID']))
        {
            //set session event id so when the page refresh the id is retrieved
            $_SESSION['eventID'] = $_POST['eventID'];
        }
        //check if button to update information is pressed.
        if(isset($_POST['eventID']) || $_POST['action'] === "updateEvent")
        {
            $result = mysqli_query($conn, 'SELECT * FROM Event WHERE EventID = '.$_SESSION['eventID']);
            $row = mysqli_fetch_assoc($result);
            //check if result is 0
            if(mysqli_num_rows($result) === 0)
            {
                echo "EVENT NOT FOUND";
            }
            else
            {

    ?>
                <div class=" ">
                    <form action="#" method="post">
                        <label><b>Event Title</b></label>
                        <input name = "eventTitle" type="text" placeholder="Enter Event Name" value="<?php echo $row['EventTitle']; ?>">
                        <label><b>Event Location</label>
                        <input name = "eventLocation" type="text" placeholder="Enter Event Location" value="<?php echo $row['EventLocation']; ?>">
                        <label><b>Event Date</b></label>
                        <input name = "eventDate" type="text" placeholder="Enter Event Name" value="<?php echo $row['EventDate']; ?>">
                        <label><b>Event Ticket</b></label>
                        <input name = "eventTicket" type="text" placeholder="Enter Event Tickets link" value="<?php echo $row['EventTicket']; ?>">
                        <button type="submit" name="action" value="updateEvent">UPDATE EVENT</button>
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