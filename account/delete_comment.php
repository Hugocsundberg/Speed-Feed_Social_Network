<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$user_id = intval($_SESSION['user']['id']);
$commentId = intval($data->commentId);

//Connect to db
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
$db->query("DELETE FROM \"Comments\" WHERE \"id\" = $commentId");
