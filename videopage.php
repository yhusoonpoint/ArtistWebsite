<?php
    // Setting the variable for the page name
    $page_name = "Video";
    include('inc/header.php');
    // End the PHP so you can add HTML
?>

<!-- Add the page content below -->
<div class="flex-container">
    <!--Iframe creates like a web inside a web and this is what youtube embed to be able to link youtube videos to pages-->
    <!--setting fixed size so it doesn't come out any how-->
    <?php
    //Creating an Array of the link instead of creating writing all out in different divs
    //used foreach loop to loop through the array
    $links = array("https://www.youtube.com/embed/l0aV5qX0X44","https://www.youtube.com/embed/QEE1jlJ10bU","https://www.youtube.com/embed/MzeBmISJ4nk","https://www.youtube.com/embed/OU0b9vwgIGM","https://www.youtube.com/embed/xn2Hl6SRJTI","https://www.youtube.com/embed/UPjIfVG9Aq4",
        "https://www.youtube.com/embed/U_9KtFV_1cQ","https://www.youtube.com/embed/vG-CFZSQCmw","https://www.youtube.com/embed/Ehj0RpRYlrY","https://www.youtube.com/embed/9fTG4taSgG0",
        "https://www.youtube.com/embed/WBImJGEYvLk","https://www.youtube.com/embed/gby-huCi5es","https://www.youtube.com/embed/QPi5sUzaLTs","https://www.youtube.com/embed/WV-vHov-ssI",
        "https://www.youtube.com/embed/aT4eVWs7p5g","https://www.youtube.com/embed/K-HLOZ_zhT0");
        //looping through array to print all data
        foreach ($links as $value)
            {
                echo '
                    <div>
                        <iframe width="400" height="315" src="'.$value.'"   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                 </div>
                ';
            }
    ?>
</div>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>