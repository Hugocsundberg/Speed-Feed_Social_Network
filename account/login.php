<?php

declare(strict_types=1);
require('../functions.php');

//Submitted information
$email = $_POST['Email'];
$password = $_POST['Password'];

//Database connection
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
$result = $db->query("SELECT * FROM \"Users\" WHERE \"email\" = '$email'");
$user = $result->fetch(PDO::FETCH_ASSOC);
//Validate password

if ($user) {
    if (password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user;

        if (isset($user['name'])) {

            if ($user['name'] === 'Anonymous') {
                $greet = $email;
            } else {
                $greet = $user['name'];
            }
        } else {
            $greet = $email;
        }

        createMessage(1, "You are logged in as $greet");
        redirect('/index.php');
    } else {
        createMessage(2, 'The password is incorrect');
        redirect('/views/login.php');
    }
} else {
    createMessage(2, 'There is no account with this email');
    redirect('/views/login.php');
}
