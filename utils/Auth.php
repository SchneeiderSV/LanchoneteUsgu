<?php

class Auth {
    public static $path = "http://localhost/lanchoneteusgu/";

    public static function login($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['admin'] = $user['is_adm'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['cpf'] = $user['cpf'];
    }

    public static function redirect($url = "") {
        header("Location: " . self::$path . $url);
        die();
    }

    public static function checkAuth(){
        if(!isset($_SESSION['id'])){
            self::redirect();
        }
    }

    public static function checkAdmin(){
        if(!isset($_SESSION['id']) || $_SESSION['admin'] != 1){
            self::redirect();
        }
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }
}

?>