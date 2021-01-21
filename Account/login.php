<?php

declare(strict_types=1);
require('../functions.php');

//Submitted information
$email = $_POST['Email'];
$password = $_POST['Password'];

//Database connection
$db = new PDO('sqlite:../hacker_news_database.sqlite3');
$result = $db->query("SELECT * FROM Users WHERE email = '$email'");
$user = $result->fetch(PDO::FETCH_ASSOC);
//Validate password

if ($user) {
    if (password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user;
        createMessage(1, 'You are logged in');
        redirect('/views/index.php');
    } else {
        createMessage(2, 'Account exists. Tip: enter a password that is less incorrect');
        redirect('/views/login.php');
    }
} else {
    createMessage(2, 'Create an account bro');
    redirect('/views/login.php');
}
