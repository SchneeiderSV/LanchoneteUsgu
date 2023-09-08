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

    ?>
    
    <table class="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Registro da conta</th>
            </tr>
        </thead>

        <tbody>
        <?php
    if($users) { foreach($users as $user){ ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['cpf'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= (new DateTimeImmutable($user['created_at']))->format('d-m-Y H:i:s') ?></td>
        </tr>

        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['cpf'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= (new DateTimeImmutable($user['created_at']))->format('d-m-Y H:i:s') ?></td>
        </tr>
<?php } } } ?>
        </tbody>
    </table>
    
    


<?php include('footer.php') ?>