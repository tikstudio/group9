
<?php
defined('SITE_URL') or exit;
?>
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Registration</h2>
                <form action="<?= SITE_URL ?>/register" method="POST" class="register-form" id="register-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <?php if (isset($errors['name'])) : ?>
                            <p class="form_error"><?= $errors['name'] ?></p>
                        <?php endif ?>
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name"/>
                    </div>
                    <div class="form-group">
                        <?php if (isset($errors['email'])) : ?>
                            <p class="form_error"><?= $errors['email'] ?></p>
                        <?php endif ?>
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email"/>
                    </div>
                    <div class="form-group">
                        <?php if (isset($errors['pass'])) : ?>
                            <p class="form_error"><?= $errors['pass'] ?></p>
                        <?php endif ?>
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <?php if (isset($errors["re_pass"])) : ?>
                            <p class="form_error"><?= $errors['re_pass'] ?></p>
                        <?php endif ?>
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                    </div>
                    <div class="form-group">

                        <input type="file" name="img" class="form-control" class="file"/>
                        <?php
                        //TODO img
                        if (isset($errors['img'])) : ?>
                            <p class="form_error"><?= $errors['img'] ?></p>
                        <?php endif ?>
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"/>
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                            statements in
                            <a href="#" class="term-service">Terms of service</a>
                        </label>
                        <?php if (isset($errors['agree-term'])) : ?>
                            <p class="form_error"><?= $errors['agree-term'] ?></p>
                        <?php endif ?>

                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="<?= SITE_URL ?>/assets/images/signup-image.jpg" alt="sing up image"></figure>
            </div>
        </div>
    </div>
</section>

