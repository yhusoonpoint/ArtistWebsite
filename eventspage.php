<?php
    // Set the variable for the page name
    $page_name = "Events";
    include('inc/header.php');
    global $conn;
    // End the PHP so you can add HTML
?>

<!-- Add the page content below -->
<table class="centerTable">
    <tr>
        <th>DATE</th>
        <th>TITLE</th>
        <th>LOCATION</th>
        <!-- links will be visible other tickets-->
        <th>TICKETS</th>
    </tr>
    <?php
        include('inc/functions.php');
        connect();
        $sql = "SELECT * FROM Event";
        $result = mysqli_query($conn,$sql);
        //loop through result to scan for rows if none then display none
        if(mysqli_num_rows($result) === 0)
        {
            echo "NO EVENT AVAILABLE YET!!!";
        }
        else
        {
            //rows were found so it's looping through each row to put it's content into the template
            while($row = mysqli_fetch_array($result))
            {
                //index is set to add increment in case there's more than one link
                $index = 1;
                echo'
                <tr>
                    <td>'.$row["EventDate"].'</td>
                    <td>'.$row["EventTitle"].'</td> 
                    <td>'.$row["EventLocation"].'</td>
                    <td>';
                        //loops through tickets for the addresses.
                        foreach(explode(" ",$row["EventTicket"]) as $value)
                        {
                            if(!strstr($value,'http'))
                            {
                                $value = "http://" . $value;
                            }
                            echo '<a href="'.$value. '" style="background: #d2691e;" > LINK ' .$index++.' </a>';
                        }
                    echo '</td>
                </tr>';
            }
        }

    ?>
</table>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>