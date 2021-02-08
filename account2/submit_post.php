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

    if ($file_size < 300000) {
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        createMessage(2, 'Image is too large :C make smol');
    }

    echo $file_name_new;
} else {
    $file_destination = 'default';
}

//Other variables
if (isset($_SESSION['user']['name'])) {
    $userName = $_SESSION['user']['name'];
} else {
    $userName = 'IHaveNoName';
}

if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    $userId = 12;
}

$dateNow = time();


//Database connection
$database_host = 'ec2-34-251-118-151.eu-west-1.compute.amazonaws.com';
$database_name = 'd2m7cahbqat10u';
$database_user = 'ibmysphorhuxnp';
$database_port = '5432';
$database_password = '17d71d5877ce8f94d8d912acdc727e8dd69d290548b93a22d0bc8c0b9b07489f';

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
