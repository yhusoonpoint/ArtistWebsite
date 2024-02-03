<?php
    // Setting the variable for the page name
    $page_name = "Basket";

    //include header
    include('inc/header.php');
    global $conn;

    //check for button value to see if it's to remove item and also check if the basket is not empty
    if (isset($_POST['action']))
    {
          include('inc/functions.php');
          updateBasket($_POST['action'],$_SESSION["shoppingBasket"],$_POST['id'],$_POST['size'],$_POST['quantity']);
          header("Location: " . "basket.php");
    }
    // Ending the PHP so you can add HTML
?>

<!-- Adding the page content below -->
<table id="basket-table">
    <tr>
        <th>Product</th>
        <th>Info</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    <?php
        //check if there's already a basket
        if (isset($_SESSION["shoppingBasket"]))
        {
            $totalPrice = 0;
            foreach ($_SESSION["shoppingBasket"] as $product) {
                echo '            
                    <tr>
                        <td>
                            <a href="item.php?data='.$product["id"].'">
                                <!-- product image display, alt as an alternative for picture-->
                                <img src="'.$product["image"].'" alt="' . $product["name"] . '"/>
                            </a>
                        </td>
                        <td>
                            <h2><a href="item.php?data=' . $product["id"] . '">' . $product["name"] . '</a></h2>
                            <p> SIZE - ' . $product["size"] . '</p>
                            <!-- created a link to remove item-->
                            <form method="post" action="">
                                    <!-- hidden is set to pass value through the post -->
                                    <input type="hidden" name="id" value="'.$product["id"].'" />
                                    <input type="hidden" name="size" value="'.$product["size"].'" />
                                    <input type="hidden" name="action" value="remove" />
                                    <button type="sumbit" class="remove"> Remove Item </button>
                            </form>
                        </td>
                        <td>
                            <!--setting scrollbar to change number of quantity with min value of 1 so it doesnt have negative-->
                            <form method="post" action="">
                                <input type="hidden" name="id" value="'.$product["id"].'" />
                                <input type="hidden" name="action" value="changeQuantity" />
                                <input type="hidden" name="size" value="'.$product["size"].'" />
                            <input type="number"  name="quantity" value="'.$product["quantity"].'" min="1"  onChange="this.form.submit()">
                            </form>
                        </td>
                        <td>£' . $product["price"]*$product["quantity"] . '</td>
                    </tr>
                    ';
                //update price and session price
                $totalPrice += ($product["price"]*$product["quantity"]);
                $_SESSION["totalPrice"] = $totalPrice;
            }
        }
        //if there's no basket array show the basket is empty
        else
        {
            //Set price to 0 once basket is empty
            $_SESSION["totalPrice"] = 0;
            echo "<tr><td>BASKET IS EMPTY!!!!</td></tr>";
        }
    ?>
    <tr>
        <td colspan="3">TOTAL: </td>
        <td colspan="3"><?php echo '£'.$totalPrice; ?></td>
    </tr>
    <tr>
        <td colspan="2"> </td>
        <td colspan="2">
            <!-- button to proceed to checkout and pay, deliver info will be displayed after-->
            <button type="button">PROCEED TO CHECKOUT</button>
        </td>
    </tr>
</table>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>