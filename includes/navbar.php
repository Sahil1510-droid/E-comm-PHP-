<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">E-comm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav" style="margin-left: auto;">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Collections</a>
                </li>

                <?php
                if (isset($_SESSION['auth'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my-orders.php">Orders</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['auth_user']['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="my-wishlist.php">Wishlist</a>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>

                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log in</a>
                    </li>
                <?php
                }
                ?>


            </ul>
        </div>
    </div>
</nav>