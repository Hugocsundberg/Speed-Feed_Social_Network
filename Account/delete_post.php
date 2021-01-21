<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$user_id = intval($_SESSION['user']['id']);
$postId = intval($data->postId);

//Connect to db
$db = new PDO('sqlite:../hacker_news_database.sqlite3');
$db->query("DELETE FROM Posts WHERE id = $postId");
