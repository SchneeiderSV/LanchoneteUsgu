<?php
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/functions.php');
    Auth::checkAuth();
?>

<?php
    if(!isset($_GET['id'])) die("ID nao foi informado");

    require_once('utils/Database.php');
    $user = Database::select('users', ['email', 'id'], ["id" => $_SESSION['id']])[0];


    if(isset($_POST['email'])){
        require_once('utils/Database.php');
        
        $errors = [];

        if(!validate($_POST['email'], 'email')){
            $errors['email'] = 'O email é obrigatório';
        }

        if(empty($errors)){
            $user2 = Database::select('users', ['id'], ["email" => $_POST['email']]);
            if($user2){
                echo "<script>alert('O email informado ja esta cadastrado')</script>";
                header("Refresh: 1; user.php");
                die();
            }
        
            $updateData = [
                'email' => $_POST['email'],
            ];
            
            $updateConditions = [
                'id' => $user['id'],
            ];

            $cnt = Database::update('users', $updateData, $updateConditions);
    
            if($cnt){
                echo "<script>alert('O email foi editado com sucesso!')</script>";
                Auth::redirect("user.php");
            }
        }
    }
?>
<section class="altContainer">
    <h1 class="logo">- Alterar Email -</h1>
    <div class="card">
        <form  class="center" method="POST">
            <label for="name">Email</label>
            <input type="text" name="email" id="email" value="<?= $user['email']; ?>">
            <button>Atualizar</button>
        </form>
    </div>
</section>

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