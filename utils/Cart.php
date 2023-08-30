<?php

class Cart {
    public static function store($cartItem) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; 
        }

        $existingItemKey = -1;
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] === $cartItem['id']) {
                $existingItemKey = $key;
                break;
            }
        }

        if ($existingItemKey !== -1) {
            $_SESSION['cart'][$existingItemKey]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][] = $cartItem;
        }
    }
}

?>