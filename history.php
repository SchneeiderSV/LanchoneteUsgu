<?php
    include("header.php");
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    Auth::checkAuth();


    $orders = Database::select('orders', ['*'], ['user_id' => $_SESSION['id']]);
    if(!$orders) echo "Nenhum pedido foi feito ainda!";
?>


<?php

    include("footer.php");

?>