<?php
    include("header.php");
    require_once('utils/Auth.php');
    require_once('utils/Database.php');
    Auth::checkAuth();

    $user = Database::select('users', ['*'], ["id" => $_SESSION['id']])[0];
?>


<h1><?= $user['name'] ?></h1>
<h1><?= $user['email'] ?></h1>
<h1><?= $user['cpf'] ?></h1>


<?php
    include("footer.php");
?>