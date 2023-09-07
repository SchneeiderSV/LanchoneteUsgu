<?php 
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/functions.php');
    require_once('utils/Database.php');

    Auth::checkAdmin();

    if(isset($_POST['status'])){
        $id = $_POST['orderId'];
        $newStatus = $_POST['status'];

        Database::update('orders', ['status' => $newStatus], ['id' => $id ]);
    }

    $orders = Database::select('orders', ['*'], [], 'created_at DESC');
?>

<h2>Listagem de pedidos</h2>

<?php if($orders) { foreach($orders as $order) {
        $user = Database::select('users', ['*'], [ 'id' => $order['user_id']])[0];
        $orderDishes = Database::select('orders_dishes', ['*'], ['order_id' => $order['id']]);
    ?>
    <div class="orderItem">
        <h3>Itens</h3>

        <div class="orderDishes">
            <?php foreach($orderDishes as $orderDish){
                $dish = Database::select('dishes', ['*'], ['id' => $orderDish['dish_id']])[0];
                ?>
                <h2><?= $dish['name'] . " - " . $dish['size'] . " - " . $orderDish['notes'] ?></h2>
            <?php } ?>
        </div>

        <p>Valor total: R$<?= number_format((float)$order['total_price'], 2, ',') ?></p>

        <p>Dados de entrega: <?= $order['district'] . ", ". $order['street'] . ", " . $order['number'] . ", " . $order['complement'] ?></p>

        <div class="paymentMethodBox">
            <p>Metodo de pagamento: <?= $order['payment_method'] == 2 ? 'Pix' : 'Dinheiro' ?></p>
            <?php if($order['payment_method'] == 2){ ?>
                <a target="__blank" href="comprovantes/<?= $order['payment_confirmation'] ?>">Ver comprovante de pagamento</a>
            <?php } else { ?>
                <p>Valor que será entregue: R$<?= number_format((float)$order['change_value'], 2, ',') ?></p>
            <?php } ?> 

        </div>
        <p>Status do pedido: <?= $orderStatus[$order['status']] ?></p>
        <p>Pedido feito por: <a href="users.php?id=<?= $user['id']?>"><?= $user['name']?></a> - <?php $user['email']?> - <?php echo (new DateTimeImmutable($order['created_at']))->format('d-m-Y H:i:s'); ?></p>

        <?php if($order['status'] != 3 && $order['status'] != 4) { ?>
        <form method="POST">
            <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
            <label for="status">Atualizar status do pedido</label>
            <select name="status" id="status">
                <?php foreach($orderStatus as $k => $v) { ?>
                <option value="<?= $k ?>"><?= $v ?></option>
                <?php } ?>
            </select>
            <button>Salvar</button>
        </form>
        <?php } ?>
    </div>
    
<?php } }?>

<?php include('footer.php'); ?>