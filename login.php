<?php include('header.php'); ?>

<?php
    if(isset($_POST['email'])){
        require_once('utils/functions.php');
        require_once('utils/Database.php');
        require_once('utils/Auth.php');
        
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $errors = [];
    
        if(!validate($email, 'email')){
            $errors['email'] = 'O email é obrigatório';
        }
    
        if(!validate($password, 'string')){
            $errors['password'] = 'A senha é obrigatório';
        }
    
        if(empty($errors)){

            $user = Database::select('users', ['id', 'email', 'pass', 'cpf', 'is_adm', 'name'], ["email" => $email])[0];

            if($user && password_verify($password, $user['pass'])){
                Auth::login($user);
                Auth::redirect();
            } else {
                $errors["usuario"] = "Email ou senha incorretos";
            }
        }
    }

?>

<section class="logContainer">
    <h1 class="logo">D'MANOS MERENDEROS</h1>
    <div class="card">
        <form class="center" method="POST">
            <h1>Entrar</h1>

            <input class="input" type="email" name="email" placeholder="Email" required>
            <input class="input" type="password" name="password" placeholder="Senha" required>

            <button class="inputBtn">Entrar</button>

            <p class="p">Ainda não possui uma conta? Clique <a href="register.php">aqui</a></p>
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