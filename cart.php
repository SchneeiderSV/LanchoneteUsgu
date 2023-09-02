<?php 
    include('header.php');
    require_once('utils/Auth.php');
    require_once('utils/functions.php');
    require_once('utils/Database.php');
    require_once('utils/Cart.php');

    Auth::checkAuth();

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        Cart::remove($id);
        Auth::redirect('cart.php');
    }

    if (!isset($_SESSION['cart'])) {
       echo "Nenhum item adicionado ao carrinho!";
    }

    $total = 0;

?>

<h1>Carrinho de compras</h1>

<div class="center">

    <?php if(isset($_SESSION['cart'])) foreach($_SESSION['cart'] as $index => $item){
        $dish = Database::select('dishes', ['id', 'name', 'price', 'description', 'img'], ["id" => $item['id']])[0];
        $currentItemPrice = $item['quantity']*intval($dish['price']);
        $total += $currentItemPrice;
    ?>

    <div class="cartItem center">
        <img class="imgCart" src="images/<?= $dish['img'] ?>" alt="">
        <h1><?= $dish['name']; ?></h1>
        <div class="ingredients">
            <?php foreach($item['ingredients'] as $k) {
                $currentIngredient = Database::select('ingredients', ['id', 'name'], ['id' => $k])[0];
                ?>
                
                <h2><?= $currentIngredient['name'] ?></h2>
            <?php } ?>
        </div>
        <h3><?= $item['quantity']; ?></h3>

        <h2>R$<?= $currentItemPrice ?></h2>


        <a class="link" href="cart.php?delete=<?= $index ?>">Remover</a>
    </div>

    <?php } ?>

    <?php
    
    if(isset($_SESSION['cart']) && isset($_POST['finishOrder'])){
        $district = $_POST['district'];
        $street = $_POST['street'];
        $number = $_POST['num'];
        $complement = $_POST['complement'];
        $paymentMethod = $_POST['paymentMethod'];

        $errors = [];

        if(!validate($district, 'string')){
            $errors['district'] = 'O nome do bairro é obrigatório';
        }

        if(!validate($street, 'string')){
            $errors['street'] = 'O nome da rua é obrigatório';
        }

        if(!validate($number, 'string')){
            $errors['number'] = 'O número do local é obrigatório';
        }

        if(!validate($complement, 'string')){
            $errors['complement'] = 'O complemento é obrigatório';
        }

        if(empty($errors)){
            if($paymentMethod == 1){
                // Dinheiro

            } else {
                // Pix
            }

            $orderData = [
                "total_price" => $total,
                "change_value" => 0,
                "district" => $district,
                "street" => $street,
                "number" => $number,
                "complement" => $complement,
                "payment_method" => $paymentMethod,
                "payment_confirmation" => 0,
                "status" => 0,
                "user_id" => $_SESSION['id'],
            ];
            
            $orderId = Database::insert('orders', $orderData);

            foreach($_SESSION['cart'] as $item){
                $data = [
                    "amount" => $item['quantity'],
                    "order_id" => $orderId,
                    "dish_id" => $item['id'],
                ];

                $dish = Database::select('dishes_ingredients', ['*'], ['dish_id' => $item['id']])[0];

                foreach($item['ingredients'] as $ingredientId){
                   $ingredient = Database::join('dishes_ingredients', 'ingredient_id', 'ingredients', 'id', ['*'], [ 'ingredient_id' => $ingredientId])[0];

                   if($ingredient['quantity']<$item['quantity']*$dish['quantity']) return;

                   $newAmount = $ingredient['quantity']-($item['quantity']*$dish['quantity']);

                   Database::update('ingredients', ['quantity' => $newAmount], ['id' => $ingredientId ]);
                }

                $orderDishId = Database::insert('orders_dishes', $data);
            }

        }
    }
    
    ?>

    <p>Total: R$<?= $total ?></p>
    
    <form class="center" method="POST" enc="multipart/form-data">
        <input class="input" type="text" name="district" placeholder="Bairro" required>
        <input class="input" type="text" name="street" placeholder="Rua" required>
        <input class="input" type="text" name="num" placeholder="Numero" required>
        <input class="input" type="text" name="complement" placeholder="Complemento" required>
   
        <label class="lbl" for="paymentMethod">Método de pagamento</label>
        <select name="paymentMethod" id="paymentMethod">
            <option value="1" selected>Dinheiro</option>
            <option value="2">Pix</option>
        </select>

        <div class="center" id="changePayment">
            <label class="lbl" for="changeValue">Valor que será entregue</label>
            <input class="input" type="text" name="changeValue" id="changeValue">
        </div>

        <div id="pixPayment" style="display: none;">
            <h2>Chave pix: pix@merenderashermanos.com</h2>

            <div class="inputGroup">
                <label class="lbl" for="confirmation">Anexe o comprovante de pagamento aqui</label>
                <input type="file" name="confirmation" id="confirmation">
            </div>
        </div>

        <input class="btn" type="submit" name="finishOrder" value="Fazer pedido"></input>

    </form>

    <?php if (!empty($errors)){ ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>

<script>
    const selectPayment = document.getElementById("paymentMethod");
    const pixDiv = document.getElementById("pixPayment");
    const changeDiv = document.getElementById("changePayment");
    let show = false;

    selectPayment.addEventListener('change', () => {
        show^=1;

        if(show){
            pixDiv.style.display = 'block';
            changeDiv.style.display = 'none';
        } else {
            pixDiv.style.display = 'none';
            changeDiv.style.display = 'block';
        }
    });
</script>


</div>

<?php 
    include('footer.php');
?>