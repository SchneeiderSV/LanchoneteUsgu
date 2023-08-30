<?php 
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    require_once('utils/Cart.php');

    Auth::checkAuth();

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        Cart::remove($id);
        Auth::redirect('cart.php');
    }

    if (!isset($_SESSION['cart'])) {
        header("location: cartNone.php");
    }

?>

<h1>Carrinho de compras</h1>

<div class="list">

    <?php foreach($_SESSION['cart'] as $index => $item){
        $dish = Database::select('dish', ['id', 'name', 'price', 'description', 'img'], ["id" => $item['id']])[0];
    ?>

    <div class="item">
        <a href="cart.php?delete=<?= $index ?>">Remover do carrinho</a>
        <img width="100" height="100" src="images/<?= $dish['img'] ?>" alt="">
        <h1><?= $dish['name']; ?></h1>
        <h1><?= $dish['price']; ?></h1>
        <h1><?= $item['quantity']; ?></h1>

        <div class="ingredients">
            <?php foreach($item['ingredients'] as $k => $v) {
                $currentIngredient = Database::select('ingredient', ['id', 'name'], ['id' => $k])[0];
                ?>
                
                <h2><?= $currentIngredient['name'] ?></h2>
            <?php } ?>
        </div>
    </div>

    <?php } ?>

            
    <a href="order.php">Finalizar Pedido</a>

</div>

<?php 
    include('footer.php');
?>