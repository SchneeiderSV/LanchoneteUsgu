<?php

class Cart {
    public static function store($cartItem) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; 
        }
        
        $_SESSION['cart'][] = $cartItem;
    }

    public static function remove($position) {
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$position])) {
            unset($_SESSION['cart'][$position]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }

    public static function isEmpty() {
        return empty($_SESSION['cart']);
    }
    
}

?>