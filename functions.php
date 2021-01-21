<?php

declare(strict_types=1);
session_start();
if (isset($_SESSION['message'])) {
} else {
    $_SESSION['message'] = [];
}

function createMessage(int $type, string $message = 'ok')
{
    $messageArray = ['type' => $type, 'message' => $message];
    array_push($_SESSION['message'], $messageArray);
}

function logMessage()
{
    $errorArray = [];
    if (count($_SESSION['message']) > 0) { //Only try logging if array is not empty
        foreach (($_SESSION['message']) as $message) {
            if ($message['type'] !== 3) {
                $errorArray[] = $message['message'];
            } else {
                $errorArray = [];
            }
        }
        if (count($errorArray) > 0) {
            print_r($errorArray);
        }
    }
}

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// function errorLog(string $errorMessage)
// {
//     $errors = file_get_contents(__DIR__ . '/errors.json');
//     $decodedJSON = json_decode($errors);
//     $errorObject = new stdClass;
//     $errorObject->error = $errorMessage;
//     $decodedJSON[] = $errorObject;
//     $encodedJSON = json_encode($decodedJSON);
//     file_put_contents('../errors.json', $encodedJSON);
// }

// function errorPrint()
// {
//     $errors = file_get_contents(__DIR__ . '/errors.json');
//     $decodedJSON = json_decode($errors);
//     foreach ($decodedJSON as $error) {
//         echo $error->error;
//     }
// }
