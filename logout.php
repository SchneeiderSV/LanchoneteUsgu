<?php
    include('header.php');
    require_once('utils/Auth.php');
    Auth::logout();
    Auth::redirect();
?>

<?php
    include('footer.php');

?>