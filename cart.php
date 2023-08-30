<?php 
    include('header.php');
    require_once('utils/Auth.php');

    Auth::checkAuth();
?>

<h1>Carrinho de compras</h1>

<?php 
    include('footer.php');
?>