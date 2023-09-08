<?php
include("header.php");
require_once("utils/Database.php");
require_once("utils/Auth.php");

Auth::checkAdmin();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = Database::select('users', ['*'], [ "id" => $id ])[0];
    ?>

<h1><?= $user['name'] ?></h1>
<h1><?= $user['email'] ?></h1>
<h1><?= $user['cpf'] ?></h1>
<h2><?php echo (new DateTimeImmutable($user['created_at']))->format('d-m-Y H:i:s') ?>
</h2>
<?php } else {
    $users = Database::select('users', ['*']);

    if($users) { foreach($users as $user){ ?>
        <div class="userBox">
            <span class="userInfo"><?= $user['name'] ?></span>
            <span class="userInfo"><?= $user['email'] ?></span>
            <span class="userInfo"><?= $user['cpf'] ?></span>
            <span class="userInfo"><?= (new DateTimeImmutable($user['created_at']))->format('d-m-Y H:i:s') ?></span>
        </div>
<?php } } } ?>


<?php include('footer.php') ?>