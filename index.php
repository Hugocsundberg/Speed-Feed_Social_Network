<?php
require(__DIR__ . '/views/header.php');
require(__DIR__ . '/functions.php');
logMessage();

$database_host = 'ec2-34-251-118-151.eu-west-1.compute.amazonaws.com';
$database_name = 'd2m7cahbqat10u';
$database_user = 'ibmysphorhuxnp';
$database_port = '5432';
$database_password = '17d71d5877ce8f94d8d912acdc727e8dd69d290548b93a22d0bc8c0b9b07489f';

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");


if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $stmt = $db->prepare("SELECT \"sort_by\" FROM \"Users\" where \"id\" = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $sort_by = $data['sort_by'];
} else {
    if (isset($_SESSION['sort'])) {
        $sort_by = $_SESSION['sort'];
    } else {
        $sort_by = 'new';
    }
}

$result;
if ($sort_by === 'new') {
    $result = $db->query("SELECT * FROM \"Posts\" ORDER BY \"date\" DESC LIMIT 30");
} else if ($sort_by === 'mostupvoted') {
    $result = $db->query("SELECT \"id\", \"user_id\", \"header\", \"body\", \"date\", \"link\", \"image_path\", COALESCE((SELECT sum(\"up_down\") FROM \"Likes\" where \"Posts\".\"id\"=\"Likes\".\"post_id\"), 0) AS \"antallikes\" FROM \"Posts\" ORDER BY \"antallikes\" DESC LIMIT 30;");
}

$posts = $result->fetchAll(PDO::FETCH_ASSOC);




?>

