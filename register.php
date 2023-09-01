<?php include('header.php'); ?>

<?php

if(isset($_POST['name'])){
    require_once('utils/functions.php');
    require_once('utils/Database.php');
    require_once('utils/Auth.php');
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpf = $_POST['cpf'];

    $errors = [];

    if(!validate($name, 'string')){
        $errors['name'] = 'O nome de usuário é obrigatório';
    }

    if(!validate($email, 'email')){
        $errors['email'] = 'O email é obrigatório';
    }

    if(!validate($password, 'string')){
        $errors['password'] = 'A senha é obrigatório';
    }

    if(!validate($cpf, 'string')){
        $errors['cpf'] = 'O cpf é obrigatório';
    }

    if(empty($errors)){
        $user = Database::select('users', ['id'], ["email" => $email]);
        if($user){
            echo "<script>alert('O email informado ja esta cadastrado')</script>";
            header("Refresh: 3; register.php");
            die();
        }
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            "name" => $name,
            "email" => $email,
            "pass" => $passwordHash,
            "cpf" => $cpf,
        ];

        $userId = Database::insert('users', $data);
        $userData = Database::selectAll('users');

        if($userId){
            echo "<script>alert('O usuario foi criado com sucesso!')</script>";
            Auth::login($userData);
            Auth::redirect();
        } else {
            echo "<script>alert('O usuario não foi criado. Erro desconhecido!')</script>";
            header("Refresh: 3; register.php");
            die();
        }
    }
}
?>

<form class="center" method="POST">
    <h1>Registrar-se</h1>

    <input class="input" type="text" name="cpf" placeholder="CPF" required>
    <input class="input" type="text" name="name" placeholder="Nome" required>
    <input class="input" type="email" name="email" placeholder="Email" required>
    <input class="input" type="password" name="password" placeholder="Senha" required>

    <button class="inputBtn">Criar conta</button>
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
