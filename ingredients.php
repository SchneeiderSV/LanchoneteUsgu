<?php
    include('header.php');
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<?php
    require_once('utils/Database.php');

    if(isset($_GET['delete'])){
        require_once('utils/Database.php');
        Database::delete('ingredients', ['id' => $_GET['delete']]);
}

    if(isset($_POST['name'])){
        require_once('utils/functions.php');

        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $errors = [];
    
        if(!validate($name, 'string')){
            $errors['name'] = 'O nome é obrigatório';
        }

        if(!validate($qty, 'int')){
            $errors['qty'] = 'A quantidade é obrigatória';
        }

        if(empty($errors)){

            $data = [
                "name" => $name,
                "quantity" => $qty,
            ];

            $ingredientId = Database::insert('ingredients', $data);

            if($ingredientId){
                echo "<script>alert('O ingrediente foi adicionado com sucesso!')</script>";
            }
        }
    }

    $ingredients = Database::selectAll("ingredients");

?>



<form class="center" method="POST">
        <h1>Cadastrar ingredientes</h1>
        
        <input class="input" type="text" name="name" placeholder="Nome" required>

        <div class="inputGroup">
            <label class="lbl" for="qty">Quantidade</label>
            <input class="quantityInput" type="number" name="qty"id="qty" required>
        </div>
        
        <button class="inputBtn">Enviar</button>

        <div class="ingredientslist">
            <?php if($ingredients) {
                foreach($ingredients as $ingredient) { ?>
                <div class="ingredient">
                    <h2><?= $ingredient['name'] ?></h2>
                    <p>Quantidade: <?= $ingredient['quantity'] ?></p>
                    <a href="editIngredient.php?id=<?= $ingredient['id'] ?>">Editar</a>
                    <a href="ingredients.php?delete=<?= $ingredient['id'] ?>">Excluir</a>
                </div>
            <?php } } ?>
        </div>
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