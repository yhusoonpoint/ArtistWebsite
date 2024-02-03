<?php
    // Setting name variable
    $page_name = "Store";
    include('inc/header.php'); // Top part of html that includes nav
    include ("inc/functions.php");
    global $conn;
    // connecting to the database
    connect();
    // creating a session so information can be passed around

    //calling a function to add to the basket
    addToBasket($conn, $_POST['id'], $_POST['size'], $_SESSION["shoppingBasket"]);
    // End the PHP so you can add HTML
?>

<!-- page content -->



    <?php
        //get result of the query of featured MERCHANDISE
        $result = mysqli_query($conn, 'SELECT * FROM Products WHERE ProductProductCategoryID = 5');
        // Check there are some results
        if (mysqli_num_rows($result) > 0)
        {
            echo '<h1 class="flex-container"> FEATURED MERCHANDISE </h1>
                <div class="flex-container" >';
                    // There were results so loop through each result
                    while($row = mysqli_fetch_assoc($result))
                    {
                        //printing the information of the items from the database using the template below
                        echo '
                            <div>
                                <img class="bin-display" src="'.$row["ProductImage"].'" alt="'.$row["ProductName"].'"/>
                                <span>
                                    <a href="item.php?data='.$row["ProductID"].'">
                                        <h3>'.$row["ProductName"].'</h3>
                                        <p>'.$row["ProductShortDescription"].'</p>
                                        <p>£'.$row["ProductPrice"].'</p>
                                    </a>
                                    <div>
                                        <!-- creating a form to redirect when button is clicked. -->
                                        <form method="post" action="">
                                        <!-- hidden input to pass id through the post method -->
                                        <input type="hidden" name="id" value="'.$row["ProductID"].'" />
                                        <label>Size:</label>
                                        <select name="size">';
                        //splitting the result by space to get the size and looping through it
                        foreach(explode(" ",$row["ProductSize"]) as $value) {
                            echo '<option >' . $value . '</option>';
                        }
                        echo '
                                        </select>
                                        <button type="submit">ADD TO BASKET</button>
                                        </form>
                                     </div>
                                </span>
                            </div>
                        ';
                    }
                    echo '</div>';
        }
    ?>
    <h1 class="flex-container"> ALL MERCHANDISE </h1>
    <div class="flex-container" >
    <?php
        //get result of the query
        $result = mysqli_query($conn, 'SELECT * FROM Products');
        // Check there are some results
        if (mysqli_num_rows($result) > 0)
        {
            // There were results so loop through each result
            while($row = mysqli_fetch_assoc($result))
            {
                //printing the information of the items from the database using the template below
                echo '
                    <div>
                        <img class="bin-display" src="'.$row["ProductImage"].'" alt="'.$row["ProductName"].'"/>
                        <span>
                            <a href="item.php?data='.$row["ProductID"].'">
                                <h3>'.$row["ProductName"].'</h3>
                                <p>'.$row["ProductShortDescription"].'</p>
                                <p>£'.$row["ProductPrice"].'</p>
                            </a>
                            <div>
                                <!-- creating a form to redirect when button is clicked. -->
                                <form method="post" action="">
                                <!-- hidden input to pass id through the post method -->
                                <input type="hidden" name="id" value="'.$row["ProductID"].'" />
                                <label>Size:</label>
                                <select name="size">';
                                //splitting the result by space to get the size and looping through it
                                foreach(explode(" ",$row["ProductSize"]) as $value) {
                                    echo '<option >' . $value . '</option>';
                                }
                                echo '
                                </select>
                                <button type="submit">ADD TO BASKET</button>
                                </form>
                             </div>
                        </span>
                    </div>
                ';
            }
        }
        else
        {
            // There were no rows in the table that matched the query
            echo "NO ITEMS FOUND!!!";
        }
    ?>
</div>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>