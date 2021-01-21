<?php

declare(strict_types=1);
require('../functions.php');
$user_id = $_SESSION['user']['id'];

$headline = $_POST['headline'];
$body = $_POST['body'];
$link = $_POST['link'];
$postId = $_POST['id'];

//db connection
$db = new PDO('sqlite:../hacker_news_database.sqlite3');

$stmt = $db->prepare("UPDATE Posts SET header = :header, body = :body, link = :link WHERE id = :postid");
$stmt->bindParam(':header', $headline);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':link', $link);
$stmt->bindParam(':postid', $postId);
$stmt->execute();
createMessage(1, 'Post har uppdaterats');




redirect('/views/index.php');
