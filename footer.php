</div>
<div class="footerContainer">
        <div class="footerItem">
            <a href="index.php"><i class='bx bxs-home'></i></a>
        </div> 
        <?php 
            if(isset($_SESSION['id'])){ ?>
                <div class='footerItem'>
                    <a href='cart.php'><i class='bx bxs-cart'></i></a>
                </div>
                
                <div class='footerItem'>
                    <a href='history.php'><i class='bx bx-history' ></i></a>
                </div>

                <div class='footerItem'>
                    <a href='user.php'><i class='bx bxs-user'></i></a>
                </div>

                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){ ?>
                    <div class='footerItem'>
                        <a href='settings.php'><i class='bx bxs-cog' ></i></a>
                    </div>
                <?php } ?>

                <div class='footerItem'>
                    <a href='logout.php'><i class='bx bxs-exit'></i></a>
                </div>
            <?php     
            } else{ ?>
                <div class='footerItem'>
                    <a href='login.php'><i class='bx bxs-user'></i></a>
                </div> <?php
            }
        ?>
    </div>

</body>
</html>
