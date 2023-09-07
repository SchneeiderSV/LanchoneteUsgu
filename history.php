<?php
    include("header.php");
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    require_once('utils/functions.php');
    Auth::checkAuth();


    $orders = Database::select('orders', ['*'], ['user_id' => $_SESSION['id']], "created_at DESC");
    if(!$orders) echo "Nenhum pedido foi feito ainda!";
?>

<h1>Pedidos</h1>

<?php if($orders) { foreach($orders as $order) {
        $orderDishes = Database::select('orders_dishes', ['*'], ['order_id' => $order['id']]);
    ?>
    <div class="orderItem">
        <h3>Itens</h3>

        <div class="orderDishes">
            <?php foreach($orderDishes as $orderDish){
                $dish = Database::select('dishes', ['*'], ['id' => $orderDish['dish_id']])[0];
                ?>
                <h2><?= $dish['name'] . " - " . $dish['size'] . " - " . $orderDish['notes'] ?>x</h2>
            <?php } ?>
        </div>

        <p>Valor total: R$<?= number_format((float)$order['total_price'], 2, ',') ?></p>

        <p>Dados de entrega: <?= $order['district'] . ", ". $order['street'] . ", " . $order['number'] . ", " . $order['complement'] ?></p>

        <p>Metodo de pagamento: <?= $order['payment_method'] == 2 ? 'Pix' : 'Dinheiro' ?></p>
        <p>Status do pedido: <?= $orderStatus[$order['status']] ?></p>
        <p><?php echo (new DateTimeImmutable($order['created_at']))->format('d-m-Y H:i:s'); ?></p>
    </div>
    
<?php } }?>

<?php

    include("footer.php");

?>