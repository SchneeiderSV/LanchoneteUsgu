<?php
    include("header.php");
    require_once("utils/Database.php");

    $dishes = Database::select('dishes', ['*'], ['is_drink' => false]);
    $drinks = Database::select('dishes', ['*'], ['is_drink' => true]);
?>


<div>
    <h1 class="title">Comidas</h1>
    <section class="dishList">
        <?php if($dishes) { foreach($dishes as $dish) {  ?>
        <div class="dishBox" onclick="window.location.href=`dish.php?id=<?= $dish['id'] ?>`">
            <img class="img" src="images/<?= $dish['img'] ?>">
            <h3><?= $dish['name'] ?></h3>
            <p>R$<?= number_format((float)$dish['price'], 2, ',') ?></p>

            <button>Ver mais</button>
        </div>

        <?php } } ?>
    </section>
</div>


<div>
    <h1 class="title">Bebidas</h1>
    <section class="dishList">
        <?php if($drinks) { foreach($drinks as $drink) {  ?>
        <div class="dishBox" onclick="window.location.href=`dish.php?id=<?= $dish['id'] ?>`">
            <img class="img" src="images/<?= $drink['img'] ?>">
            <h3><?= $drink['name'] ?></h3>
            <p>R$<?= number_format((float)$drink['price'], 2, ',') ?></p>

            <button>Ver mais</button>
        </div>

        <?php } } ?>
    </section>
</div>

<?php include("footer.php");?>