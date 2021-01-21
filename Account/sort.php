<?php
require('../functions.php');
$contents = file_get_contents('php://input');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    //Connect to db
    $db = new PDO('sqlite:../hacker_news_database.sqlite3');
    $stmt = $db->prepare("UPDATE Users SET sort_by = :sort WHERE id = :userId");
    $stmt->bindParam(':sort', $contents);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
} else {
    $_SESSION['sort'] = $contents;
}
