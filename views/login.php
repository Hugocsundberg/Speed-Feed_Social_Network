<?php
require('../functions.php');
require('header.php');
require('./nav.php');

logMessage();
// print_r($_SESSION);
?>
<script src="../script/Classes/Smooth.js"></script>
<script src="../script/landing.js"></script>

<body class="login-body">
    <div class="login-view">
        <h2>Login</h2>
        <form action="/account/login.php" method="post">
            <Label for="Email">Email</Label>
            <input class="input-field" type="text" name="Email" id="Email">
            <Label for="Password">Password</Label>
            <input class="input-field" type="text" name="Password" id="Password">
            <input class="submit-button" type="submit" value="Log in! 🚪">
        </form>

        <h2>OR</h2>

        <h2>Create account</h2>
        <form action="/account/create_account.php" method="post">
            <Label for="Email">Email</Label>
            <input class="input-field" type="text" name="Email" id="Email">
            <Label for="Password">Password</Label>
            <input class="input-field" type="text" name="Password" id="Password">
            <input class="submit-button" type="submit" value="Create! 🛠">
        </form>
    </div>
</body>
<script src="/script/hamburger.js"></script>
<?php createMessage(3) ?>