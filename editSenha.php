<?php
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/functions.php');
    Auth::checkAuth();
?>

<?php
    if(!isset($_GET['id'])) die("ID nao foi informado");

    require_once('utils/Database.php');
    $user = Database::select('users', ['email', 'id', 'pass'], ["id" => $_SESSION['id']])[0];


    if(isset($_POST['novaSenha']) && isset($_POST['senhaAntiga'])){
        require_once('utils/Database.php');
        
        $errors = [];

        if(!validate($_POST['novaSenha'], 'string') || !password_verify($_POST['senhaAntiga'], $user['pass'])){
            $errors['password'] = 'Nova Senha é obrigatória / Senha Antiga é incorreta';
        }

        if(empty($errors)){
            $updateData = [
                'pass' => password_hash($_POST['novaSenha'], PASSWORD_DEFAULT),
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


<form method="POST">
    <label for="name">Senha Antiga</label>
    <input type="password" name="senhaAntiga" id="senhaAntiga">
    <br><br>
    <label for="name">Nova Senha</label>
    <input type="password" name="novaSenha" id="novaSenha">
    <br><br>
    <button>Atualizar</button>
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