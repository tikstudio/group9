<div class="d-flex justify-content-start mb-4" data-id="<?= $m['id'] ?>">
    <div class="img_cont_msg">
        <?php $image = $user['image'] ? $user['image'] : 'user.png' ?>
        <img src="<?= SITE_URL ?>/assets/images/<?= $image ?>"
             class="rounded-circle user_img_ms">
    </div>
    <div class="msg_cotainer">
        <?= $m['message'] ?>

        <?php
        $attachment = isset($m['attachment']) ? $m['attachment'] : '';
        new \includes\Attachment($attachment)
        ?>
        <span class="msg_time">
            <?= \includes\Date::computeDate($m['date']) ?>
            <?php if ($m['seen'] === '1') : ?>
                <i class="fas fa-check text-blue"></i>
            <?php endif; ?>
        </span>
    </div>
</div>


