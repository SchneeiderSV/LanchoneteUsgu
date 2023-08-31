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
    $address = $_POST['address'];

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

    if(!validate($address, 'string')){
        $errors['name'] = 'O endereço é obrigatório';
    }


    if(empty($errors)){
        $user = Database::select('user', ['id'], ["email" => $email]);
        if($user){
            echo "<script>alert('O email informado ja esta cadastrado')</script>";
            return;
        }
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            "name" => $name,
            "email" => $email,
            "pass" => $passwordHash,
            "cpf" => $cpf,
            "address" => $address,
        ];

        $userId = Database::insert('user', $data);
        $userData = Database::selectAll('user');

        if($userId){
            echo "<script>alert('O usuario foi criado com sucesso!')</script>";
            Auth::login($userData);
            Auth::redirect();
        } else {
            echo "<script>alert('O usuario não foi criado. Erro desconhecido!')</script>";
        }
    }
}

?>

<form method="POST">
    <div class="logincontainer">
        <h1 class="logo">D'MANOS MERENDEROS</h1>
        <h1 class="betterh1">Register</h1>
            <div class="loginitems">
                <div class="loginitem">
                    <input class="logInp" type="text" name="name" placeholder="Nome">
                </div>
                <div class="loginitem">
                    <input class="logInp" type="email" name="email" placeholder="Email">   
                </div>
                <div class="loginitem">
                    <input class="logInp" type="password" name="password" placeholder="Senha">
                </div>
                <div class="loginitem">
                    <input class="logInp" type="text" name="cpf" placeholder="CPF">
                </div>
                <div class="loginitem">
                    <input class="logInp" type="text" name="address" placeholder="Endereço">
                </div>
                <div class="loginitem">
                    <button class="inpBtn">Enviar</button>
                </div>
                <div class="loginitem">
                    <span class="logintext">Já possui uma conta? Clique <a href="login.php">aqui</a></span>
                </div>
            </div>
    </div>
    
</form>

<?php include('footer.php'); ?>
