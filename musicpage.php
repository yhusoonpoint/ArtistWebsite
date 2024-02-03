<?php
    // Setting variable for the page name
    $page_name = "Music";
    include('inc/header.php');
    include('inc/functions.php');

    //creating class object and adding value to it.
    $underTheSun = new AlbumDetails("UNDER THE SUN", "https://open.spotify.com/album/06s9tZKaqFHIOP3qPrchBQ?si=zLUkPcakRaSY4_IYtcB3gQ", "images/IMG-20210220-WA0005.jpg");
    $ls400 = new AlbumDetails("LS400", "https://open.spotify.com/album/3EkK4QOYgnUX0MbyQWF0cN?si=I1y5FyFqRKy5LHQY0zfF-A", "images/IMG-20210220-WA0006.jpg" );
    $seasons = new AlbumDetails("SEASONS", "https://open.spotify.com/track/4MZW4MsIIHwsqGNzVf9X9V?si=lvBqEMI-RW-y5RJ25T6pPQ","images/IMG-20210220-WA0007.jpg");
    $different = new AlbumDetails("DIFFERENT", "https://open.spotify.com/album/05ctdaJ9TDLG11Rkt2QbGy?si=CzJyHtgETJWaO-ecRsdq9g ","images/IMG-20210220-WA0008.jpg");
    //adding class object into an array.
    $albumArray = array($underTheSun, $ls400, $seasons, $different);
    // Ending the PHP so i can add HTML
?>

<!-- Adding the page content below -->
<div class="flex-container">
    <?php
    //looping through array and displaying each item in it
        foreach ($albumArray as $musicItem) {

            echo '
                <div>
                    <!--opening a new page with the link-->
                    <a href="'.$musicItem->getMedialink().'" target="_blank">
                    <img src="'.$musicItem->getImgLink().'" alt="'.$musicItem->getName().'"/>
                    <!-- DISPLAYING THE TEXT WHEN THE MOUSE IS OVER THE PICTURE-->
                    <span>	'.$musicItem->getName().'  </span>
                    </a>
                </div>
                ';
        }
    ?>
</div>


<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>