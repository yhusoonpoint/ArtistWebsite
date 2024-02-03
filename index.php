<?php
    // Set the variable for the page name
    $page_name = "Home";
    include('inc/header.php');
    // End the PHP so you can add HTML
?>

<!-- Add the page content below -->
<!--main content data-->
<!--linking to youtube for full video with audio -->
<a href="https://youtu.be/l0aV5qX0X44" target="_blank">
    <!--background video with loop and muted properties-->
    <video autoplay muted loop id="page-video">
        <source src="images/VID-20210220-WA0010.mp4" type="video/mp4">
    </video>
</a>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>