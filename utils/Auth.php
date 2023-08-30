<?php

namespace Utils;

class Auth {
    public static $path = "http://localhost/lanchoneteusgu/";

    public static function loginUserSession($user) {
        // status 1 = usuario logado
        // status 2 = administrador
        $_SESSION['status'] = $user['is_admin'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['cpf'] = $user['cpf'];
    }

    public static function redirect($url = "") {
        header("Location: " . self::$path . $url);
        die();
    }

    public static function checkAuth(){
        if(!isset($_SESSION['status'])){
            self::redirect();
        }
    }

    public static function checkAdmin(){
        if(!isset($_SESSION['status']) || $_SESSION['status'] != 2){
            self::redirect();
        }
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }
}

?>