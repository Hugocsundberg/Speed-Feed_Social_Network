<nav>
    <div class="logo press-bounce">
        <a href="/index.php"><img class="logo" src="/images/logo.svg" alt="Logotype 'speed feed'"></a>
    </div>
    <div class="press-bounce hamburger-icon hamburger center-contain"></div>
    <div class="hamburger-menu hamburger">
        <div class="hamburger_text_container">
            <?php $url = $_SERVER['REQUEST_URI']; ?>
            <?php if ($url !== '/index.php') : ?>
                <a href="/index.php">
                    <h1 class="most-right-nav press-bounce">Start</h1>
                </a>
            <?php endif ?>
            <?php
            if (!isset($_SESSION['user']) && $url !== '/views/login.php') : ?>
                <a href="/views/login.php">
                    <h1 class="press-bounce">Login/Create account</h1>
                </a>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user']) && $url !== "/views/account.php") : ?>
                <a href="/views/account.php">
                    <h1 class="press-bounce">Account</h1>
                </a>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user'])) : ?>
                <a href="/account/logout.php">
                    <h1 class="press-bounce" class="red-shadow">Logout</h1>
                </a>
            <?php endif ?>
        </div>
    </div>
</nav>