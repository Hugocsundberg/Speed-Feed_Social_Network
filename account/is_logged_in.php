<?php
require '../functions.php';

if (isset($_SESSION['user']['id'])) {
    echo json_encode($_SESSION['user']);
} else {
    echo 'false';
}
