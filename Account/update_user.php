<?php

declare(strict_types=1);
require('../functions.php');
$user_id = $_SESSION['user']['id'];

// Other
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);
$bio = $_POST['bio'];
$user_id = $_SESSION['user']['id'];

//db connection
$db = new PDO('sqlite:../hacker_news_database.sqlite3');





//Image
if (isset($_FILES['file'])) {

    //File proporties
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $fileNameExploded = explode('.', $file_name);
    $file_extention = end($fileNameExploded);
    $file_name_new = "profile_picture" . $user_id . '.' . $file_extention;
    $file_destination = __DIR__ . '/uploads/' . $file_name_new;
    $file_relative_path = '/Account/uploads/' . $file_name_new;

    if ($file_size < 300000) {
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        createMessage(2, 'Image is too large :C make smol');
    }


    //Add avatar path to db
    $stmt = $db->prepare("UPDATE Users SET avatar_path = :file_destination WHERE id = :user_id");
    $stmt->bindParam(':file_destination', $file_relative_path);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

//Add other to db
if ($name !== '') {
    $stmt = $db->prepare("UPDATE Users SET name = :name WHERE id = :user_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    createMessage(1, 'Namn har uppdaterats');
}
if ($email !== '') {
    $stmt = $db->prepare("UPDATE Users SET email = :email WHERE id = :user_id");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    createMessage(1, 'Email har uppdaterats');
}
if ($password !== '') {
    $stmt = $db->prepare("UPDATE Users SET password_hash = :password_hash WHERE id = :user_id");
    $stmt->bindParam(':password_hash', $password_hash);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    createMessage(1, 'Password har uppdaterats');
}
if ($bio !== '') {
    $stmt = $db->prepare("UPDATE Users SET bio = :bio WHERE id = :user_id");
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    createMessage(1, 'Bio har uppdaterats');
}



redirect('/views/account.php');
