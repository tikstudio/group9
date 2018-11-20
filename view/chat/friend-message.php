<div class="d-flex justify-content-end mb-4">
    <div class="msg_cotainer_send">
        <?= $m['message'] ?>
        <span class="msg_time_send">
            <?= \includes\Date::computeDate($m['date']) ?>
        </span>

    </div>
    <div class="img_cont_msg">
        <?php $image = $friend['image'] ? $friend['image'] : 'user.png' ?>
        <img src="<?= SITE_URL ?>/assets/images/<?= $image ?>"
             class="rounded-circle user_img_msg">
    </div>
</div>
