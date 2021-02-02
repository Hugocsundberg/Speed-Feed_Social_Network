<nav>
    <div class="logo">
        <a href="/index.php"><img class="logo" src="/images/logo.svg" alt="Logotype 'speed feed'"></a>
    </div>
    <div class="hamburger-icon hamburger center-contain"></div>
    <div class="hamburger-menu hamburger">
        <div class="hamburger_text_container">
            <?php $url = $_SERVER['REQUEST_URI']; ?>
            <?php if ($url !== '/index.php') : ?>
                <a href="/index.php">
                    <h1 class="most-right-nav">Start</h1>
                </a>
            <?php endif ?>
            <?php
            if (!isset($_SESSION['user']) && $url !== '/views/login.php') : ?>
                <a href="/views/login.php">
                    <h1>Login/Create account</h1>
                </a>
            <?php endif ?>
            <?php if ($url !== '/views/create_post.php') : ?>
                <a href="/views/create_post.php">
                    <h1>Create post</h1>
                </a>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user']) && $url !== "/views/account.php") : ?>
                <a href="/views/account.php">
                    <h1>Account</h1>
                </a>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user'])) : ?>
                <a href="/account/logout.php">
                    <h1 class="red-shadow">Logout</h1>
                </a>
            <?php endif ?>
        </div>
    </div>
</nav>