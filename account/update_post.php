<?php

declare(strict_types=1);
require('../functions.php');
$user_id = $_SESSION['user']['id'];

$headline = $_POST['headline'];
$body = $_POST['body'];
$link = $_POST['link'];
$postId = $_POST['id'];

//db connection
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

$stmt = $db->prepare("UPDATE \"Posts\" SET \"header\" = :header, \"body\" = :body, \"link\" = :link WHERE \"id\" = :postid");
$stmt->bindParam(':header', $headline);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':link', $link);
$stmt->bindParam(':postid', $postId);
$stmt->execute();
createMessage(1, 'Post har uppdaterats');




redirect('/index.php');
