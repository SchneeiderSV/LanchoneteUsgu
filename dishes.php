<?php
    include('header.php');
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<?php
    require_once('utils/Database.php');

    if(isset($_POST['name'])){
        require_once('utils/functions.php');

        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $ingredients = $_POST['ingredients'];
        $img = $_FILES['img'];

        $errors = [];
    
        if(!validate($name, 'string')){
            $errors['name'] = 'O nome é obrigatório';
        }

        if(!validate($desc, 'string')){
            $errors['desc'] = 'A descrição é obrigatória';
        }

        if(!validate($price, 'float')){
            $errors['price'] = 'O preço é obrigatório';
        }

        if(!validate($img, 'img')){
            $errors['img'] = 'A imagem é obrigatória';
        }

        if(empty($errors)){
            $filename = $_FILES['img']['name'];
            $info_name = explode(".",$filename);
            $ext = end($info_name);
            $newName = uniqid().".".$ext;
            if(!move_uploaded_file($_FILES["img"]["tmp_name"],"images/".$newName)){
                echo "Upload não foi realizado";
            }

            $data = [
                "name" => $name,
                "price" => $price,
                "description" => $desc,
                "img" => $newName,
            ];

            $dishId = Database::insert('dish', $data);
            if(!$dishId){
                echo '<script>alert("Erro!")</script>';
            }

            foreach ($ingredients as $ingredientID => $quantity) {
                $currentData = [
                    "dish_id" => $dishId,
                    "ingredient_id" => $ingredientID,
                    "quantity" => $quantity,
                ];

                Database::insert('dish_ingredient', $currentData);
            }

            
        } else {
            var_dump($errors);
        }
    }

    $dishes = Database::selectAll("dish");
    $ingredients = Database::selectAll("ingredient");

?>

<h1>Pratos</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Nome">
    <input type="text" name="price" placeholder="Preço">
    <textarea name="desc" id="" cols="30" rows="10"></textarea>

    <label for="img">Imagem do prato</label>
    <input type="file" name="img" id="img">
    <?php if($ingredients){ foreach ($ingredients as $ingredient) { ?>  
        <label for="<?= $ingredient['id']?>"><?= $ingredient['name']?></label>
        <input type="number" name="ingredients[<?= $ingredient['id']?>]" id="<?= $ingredient['id']?>" placeholder="Quantidade">
    <?php } } ?>

    <button>Enviar</button>
</form>

<div class="list">

    <?php if($dishes) {
        foreach($dishes as $dish) { ?>
        <div class="dish">
            <h2><?= $dish['name'] ?></h2>
            <p><?= $dish['description'] ?></p>
        </div>
    <?php } } ?>
</div>

<?php include('footer.php'); ?>