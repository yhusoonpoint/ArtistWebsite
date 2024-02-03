<?php
    // Setting the variable for the page name
    $page_name = "Item";
    //include two php script
    include('inc/header.php');
    include('inc/functions.php');
    global $conn;
    //connect function is called to connect to the database
    connect();
    //if an item is added to the basket the page gets called and calls the function so it can add to basket using the acquired post data.
    addToBasket($conn, $_POST['id'], $_POST['size'], $_SESSION["shoppingBasket"]);
    // Ending the PHP so you can add HTML
?>

<!-- Adding the page content below -->
<div style="width: 100%;">
    <!-- assigning a fixed size so that image can fit without using original dimensions-->
    <?php
        $sql = 'SELECT * FROM Products WHERE ProductID = '.$_GET["data"];

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            // There were results so loop through each result
            while ($row = mysqli_fetch_assoc($result))
            {
                echo '
                <div style="width: 47%;height: 100px;float: left;padding-left: 16px;">
                    <img src="'.$row["ProductImage"].'" alt="'.$row["ProductName"].'"  style="width:100%;"/>
                </div>
                <div style="margin-left: 50%; height: 100px;">
                    <p>Product id: '.$row["ProductID"].'</p>
                    <h1'.$row['ProductShortDescription'].'</h1>
                    <p>£'.$row['ProductPrice'].'</p>
                    <form method="post" action="">
                    <input type="hidden" name="id" value="'.$row["ProductID"].'" />
                    <label>Size:</label>
                    <!-- drop down list to pick size-->
                    <select name="size">';
                        foreach(explode(" ",$row["ProductSize"]) as $value)
                        {
                            echo '<option >' . $value . '</option>';
                        }
                        echo '
                    </select>
                    <button type="submit">ADD TO BASKET</button>
                    </form>
                    <h2>Details:</h2>
                    <p>'.$row["ProductLongDescription"].'</p>
                </div>
                ';
            }
        }
        else
        {
            // There were no rows in the table that matched the query
            echo "NO ITEMS FOUND";
        }
    ?>
</div>


<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>