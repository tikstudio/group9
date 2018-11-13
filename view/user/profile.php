<?php
defined('SITE_URL') or exit;
?>
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Profile edit</h2>
                <form action="<?= SITE_URL ?>/user" method="POST" class="register-form" id="register-form">
                    <div class="form-group">
                        <?php if (isset($errors['email'])) : ?>
                            <p class="form_error"><?= $errors['email'] ?></p>
                        <?php endif ?>
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input value="<?= $user['email'] ?>" type="email" name="email" id="email"
                               placeholder="Your Email"/>
                    </div>
                    <div class="form-group">
                        <?php if (isset($errors['new_name'])) : ?>
                            <p class="form_error"><?= $errors['new_name'] ?></p>
                        <?php endif ?>
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input value="<?= $user['user_name'] ?>" type="text" name="new_name" id="name"
                               placeholder="New Name"/>
                    </div>
                    <div class="form-group">
                        <?php if (isset($errors['new_pass'])) : ?>
                            <p class="form_error"><?= $errors['new_pass'] ?></p>
                        <?php endif ?>
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="new_pass" id="pass" placeholder="New Password"/>
                    </div>
                    <div class="form-group">
                        <?php if (isset($errors["new_re_pass"])) : ?>
                            <p class="form_error"><?= $errors['new_re_pass'] ?></p>
                        <?php endif ?>
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="new_re_pass" id="re_pass" placeholder="Repeat your new password"/>
                    </div>

                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Edit"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="<?= SITE_URL ?>/assets/images/team_graphic.png" alt="sing up image"></figure>
            </div>
        </div>
    </div>
</section>

