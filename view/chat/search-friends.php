<?php
if (!empty($search_result)) {
    foreach ($search_result as $user) {
        ?>
        <ui class="active">
            <a href="?friend=<?= $user['id'] ?>">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <?php $image = $user['image'] ? $user['image'] : 'user2.png' ?>
                        <img src="<?= SITE_URL ?>/assets/images/<?= $image ?>"
                             class="rounded-circle user_img">
                        <span class="online_icon"></span>
                    </div>
                    <div class="user_info">
                        <span><?= $user['user_name'] ?></span>
                        <p>Maryam is online</p>
                    </div>
                </div>
            </a>
        </ui>
        <?php
    }
} else {
    echo 'No Result';
}


?>