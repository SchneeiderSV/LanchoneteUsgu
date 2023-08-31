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

<form method="POST">
    <div class="logincontainer">
        <h1 class="logTitle">LogIn</h1>
        <div class="loginitems">
            <div class="loginitem">
                <input class="logInp" type="email" name="email" placeholder="Email">
            </div>
            <div class="loginitem">
                <input class="logInp" type="password" name="password" placeholder="Senha">
            </div>
            <div class="loginitem">
                <button class="inpBtn">Enviar</button>
            </div>
            <div class="loginitem">
                <span class="logintext">Ainda não possui uma conta? Cadastre-se <a href="register.php">aqui</a></span>
            </div>
        </div>
    </div>
    
</form>

<?php include('footer.php'); ?>