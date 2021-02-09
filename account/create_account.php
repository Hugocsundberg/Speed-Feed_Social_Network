<?php

declare(strict_types=1);
require('../functions.php');
$email = $_POST['Email'];
$password_hash = password_hash($_POST['Password'], PASSWORD_BCRYPT);
$new = 'new';
//If email is not correct
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    createMessage(2, 'Email has an incorrect format');
    redirect('/views/login.php');
}
if (strlen($_POST['Password']) < 8) {
    createMessage(2, 'Password has to be 8 characters or longer');
    redirect('/views/login.php');
}
//Create message (email not correct)
//Redirect to login
//If password is not correct
//Create message (password not correct)
//Redirect to login



//Check if email exists
$database_host = 'ec2-34-251-118-151.eu-west-1.compute.amazonaws.com';
$database_name = 'd2m7cahbqat10u';
$database_user = 'ibmysphorhuxnp';
$database_port = '5432';
$database_password = '17d71d5877ce8f94d8d912acdc727e8dd69d290548b93a22d0bc8c0b9b07489f';

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
$result = $db->query("SELECT * FROM \"Users\" WHERE \"email\" = '$email'");
$data = $result->fetch(PDO::FETCH_ASSOC);

if (isset($data['email'])) { //Email already exists
    createMessage(2, 'This email is already in use');
    redirect('/views/login.php');
} else {  //Email is available
    //Export new user to database
    $stmt = $db->prepare("INSERT INTO \"Users\" (email, password_hash, sort_by)  
    VALUES(:email, :password_hash, :sort_by)");

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password_hash', $password_hash);
    $stmt->bindParam(':sort_by', $new);
    $stmt->execute();

    //Get user from database 
    $db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
    $result = $db->query("SELECT * FROM \"Users\" WHERE \"email\" = '$email'");
    $user = $result->fetch(PDO::FETCH_ASSOC);
    //Bind user settings to SESSION
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
}
