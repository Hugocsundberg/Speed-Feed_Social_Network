<?php
require('../functions.php');
require('header.php');
require('./nav.php');

logMessage();
// print_r($_SESSION);
?>
<div class="login-view">
    <h2>Login</h2>
    <form action="/Account/login.php" method="post">
        <Label for="Email">Email</Label>
        <input class="input-field" type="text" name="Email" id="Email">
        <Label for="Password">Password</Label>
        <input class="input-field" type="text" name="Password" id="Password">
        <input class="submit-button" type="submit" value="Log in! 🚪">
    </form>

    <h2>OR</h2>

    <h2>Create account</h2>
    <form action="/Account/create_account.php" method="post">
        <Label for="Email">Email</Label>
        <input class="input-field" type="text" name="Email" id="Email">
        <Label for="Password">Password</Label>
        <input class="input-field" type="text" name="Password" id="Password">
        <input class="submit-button" type="submit" value="Create! 🛠">
    </form>
</div>

<script src="/script/hamburger.js"></script>
<?php createMessage(3) ?>