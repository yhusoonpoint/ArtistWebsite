<?php
    // Set the variable for the page name
    $page_name = "AddItem";
    //include header
    include('inc/header.php');
    //calling global variable
    global $conn;
    //include function
    include('inc/functions.php');
    connect();
    //check if button is pressed by checking post data
    if(isset($_POST['action']) && $_POST['action'] === "addItem")
    {
        addItem($conn,$_POST['catID'],$_POST['product-name'],$_POST['product-image'], $_POST['product-price'],
                $_POST['product-short-description'],$_POST['product-long-description'],$_POST['product-size']);
    }
?>

    <!-- simple form layout for admin to add event -->
<div>
    <form action="#" method="post">
        <!--button to redirect to admin page-->
        <button type="button" onclick="window.location.href='admin.php'"  >ADMIN PAGE</button>
        <label><b>Product Name</b></label>
        <input name = "product-name" type="text" placeholder="Enter Product Name" >
        <label><b>Product Price </b></label>
        <input name = "product-price" type="text" placeholder="Enter Product Price " >
        <label><b>Product Category</b></label>
        <select name = "catID">
            <option disabled selected value> SELECT A CATEGORY </option>';
            <?php
            $newResult = mysqli_query($conn, 'SELECT * FROM ProductCategories');
            //gets the result of categories options from the database, loops through and adds to option container
            while ($cat = mysqli_fetch_assoc($newResult))
            {

               echo '<option value="'.$cat['ProductCategoryID'].'">' . $cat["ProductCategoryName"] . '</option>';
            }

            ?>
        </select>
        <label><b>Product Short Description</b></label>
        <input name = "product-short-description" type="text" placeholder="Enter product short description" >
        <label><b>Product Size</b></label>
        <input name = "product-size" type="text" placeholder="Enter product size separating with space" >
        <label><b>Product Image</b></label>
        <input name = "product-image" type="file" />
        <label><b>Product Long Description</b></label>
        <textarea name = "product-long-description" placeholder="Enter product long description"></textarea>
        <button type="submit" name="action" value="addItem">ADD ITEM</button>
    </form>
</div>

<?php
// Now we start PHP again to include the footer
include('inc/footer.php');
?>