<?php
    include('header.php');
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<?php
    require_once('utils/Database.php');

    if(isset($_GET['delete'])){
        require_once('utils/Database.php');
        Database::delete('ingredient', ['id' => $_GET['delete']]);
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

            $ingredientId = Database::insert('ingredient', $data);

            if($ingredientId){
                echo "<script>alert('O ingrediente foi adicionado com sucesso!')</script>";
            }
        }
    }

    $ingredients = Database::selectAll("ingredient");

?>



<form method="POST">
    <div class="ingredientscontainer">
        <h1 class="betterh1">Ingredientes</h1>
        <div class="ingredientsitems">
            <div class="ingredientitem">
                <input type="text" name="name" placeholder="Nome">
            </div>
            <div class="ingredientitem">
                <input type="number" name="qty" placeholder="Quantidade">
            </div>
            <div class="ingredientsitem">
                <button>Enviar</button>
            </div>
        </div>
        <div class="ingredientslist">
            <?php if($ingredients) {
                foreach($ingredients as $ingredient) { ?>
                <div class="ingredient">
                    <h2><?= $ingredient['name'] ?></h2>
                    <p>Quantidade: <?= $ingredient['quantity'] ?></p>
                    <a href="ingredients.php?delete=<?= $ingredient['id'] ?>">excluir</a>
                </div>
            <?php } } ?>
        </div>
    </div>   
</form>



<?php include('footer.php'); ?>