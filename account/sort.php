<?php
require('../functions.php');
$contents = file_get_contents('php://input');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    //Connect to db
    $database_host = $_ENV['DB_HOST'];
    $database_name = $_ENV['DB_NAME'];
    $database_user = $_ENV['DB_USER'];
    $database_port = $_ENV['DB_PORT'];
    $database_password = $_ENV['DB_PASSWORD'];

    $db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");
    $stmt = $db->prepare("UPDATE \"Users\" SET \"sort_by\" = :sort WHERE \"id\" = :userId");
    $stmt->bindParam(':sort', $contents);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
} else {
    $_SESSION['sort'] = $contents;
}
