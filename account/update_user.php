<?php

declare(strict_types=1);
require('../functions.php');
$user_id = $_SESSION['user']['id'];

// Other
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);
$bio = $_POST['bio'];
$user_id = $_SESSION['user']['id'];

//db connection
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

//Image
if ($_FILES['file']['size'] > 0) {

    //File proporties
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $fileNameExploded = explode('.', $file_name);
    $file_extention = end($fileNameExploded);
    $file_name_new = "profile_picture" . $user_id . '.' . $file_extention;
    $file_destination = __DIR__ . '/uploads/' . $file_name_new;
    $file_relative_path = '/account/uploads/' . $file_name_new;

    if ($file_size < 5000000) {
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        createMessage(2, 'Im sorry, upload an image smaller than 5MB');
    }


    //Add avatar path to db
    $stmt = $db->prepare("UPDATE \"Users\" SET \"avatar_path\" = :file_destination WHERE \"id\" = :user_id");
    $stmt->bindParam(':file_destination', $file_relative_path);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

//Add other to db
if ($name !== '') {
    $stmt = $db->prepare("UPDATE \"Users\" SET \"name\" = :name WHERE \"id\" = :user_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}
if ($email !== '') {
    $stmt = $db->prepare("UPDATE \"Users\" SET \"email\" = :email WHERE \"id\" = :user_id");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}
if ($password !== '') {
    $stmt = $db->prepare("UPDATE \"Users\" SET \"password_hash\" = :password_hash WHERE \"id\" = :user_id");
    $stmt->bindParam(':password_hash', $password_hash);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}
if ($bio !== '') {
    $stmt = $db->prepare("UPDATE \"Users\" SET \"bio\" = :bio WHERE \"id\" = :user_id");
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

createMessage(1, 'Account information has updated');

//Get user 
$result = $db->query("SELECT * FROM \"Users\" WHERE \"email\" = '$email'");
$user = $result->fetch(PDO::FETCH_ASSOC);
//Update session
$_SESSION['user'] = $user;


redirect('/index.php');
