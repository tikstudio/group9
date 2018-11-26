<div class="d-flex justify-content-start mb-4">
    <div class="img_cont_msg">
        <?php $image = $user['image'] ? $user['image'] : 'user.png' ?>
        <img src="<?= SITE_URL ?>/assets/images/<?= $image ?>"
             class="rounded-circle user_img_ms">
    </div>
    <div class="msg_cotainer">
        <?= $m['message'] ?>
        <?php
        $attachment= '';
        $attachment = $m['attachment'] ? $m['attachment'] : '';
        if (preg_match("/[^\s]+\S+\.(jpg|png|gif)/", $attachment)){
            ?>
            <div class="uploads">
                <img src="<?=SITE_URL ?>/assets/images/uploads/<?=$m['attachment'] ?>" alt="">
            </div>
        <?php
        }else if(preg_match("/[^\s]+\S+\.(pdf)/", $attachment)){
            ?>
            <a href="<?= $m['attachment'] ?>" download=""><?=$m['attachment'] ?></a>
        <?php
        }else if(preg_match("/[^\s]+\S+\.(webm|mp4|ogv)/", $attachment)){

            ?>
            <video width="320" height="240" controls>
                <source src="<?= $m['attachment']?>" type="video/mp4">
                <source src="<?= $m['attachment']?>" type="video/ogg">
                <source src="<?= $m['attachment']?>" type="video/webm">
                Your browser does not support the video tag.
            </video>

            <?php
        }

        ?>
        <span class="msg_time">
            <?= \includes\Date::computeDate($m['date']) ?>
            <?php if ($m['seen'] === '1') : ?>
                <i class="fas fa-check text-blue"></i>
            <?php endif; ?>
        </span>
    </div>
</div>


