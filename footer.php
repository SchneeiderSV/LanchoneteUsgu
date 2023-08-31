


</body>
    <div class="footerContainer">
        <div class="footerItem">
            <a href="index.php"><img src="assets/house.png" width="35"></a>
        </div> 
        <?php 
            if(isset($_SESSION['id'])){ 
                echo "<div class='footerItem'>";
                    echo "<a href='cart.php'><img src='assets/shopcart.png' width='35'></a>";
                echo "</div>";
                echo "<div class='footerItem'>";
                    echo "<a href='historical.php'><img src='assets/historical.png' width='35'></a>";
                echo "</div>";
                echo "<div class='footerItem'>";
                    echo "<a href='user.php'><img src='assets/user.png' width='35'></a>";
                echo "</div>";
                echo "<div class='footerItem'>";
                    echo "<a href='logout.php'><img src='assets/logout.png' width='35'></a>";
                echo "</div>";
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
                    echo "<div class='footerItem'>";
                        echo "<a href='settings.php'><img src='assets/settings.png' width='35'></a>";
                    echo "</div>";
                }
            } else{
                echo "<div class='footerItem'>";
                    echo "<a href='login.php'><img src='assets/user.png' width='35'></a>";
                echo "</div>";
            }
        ?>
    </div>
</html>
