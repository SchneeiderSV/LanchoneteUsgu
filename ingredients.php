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

<h1>Ingredientes</h1>

<form method="POST">
    <input type="text" name="name" placeholder="Nome">
    <input type="number" name="qty" placeholder="Quantidade">

    <button>Enviar</button>
</form>

<div class="list">

    <?php if($ingredients) {
        foreach($ingredients as $ingredient) { ?>
        <div class="ingredient">
            <h2><?= $ingredient['name'] ?></h2>
            <p><?= $ingredient['quantity'] ?></p>
            <a href="ingredients.php?delete=<?= $ingredient['id'] ?>">excluir</a>
        </div>
    <?php } } ?>
</div>

<?php include('footer.php'); ?>