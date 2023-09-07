<?php
    include("header.php");
    require_once('utils/Auth.php');
    Auth::checkAuth();
?>


<section class="accContainer">
    <h1 class="logo accTitle">Conta</h1>
    <div class="card account">
        <h1 class="accInfo">Nome: <span><?= $_SESSION['name'] ?></span></h1>
        <h1 class="accInfo">E-mail: <span><?= $_SESSION['email'] ?></span></h1>
        <h1 class="accInfo">CPF: <span><?= $_SESSION['cpf'] ?></span></h1>

        <button class="change">Trocar E-mail</button>
        <button class="change">Trocar Senha</button>
    </div>
</section>

<?php
    include("footer.php");
?>