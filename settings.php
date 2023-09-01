<?php
    include("header.php");
    require_once('utils/Auth.php');
    Auth::checkAdmin();
?>

<div class="center">

    <div class="center sales">
        <h1>Resumo de vendas</h1>
        <p style="text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, corporis, consequatur eligendi doloribus atque nam voluptates inventore quas odit cumque dicta. Cumque repellat accusamus similique? Atque, explicabo veniam cupiditate dolores tempora impedit quo, velit cumque eum totam iusto, rem inventore asperiores quidem maxime ea suscipit nisi eos. Vitae, placeat possimus? Quisquam, blanditiis culpa fugit fugiat et dignissimos soluta earum dicta sequi, cum esse saepe, aut nostrum eveniet! Laudantium optio harum doloremque odit accusamus architecto blanditiis laborum similique doloribus consectetur tempore neque, voluptate recusandae a nesciunt autem quasi deleniti. Voluptatibus ab magnam saepe odit, rerum voluptatum. Facere delectus architecto ut autem rerum porro iste, quis libero accusamus laborum inventore sunt quae modi totam ea, earum explicabo, cum ipsum quos doloribus tempora aperiam aut. Cum nostrum quia molestias, tempore obcaecati laborum nihil rem similique ut non veniam quaerat a laboriosam quasi. Dolorem, incidunt! Dolorum nemo assumenda voluptas? Doloribus provident animi a vitae illum aspernatur nam quisquam unde reiciendis, dolorum voluptatum iusto facere tenetur iure sed rerum sit quam ea, illo saepe? Impedit, eum ratione minima neque at iure asperiores accusantium numquam minus atque perferendis totam a maxime quasi nobis repellendus? Distinctio consectetur repudiandae facilis tenetur laborum enim voluptatem minima adipisci est molestias!</p>
    </div>

    <a class="link" href="dishes.php">Gerenciar itens do menu</a>
    <a class="link" href="ingredients.php">Gerenciar estoque</a>
    <a class="link" href="users.php">Gerenciar usuários</a>
    <a class="link" href="orders.php">Gerenciar pedidos</a>
</div>

<?php

    include("footer.php");

?>
