<?php

    // Assigning variables to connect to database
    $db_host = "localhost"; // website host
    $db_user = "xxxxx"; // database username
    $db_pass = "xxxxx"; // database password
    $db_name = "xxxxx" . $db_user; // databasename

    //Album class to set the parameters and add to loop
    Class AlbumDetails
    {
        //Variables to store name link and image for the album
        public $name;
        public $medialink;
        public $imgLink;

        /**
         * AlbumDetails constructor to assign values when called
         * @param $name
         * @param $medialink
         * @param $imgLink
         */
        public function __construct($name, $medialink, $imgLink)
        {
            $this->name = $name;
            $this->medialink = $medialink;
            $this->imgLink = $imgLink;
        }

        /**
         * @return mixed returns name if requested
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @return mixed returns media link if requested
         */
        public function getMedialink()
        {
            return $this->medialink;
        }

        /**
         * @return mixed returns the image link if requested
         */
        public function getImgLink()
        {
            return $this->imgLink;
        }
    }

    // Function to connect to the database
    function connect(){

        // Set the globals so we can access variables outside of the function
        global $db_host, $db_user, $db_pass, $db_name, $conn;
    
        // Create the database connection using MySQLi Procedural
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
        // Print out a message to say what happened if error occured
        if  (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        return $conn;
    }

    //function to add item to basket
    function addToBasket($conn, $id, $size, $basketShoppingArray)
    {
        // Check if id is set then continue
        if (isset($id) && $id !== "")
        {
            // get result from query
            $result = mysqli_query($conn,"SELECT * FROM Products WHERE ProductID=".$id);
            //get the rows for result
            $row = mysqli_fetch_assoc($result);

            //array to store basket item information
            $basketArray = array(
                $id=>array('name'=>$row['ProductName'], 'id'=>$row['ProductID'], 'price'=>$row['ProductPrice'], 'image'=>$row['ProductImage'], 'quantity'=>1, 'size'=>$size)
            );

            //checking if basket is empty
            if(empty($basketShoppingArray))
            {
                $basketShoppingArray = $basketArray; //add array to main basket  array
            }
            else
            {
                //check if product exist when looping through array
                $productExist = false;
                //loop each item in basket array.
                foreach($basketShoppingArray as $result) {
                    //checks if data already exist in array
                    if($result['id'] === $id && $result['size'] === $size)
                    {
                        echo'<div class="alert">ALREADY IN BASKET!!!</div>';
                        $productExist = true;
                        break;
                    }
                }
                // if product doesn't exist add item to basket by merging array
                if($productExist === false)
                {
                    $basketShoppingArray = array_merge($basketShoppingArray, $basketArray);
                    echo'<div class="alert">ADDED TO BASKET!!!</div>';
                }

            }
            $_SESSION['totalPrice'] += $row['ProductPrice']; //add up price for the header basket info
            $_SESSION["shoppingBasket"] = $basketShoppingArray; // add array to session array

        }
    }

    //function to update basket
    function updateBasket($action, $basketShoppingArray,$id,$size,$quantity)
    {
        if ($action === "remove" && !empty($basketShoppingArray))
        {
            //loop through the array to find the item to remove
            foreach($basketShoppingArray as $itemToRemove => $value)
            {
                //check if the item id and size matches with the basket array because if i check only for id, it will remove all item with the id.
                //if i break loop it will delete first item which could be what isn't required to be deleted
                if($id === $value['id'] && $size === $value['size'])
                {
                    //remove the item by unset
                    unset($_SESSION["shoppingBasket"][$itemToRemove]);
                }
                // if the basket is empty unset the basket if not, it will be seen as there's an item inside the basket
                if(empty($basketShoppingArray))
                {
                    unset($_SESSION["shoppingBasket"]);
                }
            }
        }
        //if the quantity is changed, update the information
        if ($action==="changeQuantity"){
            foreach($_SESSION["shoppingBasket"] as &$value){
                //compare with two data to update right size
                if($value['id'] === $id  && $value['size'] === $size)
                {
                    //update array quantity
                    $value['quantity'] = $quantity;
                }
            }
        }
    }

    //function to login user
    function login($conn,$username,$password,$headerLocation)
    {

        if ( $username !== "" && password !== "" ) { // User is trying to login

            // Retrieve any user with the same username
            $sql = "SELECT UserID, UserPassword FROM Users WHERE UserUsername = '$username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            //checks if the result is 0 o
            if (mysqli_num_rows($result) === 0)
            {
                echo "<p class='alertNormal'>USER NOT FOUND!!!</p>";
            }
            //There's a result, now check if the password matches the one in db c2be0df
            //https://www.php.net/manual/en/function.password-hash.php password_hash documentation
            elseif (password_verify($password, $row['UserPassword'])) {

                // Verification success! Create the user session variables
                // Account exists, now we verify the password.
                $_SESSION['UserUsername'] = $username;
                $_SESSION['UserID'] = $row['UserID'];

                //Redirect's user back to the location entered
                header("Location: " . $headerLocation);
            }
            else
            {
                echo "<p class='alertNormal'>DETAILS NOT CORRECT!!!</p>";
                $_SESSION['error'] = "Details not correct";
            }
        }
        else
        {
            return $_SESSION['error']="Details not found";
        }
    }

    //function to register new users
    function register($conn,$firstName,$lastName,$email, $username,$password,$pageName)
    {
        //Check if forms are not blank
        if ($username !== "" && $firstName !== "" && $lastName !== "" && $email !== "" && $password !== "")
        {
            // User is trying to register
            //Check db if user already exist
            if(mysqli_num_rows(mysqli_query($conn, "SELECT UserUsername FROM Users WHERE UserUsername = '$username'")) !== 0)
            {
                echo "<p class='alertNormal'>USER ALREADY EXIST!!!</p>";
            }
            //Check db if email already exist
            elseif(mysqli_num_rows(mysqli_query($conn, "SELECT UserEmail FROM Users WHERE UserUsername = '$email'")) !== 0)
            {
                echo "<p class='alertNormal'>EMAIL ALREADY EXIST!!!</p>";
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT); // Encrypt the password to password_hash
                // Insert the user into the table
                $sql = "INSERT INTO Users (UserID, UserFirstName, UserLastName, UserEmail, UserPassword, UserRegistrationDate, UserUsername) 
                        VALUES (NULL, '$firstName', '$lastName', '$email', '$password', CURRENT_TIMESTAMP, '$username')";

                // Run the query
                mysqli_query($conn, $sql);

                // Get the id of the row we just inserted (this is the new user_id
                $user_id_new = mysqli_insert_id($conn);
                // Tell the user what happened
                if ($user_id_new != "")
                {

                    // Set the session variables
                    $_SESSION['UserUsername'] = $username;
                    $_SESSION['UserID'] = $user_id_new;
                    //redirect to profile if its in registration page else print added
                    if($pageName === "Admin")
                    {
                        echo "<p class='alertNormal'>NEW USER ADDED SUCCESSFULLY!!!</p>";
                    }
                    else
                    {
                        header("Location: profile.php");
                    }
                }
                else
                {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

            }
        }
        else
        {
            echo "<p class='alertNormal'>DETAILS NOT CORRECT!!!<p class='alertNormal'>";
        }
    }

    //function to update user info
    function updateUser($conn,$firstName,$lastName,$email, $username,$password)
    {
        //Check if password is not empty so it replace password in db
        if($password !== "")
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            //sql command to update user
            $sql = "UPDATE Users SET UserFirstName = '$firstName',UserLastName = '$lastName',UserEmail='$email',
            UserPassword='$password', UserUsername = '$username' WHERE UserID = ".$_SESSION['UserID'];
            //do query
            mysqli_query($conn, $sql);
        }
        //leave password if field is empty
        else
        {
            $sql = "UPDATE Users SET UserFirstName = '$firstName',UserLastName = '$lastName',UserEmail='$email',
             UserUsername = '$username' WHERE UserID = ".$_SESSION['UserID'];
            if (mysqli_query($conn, $sql) !== false)
            {
                echo "<p class='alertNormal'>USER UPDATED SUCCESSFULLY!!!</p>";
            }
            else
            {
                echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
            }
        }
    }

    //function to delete user
    function deleteUser($conn,$userID)
    {
        //delete using id to check row
        $sql= "DELETE FROM Users WHERE Users.UserID = ".$userID;

        if (mysqli_query($conn, $sql) !== false)
        {
            echo "<p class='alertNormal'>ACCOUNT DELETED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }
    }

    //function to add item to db
    function addItem($conn, $productCat, $productName,$productImage, $productPrice,$productSD, $productLD, $productSize)
    {
        $productPrice= str_replace(£,"",$productPrice);
        $sql = "INSERT INTO Products(ProductID, ProductProductCategoryID, ProductDate, ProductName, ProductImage, ProductPrice, ProductShortDescription, ProductLongDescription, ProductSize) 
                VALUES (NULL,'$productCat', CURRENT_TIMESTAMP,'$productName','$productImage','$productPrice','$productSD',\"$productLD\", '$productSize')";
        mysqli_query($conn, $sql);
        // Get the id of the row we just inserted (this is the new ITEM_id
        $item_id_new = mysqli_insert_id($conn);
        // Tell the user what happened
        if ($item_id_new !== "") {
            echo "<p class='alertNormal'>NEW ITEM ADDED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }
        // Set the session variables
        $_SESSION['ProductID'] = $item_id_new;
    }

    //function to update db item(product db)
    function updateItem($conn,$productId, $productCat, $productName,$productImage, $productPrice,$productSD, $productLD, $productSize)
    {
        $productPrice= str_replace(£,"",$productPrice);
        $sql = "UPDATE Products SET ProductProductCategoryID='$productCat',ProductName='$productName',ProductImage='$productImage',
                ProductPrice='$productPrice',ProductShortDescription='$productSD',ProductLongDescription=\"$productLD\",ProductSize='$productSize' WHERE ProductID = '$productId'";
        if (mysqli_query($conn, $sql) !== false)
        {
            echo "<p class='alertNormal'>ITEM UPDATED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }
    }

    //function to delete item in product db
    function deleteItem($conn, $productID)
    {
        $sql= "DELETE FROM Products WHERE Products.ProductID = ".$productID;
        if (mysqli_query($conn, $sql) !== false)
        {
            echo "<p class='alertNormal'>ITEM DELETED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }


    }

    //function to add event to db
    function addEvent($conn, $eventName,$eventTicket, $eventLocation,$eventDate)
    {
        $sql = "INSERT INTO Event(EventID, EventLocation, EventDate, EventTicket, EventTitle)
                        VALUES (NULL, '$eventLocation','$eventDate','$eventTicket','$eventName')";
        mysqli_query($conn, $sql);
        // Get the id of the row we just inserted (this is the new ITEM_id
        $item_id_new = mysqli_insert_id($conn);
        // Tell the user what happened
        if ($item_id_new !== "")
        {
            echo "<p class='alertNormal'>NEW EVENT ADDED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }
        // Set the session variables
        $_SESSION['ProductID'] = $item_id_new;
    }

    //function to update event
    function updateEvent($conn, $eventID,$eventTitle,$eventTicket, $eventLocation,$eventDate)
    {
        $sql = "UPDATE Event SET EventTitle='$eventTitle',EventLocation='$eventLocation',EventDate='$eventDate',EventTicket='$eventTicket' WHERE EventID='$eventID'";
        if (mysqli_query($conn, $sql) !== false)
        {
            echo "<p class='alertNormal'>EVENTS UPDATED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }
    }

    //function to delete event from db table
    function deleteEvent($conn, $eventID)
    {
        $sql= "DELETE FROM Event WHERE Event.EventID = ".$eventID;
        if (mysqli_query($conn, $sql) !== false)
        {
            echo "<p class='alertNormal'>EVENTS DELETED SUCCESSFULLY!!!</p>";
        }
        else
        {
            echo "<p class='alertNormal'>Error: " . $sql . "<br>" . mysqli_error($conn)."</p>";
        }

    }

