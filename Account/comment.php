<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$body = $data->value;
$postId = $data->postId;
$date = time();
$userId = $_SESSION['user']['id'];

//Connect to database
$db = new PDO('sqlite:../hacker_news_database.sqlite3');
$stmt = $db->prepare("INSERT INTO COMMENTS (user_id, post_id, body, date) VALUES (:user_id, :post_id, :body, :date)");

$stmt->bindParam(':user_id', $userId);
$stmt->bindParam(':post_id', $postId);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':date', $date);
$stmt->execute();
