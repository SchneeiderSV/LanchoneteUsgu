<?php
    include('header.php');
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<?php
    if(!isset($_GET['id'])) die("ID nao foi informado");

    require_once('utils/Database.php');
    $currentIngredient = Database::select('ingredient', ['id', 'name', 'quantity'], ["id" => $_GET["id"]])[0];

    if(isset($_POST['name'])){
        require_once('utils/functions.php');

        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $updateData = [
            'name' => $_POST['name'],
            'quantity' => intval($_POST['qty']),
        ];
        
        $updateConditions = [
            'id' => $_GET['id'],
        ];

        $cnt = Database::update('ingredient', $updateData, $updateConditions);

        if($cnt){
            echo "<script>alert('O ingrediente foi editado com sucesso!')</script>";
            Auth::redirect("ingredients.php");
        }
    }
?>



<form method="POST">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" value="<?= $currentIngredient['name']; ?>">

    <label for="qty">Quantidade</label>
    <input type="text" name="qty" id="qty" value="<?= $currentIngredient['quantity']; ?>">

    <button>Atualizar</button>
</form>



<?php include('footer.php'); ?>