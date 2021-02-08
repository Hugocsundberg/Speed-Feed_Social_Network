<?php

declare(strict_types=1);
require('../functions.php');

//Submitted information
$email = $_POST['Email'];
$password = $_POST['Password'];

//Database connection
$database_host = 'ec2-34-251-118-151.eu-west-1.compute.amazonaws.com';
$database_name = 'd2m7cahbqat10u';
$database_user = 'ibmysphorhuxnp';
$database_port = '5432';
$database_password = '17d71d5877ce8f94d8d912acdc727e8dd69d290548b93a22d0bc8c0b9b07489f';

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
$result = $db->query("SELECT * FROM \"Users\" WHERE \"email\" = '$email'");
$user = $result->fetch(PDO::FETCH_ASSOC);
//Validate password

if ($user) {
    if (password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user;
        createMessage(1, 'You are logged in');
        redirect('/index.php');
    } else {
        createMessage(2, 'Account exists. Tip: enter a password that is less incorrect');
        redirect('/views/login.php');
    }
} else {
    createMessage(2, 'Create an account bro');
    redirect('/views/login.php');
}
