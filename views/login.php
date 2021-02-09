<?php
require('../functions.php');
require('header.php');
require('./nav.php');

logMessage();
// print_r($_SESSION);
?>
<script src="../script/enter.js"></script>

<body class="login-body">
    <div class="login-view">
        <img class="loginImg" src="/images/logIn.svg" alt="">
        <form action="/account/login.php" method="post">
            <Label for="Email">Email</Label>
            <input class="input-field" type="text" name="Email" id="Email">
            <Label for="Password">Password</Label>
            <input class="input-field" type="password" name="Password" id="Password">
            <input class="submit-button" type="submit" value="Log in! 🚪">
        </form>

        <h2 class="loginOr">OR</h2>

        <img class="accountImg" src="/images/createAccount.svg" alt="">
        <form action="/account/create_account.php" method="post">
            <Label for="Email">Email</Label>
            <input class="input-field" type="text" name="Email" id="Email">
            <Label for="Password">Password</Label>
            <input class="input-field" type="password" name="Password" id="Password">
            <input class="submit-button" type="submit" value="Create! 🛠">
        </form>
    </div>
</body>
<script src="/script/hamburger.js"></script>
<?php createMessage(3) ?>