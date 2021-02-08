<nav>
    <div class="logo press-bounce">
        <a href="/index.php"><img class="logo" src="/images/logo.svg" alt="Logotype 'speed feed'"></a>
    </div>
    <div class="press-bounce hamburger-icon hamburger center-contain hamburgerHamburger"></div>
    <div class="hamburger-menu hamburger">
        <div class="hamburger_text_container">
            <?php $url = $_SERVER['REQUEST_URI']; ?>
            <?php if ($url !== '/index.php') : ?>
                <h1 data-link="/index.php" class="smooth-redirect most-right-nav press-bounce">Start</h1>
            <?php endif ?>
            <?php
            if (!isset($_SESSION['user']) && $url !== '/views/login.php') : ?>
                <h1 data-link="/views/login.php" class="smooth-redirect press-bounce">Login/Create account</h1>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user']) && $url !== "/views/account.php") : ?>
                <h1 data-link="/views/account.php" class="smooth-redirect press-bounce">Account</h1>
            <?php endif ?>
            <?php
            if (isset($_SESSION['user'])) : ?>
                <h1 data-link="/account/logout.php" class="press-bounce log-out" class="red-shadow">Logout</h1>
            <?php endif ?>
        </div>
    </div>
    <script src="../script/Classes/Smooth.js"></script>
    <?php if (isset($_SESSION['user'])) : ?>
        <script src="../script/logOutConfirmation.js"></script>
    <?php endif ?>
    <script src="../script/smoothRedirectNav.js"></script>
</nav>