<?php
require('../functions.php');
require('header.php');
require('./nav.php');
logMessage();

if (isset($_SESSION['user']['name'])) {
    $userName = $_SESSION['user']['name'];
} else {
    $userName = 'IHaveNoName';
}

//Database connection
$db = new PDO('sqlite:../hacker_news_database.sqlite3');
?>
<form action="/Account/submit_post.php" method="post">
    <div class="post">
        <div class="date-section">
            <div class="left">
                <img src="/images/photo-1609050470947-f35aa6071497.jpeg" alt="">
                <p class="name"><?= $userName ?></p>
            </div>
            <div class="right">
                <p class="date"><?= 'future date' ?></p>
            </div>
        </div>
        <div class="image-section imageUploadSection">
            <img class="image-upload-placeholder" src="/images/image-placeholder.svg" alt="">
            <p>Click to upload image</p>
            <input class="hidden" type="file" name="file" id="file">
        </div>
        <div class="text-section">
            <div class="text-section-text">
                <input class="headline" placeholder="Headline" type="text" name="Headline" id="Headline">
                <input class="body" placeholder="This is an interesting block of text" type="text" name="Body" id="Body">
            </div>
            <div class="text-section-vote">
                <div class="img-container">
                    <img class="upvote" src="/assets/up-arrow.svg" alt="">
                </div>
                <p>42</p>
                <div class="img-container">
                    <img class="downvote" src="/assets/down-arrow.svg" alt="">
                </div>
            </div>
        </div>
        <div class="bottom-section">
        </div>
    </div>
    <label for="link">Link</label>
    <input placeholder="http://example.com" type="text" name="link" id="link">
    <input type="submit" value="Post">
</form>
<script src="../script/hamburger.js"></script>
<script src="../script/imageUpload.js"></script>

<?php createMessage(3) ?>