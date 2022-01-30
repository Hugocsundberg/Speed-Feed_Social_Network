<?php

require('../functions.php');
require('header.php');
require('./nav.php');
$userId = $_SESSION['user']['id'];
logMessage();

//Database connection
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

if (!$_SESSION['user']) {
    redirect('/views/login.php');
} else {
    $result = $db->query("SELECT * FROM \"Users\" WHERE \"id\" = $userId");
    $userData = $result->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $userData;
}

if ($_SESSION['user']['avatar_path'] === 'default') {
    $avatarPath = '/images/image-placeholder-account.png';
} else {
    $avatarPath = $_SESSION['user']['avatar_path'];
}



?>

<body class="accountBody">
    <script src="../script/enter.js"></script>
    <form class="account-form" action="/account/update_user.php" method="post" enctype="multipart/form-data">
        <section class="top">
            <h1>Account</h1>
            <img src="<?= $avatarPath ?>" alt="" class="profile-image">
            <div class="label-container">
                <label class="edit-image-button press-bounce" for="file">Upload image</label>
            </div>
            <input class="hidden input-field img-button" type="file" name="file" id="file">
        </section>
        <section class="form">
            <label for="email">Email</label>
            <input class="input-field" value="<?php echo $_SESSION['user']['email'] ?>" type="text" name="email" id="email">
            <label for="name">Display name</label>
            <input class="input-field" value="<?php echo $_SESSION['user']['name'] ?>" type="text" name="name" id="name">
            <label for="password">Password</label>
            <input class="input-field" placeholder="***********" type="password" name="password" id="password">
            <label for="bio">Bio</label>
            <input class="input-field" value="<?php echo $_SESSION['user']['bio'] ?>" type="text" name="bio" id="bio">
            <input class="hidden form-account-submit" type="submit" value="hidden">
            <div class="save inactive">
                <p>Save</p>
            </div>
    </form>
    </section>
    <script src="../script/hamburger.js"></script>
    <script src="../script/functions.js"></script>
    <script src="../script/Classes/ConfirmationBox.js"></script>
    <script src="../script/account.js"></script>
</body>


<?php createMessage(3) ?>
<?php require('footer.php') ?>