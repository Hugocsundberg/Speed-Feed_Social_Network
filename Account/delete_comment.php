<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$user_id = intval($_SESSION['user']['id']);
$commentId = intval($data->commentId);

//Connect to db
$db = new PDO('sqlite:../hacker_news_database.sqlite3');
$db->query("DELETE FROM COMMENTS WHERE id = $commentId");
