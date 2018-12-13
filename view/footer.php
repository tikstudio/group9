</div>

<script src="<?= SITE_URL ?>/assets/scripts/jquery.min.js"></script>
<script src="<?= SITE_URL ?>/assets/scripts/emojionearea.min.js"></script>


<script src="<?= SITE_URL ?>/assets/scripts/script.js"></script>

<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?= FACEBOOK_APP_ID ?>',
            cookie: true,
            xfbml: true,
            version: 'v3.2'
        });

        FB.AppEvents.logPageView();
    };

    function checkLoginState() {
        FB.getLoginStatus((response) => {
            if (response.status === 'connected') {
                const accessToken = response.authResponse.accessToken
                window.location.href = window.location.pathname + '?fb_token=' + accessToken
            } else if (response.status === 'not_authorized') {
                console.warn(`Auth error ${response.status}`)
            }
        })
        return false
    }

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>