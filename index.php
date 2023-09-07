<?php
    include("header.php");
    require_once("utils/Database.php");

    $dishes = Database::selectAll('dishes');
?>


<div>
    <h1 class="title">Comidas</h1>
    <section class="dishList">
        <?php if($dishes) { foreach($dishes as $dish) {
            if ($dish["is_drink"]==0) { ?>
            
        <div class="dishBox" onclick="window.location.href=`dish.php?id=<?= $dish['id'] ?>`">
            <img class="img" src="images/<?= $dish['img'] ?>">
            <h3><?= $dish['name'] ?></h3>
            <p>R$<?= number_format((float)$dish['price'], 2, ',') ?></p>

            <button>Ver mais</button>
            <button>Adicionar ao carrinho</button>
        </div>

        <?php } } } ?>
</div>

<div>
    <h1 class="title">Bebidas</h1>
    <section class="dishList">
        <?php if($dishes) { foreach($dishes as $dish) {
            if ($dish["is_drink"]==1) { ?>
            
        <div class="dishBox" onclick="window.location.href=`dish.php?id=<?= $dish['id'] ?>`">
            <img class="img" src="images/<?= $dish['img'] ?>">
            <h3><?= $dish['name'] ?></h3>
            <p>R$<?= number_format((float)$dish['price'], 2, ',') ?></p>

            <button>Ver mais</button>
            <button>Adicionar ao carrinho</button>
        </div>

        <?php } } } ?>
    </section>
</div>

<script>
    let dishLists=document.querySelectorAll(".dishList");

    window.addEventListener("load", ()=>{
        for (let i = 0; i < dishLists.length; i++) {
            const dishList = dishLists[i];
            if (dishList.children.length>=2) {
                dishList.classList.add("padding")
            }else{
                dishList.classList.remove("padding")
            }
        }
    })
</script>

<?php include("footer.php");?>