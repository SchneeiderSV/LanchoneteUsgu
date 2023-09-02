<?php
    include("header.php");
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    require_once('utils/functions.php');
    Auth::checkAdmin();

    $queryMonth = "SELECT SUM(orders.total_price) as total_sum FROM orders WHERE MONTH(created_at) = " . date('m') . " AND YEAR(created_at) = " . date('Y');
    $totalMonth = Database::rawQuery($queryMonth)[0]['total_sum'];

    $queryAll = "SELECT SUM(orders.total_price) as total_sum FROM orders";
    $totalAll = Database::rawQuery($queryAll)[0]['total_sum'];
?>

<div class="center">

    <div class="center sales" style="text-align: center;">
        <h1>Resumo de vendas</h1>

        <div class="box">
            <h1>Este mês</h1>
            <p>Faturamento até agora: R$<?= $totalMonth ?> </p>
        </div>

        <div class="box">
            <h1>Total</h1>
            <p>Faturamento registrado: R$<?= $totalAll ?></p>
        </div>
    </div>

    <a class="link" href="dishes.php">Gerenciar itens do menu</a>
    <a class="link" href="ingredients.php">Gerenciar estoque</a>
    <a class="link" href="users.php">Gerenciar usuários</a>
    <a class="link" href="orders.php">Gerenciar pedidos</a>
</div>

<?php

    include("footer.php");

?>
