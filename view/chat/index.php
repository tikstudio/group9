<div id="chat" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." name="" class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body">
                    <ui class="contacts">
                        <?php foreach ($all_users as $u) : ?>
                            <li class="active">
                                <a href="?friend=<?= $u['id'] ?>">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
<!--                                            --><?php //$img = $u['id'] == $user['id'] ? 'user' : 'user2' ?>
                                            <img src="<?= SITE_URL ?>/assets/images/<?= $u['image'] ?>"
                                                 class="rounded-circle user_img">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span><?= $u['user_name'] ?></span>
                                            <p>Maryam is online</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ui>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="<?= SITE_URL ?>/assets/images/<?= $u['image'] ?>"
                                 class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span><?= $user['user_name'] ?></span>
                            <p>1767 Messages</p>
                        </div>
                        <div class="video_cam">
                            <span><i class="fas fa-video"></i></span>
                            <span><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                    <div class="action_menu">
                        <ul>
                            <li><i class="fas fa-user-circle"></i> View profile</li>
                            <li><i class="fas fa-users"></i> Add to close friends</li>
                            <li><i class="fas fa-plus"></i> Add to group</li>
                            <li><i class="fas fa-ban"></i> Block</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body msg_card_body">
                    <?php foreach ($messages as $m) :
                        if ($user['id'] === $m['from']): ?>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="<?= SITE_URL ?>/assets/images/<?= $u['image'] ?>"
                                         class="rounded-circle user_img_ms">
                                </div>
                                <div class="msg_cotainer">
                                    <?= $m['message'] ?>
                                    <span class="msg_time"><?= $m['date'] ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    <?= $m['message'] ?>
                                    <span class="msg_time_send"><?= $m['date'] ?></span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="<?= SITE_URL ?>/assets/images/<?= $u['image'] ?>"
                                         class="rounded-circle user_img_ms">
                                </div>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
                <form method="post" action="<?= SITE_URL ?>/chat/send-message" class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <textarea name="message" class="form-control type_msg"
                                  placeholder="Type your message..."></textarea>
                        <input type="hidden" name="friend_id" value="<?= $friend_id ?>">
                        <div class="input-group-append">
                            <button class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>