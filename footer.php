


</body>
    <div class="footerContainer">
        <div class="footerItem">
            <a href="index.php"><img src="assets/house.png" width="35"></a>
        </div> 
        <?php 
            if(isset($_SESSION['id'])){ ?>
                <div class='footerItem'>
                    <a href='cart.php'><img src='assets/shopcart.png' width='35'></a>
                </div>
                <div class='footerItem'>
                    <a href='historical.php'><img src='assets/historical.png' width='35'></a>
                </div>
                <div class='footerItem'>
                    <a href='user.php'><img src='assets/user.png' width='35'></a>
                </div>
                <div class='footerItem'>
                    <a href='logout.php'><img src='assets/logout.png' width='35'></a>
                </div> <?php
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){ ?>
                    <div class='footerItem'>
                        <a href='settings.php'><img src='assets/settings.png' width='35'></a>
                    </div> <?php
                }
            } else{ ?>
                <div class='footerItem'>
                    <a href='login.php'><img src='assets/user.png' width='35'></a>
                </div> <?php
            }
        ?>
    </div>
</html>
