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
       echo "Nenhum item adicionado ao carrinho!";
    }

    $total = 0;

?>

<h1>Carrinho de compras</h1>

<div class="center">

    <?php if(isset($_SESSION['cart'])) foreach($_SESSION['cart'] as $index => $item){
        $dish = Database::select('dishes', ['id', 'name', 'price', 'description', 'img'], ["id" => $item['id']])[0];
        $currentItemPrice = $item['quantity']*intval($dish['price']);
        $total += $currentItemPrice;
    ?>

    <div class="cartItem center">
        <img class="imgCart" src="images/<?= $dish['img'] ?>" alt="">
        <h1><?= $dish['name']; ?></h1>
        <div class="ingredients">
            <?php foreach($item['ingredients'] as $k => $v) {
                $currentIngredient = Database::select('ingredients', ['id', 'name'], ['id' => $k])[0];
                ?>
                
                <h2><?= $currentIngredient['name'] ?></h2>
            <?php } ?>
        </div>
        <h3><?= $item['quantity']; ?></h3>

        <h2>R$<?= $currentItemPrice ?></h2>


        <a class="link" href="cart.php?delete=<?= $index ?>">Remover</a>
    </div>

    <?php } ?>

    <p>Total: R$<?= $total ?></p>
    <a class="link" href="order.php">Finalizar Pedido</a>

</div>

<?php 
    include('footer.php');
?>