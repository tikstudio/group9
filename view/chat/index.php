<div id="chat" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <form method="post" id="searching">
                        <div class="input-group">

                            <input type="text" placeholder="Search..." name="search-friend" id="search"
                                   class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="card-body contacts_body">
                    <?php
                    foreach ($all_users as $user) {

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
                    ?>

                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <?php
                            $image = $user['image'] ? $user['image'] : 'user.png' ?>
                            <img src="<?= SITE_URL ?>/assets/images/<?= $image ?>"
                                 class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span><?= $user['user_name'] ?></span>
                            <!-- todo -->


                            <p><?= count($messages)?> Messages</p>

                            <?php foreach ($messages as $m) :


                                if ($user['id'] === $m['from']) {

                                } else {

                                }

                            endforeach; ?>
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

                        if ($user['id'] === $m['from']) {

                            include 'sender-message.php';
                        } else {
                            include 'friend-message.php';
                        }

                    endforeach; ?>
                </div>
                <form method="post" id="send_message" action="<?= SITE_URL ?>/chat/send-message" class="card-footer">
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