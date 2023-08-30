<?php
include("header.php");
require_once("utils/Database.php");
require_once("utils/Cart.php");



if(isset($_GET['id'])){
    $selectedId = $_GET['id'];
    $dish = Database::select('dish', ['id', 'name', 'description', 'price', 'img'], ["id" => $selectedId]);

    if (isset($_POST['cart'])) {
        $quantity = intval($_POST['cart']);
        if ($quantity > 0) {
            $cartItem = [
                'id' => $dish['id'],
                'quantity' => $quantity
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
    

<img width="200" height="200" src="images/<?= $dish[0]['img'] ?>" alt="">
<h1><?= $dish[0]['name'] ?></h1>
<h2><?= $dish[0]['description'] ?></h2>
<h2><?= $dish[0]['price'] ?></h2>


<form method="POST">
    <label for="quantity">Quantidade</label>
    <input type="number" value="1" min="1" name="quantity" id="quantity">
<h2>Ingredientes:</h2>
<?php if($ingredients){ foreach($ingredients as $ingredient){ ?>
    <input type="checkbox" checked name="<?= $ingredient['name'] ?>" id="<?= $ingredient['name'] ?>">
    <label for="<?= $ingredient['name'] ?>"><?= $ingredient['name'] ?></label>
<?php } } ?>
<input type="submit" name="carrinho" value="Adicionar ao carrinho">

</form>

<button>Finalizar Pedido</button>

<?php } ?>

<?php include("footer.php");?>