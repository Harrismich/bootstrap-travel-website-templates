
<header class="continer-fluid ">
<div  class="header-top">
    <div class="container">
        <div class="row col-det">
            <div class="col-lg-6 d-none d-lg-block">
                <ul class="ulleft">
                    <li>
                        <i class="far fa-envelope"></i>
                        sphy_admin@gmail.com
                        <span>|</span></li>
                    <li>
                        <i class="fas fa-phone-volume"></i>
                        +30 210-7496346</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-12">
                <ul class="ulright">
                    <li>
                        <i class="fab fa-facebook-square"></i>
                    </li>
                    <li>
                        <i class="fab fa-twitter-square"></i>
                    </li>
                    <li>
                        <i class="fab fa-instagram"></i>
                    </li>
                    <li>
                        <i class="fab fa-linkedin"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="menu-jk" class="header-bottom">
    <div class="container">
        <div class="row nav-row">
            <div class="col-lg-3 col-md-12 logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="">
                    <a data-toggle="collapse" data-target="#menu" href="#menu"><i class="fas d-block d-lg-none  small-menu fa-bars"></i></a>
                </a>

            </div>
            <div id="menu" class="col-lg-9 col-md-12 d-none d-lg-block nav-col">
        
                        <ul class="navbad">
                        <?php if (isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item active">
                            <a class="nav-link" href="packages.php">Home</a>
                            </li>
                            <?php } ?>
                            <?php if (isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item">
                            <a class="nav-link" href="index.php?city_id=<?php echo $_SESSION['city_id']; ?>">City</a>
                            </li>
                            <?php } ?>
                            <?php if (isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="favorites.php">Favorites</a>
                            </li>
                            <?php } ?>
                            <!-- <?php if (isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="blog.php">Blog</a>
                            </li>
                            <?php } ?> -->
                            <?php if (isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="contact_us.php">Contact US</a>
                            </li>
                            <?php } ?>
                            <?php if (!isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">login / Register</a>
                            </li>
                            <?php } ?>
                            <?php if (isset($_SESSION['logged_in_user'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                            <?php } ?>
                        </ul>
                        
                
            </div>
        </div>
    </div>
</div> 
</header>
