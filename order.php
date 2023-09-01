<?php
include('header.php');
require_once('utils/Auth.php');
require_once('utils/Database.php');
require_once('utils/Cart.php');

if(!isset($_SESSION['cart'])){
    Auth::redirect("index.php");
}

Auth::checkAuth();
$total = 0;
?>

<?php foreach($_SESSION['cart'] as $index => $item){
        $dish = Database::select('dishes', ['*'], ["id" => $item['id']])[0];
        $total += $item['quantity']*intval($dish['price']);
    ?>

    <div class="item">
        <h1><?= $dish['name'] ?></h1>
    </div>
    
    <?php }?>

    <form method="POST" enc="multipart/form-data">
        <input type="text" name="district" placeholder="Bairro" required>
        <input type="text" name="street" placeholder="Rua" required>
        <input type="text" name="num" placeholder="Numero" required>
        <input type="text" name="complement" placeholder="Complemento" required>


        <h2>O total do seu pedido é: <?= $total ?></h2>
   
        <label for="paymentMethod">Método de pagamento</label>
        <select name="paymentMethod" id="paymentMethod">
            <option value="1" selected>Dinheiro</option>
            <option value="2">Pix</option>
        </select>

        <div id="pixPayment" style="display: none;">
            <h2>Chave pix: pix@merenderashermanos.com</h2>

            <label for="confirmation">Anexe o comprovante de pagamento aqui</label>
            <input type="file" name="confirmation" id="confirmation">
        </div>

        <button>Fazer pedido</button>

    </form>

<script>
    const selectPayment = document.getElementById("paymentMethod");
    const pixDiv = document.getElementById("pixPayment");
    let showPixDiv = false;

    selectPayment.addEventListener('change', () => {
        showPixDiv^=1;
        showPixDiv ? pixDiv.style.display = 'block' : pixDiv.style.display = 'none';
    });
</script>

<?php 
include('footer.php');
?>