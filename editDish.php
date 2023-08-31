<?php
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    Auth::checkAdmin();
?>

<?php
    if(!isset($_GET['id'])) die("ID nao foi informado");

    $selectedId = intval($_GET['id']);
    $dish = Database::select('dish', ['*'], ['id' => $selectedId])[0];
    $dishIngredients = Database::select('dish_ingredient', ['*'], ['dish_id' => $selectedId]);


    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];

        $updateData = [
            'name' => $_POST['name'],
            'price' => intval($_POST['price']),
            'description' => $_POST['description']
        ];
        
        $updateConditions = [
            'id' => $_GET['id'],
        ];

        $cnt = Database::update('dish', $updateData, $updateConditions);

        if($cnt){
            echo "<script>alert('O prato foi editado com sucesso!')</script>";
            Auth::redirect("dishes.php");
        }
    }
?>

<form method="POST" enctype="multipart/form-data">
    <div class="ingredientscontainer">
        <h1 class="betterh1">Dishes</h1>
        <div class="dishesitems">
            <div class="box">
                <div class="ingredientitem">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="<?= $dish['name'] ?>">
                </div>
                <div class="ingredientitem">
                    <label for="price">Preço</label>
                    <input type="text" name="price" value="<?= $dish['price'] ?>">
                </div>
                <div class="ingredientsitemexception">
                    <label for="img">Imagem do prato</label>
                    <input type="file" name="img" id="img" value="images/<?= $dish['img'] ?>">
                </div>
            </div>  
            <div class="ingredientsitem">
                <textarea name="desc" id="" cols="20" rows="10" value="<?= $dish['description'] ?>"></textarea>
            </div>
        </div>
        

        
        <div class="ingredientslist">
            <?php
                foreach($dishIngredients as $dishIngredient) {
                    $ingredient = Database::select('ingredient', ['*'], ['id' => $dishIngredient['ingredient_id']])[0];
                    ?>
                <div class="ingredient">
                <h2 for="<?= $ingredient['id']?>"><?= $ingredient['name']?></h2>
                <h4><?= $ingredient['quantity'] ?></h4>
                </div>
            <?php } ?>
        </div>

        <button>Atualizar</button>
    </div>

</form>

<?php include('footer.php'); ?>