<nav>
    <div class="logo">
        <a href="/views/index.php"><img class="logo" src="/images/logo.svg" alt="Logotype 'speed feed'"></a>
    </div>
    <div class="hamburger-icon hamburger center-contain"></div>
    <div class="hamburger-menu hamburger">
        <div class="hamburger_text_container">
            <a href="/views/index.php">
                <h1>Start</h1>
            </a>
            <?php
            if (!isset($_SESSION['user'])) : ?>
                <a href="/views/login.php">
                    <h1>Login</h1>
                </a>
            <?php endif ?>
            <a href="/views/create_post.php">
                <h1>Create post</h1>
            </a>
            <?php
            if (isset($_SESSION['user'])) : ?>
                <a href="/views/account.php">
                    <h1>Account</h1>
                </a>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user'])) : ?>
                <a href="/Account/logout.php">
                    <h1>Logout</h1>
                </a>
            <?php endif ?>
        </div>
    </div>
</nav>