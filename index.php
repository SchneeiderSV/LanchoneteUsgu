<?php
    include("header.php");
    require_once("utils/Database.php");

    $dishes = Database::selectAll('dishes');
?>


<div>

    <main>
        <h1>Comidas</h1>
        <section">
            <?php if($dishes) { foreach($dishes as $dish) {  ?>
            <div onclick="window.location.href=`dish.php?id=<?= $dish['id'] ?>`">
                <img width="250" height="250"  src="images/<?= $dish['img'] ?>">
                <span><?= $dish['name'] ?></span>
                <span>R$<?= $dish['price']?>,00</span>
            </div>

            <?php } } ?>
        </section>
    </main>

</div>
<?php include("footer.php");?>