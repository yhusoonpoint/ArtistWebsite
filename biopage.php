<?php
    // Set the variable for the page name
    $page_name = "Bio";
    include('inc/header.php');
    // End the PHP so you can add HTML
?>

<!-- Add the page content below -->
<div id="bio-container" class="flex-container" >
    <div id="img-display">
        <img src="images/IMG-20210220-WA0001.jpg" alt="ARTIST IMAGE">
        <!--span created to display words when hoover over the picture is active-->
        <span style="color:white;">
            <h2>Who are you?</h2>
            <p>My name is T3D (Ted) an my aim is to strike a balance between the crud and conscious.</p>
            <b>Who said conscious lyrics have to be presented in a preachy slow tempo “take me in “ kind of way. Of course theres an audience for it but my aim is to make my music undeniably cold regardless of who’s listening to it. Now that means I may not always jump on the beats you expect but the message will always be clear.</b>
            <h2>Why T3D?</h2>
            <p>Well ... it was TED but T3D is just more discoverable lol. Whats more important is the meaning behind it:</p>
            <p>T - TRUST the process ( If you truly believe what your doing is impactful Trust that it will come to the light)</p>
            <p>3 - 3NDURE the storm ( Most people get stuck on this step , no one said it would be easy , keep grinding )</p>
            <p>D - DELIVER ( Trust and Endure , It will be delivered )</p>
        </span>
    </div>
</div>

<?php
    // Now we start PHP again to include the footer
    include('inc/footer.php');
?>