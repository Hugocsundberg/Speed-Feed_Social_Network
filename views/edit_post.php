<?php
require('../functions.php');
require('header.php');
require('nav.php');
logMessage();

if (isset($_SESSION['user']['name'])) {
    $userName = $_SESSION['user']['name'];
} else {
    $userName = 'IHaveNoName';
}

//Vars
$postId = $_GET['postId'];
$headline = $_GET['headline'];
$body = $_GET['body'];
$link = $_GET['link'];
$imgSource = $_GET['img_source'];
$profileImgSource = $_GET['profile_img_source'];

//Database connection
// $db = new PDO('sqlite:../hacker_news_database.sqlite3');
?>
<script src="../script/Classes/Smooth.js"></script>
<script src="../script/landing.js"></script>
<form id="edit-post" class="create-post-form" action="/Account/update_post.php" method="post">
    <div class="post">
        <div class="date-section">
            <div class="left">
                <img src="<?= $profileImgSource ?>" alt="">
                <p class="name"><?= $userName ?></p>
            </div>
            <div class="right">
                <p class="date"><?= 'future date' ?></p>
            </div>
        </div>
        <div class="image-section">
            <img src="<?= $imgSource ?>" alt="">
        </div>
        <div class="text-section">
            <div class="text-section-text">
                <input class="headline" maxlength="20" value="<?= $headline ?>" type="text" name="headline" id="headline">
                <textarea class="body" type="text" name="body" id="body" form="edit-post"><?= $body ?></textarea>
            </div>
            <div class="text-section-vote">
                <div class="img-container">
                    <img class="upvote" src="/images/upvote.svg" alt="">
                </div>
                <p>42</p>
                <div class="img-container">
                    <img class="downvote" src="/images/downvote.svg" alt="">
                </div>
            </div>
        </div>
        <div class="bottom-section">
        </div>
    </div>
    <div class="link-submit-container">
        <label class="link-label" for="link">Link</label>
        <input class="link-input input-field" value="<?= $link ?>" type="text" name="link" id="link">
        <input type="text" class="hidden" name="id" value="<?= $postId ?> ">
        <input class="inactive link-button" type="submit" value="Update">
    </div>
</form>
<script src="../script/hamburger.js"></script>
<script src="../script/edit_post_page.js"></script>

<?php createMessage(3) ?>