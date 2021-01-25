<?php

declare(strict_types=1);
require('../functions.php');
$user_id = $_SESSION['user']['id'];

$headline = $_POST['headline'];
$body = $_POST['body'];
$link = $_POST['link'];
$postId = $_POST['id'];

//db connection
$database_host = 'ec2-34-251-118-151.eu-west-1.compute.amazonaws.com';
$database_name = 'd2m7cahbqat10u';
$database_user = 'ibmysphorhuxnp';
$database_port = '5432';
$database_password = '17d71d5877ce8f94d8d912acdc727e8dd69d290548b93a22d0bc8c0b9b07489f';

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

$stmt = $db->prepare("UPDATE \"Posts\" SET \"header\" = :header, \"body\" = :body, \"link\" = :link WHERE \"id\" = :postid");
$stmt->bindParam(':header', $headline);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':link', $link);
$stmt->bindParam(':postid', $postId);
$stmt->execute();
createMessage(1, 'Post har uppdaterats');




redirect('/index.php');
