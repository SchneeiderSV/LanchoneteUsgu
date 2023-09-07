<?php
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    Auth::checkAdmin();
?>

<?php
    if(isset($_GET['delete'])){
        
        Database::delete('dishes_ingredients', ['dish_id' => $_GET['delete']]);
        $filename = Database::select('dishes', ['img'], ['id' => $_GET['delete']])[0]['img']; 
        Database::delete('dishes', ['id'=> $_GET['delete']]);
        unlink('images/'.$filename);
        Auth::redirect("dishes.php");
    }

    if(isset($_POST['name'])){
        require_once('utils/functions.php');

        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $ingredients = $_POST['ingredients'];
        $img = $_FILES['img'];
        $size = $_POST['size'];
        $isDrink = false;

        if(isset($_POST['isDrink'])) $isDrink = true;


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

        if(!validate($size, 'string')){
            $errors['size'] = 'O tamanho é obrigatório';
        }

        if(empty($errors)){
            $filename = $img['name'];
            $info_name = explode(".",$filename);
            $ext = end($info_name);
            $newName = uniqid().".".$ext;
            if(!move_uploaded_file($img["tmp_name"],"images/".$newName)){
                echo "Upload não foi realizado";
            }

            $data = [
                "name" => $name,
                "price" => $price,
                "description" => $desc,
                "img" => $newName,
                "is_drink" => $isDrink,
                "size" => $size,
            ];

            $dishId = Database::insert('dishes', $data);
            if(!$dishId){
                echo '<script>alert("Erro!")</script>';
            }

            foreach ($ingredients as $ingredientID => $quantity) {
                if(intval($quantity) <= 0) continue;
                
                $currentData = [
                    "dish_id" => $dishId,
                    "ingredient_id" => $ingredientID,
                    "quantity" => $quantity,
                ];

                Database::insert('dishes_ingredients', $currentData);
            }

            
        }
    }

    $dishes = Database::selectAll("dishes");
    $ingredients = Database::selectAll("ingredients");

?>

<section class="dishes">
    <h1 class="logo" style="background-color: lightgray; font-size:2rem;">Pratos</h1>
    <form class="center form" method="POST" enctype="multipart/form-data">
            
            
            <input class="input" type="text" name="name" placeholder="Nome" required>
            <input class="input" type="text" name="price" placeholder="Preço" required>

            <div class="imageUpload">
                <label class="inputBtn imgLbl" for="img">Escolher imagem do prato</label>
                <input type="file" name="img" id="img" style="display: none;" multiple=false required>
                <span class="imgName"></span>
            </div>

            <div class="inputGroup">
                <label class="lbl" for="isDrink">É bebida?</label>
                <input type="checkbox" name="isDrink" id="isDrink" value="1">
            </div>

            <input class="input" type="text" name="size" id="size" placeholder="Tamanho" required>

            <textarea class="textarea" placeholder="Descrição" name="desc" id="" cols="35" rows="5" required></textarea>

            <div class="existingingredients">
                <?php if($ingredients){ foreach ($ingredients as $ingredient) { ?>  
                    <div>
                        <label class="lbl" for="<?= $ingredient['id']?>"><?= $ingredient['name']?></label>
                        <input class="quantityInput" min="1" type="number" name="ingredients[<?= $ingredient['id']?>]" id="<?= $ingredient['id']?>" required>
                    </div>
                <?php } } ?>

                <button class="inputBtn">Enviar</button>
            </div>
            

            
            <div class="ingredientslist">
                <?php if($dishes) {
                    foreach($dishes as $dish) { ?>
                    <div class="ingredient">
                        <h2 class="ingName"><?= $dish['name'] ?></h2>
                        <p style="text-align: justify; margin-top: 0.5rem;margin-bottom: 0.25rem;"><?= $dish['description'] ?></p>
                        <a class="dishBtn" href="editDish.php?id=<?= $dish['id'] ?>">Editar</a>
                        <a class="dishBtn" href="dishes.php?delete=<?= $dish['id'] ?>">Excluir</a>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </form>
</section>

<script>
    let imgInp=document.querySelector("#img")
    let imgName=document.querySelector(".imgName")

    imgInp.addEventListener("change", function() {
        let path=imgInp.value
        let img=path.split("\\")
        imgName.innerHTML=img[img.length-1]
    })
</script>

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