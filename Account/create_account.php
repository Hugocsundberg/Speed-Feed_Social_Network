<?php

declare(strict_types=1);
require('../functions.php');
$email = $_POST['Email'];
$password_hash = password_hash($_POST['Password'], PASSWORD_BCRYPT);
$new = 'new';

//Check if email exists
$db = new PDO('sqlite:../hacker_news_database.sqlite3');
$result = $db->query("SELECT * FROM Users WHERE email = '$email'");
$data = $result->fetch(PDO::FETCH_ASSOC);

if (isset($data['email'])) { //Email already exists
    createMessage(2, 'This email is already in use');
    redirect('../views/login.php');
} else {  //Email is available
    //Export new user to database
    $db = new PDO('sqlite:../hacker_news_database.sqlite3');
    $stmt = $db->prepare('INSERT INTO Users (email, password_hash, sort_by)
    VALUES(:email, :password_hash, :sort_by)');

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password_hash', $password_hash);
    $stmt->bindParam(':sort_by', $new);
    $stmt->execute();
    createMessage(2, 'Account has been created');
    redirect('../views/login.php');
}
