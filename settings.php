<?php
    include("header.php");
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<div class="settingscontainer">

    <a class="settingsitem" href="dishes.php">
        <span class="settingstext">Add Dishes</span>
    </a>

    <a class="settingsitem" href="ingredients.php">
        <span class="settingstext">Add Ingredients</span>
    </a>

</div>

<?php

    include("footer.php");

?>
