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
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

$stmt = $db->prepare("UPDATE \"Comments\" SET \"user_id\" = :user_id, \"post_id\" = :post_id, \"body\" = :body, \"date\" = :date WHERE \"id\" = :id");
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':post_id', $postId);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':date', $time);
$stmt->bindParam(':id', $commentId);
$stmt->execute();
