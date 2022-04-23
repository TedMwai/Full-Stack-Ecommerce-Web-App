<header>
    <div class="reg-links">
        <div class="logos">
            <img src="../images/adidas-logo.svg" alt="Adidas">
            <img src="../images/New Balance.svg" alt="New Balance">
        </div>
        <div class="jumpman_brand">
            <h1>MR. CARTER</h1>
        </div>
        <div class="first_links">
            <?php
            if (isset($_SESSION['user'])) {
                echo '
            <a href="../orders.php" >Hi,' .  $user['first_name'] . '</a>
            <button class="btn_icon">
                <img src="../images/user_icon.svg" alt="icon" height="30px" width="30px" href="#">
            </button>
            <div class="dropdown">
            |
            <a href="../logout.php">Log Out</a>
            </div>
            
            ';
            } else {
                echo '
            <a href="/signup.php">Join us</a>
            <a href="/login.php">Sign In</a>
            ';
            }
            ?>
        </div>
    </div>
    <div class="header">
        <a href="../index.php" class="logo">
            <img src="../images/jumpman_logo.svg" alt="Jumpman Logo" />
        </a>
        <nav class="navbar">
            <a href="../index.php">Home</a>
            <a href="#popular">Popular</a>
            <a href="#nike">Nike</a>
            <a href="#adidas">Adidas</a>
            <a href="#yeezy">Yeezy</a>
            <a href="#contact">Contact</a>
        </nav>
        <h1 class="jumpman">JUMPMAN</h1>
        <div class="icons">
            <form class="search" method="POST" action="/search.php">
                <input type="text" name="input-search" id="input-search" placeholder="Search">
                <button type="submit" id="search-btn-submit" style="border: none; outline:none; background:none;">
                    <img src="../images/search.svg" alt="search">
                </button>
            </form>
            <div class="heart">
                <a href="../wishlist/wishlist_view.php">
                    <img src="../images/heart.svg" alt="heart" height="30px" width="30px">
                </a>
            </div>
            <div class="bag">
                <a href="../cart/cart_view.php">
                    <img src="../images/bag.svg" alt="bag" height="50px" width="50px">
                    <span class="cart-count">0</span>
                </a>
            </div>
            <button class="menu">
                <span class="menu-top"></span>
                <span class="menu-middle"></span>
                <span class="menu-bottom"></span>
            </button>
        </div>
</header>