<?php
    include("header.php");
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    Auth::checkAuth();


    $users = Database::select('order', ['*']);
    var_dump($users);
    if(!$orders) echo "Nenhum pedido foi feito ainda!";
?>


<?php

    include("footer.php");

?>