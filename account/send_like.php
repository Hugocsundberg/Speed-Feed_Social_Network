<?php

declare(strict_types=1);
require('../functions.php');

$postId = json_decode(file_get_contents('php://input'))->post_id;
$response = new stdClass();
//Connect to db 
$database_host = $_ENV['DB_HOST'];
$database_name = $_ENV['DB_NAME'];
$database_user = $_ENV['DB_USER'];
$database_port = $_ENV['DB_PORT'];
$database_password = $_ENV['DB_PASSWORD'];

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

$likesResult = $db->query("SELECT COUNT(\"user_id\") AS \"likes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = 1");
$likes = $likesResult->fetch(PDO::FETCH_ASSOC)['likes'];

//Fetch dislikes
$dislikeResult = $db->query("SELECT COUNT(\"user_id\") AS \"dislikes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = -1");
$dislikes = $dislikeResult->fetch(PDO::FETCH_ASSOC)['dislikes'];

$LikesSum = $likes - $dislikes;

//If user is not logged in, die
if (!isset($_SESSION['user'])) {
    //Send response to frontned
    //Fetch likes on post
    $likesResult = $db->query("SELECT COUNT(\"user_id\") AS \"likes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = 1");
    $likes = $likesResult->fetch(PDO::FETCH_ASSOC)['likes'];

    //Fetch dislikes
    $dislikeResult = $db->query("SELECT COUNT(\"user_id\") AS \"dislikes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = -1");
    $dislikes = $dislikeResult->fetch(PDO::FETCH_ASSOC)['dislikes'];

    $LikesSum = $likes - $dislikes;

    $response->post_likes = $LikesSum;
    $response->loggedIn = false;
    $response->type = 2;
    $response->likes = $LikesSum;
    $response->message = 'Hello!😊 Log in to vote';
    $JSON_response = json_encode($response);

    echo $JSON_response;
    die();
}

$user_id = $_SESSION['user']['id'];

//Check previous likes
$getLikes = $db->query("SELECT * from \"Likes\" WHERE \"user_id\" = $user_id AND \"post_id\" = $postId");
$getLikes_result = $getLikes->fetch(PDO::FETCH_ASSOC);

if (isset($getLikes_result['id']) && $getLikes_result['up_down'] === 1) {  //Post previously liked

    //Remove like from db 
    $db->query("DELETE FROM \"Likes\" WHERE \"user_id\" = $user_id AND \"post_id\" = $postId;");

    //Send response to frontned
    //Fetch likes on post
    $likesResult = $db->query("SELECT COUNT(\"user_id\") AS \"likes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = 1");
    $likes = $likesResult->fetch(PDO::FETCH_ASSOC)['likes'];

    //Fetch dislikes
    $dislikeResult = $db->query("SELECT COUNT(\"user_id\") AS \"dislikes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = -1");
    $dislikes = $dislikeResult->fetch(PDO::FETCH_ASSOC)['dislikes'];

    $LikesSum = $likes - $dislikes;

    $response->likes = $LikesSum;
    $response->post_likes = $LikesSum;
    $response->type = 1;
    $response->addedlikeCount = -1;
    $response->message = 'Your upvote was removed';
    $JSON_response = json_encode($response);
    echo $JSON_response;
    die();
    //Already liked post
} else if (!isset($getLikes_result['id'])) {
    //Send like to db 
    $like = 1;
    $stmt = $db->prepare("INSERT INTO \"Likes\" (\"user_id\", \"post_id\", \"up_down\") VALUES (:user_id, :post_id, :up_down)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $postId);
    $stmt->bindParam(':up_down', $like);
    $stmt->execute();

    //Send response to frontned
    //Fetch likes on post
    $likesResult = $db->query("SELECT COUNT(\"user_id\") AS \"likes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = 1");
    $likes = $likesResult->fetch(PDO::FETCH_ASSOC)['likes'];

    //Fetch dislikes
    $dislikeResult = $db->query("SELECT COUNT(\"user_id\") AS \"dislikes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = -1");
    $dislikes = $dislikeResult->fetch(PDO::FETCH_ASSOC)['dislikes'];

    $LikesSum = $likes - $dislikes;

    $response->likes = $LikesSum;
    $response->post_likes = $LikesSum;
    $response->type = 1;
    $response->addedlikeCount = 1;
    $response->message = 'You have upvoted the post';
    $JSON_response = json_encode($response);
    echo $JSON_response;
    die();
    //No like or dislike on post
}
if (isset($getLikes_result['id']) && $getLikes_result['up_down'] === -1) {
    //remove previous dislike
    $db->query("DELETE FROM \"Likes\" WHERE \"user_id\" = $user_id AND \"post_id\" = $postId;");

    //Send like to db 
    $like = 1;
    $stmt = $db->prepare("INSERT INTO \"Likes\" (\"user_id\", \"post_id\", \"up_down\") VALUES (:user_id, :post_id, :up_down)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $postId);
    $stmt->bindParam(':up_down', $like);
    $stmt->execute();

    //Send to frontend
    //Fetch likes on post
    $likesResult = $db->query("SELECT COUNT(\"user_id\") AS \"likes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = 1");
    $likes = $likesResult->fetch(PDO::FETCH_ASSOC)['likes'];

    //Fetch dislikes
    $dislikeResult = $db->query("SELECT COUNT(\"user_id\") AS \"dislikes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = -1");
    $dislikes = $dislikeResult->fetch(PDO::FETCH_ASSOC)['dislikes'];

    $LikesSum = $likes - $dislikes;

    $response->likes = $LikesSum;
    $response->post_likes = $LikesSum;
    $response->type = 1;
    $response->addedlikeCount = 2;
    $response->message = 'You have upvoted the post';
    $JSON_response = json_encode($response);
    echo $JSON_response;
    die();
    //Post previously disliked
}

$response->likes = 0;
$response->result = $getLikes_result;
$response->type = 2;
$response->message = 'Problem Occured... I will have to fix that';
$JSON_response = json_encode($response);
echo $JSON_response;
die();
