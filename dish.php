<?php
include("header.php");
require_once('utils/Database.php');
require_once('utils/Auth.php');
require_once("utils/Cart.php");



if(isset($_GET['id'])){
    $selectedId = $_GET['id'];
    $dish = Database::select('dish', ['id', 'name', 'description', 'price', 'img'], ["id" => $selectedId]);

    if(!$dish[0]['id']) Auth::redirect();

    if (isset($_POST['cart'])) {
        $quantity = intval($_POST['quantity']);
        if ($quantity > 0) {

            $cartItem = [
                'id' => $dish[0]['id'],
                'quantity' => $quantity,
                'ingredients' => $_POST['ingredients'],
            ];

            Cart::store($cartItem);
        }
    }

    $dishIngredients = Database::select('dish_ingredient', ['ingredient_id'], ["dish_id" => $selectedId]);

    $ingredients = [];
    foreach ($dishIngredients as $ingredient) {
        $ingredients[$ingredient["ingredient_id"]] = Database::select('ingredient', ['id', 'name', 'quantity'], ["id" => $ingredient["ingredient_id"]])[0];
    }
    ?>
    

<section class="foodView">
    <img class="foodImg" src="images/<?= $dish[0]['img'] ?>" alt="">
    <h1><?= $dish[0]['name'] ?></h1>
    <h2 class="foodDesc"><?= $dish[0]['description'] ?></h2>
    <h2>R$<?= $dish[0]['price'] ?>,00</h2>


    <form method="POST">
        <label class="quantLbl" for="quantity">Quantidade</label>
        <input class="quantInp" type="number" value="1" min="1" name="quantity" id="quantity">
        <h2>Ingredientes:</h2>
        <?php if($ingredients){ foreach($ingredients as $ingredient){ ?>
            <input type="checkbox" checked name="ingredients[<?= $ingredient['id'] ?>]" id="<?= $ingredient['name'] ?>">
            <label for="<?= $ingredient['name'] ?>"><?= $ingredient['name'] ?></label>
        <?php } } ?>
        <input type="submit" name="cart" value="Adicionar ao carrinho">

    </form>

    <button>Finalizar Pedido</button>
</section>

<?php } ?>

<?php include("footer.php");?>