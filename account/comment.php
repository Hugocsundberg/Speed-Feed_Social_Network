<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$body = $data->value;
$postId = $data->postId;
$date = time();
$userId = $_SESSION['user']['id'];

//Connect to database
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
$stmt = $db->prepare("INSERT INTO \"Comments\" (\"user_id\", \"post_id\", \"body\", \"date\") VALUES (:user_id, :post_id, :body, :date)");

$stmt->bindParam(':user_id', $userId);
$stmt->bindParam(':post_id', $postId);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':date', $date);
$stmt->execute();
