<?php
include('header.php');
require_once('utils/Auth.php');
require_once('utils/Database.php');
require_once('utils/Cart.php');

Auth::checkAuth();
$total = 0;
?>

<?php foreach($_SESSION['cart'] as $index => $item){
        $total += $item['quantity']*intval(Database::select('dish', ['price'], ["id" => $item['id']])[0]['price']);
    }?>

    <h1><?= $total ?></h1>


<?php 
include('footer.php');
?>