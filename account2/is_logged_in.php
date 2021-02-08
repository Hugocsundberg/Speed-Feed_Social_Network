<?php
require '../functions.php';

if (isset($_SESSION['user']['id'])) {
    echo 'true';
} else {
    echo 'false';
}
