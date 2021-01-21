<?php
require('../functions.php');
session_destroy();
createMessage(1, 'You have been logged out');
redirect('/views/index.php');
