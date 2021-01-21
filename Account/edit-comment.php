<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$postId = intval($data->postId);
$body = $data->body;
$commentId = intval($data->commentId);
$time = time();
$user_id = intval($_SESSION['user']['id']);

//Connect to db
$db = new PDO('sqlite:../hacker_news_database.sqlite3');

$stmt = $db->prepare("UPDATE COMMENTS SET user_id = :user_id, post_id = :post_id, body = :body, date = :date WHERE id = :id");
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':post_id', $postId);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':date', $time);
$stmt->bindParam(':id', $commentId);
$stmt->execute();
