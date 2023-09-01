<?php
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    require_once('utils/functions.php');
    Auth::checkAdmin();
?>

<?php
    if(!isset($_GET['id'])) die("ID nao foi informado");

    $selectedId = intval($_GET['id']);
    $dish = Database::rawQuery("SELECT dishes.id, dishes.name, dishes.description, dishes.price, dishes.img, GROUP_CONCAT(ingredients.id) AS ingredients
    FROM dishes
    LEFT JOIN dishes_ingredients ON dishes.id = dishes_ingredients.dish_id
    LEFT JOIN ingredients ON dishes_ingredients.ingredient_id = ingredients.id
    GROUP BY dishes.id")[0];

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $desc = $_POST['description'];
        $ingredients = $_POST['ingredients'];

        $errors = [];

        if(!validate($name, 'string')){
            $errors["name"] = "O nome é obrigatório";
        }

        if(!validate($price, 'float')){
            $errors["price"] = "O preço é obrigatório";
        }

        if(!validate($desc, 'string')){
            $errors["desc"] = "A descrição é obrigatória";
        }

        if(empty($errors)){
            $updateData = [
                'name' => $name,
                'price' => floatval($price),
                'description' => $desc,
            ];
    
            $cnt = Database::update('dishes', $updateData, ['id' => $selectedId]);
    
            foreach ($ingredients as $k => $v) {
                Database::update('dishes_ingredients', [ "quantity" => $v ], ["id" => $k]);
            }

            if($cnt){
                echo "<script>alert('O prato foi editado com sucesso!')</script>";
                Auth::redirect("dishes.php");
            }
        }
    }
?>

<form method="POST" enctype="multipart/form-data">
    <div>
        <h1 >Dishes</h1>
        <div>
            <div>
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" value="<?= $dish['name'] ?>">

                <label for="price">Preço</label>
                <input type="text" name="price" value="<?= $dish['price'] ?>">
                
            </div>  
            <textarea name="description" id="" cols="20" rows="10" value=""><?= $dish['description'] ?></textarea>
        </div>
        
        <div class="ingredientslist">
            <?php
                foreach(explode(',', $dish['ingredients']) as $ingredientId) {
                    $ingredient = Database::join('ingredients', 'id', 'dishes_ingredients', 'ingredient_id', ['*'], ['id' => $ingredientId])[0];
                    ?>
                <div class="ingredient">
                <label for="<?= $ingredient['name']?>"><?= $ingredient['name']?></label>
                <input type="text" name="ingredients[<?= $ingredient['id'] ?>]" id="<?= $ingredient['name'] ?>" value="<?= $ingredient['quantity'] ?>">
                </div>
            <?php } ?>
        </div>

        <button>Atualizar</button>
    </div>

</form>

<?php if (!empty($errors)){ ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>

<?php include('footer.php'); ?>