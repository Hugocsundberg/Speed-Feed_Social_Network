<?php

require('../functions.php');
require('header.php');
require('./nav.php');
$userId = $_SESSION['user']['id'];
logMessage();

//Database connection
$db = new PDO('sqlite:../hacker_news_database.sqlite3');

if (!$_SESSION['user']) {
    redirect('/views/login.php');
} else {
    $result = $db->query("SELECT * FROM USERS WHERE id = $userId");
    $userData = $result->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $userData;
}



?>

<body>
    <section class="top">
        <h1>Account</h1>
        <img src="<?= $_SESSION['user']['avatar_path'] ?>" alt="" class="profile-image">
    </section>
    <section class="form">
        <form action="/Account/update_user.php" method="post" enctype="multipart/form-data">

            <label for="file">Image</label>
            <input class="input-field img-button" type="file" name="file" id="file">
            <label for="email">Email</label>
            <input class="input-field" value="<?php echo $_SESSION['user']['email'] ?>" type="text" name="email" id="email">
            <label for="name">Name</label>
            <input class="input-field" value="<?php echo $_SESSION['user']['name'] ?>" type="text" name="name" id="name">
            <label for="password">Password</label>
            <input class="input-field" placeholder="***********" type="text" name="password" id="password">
            <label for="bio">Bio</label>
            <input class="input-field" value="<?php echo $_SESSION['user']['bio'] ?>" type="text" name="bio" id="bio">
            <input class="save" type="submit" value="Save">
        </form>
    </section>
    <script src="../script/hamburger.js"></script>
</body>


<?php createMessage(3) ?>
<?php require('footer.php') ?>