<body>

    <?php require(__DIR__ . '/views/nav.php') ?>
    <script src="../script/landing.js"></script>
    <div class="post-flex-container">
        <div class="content-container">
            <select class="sort-by" name="sort" id="">
                <option <?php if ($sort_by === 'new') {
                            echo 'selected';
                        } ?>value="new">Sort by: New 💎</option>
                <option <?php if ($sort_by === 'mostupvoted') {
                            echo 'selected';
                        } ?> value="mostupvoted">Sort by: Upvotes 💯</option>
            </select>
            <button class="button press-bounce">Create Post</button>
        </div>
        <?php foreach ($posts as $post) : ?>
            <?php
            $postId = $post['id'];
            // if ($post['image_path'] === 'default' || null) {
            //     $postImagePath = 'images/photo-1609050470947-f35aa6071497.jpeg';
            // } else {
            //     $postImagePath = $post['image_path'];
            // }
            $postImagePath = $post['image_path'];
            if ($postImagePath === null) {
                $postImagePath = 'images/image-placeholder-landing.svg';
            }
            $upvoteImage = '/images/upvote.svg';
            $downvoteImage = '/images/downvote.svg';

            if (isset($_SESSION['user'])) {
                $hasLikedResult = $db->query("SELECT * FROM \"Likes\" WHERE \"post_id\" = $postId AND \"user_id\" = $userId AND \"up_down\" = 1");
                $hasLikedData = $hasLikedResult->fetch(PDO::FETCH_ASSOC);
                if (isset($hasLikedData['id'])) {
                    $hasLiked = true;
                    $upvoteImage = '/images/upvoteActive.svg';
                } else {
                    $hasLiked = false;
                    $upvoteImage = '/images/upvote.svg';
                }

                $hasDislikedResult = $db->query("SELECT \"id\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"user_id\" = $userId AND \"up_down\" = -1");
                $hasDislikedData = $hasDislikedResult->fetch(PDO::FETCH_ASSOC);
                if (isset($hasDislikedData['id'])) {
                    $hasDisliked = true;
                    $downvoteImage = '/images/downvoteActive.svg';
                } else {
                    $hasDisliked = false;
                    $downvoteImage = '/images/downvote.svg';
                }
            } else {
                $hasLiked = false;
                $hasDisliked = false;
            }



            //Fetch all comments on post
            $commentResult = $db->query("SELECT * FROM \"Comments\" WHERE \"post_id\" = $postId");
            $comments = $commentResult->fetchAll(PDO::FETCH_ASSOC);

            //Fetch likes on post
            $likesResult = $db->query("SELECT COUNT(\"user_id\") AS \"likes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = 1");
            $likes = $likesResult->fetch(PDO::FETCH_ASSOC)['likes'];




            //Fetch dislikes
            $dislikeResult = $db->query("SELECT COUNT(user_id) AS \"dislikes\" FROM \"Likes\" WHERE \"post_id\" = $postId AND \"up_down\" = -1");
            $dislikes = $dislikeResult->fetch(PDO::FETCH_ASSOC)['dislikes'];

            $LikesSum = $likes - $dislikes;

            //Fetch user from database
            $postUserId = $post['user_id'];
            $result = $db->query("SELECT * FROM \"Users\" WHERE \"id\" = $postUserId");
            $user = $result->fetch(PDO::FETCH_ASSOC);
            isset($user['avatar_path']) ? $avatarPath = $user['avatar_path'] : $avatarPath = '/Account/uploads/default.svg';

            //If user has a name, set it to $userName
            if (isset($user['name'])) {
                $userName = $user['name'];
            } else {
                $userName = 'IHaveNoName';
            }
            $arrowPositionClass = "";
            if (!isset($_SESSION['user']) || $post['user_id'] !== $_SESSION['user']['id']) {
                $arrowPositionClass = "arrowSectionMoveDown";
            } else {
                $arrowPositionClass = "arrowSectionMoveUp";
            }




            ?>


            <div data-postId="<?= $postId ?>" class="post id<?= $postId ?> post-group<?= $postId ?>">
                <div class="date-section">
                    <div class="left">
                        <img src=<?= $avatarPath ?> alt="">
                        <p class="name"><?= $userName ?></p>
                    </div>
                    <div class="right">
                        <p class="date">Date: <?= date('d-m-y', $post['date']) ?></p>
                    </div>
                </div>
                <a href="<?= $post['link'] ?>">
                    <div class="image-section">
                        <img src="<?= $postImagePath ?>" alt="">
                    </div>
                </a>
                <div class="text-section">
                    <div class="text-section-text">
                        <h2><?= $post['header'] ?></h2>
                        <p><?= $post['body'] ?></p>
                    </div>

                    <div class="<?= $arrowPositionClass ?> text-section-vote" data-post="<?= $post['id'] ?>">
                        <div class="upvote-section img-container press-bounce">
                            <img class="upvote <?= $hasLiked ? 'upvote-active' : 'upvoteInactive' ?>" src="<?= $upvoteImage ?>" alt="">
                        </div>
                        <p><?= $LikesSum ?></p>
                        <div class="downvote-section img-container press-bounce">
                            <img class="downvote <?= $hasDisliked ? 'downvote-active' : 'downvoteInactive' ?>" src="<?= $downvoteImage ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="bottom-section">
                    <div class="left">
                        <button class="post-coment-button">comment</button>
                    </div>
                    <?php if (isset($_SESSION['user']) && $post['user_id'] === $_SESSION['user']['id']) : ?>
                        <div class="right">
                            <button class="button post-edit-button press-bounce">Edit</button>
                            <button class="button post-delete-button press-bounce">Delete</button>
                        </div>
                    <?php endif ?>
                </div>
            </div>

            <?php foreach ($comments as $comment) : ?>
                <?php
                $commenter_id = $comment['user_id'];
                $result = $db->query("SELECT \"name\" FROM \"Users\" WHERE \"id\" = $commenter_id");
                $data = $result->fetch(PDO::FETCH_ASSOC);
                $commentId = $comment['id'];

                //Fetch commenter
                $commenterId = $comment['user_id'];
                $result = $db->query("SELECT * FROM \"Users\" WHERE \"id\" = $commenterId");
                $commenter = $result->fetch(PDO::FETCH_ASSOC);
                isset($commenter['avatar_path']) ? $commentImageURL = $commenter['avatar_path'] : $commentImageURL = '/Account/uploads/default.svg';

                //If user has a name, set it to $userName
                if (isset($data['name'])) {
                    $commenter_name = $data['name'];
                } else {
                    $commenter_name = 'IHaveNoName';
                }
                ?>
                <div data-postId="<?= $postId ?>" data-id="<?= $commentId ?>" class="comment post<?= $postId ?> post-group<?= $postId ?> comment-id<?= $commentId ?>">
                    <div class="upper">
                        <div class="left">
                            <img src=<?= $commentImageURL ?> alt="">
                            <p class="name"><?= $commenter_name ?></p>
                        </div>
                        <div class="right">
                            <p class="date">Date: <?= date('d-m-y', $comment['date']) ?></p>
                        </div>
                    </div>
                    <div class="lower">
                        <div class="left">
                            <p class="comment-paragraph"><?= $comment['body'] ?></p>
                        </div>
                        <?php if (isset($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) : ?>
                            <div class="right">
                                <button class="edit-button button press-bounce">Edit</button>
                                <button class="delete-button button press-bounce">Delete</button>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endforeach ?>
    </div>
    <script src="../script/like.js"></script>
    <script src="../script/delete_post.js"></script>
    <script src="../script/edit_comment.js"></script>
    <script src="../script/edit_post.js"></script>
    <script src="../script/scroll.js"></script>
    <script src="../script/comment.js"></script>
    <script src="../script/sort.js"></script>
    <script src="../script/hamburger.js"></script>
    <script src="../script/functions.js"></script>
    <script src="../script/smoothRedirectButtons.js"></script>
    <script src="../script/Classes/ConfirmationBox.js"></script>
</body>
<?php createMessage(3) ?>

<?php require('views/footer.php') ?>