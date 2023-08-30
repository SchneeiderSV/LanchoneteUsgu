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

            $user = Database::select('user', ['id', 'email', 'pass', 'cpf', 'address', 'is_adm', 'name'], ["email" => $email]);

            if($user[0] && password_verify($password, $user[0]['pass'])){
                Auth::login($user[0]);
                Auth::redirect();
            }
        } else {
            var_dump($errors);
        }
    }

?>

<h1>Login</h1>

<form method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Senha">

    <button>Enviar</button>
</form>

<p>Ainda não possui uma conta? Cadastre-se <a href="register.php">aqui</a></p>

<?php include('footer.php'); ?>