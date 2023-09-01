<?php
    include("header.php");
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<div>

    <a href="dishes.php">
        <span>Add Dishes</span>
    </a>

    <a href="ingredients.php">
        <span>Add Ingredients</span>
    </a>

</div>

<?php

    include("footer.php");

?>
