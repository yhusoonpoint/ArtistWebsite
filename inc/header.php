<!DOCTYPE html>
<?php
// start a session for all pages when header is called
    session_start();
    // function to set the color for the current page
    function getColor($nameOfPage) 
        {
            // if the name of the page is same as global page then return chocolate so it sets the colour
            if($nameOfPage === $GLOBALS['page_name'])
                return "Chocolate";
            return ""; //null basically
        }
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>T3D OFFICIAL</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div>
    <!-- Nav div -->
    <div id="main-header">
        <!-- section for the nav links-->
        <div class="pages-link">
            <ul>
                <!-- Using list to create the navigation links-->
                <!-- getColor gets the result from the function applies the colour to the page -->
                <li><a href="index.php  " style="color: <?=getColor("Home")?>;">HOME</a></li>
                <li><a href="musicpage.php " style="color: <?=getColor("Music")?>;">MUSIC</a></li>
                <li><a href="videopage.php " style="color: <?=getColor("Video")?>;">VIDEO</a></li>
                <li><a href="eventspage.php" style="color: <?=getColor("Events")?>;">EVENTS</a></li>
                <li><a href="biopage.php   " style="color: <?=getColor("Bio")?>;">BIO</a></li>
                <li><a href="storepage.php " style="color: <?=getColor("Store")?>;">STORE</a></li>
                <li><a href="profile.php " style="color: <?=getColor("Profile")?>;">PROFILE</a></li>
            </ul>
        </div>
        <div class="socials-link">
            <!-- Using list to create a social media icon to navigate-->
            <ul>
                <li><a href="https://www.youtube.com/channel/UCFxF4LqbPXDlTKZH9UG_3iA" target="_blank"><img src="images/youtube.png" alt="YOUTUBE" title="Youtube"/></a></li>
                <li><a href="https://instagram.com/ted_official1?igshid=1682gmiady94z" target="_blank"><img src="images/ig.png" alt="INSTAGRAM" title="Instagram"/></a></li>
                <li><a href="https://www.snapchat.com/add/brandz100" target="_blank"><img src="images/snapchat.png" alt="SNAPCHAT" title="Snapchat"/></a></li>
                <li><a href="https://open.spotify.com/artist/5CF9A9TmIsfPtt1tvcCgw9?si=WxgaC0iXTJ6tGDjdIe4Ulg" target="_blank"><img src="images/spotify.png" alt="SPOTIFY" title="Spotify"/></a></li>
                <li><a href="https://music.apple.com/gb/artist/t3d/1549780283" target="_blank"><img src="images/itunes.png" alt="APPLE MUSIC" title="Apple Music"/></a></li>
                <li style="color:white;">Copyright © 2021 T3D. All rights reserved.</li>
            </ul>
        </div>

        <div class="top-header"
            <?php
            //check if the page name is home then echo the current details
                //checking if user is logged in to the right text is dispkayes
                $loggedInName =(isset($_SESSION['UserID']) && $_SESSION["UserID"] !== "") ? "my Profile" : "signin | register";
                if($page_name === "Home")
                {
                    echo  'style=" justify-content: center;">
                        <p>
                            <!-- moving text side by side to gain attention-->
                            <marquee behavior="alternate">
                                T3D OFFICIAL - UNDER THE SUN OUT NOW!!!
                            </marquee>
                        </p>';
                }
                //check if the page name is store basket or item then echo the current details
                else if($page_name === "Store" || $page_name === "Basket" || $page_name === "Item")
                {
                    echo '>
						<p>
							<a href="profile.php">'.  $loggedInName   . '  </a>
						</p>
						<p> T3D OFFICIAL STORE</p>
						<p>
							<!-- created a span in p to show text when MOUSE IS over image-->
							<span>'. count($_SESSION['shoppingBasket']).' ITEMS - £'. $_SESSION['totalPrice'].'</span>
							<a href="basket.php"> basket </a>
						</p>';
                }
                //echo the current details for other pages.
                else
                {
                    echo '>
						<p>
							<a href="profile.php">'.  $loggedInName . '  </a>
						</p>
						<p> '.$page_name.' </p>
						<p> T3D OFFICIAL </p>';
                }
            ?>

        </div>
    </div>
    <div id="main-content"
        <?php
            //sets style to home page and nothing for others.
            if($page_name === "Home")
            {
                echo'style="overflow: hidden;">';
            }
            else
                {
                echo '>';
            }
