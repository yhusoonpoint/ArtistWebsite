<?php
    // Set the variable for the page name
    $page_name = "UpdateItem";
    include('inc/header.php');
    global $conn;
    include('inc/functions.php');
    connect();
    //check if action has a value when button is pressed or page is loaded
    if (isset($_POST['action']) && $_POST['action'] === "updateItem")
    {
        //connect to db and call update function to update info.
        updateItem($conn,$_SESSION['productID'], $_POST['catID'],$_POST['product-name'],$_POST['product-image'],
            $_POST['product-price'],$_POST['product-short-description'],$_POST['product-long-description'],$_POST['product-size']);
    }

?>

    <div>
        <form method="post" action="">
            <button type="button" onclick="window.location.href='admin.php'"  >ADMIN PAGE</button>
            <b>
                <select name="ProductID">
                    <option disabled selected value> SELECT AN ITEM TO UPDATE </option>
                    <?php
                    $sql = "SELECT * FROM Products";
                    $result = mysqli_query($conn, $sql);
                    //loop through items and display in a option type
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option  value="'.$row['ProductID'].'">' . $row["ProductName"] . '</option>';
                    }
                    ?>
                </select>
            </b>
            <button type="submit" name="action" value="search">SEARCH</button>
        </form>
    </div>
<?php
    //check if value is given
    if(isset($_POST['ProductID']))
    {
        $_SESSION['productID'] = $_POST['ProductID'];
    }
    //show info if id is given
    if(isset($_POST['ProductID']) || $_POST['action'] === "updateItem")
    {
        $result = mysqli_query($conn, 'SELECT * FROM Products WHERE ProductID = '.$_SESSION['productID']);
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) === 0)
        {
            echo "ITEMS NOT FOUND";
        }
        else
        {
?>
    <div class=" ">
        <form action="#" method="post">
            <!-- add value from db to form -->
            <label><b>Product Name</b></label>
            <!-- php is include in value to print the result -->
            <input name = "product-name" type="text" placeholder="Enter Product Name" value="<?php echo $row['ProductName']; ?>">
            <label><b>Product Price </label>
            <input name = "product-price" type="text" placeholder="Enter Price Price" value="<?php echo $row['ProductPrice']; ?>">
            <label><b>Product Category</b></label>
            <select name = "catID">
                <?php
                    //do a new query
                    $newResult = mysqli_query($conn, 'SELECT * FROM ProductCategories');
                    //get result of row for id entered then display info]
                    //shows all the available categories
                    while ($cat = mysqli_fetch_assoc($newResult))
                    {
                        if($cat['ProductCategoryID'] === $row['ProductProductCategoryID'])
                        {
                            echo '<option value="'.$cat['ProductCategoryID'].'" selected>' . $cat["ProductCategoryName"] . '</option>';
                        }
                        else
                        {
                            echo '<option value="'.$cat['ProductCategoryID'].'">' . $cat["ProductCategoryName"] . '</option>';
                        }

                    }

                ?>
            </select>
            <label><b>Product Short Description</b></label>
            <input name = "product-short-description" type="text" placeholder="Enter product short description" value="<?php echo $row['ProductShortDescription']; ?>">
            <label><b>Product Size</b></label>
            <input name = "product-size" type="text" placeholder="Enter product size separating with space" value="<?php echo $row['ProductSize']; ?>" >
            <label><b>Product Image</b></label>
            <input name = "product-image" type="text" placeholder="Enter product image" value ="<?php echo $row['ProductImage']; ?>" />
            <label><b>Product Long Description</b></label>
            <textarea name = "product-long-description" placeholder="Enter product long description"><?php echo $row['ProductLongDescription']; ?></textarea>
            <button type="submit" name="action" value="updateItem">UPDATE ITEM</button>
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