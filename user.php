<?php
    include("header.php");
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    Auth::checkAuth();

    $user = Database::select('users', ['*'], ["id" => $_SESSION['id']])[0];
?>


<section class="accContainer">
    <h1 class="logo accTitle">Conta</h1>
    <div class="card account">
        <h1 class="accInfo">Nome: <span><?= $user['name'] ?></span></h1>
        <h1 class="accInfo">E-mail: <span><?= $user['email'] ?></span></h1>
        <h1 class="accInfo">CPF: <span><?= $user['cpf'] ?></span></h1>

        <button class="change">Trocar E-mail</button>
        <button class="change">Trocar Senha</button>
    </div>
</section>

<?php
    include("footer.php");
?>