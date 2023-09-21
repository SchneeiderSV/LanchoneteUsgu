<?php
include("header.php");
require_once('utils/Database.php');
require_once('utils/Auth.php');
require_once("utils/Cart.php");



if(isset($_GET['id'])){
    $selectedId = $_GET['id'];
    $dish = Database::select('dishes', ['id', 'name', 'description', 'price', 'img'], ["id" => $selectedId]);

    if(!$dish[0]['id']) Auth::redirect();

    if (isset($_POST['cart'])) {
        $quantity = intval($_POST['quantity']);

        if(isset($_POST['ingredients'])){
            $ingredients = array_keys($_POST['ingredients']);
        } else $ingredients = 0;

        if ($quantity > 0) {

            $cartItem = [
                'id' => $dish[0]['id'],
                'quantity' => $quantity,
                'ingredients' => $ingredients,
            ];

            Cart::store($cartItem);
        }
    }

        $dishIngredients = Database::join('dishes_ingredients', 'ingredient_id', 'ingredients', 'id', ['*'], ["dish_id" => $selectedId]);
    ?>
    

<div class="dishInfo">
    <img class="img2" src="images/<?= $dish[0]['img'] ?>" alt="">


    <form method="POST">
        <h1><?= $dish[0]['name'] ?></h1>
        <h2 class="dishDesc"><?= $dish[0]['description'] ?></h2>
        <h2 class="price">R$<?= number_format((float)$dish[0]['price'], 2, ',') ?></h2>

        <div class="inputGroup">
            <label class="lbl" for="quantity">Quantidade</label>
            <input class="quantityInput" type="number" value="1" min="1" name="quantity" id="quantity">
        </div>
        <div class="ingredientsList">
        
        <?php
         if($dishIngredients && count($dishIngredients)>1){
            ?>
            <h2>Ingredientes:</h2>
            <?php foreach($dishIngredients as $ingredient){ ?>
            <div class="inputGroup ingredientCheckbox">
                <input type="checkbox" checked name="ingredients[<?= $ingredient['id'] ?>]" id="<?= $ingredient['name'] ?>">
                <label for="<?= $ingredient['name'] ?>"><?= $ingredient['name'] ?></label>
            </div>

        <?php } } ?>
        </div>

        <div class="center">
            <input class="btn" type="submit" name="cart" value="Adicionar ao carrinho">
        </div>
        
    </form>

</div>

<?php } ?>

<?php include("footer.php");?>