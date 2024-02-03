<?php
    // Set the variable for the page name
    $page_name = "AddEvent";
    //include page header
    include('inc/header.php');
    global $conn;
    //check if button is pressed by checking post data
    if(isset($_POST['action']) && $_POST['action'] === "addEvent")
    {
        //include function script and connect to db
        include('inc/functions.php');
        connect();
        //call function from function file that adds to event db
        addEvent($conn,$_POST['eventTitle'],$_POST['eventTickets'],$_POST['eventLocation'], $_POST['eventDate']);
    }
?>

<!-- simple form layout for admin to add event -->
<div>
    <form action="#" method="post">
        <!--button to redirect to admin page-->
        <button type="button" onclick="window.location.href='admin.php'"  >ADMIN PAGE</button>
        <label><b>Event Title</b></label>
        <input name = "eventTitle" type="text" placeholder="Enter Event Title" >
        <label><b>Event Links </b></label>
        <input name = "eventTickets" type="text" placeholder="use space for multiple source" >
        <label><b>Event Location </b></label>
        <input name = "eventLocation" type="text" placeholder="Enter Event Location" >
        <label><b>Event Date </b></label>
        <input name = "eventDate" type="text" placeholder="yyyy/mm/dd" >
        <button type="submit" name="action" value="addEvent">ADD EVENT</button>
    </form>
</div>

<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>