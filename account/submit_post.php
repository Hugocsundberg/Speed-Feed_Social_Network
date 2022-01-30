<?php

declare(strict_types=1);
require('../functions.php');

//Submitted information
$headline = $_POST['Headline'];
$body = $_POST['Body'];
$link = $_POST['link'];

//Image
if ($_FILES['file']['size'] > 0) {
    echo 'image exists';

    // File proporties
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $fileNameExploded = explode('.', $file_name);
    $file_extention = end($fileNameExploded);
    $file_name_new = "post_image" . time() . rand(0, getrandmax()) . rand(0, getrandmax()) . '.' . $file_extention;
    $file_destination = __DIR__ . '/uploads/' . $file_name_new;
    $file_relative_path = '/account/uploads/' . $file_name_new;

    if ($file_size < 5000000) {
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        createMessage(2, 'Im sorry, upload an image smaller than 5MB');
    }

    echo $file_name_new;
} else {
    $file_destination = 'default';
}

//Other variables
if (isset($_SESSION['user']['name'])) {
    $userName = $_SESSION['user']['name'];
} else {
    $userName = 'Anonymous';
}

if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    $userId = 12;
}

$dateNow = time();


//Database connection
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

$statement = $db->prepare("INSERT INTO \"Posts\" (\"user_id\", \"header\", \"body\", \"date\", \"link\", \"image_path\") VALUES (:user_id, :header, :body, :date, :link, :image_path)");
$statement->bindParam(':user_id', $userId);
$statement->bindParam(':header', $headline);
$statement->bindParam(':body', $body);
$statement->bindParam(':date', $dateNow);
$statement->bindParam(':date', $dateNow);
$statement->bindParam(':link', $link);
$statement->bindParam(':image_path', $file_relative_path);
$statement->execute();

redirect('/index.php');
