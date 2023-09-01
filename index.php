<?php
    include("header.php");
    require_once("utils/Database.php");

    $dishes = Database::selectAll('dishes');
?>


<div>
    <h1 class="title">Comidas</h1>
    <section class="dishList">
        <?php if($dishes) { foreach($dishes as $dish) {  ?>
        <div class="dishBox" onclick="window.location.href=`dish.php?id=<?= $dish['id'] ?>`">
            <img class="img" src="images/<?= $dish['img'] ?>">
            <h3><?= $dish['name'] ?></h3>
            <p>R$<?= $dish['price']?>,00</p>

            <button>Ver mais</button>
            <button>Adicionar ao carrinho</button>
        </div>

        <?php } } ?>
    </section>
</div>

<?php include("footer.php");?>